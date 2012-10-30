<?php

namespace Up2green\CommonBundle\Form\Type;

use Symfony\Component\Validator\Constraints\NotBlank;

use Symfony\Component\OptionsResolver\OptionsResolverInterface;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\Collection;

/**
 * Contact type form
 */
class ContactType extends AbstractType
{
    /**
     * (non-PHPdoc)
     *
     * @param FormBuilderInterface $builder
     * @param array                $options
     *
     * @see Symfony\Component\Form.AbstractType::buildForm()
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('first_name', 'text', array(
                'label' => 'firstname'
            ))
            ->add('last_name', 'text', array(
                'label' => 'lastname'
            ))
            ->add('subject', 'text', array(
                'label' => 'subject'
            ))
            ->add('email', 'email', array(
                'label' => 'email'
            ))
            ->add('message', 'textarea', array(
                'label' => 'message'
            ))
            ->add('captcha', 'captcha', array(
                'label' => 'captcha'
            ));
    }

    /**
     * (non-PHPdoc)
     * @see Symfony\Component\Form.FormTypeInterface::getName()
     * @return string
     */
    public function getName()
    {
        return 'contact';
    }

    /**
     * (non-PHPdoc)
     *
     * @param OptionsResolverInterface $resolver
     *
     * @see Symfony\Component\Form.AbstractType::setDefaultOptions()
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'validation_constraint' => new Collection(array(
                'email' => array(new Email(), new NotBlank()),
                'first_name' => new NotBlank(),
                'last_name' => new NotBlank(),
                'subject' => new NotBlank(),
                'message' => new NotBlank()
            ))
        ));
    }
}
