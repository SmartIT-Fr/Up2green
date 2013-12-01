<?php

namespace Up2green\EducationBundle\Controller\Admin;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sonata\AdminBundle\Controller\CRUDController;
use Symfony\Component\HttpFoundation\Request;

/**
 * Admin Voucher controller
 */
class VoucherController extends CRUDController
{
    /**
     * @param \Symfony\Component\BrowserKit\Request $request
     *
     * @Template()
     * @return array
     */
    public function generateAction(Request $request)
    {
        $form = $this->createForm('education_admin_generate_voucher');

        if ('POST' === $request->getMethod()) {
            $form->submit($request);

            if ($form->isValid()) {
                $codes = $this->get('up2green_education.manager.voucher')->generate(
                    $form->get('owner')->getData(),
                    $form->get('quantity')->getData()
                );

                $message = $this->get('translator')->trans(
                    'voucher_generated',
                    array('%vouchers%' => join(', ', $codes)),
                    'admin'
                );

                $this->addFlash('sonata_flash_success', $message);

                return $this->redirect($this->admin->generateUrl('list'));
            }
        }

        return $this->render('Up2greenEducationBundle:Admin\Voucher:generate.html.twig', array(
            'form' => $form->createView(),
            'action' => 'generate',
        ));
    }
}