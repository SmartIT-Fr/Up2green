<?php
namespace Up2green\EducationBundle\DomainObject;

use FOS\UserBundle\Util\UserManipulator;
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

    public function __construct(UserManipulator $userManipulator, $account = null, $classroom = null, $school = null)
    {
        null !== $account   && $account     instanceof Account   ? $this->account    = $account      : $this->account    = new Account($userManipulator);
        null !== $classroom && $classroom   instanceof Classroom ? $this->classroom  = $classroom    : $this->classroom  = new Classroom();
        null !== $school    && $school      instanceof School    ? $this->school     = $school       : $this->school     = new School();
    }

    public function save()
    {
        $this->school->save();
        $school = $this->school->getSchoolModel();

        $this->account->save();
        $user = $this->account->getUserModel();

        $this->classroom->setUserModel($user);
        $this->classroom->setSchoolModel($school);
        $this->classroom->save();
    }
}