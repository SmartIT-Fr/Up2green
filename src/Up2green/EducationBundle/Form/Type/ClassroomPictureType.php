<?php
namespace Up2green\EducationBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

/**
 * ClassroomPicture type
 */
class ClassroomPictureType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array                $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('student', 'text', array(
                'label' => 'form.classroom_picture_type.student'
            ))
            ->add('uploadedFile', 'file', array(
                'label'    => 'form.classroom_picture_type.picture',
                'required' => false,
            ))
            ->add('program', 'model', array(
                'class'    => 'Up2green\ReforestationBundle\Entity\Program',
                'label'    => 'form.classroom_picture_type.program'
            ));
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Up2green\EducationBundle\Entity\ClassroomPicture',
            'cascade_validation' => true,
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'education_classroom_picture';
    }
}
