<?php
namespace Up2green\EducationBundle\Form\Type;

use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Up2green\EducationBundle\DomainObject;
use Up2green\EducationBundle\Model\SchoolQuery;

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
    public function __construct()
    {
        $this->schoolChoices = DomainObject\School::$schoolChoices;

        $schools = SchoolQuery::create()
            ->orderByName('ASC')
            ->find();

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
            ->add('school_list', 'choice', array(
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
            'data_class' => 'Up2green\EducationBundle\DomainObject\School'
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