<?php
namespace Up2green\EducationBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ClassroomType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', 'text', array(
                'label' => 'form.classroom_type.name'
            ))
            ->add('pictureFile', 'file', array(
                'label' => 'form.classroom_type.picture'
            ))
            ->add('description', 'textarea', array(
                'label' => 'form.classroom_type.description'
            ))
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Up2green\EducationBundle\Model\Classroom'
        ));
    }

    public function getName()
    {
        return 'education_classroom';
    }
}