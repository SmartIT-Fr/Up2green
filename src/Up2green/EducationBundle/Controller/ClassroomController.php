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

use Pagerfanta\Adapter\PropelAdapter;
use Pagerfanta\Pagerfanta;

use Up2green\EducationBundle\Model;
use Up2green\EducationBundle\Model\ClassroomQuery;
use Up2green\EducationBundle\Form\Type\SearchClassroomType;

/**
 * Classroom controller
 */
class ClassroomController extends Controller
{
    /**
     * @param Model\School    $school
     * @param Model\Classroom $classroom
     *
     * @Route("/school/{school_slug}/{classroom_slug}", name="education_classroom_show")
     * @Template(vars={"school", "classroom"})
     * @ParamConverter("school", class="Up2green\EducationBundle\Model\School", options={"mapping"={"school_slug":"slug"}})
     * @ParamConverter("classroom", class="Up2green\EducationBundle\Model\Classroom", options={"mapping"={"classroom_slug":"slug"}})
     */
    public function showAction(Model\School $school, Model\Classroom $classroom)
    {
    }

    /**
     * @param Model\Classroom $classroom
     *
     * @Route("/classroom/{id}/edit", name="education_classroom_edit")
     * @Secure(roles="ROLE_TEACHER")
     * @SecureParam(name="classroom", permissions="EDIT")
     * @Template
     */
    public function editAction(Request $request, Model\Classroom $classroom)
    {
        $classroomPicture = new Model\ClassroomPicture();

        $formGeneral = $this->createForm('education_classroom', $classroom);
        $formPicture = $this->createForm('education_classroom_picture', $classroomPicture);

        if ('POST' === $request->getMethod()) {
            if ($request->request->has($formGeneral->getName())) {
                $formGeneral->bind($request);

                if ($formGeneral->isValid()) {
                    $classroom->save();
                    $this->get('session')->setFlash('success', "classroom.updated");
                }
            }

            if ($request->request->has($formPicture->getName())) {
                $formPicture->bind($request);

                if ($formPicture->isValid()) {

                    $classroomPicture->setClassroom($classroom);
                    $classroomPicture->save();

                    // creating the ACL
                    $aclProvider = $this->get('security.acl.provider');
                    $acl = $aclProvider->createAcl(ObjectIdentity::fromDomainObject($classroomPicture));
                    $securityIdentity = UserSecurityIdentity::fromAccount($this->getUser());
                    // grant owner access
                    $acl->insertObjectAce($securityIdentity, MaskBuilder::MASK_DELETE);
                    $aclProvider->updateAcl($acl);

                    $this->get('session')->setFlash('success', "classroom.picture.added");
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

        $query = ClassroomQuery::create();

        $form->bind($request);

        if ($form->isValid()) {
            $query->filterSearch($form->getData());
        }

        $pager = new Pagerfanta(new PropelAdapter($query));
        $pager
            ->setMaxPerPage(12)
            ->setCurrentPage($request->get('page', 1));

        return array(
            'form' => $form->createView(),
            'pager' => $pager,
        );
    }
}
