<?php
namespace Up2green\EducationBundle\DomainObject;

use FOS\UserBundle\Propel\User;
use FOS\UserBundle\Propel\UserManager;
use FOS\UserBundle\Util\UserManipulator;

/**
*
*/
class Account implements DomainObjectInterface
{
    public $username;
    public $firstname;
    public $lastname;
    public $email;
    public $password;

    protected $user;
    protected $userManipulator;

    public function __construct(UserManipulator $userManipulator, $user = null)
    {
        $this->user             = null !== $user ?: $user;
        $this->userManipulator  = $userManipulator;
    }

    public function save()
    {
        $this->user = $this->userManipulator->create($this->username, $this->password, $this->email, true, false);

        // find a nice way to extend fosuserbundle
        // $this->user->setFirstname();
        // $this->user->setLastname();
        $this->user->save();
    }

    public function getUserModel()
    {
        return $this->user;
    }
}