<?php

namespace Up2green\SearchBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

use Up2green\SearchBundle\Services\Engine\EngineFactory;
use Symfony\Component\Validator\Constraints as Assert;

class SearchType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder
            ->add('q', null, array('required' => true))
            ->add('type', 'choice', array(
                'choices'  => EngineFactory::$types,
                'required' => true,
                'expanded' => true,
                'data' => EngineFactory::TYPE_WEB,
            ))
        ;
    }

    public function getDefaultOptions()
    {
        return array(
            'csrf_protection'       => false,
            'validation_constraint' => new Assert\Collection(array(
                'q'    => new Assert\NotBlank(),
                'type' => new Assert\Choice(array(
                    'choices' => array_keys(EngineFactory::$types)
                )),
            )),
        );
    }

    public function getName()
    {
        return 'search_form';
    }
}