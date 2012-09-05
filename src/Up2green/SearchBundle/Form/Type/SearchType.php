<?php

namespace Up2green\SearchBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

use Up2green\SearchBundle\Services\Engine\EngineFactory;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Search Form Type class
 */
class SearchType extends AbstractType
{
    /**
     * Inherited doc
     *
     * @param FormBuilderInterface $builder The form builder
     * @param array                $options The options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('q', null, array('required' => true))
            ->add('type', 'choice', array(
                'choices'  => EngineFactory::$types,
                'required' => true,
                'expanded' => true,
                'data' => EngineFactory::TYPE_WEB,
            ));
    }

    /**
     * Inherited doc
     *
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'csrf_protection'       => false,
            'validation_constraint' => new Assert\Collection(array(
                'q'    => new Assert\NotBlank(),
                'type' => new Assert\Choice(array(
                    'choices' => array_keys(EngineFactory::$types)
                )),
            )),
        ));
    }

    /**
     * Inherited doc
     *
     * @return string
     */
    public function getName()
    {
        return 'search_form';
    }
}
