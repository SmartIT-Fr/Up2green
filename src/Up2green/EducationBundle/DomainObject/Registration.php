<?php
namespace Up2green\EducationBundle\DomainObject;

use Symfony\Component\Validator\Constraints as Assert;

use FOS\UserBundle\Propel\User;
use Up2green\EducationBundle\Model\Classroom;
use Up2green\EducationBundle\DomainObject\School;
use Up2green\CommonBundle\Model\Voucher;
use Up2green\CommonBundle\Model\VoucherQuery;


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
        $this->voucher->setUsedBy($this->account->getId());
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

    /**
     * @Assert\True(message="voucher_code_wrong")
     */
    public function isVoucherValid()
    {
        return VoucherQuery::create()->canBeUsed($this->voucher->getCode());
    }
}
