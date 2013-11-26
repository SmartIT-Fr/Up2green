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
            ->add('commentPublic', 'textarea', array(
                'label'      => 'form.donation_type.comment_public',
                'max_length' => 1000,
                'required' => false,
            ))
            ->add('commentPrivate', 'textarea', array(
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
        $resolver->setDefaults(array(
            'data_class' => 'Up2green\EducationBundle\Entity\Donation',
            'cascade_validation' => true,
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'education_donation';
    }

    /**
     * @return string
     */
    public function getParent()
    {
        return 'common_simple_order';
    }
}
