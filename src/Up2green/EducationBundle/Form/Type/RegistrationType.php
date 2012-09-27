<?php
namespace Up2green\EducationBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class RegistrationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('school'      , 'education_school')
            ->add('account'     , 'education_account')
            ->add('classroom'   , 'education_classroom')
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Up2green\EducationBundle\DomainObject\Registration'
        ));
    }

    public function getName()
    {
        return 'education_registration';
    }
}