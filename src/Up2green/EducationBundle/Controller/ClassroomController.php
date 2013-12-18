<?php

namespace Up2green\EducationBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

use Symfony\Component\Security\Acl\Permission\MaskBuilder;
use Symfony\Component\Security\Acl\Domain\UserSecurityIdentity;
use Symfony\Component\Security\Acl\Domain\ObjectIdentity;

use JMS\SecurityExtraBundle\Annotation\Secure;
use JMS\SecurityExtraBundle\Annotation\SecureParam;

use Pagerfanta\Adapter\DoctrineORMAdapter;
use Pagerfanta\Pagerfanta;

use Up2green\EducationBundle\Entity\ClassroomPicture;
use Up2green\EducationBundle\Entity\School;
use Up2green\EducationBundle\Entity\Classroom;
use Up2green\EducationBundle\Form\Type\SearchClassroomType;

/**
 * Classroom controller
 */
class ClassroomController extends Controller
{
    /**
     * @param School    $school
     * @param Classroom $classroom
     *
     * @Route("/school/{school_slug}/{classroom_slug}", name="education_classroom_show")
     * @Template(vars={"school", "classroom"})
     * @ParamConverter("school", class="Up2green\EducationBundle\Entity\School", options={"mapping"={"school_slug":"slug"}})
     * @ParamConverter("classroom", class="Up2green\EducationBundle\Entity\Classroom", options={"mapping"={"classroom_slug":"slug"}})
     */
    public function showAction(School $school, Classroom $classroom)
    {
    }

    /**
     * @param Classroom $classroom
     *
     * @Route("/classroom/{id}/edit", name="education_classroom_edit")
     * @Secure(roles="ROLE_TEACHER")
     * @SecureParam(name="classroom", permissions="EDIT")
     * @Template
     */
    public function editAction(Request $request, Classroom $classroom)
    {
        $classroomPicture = new ClassroomPicture();

        $formGeneral = $this->createForm('education_classroom', $classroom);
        $formPicture = $this->createForm('education_classroom_picture', $classroomPicture);

        if ('POST' === $request->getMethod()) {
            if ($request->request->has($formGeneral->getName())) {
                $formGeneral->submit($request);

                if ($formGeneral->isValid()) {

                    if ($classroom->getPictureFile()) {
                        $this->get('stof_doctrine_extensions.uploadable.manager')->markEntityToUpload($classroom, $classroom->getPictureFile());
                    }

                    $this->getDoctrine()->getManager()->flush();
                    $this->get('session')->getFlashBag()->add('success', "classroom.updated");
                }
            }

            if ($request->request->has($formPicture->getName())) {
                $formPicture->submit($request);

                if ($formPicture->isValid()) {

                    $this->get('stof_doctrine_extensions.uploadable.manager')->markEntityToUpload($classroomPicture, $classroomPicture->getPictureFile());

                    $classroomPicture->setClassroom($classroom);
                    $this->getDoctrine()->getManager()->persist($classroomPicture);
                    $this->getDoctrine()->getManager()->flush();


                    // creating the ACL
                    $aclProvider = $this->get('security.acl.provider');
                    $acl = $aclProvider->createAcl(ObjectIdentity::fromDomainObject($classroomPicture));
                    $securityIdentity = UserSecurityIdentity::fromAccount($this->getUser());
                    // grant owner access
                    $acl->insertObjectAce($securityIdentity, MaskBuilder::MASK_DELETE);
                    $aclProvider->updateAcl($acl);

                    $this->get('session')->getFlashBag()->add('success', "classroom.picture.added");
                }
            }
        }

        return array(
            'classroom'   => $classroom,
            'formGeneral' => $formGeneral->createView(),
            'formPicture' => $formPicture->createView(),
        );
    }

    /**
     * Search page
     *
     * @param Request $request
     *
     * @Route("/classrooms", name="education_classroom_list")
     * @Template()
     * @return array
     */
    public function listAction(Request $request)
    {
        $form = $this->createForm(new SearchClassroomType());
        $form->submit($request);

        $query = $this->getDoctrine()
            ->getRepository('Up2greenEducationBundle:Classroom')
            ->createFilteredQueryBuilder($form->isValid() ? $form->getData() : array());

        $pager = new Pagerfanta(new DoctrineORMAdapter($query));
        $pager
            ->setMaxPerPage(12)
            ->setCurrentPage($request->get('page', 1));

        return array(
            'form' => $form->createView(),
            'pager' => $pager,
        );
    }
}
