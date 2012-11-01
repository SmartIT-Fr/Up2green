<?php
namespace Up2green\EducationBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

/**
 * Classroom type
 */
class ClassroomType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array                $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', 'text', array(
                'label' => 'form.classroom_type.name'
            ))
            ->add('uploadedFile', 'file', array(
                'label'    => 'form.classroom_type.picture',
                'required' => false,
            ))
            ->add('description', 'textarea', array(
                'label' => 'form.classroom_type.description'
            ));
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Up2green\EducationBundle\Model\Classroom'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'education_classroom';
    }
}
