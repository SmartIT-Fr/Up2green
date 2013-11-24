<?php
namespace Up2green\EducationBundle\DomainObject;

use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Validator\Constraints as Assert;

use Up2green\EducationBundle\Entity\Classroom;
use Up2green\EducationBundle\DomainObject\School;
use Up2green\CommonBundle\Entity\Voucher;
use Up2green\UserBundle\Entity\User;


/**
 * Registration domain object
 */
class Registration implements DomainObjectInterface
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

    protected $voucher;

    /**
     * @var ObjectManager
     */
    protected $manager;

    /**
     * @param User      $account   The account
     * @param Classroom $classroom The classroom
     * @param School    $school    The school
     */
    public function __construct(Voucher $voucher)
    {
        $this->voucher   = $voucher;
        $this->account   = new User();
        $this->classroom = new Classroom();
    }

    /**
     * @param ObjectManager $manager
     */
    public function setManager(ObjectManager $manager)
    {
        $this->manager = $manager;
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
        $this->classroom->setSchool($this->school->getSchoolModel());

        $this->voucher->setIsActive(false);
        $this->voucher->setUsedBy($this->account);

        $this->school->save();
        $this->manager->persist($this->account);
        $this->manager->persist($this->classroom);

        $this->manager->flush();
    }

    /**
     * @param Voucher $voucher
     */
    public function setVoucher(Voucher $voucher)
    {
        $this->voucher = $voucher;
    }

    /**
     * @return Voucher
     */
    public function getVoucher()
    {
        return $this->voucher;
    }
}
