<?php
namespace Up2green\EducationBundle\DomainObject;

use Doctrine\Common\Persistence\ManagerRegistry;
use Stof\DoctrineExtensionsBundle\Uploadable\UploadableManager;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntityValidator;
use Symfony\Component\Routing\Router;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Translation\Translator;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Validator\ExecutionContextInterface;
use Up2green\EducationBundle\Entity\Classroom;
use Up2green\EducationBundle\DomainObject\School;
use Up2green\CommonBundle\Entity\Voucher;
use Up2green\UserBundle\Entity\User;

/**
 * Registration domain object
 *
 * @Assert\Callback(methods={"isClassroomUnique"})
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
     * @param Voucher           $voucher    The voucher
     * @param UserInterface     $account    The account
     * @param Classroom         $classroom  The classroom
     * @param School            $school     The school
     * @param \Swift_Mailer     $mailer     The mailer
     * @param Translator        $translator The translator service
     * @param UploadableManager $uploader   The Uploader manager
     * @param Router            $router     The router
     * @param ManagerRegistry   $manager    The persistent manager
     */
    public function __construct(Voucher $voucher, UserInterface $account = null, \Swift_Mailer $mailer, Translator $translator, UploadableManager $uploader, Router $router, ManagerRegistry $manager)
    {
        $this->uploader   = $uploader;
        $this->account    = $account === null ? new User() : $account;
        $this->voucher    = $voucher;
        $this->translator = $translator;
        $this->mailer     = $mailer;
        $this->router     = $router;
        $this->manager    = $manager;
        $this->classroom  = new Classroom();
    }

    /**
     * Save the registration
     */
    public function save()
    {
        if (!$this->account->hasRole('ROLE_TEACHER')) {
            $this->account->addRole('ROLE_TEACHER');
        }

        if ($this->account->getId() === null) {
            $this->account->setEnabled(true);
            $this->account->setLastLogin(new \DateTime());
        }

        $this->classroom->setUser($this->account);
        $this->classroom->setSchool($this->school->getSchool());

        if ($this->classroom->getPictureFile()) {
            $this->uploader->markEntityToUpload($this->classroom, $this->classroom->getPictureFile());
        }

        $this->voucher->setIsActive(false);
        $this->voucher->setUser($this->account);

        if ($this->account->getId() === null) {
            $this->manager->getManager()->persist($this->account);
        }

        $this->manager->getManager()->persist($this->classroom);
        $this->manager->getManager()->flush();

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

    /**
     * FIXME remove this and this domain object by moving the school object form in the classroom form
     */
    public function isClassroomUnique(ExecutionContextInterface $context)
    {
        $this->classroom->setSchool($this->school->getSchool());

        $contraint = new UniqueEntity(array(
            'fields' => array('school', 'year', 'name'),
            'message' => 'classroom.already_exist'
        ));

        $unique = new UniqueEntityValidator($this->manager);
        $unique->initialize($context);
        $unique->validate($this->classroom, $contraint);

        $this->classroom->resetSchool();
    }
}
