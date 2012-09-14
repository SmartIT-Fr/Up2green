<?php
namespace Up2green\EducationBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class AccountType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('username', 'text', array(
                'label' => 'form.account_type.username'
            ))
            ->add('firstname', 'text', array(
                'label' => 'form.account_type.fistname'
            ))
            ->add('lastname', 'text', array(
                'label' => 'form.account_type.lastname'
            ))
            ->add('email', 'email', array(
                'label' => 'form.account_type.email'
            ))
            ->add('password', 'repeated', array(
                'type' => 'password',
                'first_options'  => array('label' => 'form.account_type.password'),
                'second_options' => array('label' => 'form.account_type.re_password')
            ))
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Up2green\EducationBundle\DomainObject\Account'
        ));
    }

    public function getName()
    {
        return 'education_account';
    }
}