<?php
namespace Up2green\EducationBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

/**
 * Registration type
 */
class RegistrationType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array                $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('school', 'education_school', array(
                'label' => 'form.registration.school'
            ))
            ->add('account', 'education_account', array(
                'label' => 'form.registration.account'
            ))
            ->add('classroom', 'education_classroom', array(
                'label' => 'form.registration.classroom'
            ));
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Up2green\EducationBundle\DomainObject\Registration'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'education_registration';
    }
}
