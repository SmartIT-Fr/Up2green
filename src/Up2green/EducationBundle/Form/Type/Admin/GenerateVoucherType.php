<?php
namespace Up2green\EducationBundle\Form\Type\Admin;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

/**
 * Generate vouchers form type
 */
class GenerateVoucherType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array                $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('quantity', 'integer', array(
                'label'    => 'form.generate_voucher.quantity.label',
            ))
            ->add('owner', 'entity', array(
                'class'    => 'Up2green\UserBundle\Entity\User',
                'label'    => 'form.generate_voucher.owner.label'
            ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'education_admin_generate_voucher';
    }
}
