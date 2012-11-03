<?php
namespace Up2green\AdminBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

/**
 * Voucher prefix type
 */
class VoucherType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array                $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('prefix', 'text', array(
                'label' => 'voucher.prefix'
            ))
            ->add('is_active', null, array(
                'label' => 'voucher.is_active'
            ));
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Up2green\CommonBundle\Model\Voucher'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'admin_voucher';
    }
}
