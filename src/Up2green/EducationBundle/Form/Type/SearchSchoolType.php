<?php

namespace Up2green\EducationBundle\Form\Type;

use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\AbstractType;

/**
 * Waiting list form
 */
class SearchSchoolType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array                $options
     *
     * @see Symfony\Component\Form.AbstractType::buildForm()
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', 'text', array(
                'label' => 'schoolname',
                'required' => false
            ))
            ->add('address', 'text', array(
                'label' => 'city',
                'required' => false
            ));
    }

    /**
     * @see Symfony\Component\Form.FormTypeInterface::getName()
     * @return string
     */
    public function getName()
    {
        return 'search_school';
    }
}