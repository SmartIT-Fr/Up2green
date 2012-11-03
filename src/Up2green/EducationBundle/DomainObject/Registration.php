<?php
namespace Up2green\EducationBundle\DomainObject;

use Symfony\Component\Validator\Constraints as Assert;
use Up2green\CommonBundle\Model\Voucher;

use FOS\UserBundle\Propel\User;

/**
 * Registration domain object
 *
 * @Assert\Callback(methods={
 * 	{"Up2green\CommonBundle\Model\Voucher", "isValid"}
 * })
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

    /**
     * @Assert\Valid()
     */
    protected $voucher;

    /**
     * @param User      $account   The account
     * @param Classroom $classroom The classroom
     * @param School    $school    The school
     */
    public function __construct(User $account = null, $classroom = null, $school = null, Voucher $voucher = null)
    {
        $this->account   = $account;
        $this->classroom = $classroom;
        $this->school    = $school;
        $this->voucher    = $voucher;
    }

    /**
     * Save the registration
     */
    public function save()
    {
        $this->school->save();
        $school = $this->school->getSchoolModel();

        $this->account->addRole('ROLE_TEACHER');
        $this->account->save();
        $user = $this->account;

        $this->classroom->setUser($user);
        $this->classroom->setSchool($school);
        $this->classroom->save();

        $this->voucher->setIsActive(false);
        $this->voucher->setUsedByd($this->account->getId());
        $this->voucher->save();
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
