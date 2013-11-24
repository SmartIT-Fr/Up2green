<?php

namespace Up2green\EducationBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Acl\Permission\MaskBuilder;
use Symfony\Component\Security\Acl\Domain\UserSecurityIdentity;
use Symfony\Component\Security\Acl\Domain\ObjectIdentity;

use FOS\UserBundle\Model\UserInterface;

use Up2green\EducationBundle\DomainObject;
use Up2green\EducationBundle\Entity\EducationVoucher;
use Up2green\CommonBundle\Entity\Voucher;

/**
 * Registration controller
 */
class RegistrationController extends Controller
{
    /**
     * @param Request $request
     *
     * @Route("/registration/new/{token}", name="education.registration.new")
     * @ParamConverter("voucher", class="Up2green\CommonBundle\Entity\Voucher", options={"mapping"={"token":"code"}})
     * @Template()
     *
     * @return array
     */
    public function newAction(Request $request, Voucher $voucher)
    {
        $registration = new DomainObject\Registration($voucher);
        $registration->setManager($this->get('doctrine.orm.entity_manager'));

        $form = $this->createForm('education_registration', $registration);

        if ('POST' === $request->getMethod()) {

            $form->submit($request);

            if ($form->isValid()) {

                $registration->save();

                // creating the ACL
                $aclProvider = $this->get('security.acl.provider');
                $acl = $aclProvider->createAcl(ObjectIdentity::fromDomainObject($registration->classroom));
                $securityIdentity = UserSecurityIdentity::fromAccount($registration->account);

                // grant owner access
                $acl->insertObjectAce($securityIdentity, MaskBuilder::MASK_EDIT);
                $aclProvider->updateAcl($acl);

                $this->container->get('fos_user.user_manager')->updateUser($registration->account);

                $this->get('session')->getFlashBag()->add('success', 'registration.flash.user_created');
                $response = $this->redirect($this->generateUrl('fos_user_registration_confirmed'));

                $this->authenticateUser($registration->account, $response);

                // Todo Redirect to an other place
                return $this->redirect($this->generateUrl('education_classroom_edit', array(
                    'id' => $registration->classroom->getId()
                )));
            }
        }

        return array(
            'form' => $form->createView()
        );
    }

    /**
     * @param Request $request
     *
     * @Route("/registration/geoloc", name="education.registration.geoloc", options={"expose"=true})
     *
     * @return JsonResponse
     */
    public function GeolocAction(Request $request)
    {
        $address = null;
        if (true === $request->query->has('address')) {
            $address = urldecode($request->query->get('address'));
        }
        $geocoded = $this->get('geocoder')->geocode($address);

        return new JsonResponse($geocoded->toArray());
    }

    /**
     * Authenticate a user with Symfony Security
     *
     * @param \FOS\UserBundle\Model\UserInterface        $user
     * @param \Symfony\Component\HttpFoundation\Response $response
     */
    protected function authenticateUser(UserInterface $user, Response $response)
    {
        try {
            $this->container->get('fos_user.security.login_manager')->loginUser(
                $this->container->getParameter('fos_user.firewall_name'),
                $user,
                $response);
        } catch (AccountStatusException $ex) {
            // We simply do not authenticate users which do not pass the user
            // checker (not enabled, expired, etc.).
        }
    }
}
