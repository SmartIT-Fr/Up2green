<?php
namespace Up2green\EducationBundle\DomainObject;

use Symfony\Component\Validator\Constraints as Assert;

/**
*
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

    public function __construct($account = null, $classroom = null, $school = null)
    {
    }

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