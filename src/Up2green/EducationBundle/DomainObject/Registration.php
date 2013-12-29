<?php
namespace Up2green\EducationBundle\DomainObject;

use Doctrine\Common\Persistence\ObjectManager;
use Stof\DoctrineExtensionsBundle\Uploadable\UploadableManager;
use Symfony\Component\Routing\Router;
use Symfony\Component\Translation\Translator;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Up2green\EducationBundle\Entity\Classroom;
use Up2green\EducationBundle\DomainObject\School;
use Up2green\CommonBundle\Entity\Voucher;
use Up2green\UserBundle\Entity\User;

/**
 * Registration domain object
 */
class Registration
{
    /**
     * @Assert\Valid()
     */
    public $account;

    /**
     * @Assert\Valid()
     */
    public $classroom;

    /**
     * @Assert\Valid()
     */
    public $school;

    /**
     * @var Voucher
     */
    protected $voucher;

    /**
     * @var ObjectManager
     */
    protected $manager;

    /**
     * @var \Swift_Mailer
     */
    protected $mailer;

    /**
     * @var Translator
     */
    protected $translator;

    /**
     * @var UploadableManager
     */
    protected $uploader;

    /**
     * @var Router
     */
    protected $router;

    /**
     * @param User              $account    The account
     * @param Classroom         $classroom  The classroom
     * @param School            $school     The school
     * @param \Swift_Mailer     $mailer     The mailer
     * @param Translator        $translator The translator service
     * @param UploadableManager $uploader   The Uploader manager
     * @param Router            $router     The router
     * @param ObjectManager     $manager    The persistent manager
     */
    public function __construct(Voucher $voucher, \Swift_Mailer $mailer, Translator $translator, UploadableManager $uploader, Router $router, ObjectManager $manager)
    {
        $this->uploader   = $uploader;
        $this->voucher    = $voucher;
        $this->translator = $translator;
        $this->mailer     = $mailer;
        $this->router     = $router;
        $this->manager    = $manager;
        $this->account    = new User();
        $this->classroom  = new Classroom();
    }

    /**
     * Save the registration
     */
    public function save()
    {
        $this->account->addRole('ROLE_TEACHER');
        $this->account->setEnabled(true);
        $this->account->setLastLogin(new \DateTime());

        $this->classroom->setUser($this->account);
        $this->classroom->setSchool($this->school->getSchool());

        if ($this->classroom->getPictureFile()) {
            $this->uploader->markEntityToUpload($this->classroom, $this->classroom->getPictureFile());
        }

        $this->voucher->setIsActive(false);
        $this->voucher->setUser($this->account);

        $this->manager->persist($this->account);
        $this->manager->persist($this->classroom);

        $this->manager->flush();

        $this->sendEmail();
    }

    /**
     * Send the registration email
     */
    protected function sendEmail()
    {
        $message = \Swift_Message::newInstance()
            ->setSubject($this->translator->trans('mail.registration.subject'))
            ->setFrom('no-reply@up2green.com', 'Up2green reforestation')
            ->setTo($this->account->getEmail(), (string) $this->account)
            ->setBody($this->translator->trans('mail.registration.body', array(
                '%username%' => $this->account->getUsername(),
                '%link%' => $this->router->generate('education_classroom_edit', array(
                    'id' => $this->classroom->getId()
                ), UrlGeneratorInterface::ABSOLUTE_URL),
                '%publicLink%' => $this->router->generate('education_classroom_show', array(
                    'school_slug' => $this->classroom->getSchool()->getSlug(),
                    'classroom_slug' => $this->classroom->getSlug(),
                ), UrlGeneratorInterface::ABSOLUTE_URL),
            )));

        $this->mailer->send($message);
    }
}
