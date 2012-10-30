<?php

namespace Up2green\EducationBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

use JMS\SecurityExtraBundle\Annotation\Secure;
use JMS\SecurityExtraBundle\Annotation\SecureParam;

use Up2green\EducationBundle\Model;

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
     * @Route("/classroom/{slug}/edit", name="education_classroom_edit")
     * @Secure(roles="ROLE_TEACHER")
     * @SecureParam(name="classroom", permissions="EDIT")
     * @Template
     */
    public function editAction(Request $request, Model\Classroom $classroom)
    {
        $classroomPicture = new Model\ClassroomPicture();
        $classroomPicture->setClassroom($classroom);

        $formGeneral = $this->createForm('education_classroom', $classroom);
        $formPicture = $this->createForm('education_classroom_picture', $classroomPicture);

        if ('POST' === $request->getMethod()) {
            if ($request->request->has($formGeneral->getName())) {
                $formGeneral->bind($request);

                if ($formGeneral->isValid()) {
                    $classroom->save();
                    $this->get('session')->setFlash('success', "classroom_updated");
                }
            }

            if ($request->request->has($formPicture->getName())) {
                $formPicture->bind($request);

                if ($formPicture->isValid()) {
                    $classroom->save();
                    $this->get('session')->setFlash('success', "classroom_updated");
                }
            }
        }

        $classroomPictures = Model\ClassroomPictureQuery::create()
            ->findByClassroomId($classroom->getId());

        return array(
            'classroom'   => $classroom,
            'pictures'    => $classroomPictures,
            'formGeneral' => $formGeneral->createView(),
            'formPicture' => $formPicture->createView(),
        );
    }
}
