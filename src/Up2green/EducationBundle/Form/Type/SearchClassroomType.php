<?php

namespace Up2green\EducationBundle\Form\Type;

use Symfony\Component\OptionsResolver\OptionsResolverInterface;

use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\AbstractType;

/**
 * Waiting list form
 */
class SearchClassroomType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array                $options
     *
     * @see Symfony\Component\Form.AbstractType::buildForm()
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $years = array('' => '');
        $currentYear = date('Y');

        for ($i = 2012; $i <= $currentYear; $i++) {
            $years[$i] = $i;
        }

        $builder
            ->add('school', new SearchSchoolType())
            ->add('name', 'text', array(
                'label' => 'classname',
                'required' => false
            ))
            ->add('year', 'choice', array(
                'label' => 'year',
                'choices' => $years,
                'required' => false
            ));
    }

    /**
     * @see Symfony\Component\Form.FormTypeInterface::getName()
     * @return string
     */
    public function getName()
    {
        return 'search_classroom';
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver
            ->setDefaults(array(
                'csrf_protection' => false
            ));
    }

}