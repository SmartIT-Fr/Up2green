<?php
namespace Up2green\EducationBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Up2green\EducationBundle\DomainObject;

/**
 * SchoolSelect type
 */
class SchoolSelectType extends AbstractType
{
    protected static $schoolChoices = array(
        DomainObject\School::SCHOOL_EXISTING => 'form.school_type.school_in',
        DomainObject\School::SCHOOL_NEW      => 'form.school_type.school_out',
    );

    /**
     * @param FormBuilderInterface $builder
     * @param array                $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('choice', 'choice', array(
                'label'             => 'form.school_type.school',
                'choices'           => (array) static::$schoolChoices,
                'expanded'          => true,
                'required'          => true,
                'data'              => current(array_keys(static::$schoolChoices))
            ))
            ->add('existing', 'entity', array(
                'class'       => 'Up2green\EducationBundle\Entity\School',
                'label'       => 'form.school_type.school_list',
                'required'    => false,
                'empty_value' => 'form.school_type.school_list_choice.empty_value'
            ))
            ->add('new', 'education_school', array(
                'label'    => 'form.school_type.name',
                'required' => false,
            ));
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Up2green\EducationBundle\DomainObject\School',
            'cascade_validation' => true,
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'education_school_select';
    }
}
