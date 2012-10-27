<?php
namespace Up2green\EducationBundle\DomainObject;

use Symfony\Component\Validator\Constraints as Assert;

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

    /**
     * @param User      $account   The account
     * @param Classroom $classroom The classroom
     * @param School    $school    The school
     */
    public function __construct($account = null, $classroom = null, $school = null)
    {
        $this->account   = $account;
        $this->classroom = $classroom;
        $this->school    = $school;
    }

    /**
     * Save the registration
     */
    public function save()
    {
        $this->school->save();
        $school = $this->school->getSchoolModel();

        $this->account->save();
        $user = $this->account;

        $this->classroom->setUser($user);
        $this->classroom->setSchool($school);
        $this->classroom->save();
    }
}