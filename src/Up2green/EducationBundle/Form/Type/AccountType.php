<?php
namespace Up2green\EducationBundle\Form\Type;

use Symfony\Component\Form\AbstractType;

class AccountType extends AbstractType
{
    public function getParent()
    {
        return 'fos_user_registration';
    }

    public function getName()
    {
        return 'education_account';
    }
}