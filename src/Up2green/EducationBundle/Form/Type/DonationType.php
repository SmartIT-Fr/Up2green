<?php
namespace Up2green\EducationBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

/**
 * Donation type
 */
class DonationType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array                $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', 'text', array(
                'label' => 'form.donation_type.name',
            ))
            ->add('isAnonymous', 'checkbox', array(
                'label' => 'form.donation_type.is_anonymous',
                'required' => false,
            ))
            ->add('email', 'email', array(
                'label' => 'form.donation_type.email',
            ))
            ->add('url', 'url', array(
                'label'    => 'form.donation_type.url',
                'required' => false,
            ))
            ->add('order', 'common_order', array(
                'payment_return_route' => $options['payment_return_route'],
                'payment_cancel_route' => $options['payment_cancel_route'],
            ))
            ->add('comment_public', 'textarea', array(
                'label'      => 'form.donation_type.comment_public',
                'max_length' => 1000,
                'required' => false,
            ))
            ->add('comment_private', 'textarea', array(
                'label' => 'form.donation_type.comment_private',
                'max_length' => 1000,
                'required' => false,
            ));
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver
            ->setRequired(array(
                'payment_return_route', 'payment_cancel_route',
            ))
            ->setDefaults(array(
                'data_class' => 'Up2green\EducationBundle\Model\Donation'
            ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'education_donation';
    }
}