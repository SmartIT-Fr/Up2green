<?php

namespace Up2green\EducationBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

use JMS\SecurityExtraBundle\Annotation\Secure;
use JMS\SecurityExtraBundle\Annotation\SecureParam;

use Up2green\EducationBundle\Model\ClassroomPicture;

/**
 * Classroom picture controller
 *
 * @Route("/classroom-picture")
 */
class ClassroomPictureController extends Controller
{
    /**
     * @param ClassroomPicture $picture
     *
     * @Route("/{id}/delete", name="education_classroom_picture_delete")
     * @Secure(roles="ROLE_TEACHER")
     * @SecureParam(name="picture", permissions="DELETE")
     */
    public function deleteAction(Request $request, ClassroomPicture $picture)
    {
        $picture->delete();

        $this->get('session')->setFlash('success', "classroom.picture.deleted");

        return $this->redirect($request->headers->get('referer'));
    }
}
