<?php
namespace Up2green\EducationBundle\Form\Type;

use Doctrine\Bundle\DoctrineBundle\Registry;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Up2green\EducationBundle\DomainObject;

/**
 * School type
 */
class SchoolType extends AbstractType
{
    protected $schoolChoices;
    protected $schoolList;

    /**
     * Constructor
     */
    public function __construct(Registry $doctrine)
    {
        $this->schoolChoices = DomainObject\School::$schoolChoices;
        $schools = $doctrine->getRepository('Up2greenEducationBundle:School')->findAll();

        $this->schoolList = array();
        foreach ($schools as $school) {
            $this->schoolList[$school->getId()] = (string) $school;
        }
    }

    /**
     * @param FormBuilderInterface $builder
     * @param array                $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('school', 'choice', array(
                'label'             => 'form.school_type.school',
                'choices'           => (array) $this->schoolChoices,
                'expanded'          => true,
                'required'          => true,
                'preferred_choices' => array(current(array_keys($this->schoolChoices)))
            ))
            ->add('schoolList', 'choice', array(
                'label'         => 'form.school_type.school_list',
                'choices'       => (array) $this->schoolList,
                'required'      => false,
                'empty_value'   => 'form.school_type.school_list_choice.empty_value'
            ))
            ->add('name', 'text', array(
                'label' => 'form.school_type.name',
                'required'      => false,
            ))
            ->add('address', 'textarea', array(
                'label' => 'form.school_type.address',
                'required'      => false,
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
        return 'education_school';
    }
}
