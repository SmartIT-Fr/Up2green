<?php
namespace Up2green\EducationBundle\DomainObject;

use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Validator\Constraints as Assert;
use Up2green\EducationBundle\Model;

/**
*
*/
class Classroom implements DomainObjectInterface
{
    /**
     * @Assert\NotBlank()
     * @Assert\MaxLength(2000)
     */
    public $description;

    /**
     * @Assert\NotBlank()
     * @Assert\MaxLength(30)
     */
    public $name;

    /**
     * @Assert\Image()
     */
    public $picture;

    protected $classroomModel;

    public function __construct($classroomModel = null)
    {
        $this->classroomModel   = null === $classroomModel ? new Model\Classroom() : $classroomModel;
        $this->description      = $this->classroomModel->getDescription();
        $this->name             = $this->classroomModel->getName();
        $this->picture          = $this->classroomModel->getPicture();
    }

    public function save()
    {
        $this->classroomModel->setDescription($this->description);
        $this->classroomModel->setName($this->name);

        if (null !== $this->picture) {
            $picture = $this->upload($this->picture);
            $this->classroomModel->setPicture($picture);
        }

        $this->classroomModel->save();
    }

    public function setSchoolModel(Model\School $schoolModel)
    {
        $this->classroomModel->setSchool($schoolModel);
    }

    public function setUserModel(\FOS\UserBundle\Propel\User $userModel)
    {
        $this->classroomModel->setUser($userModel);
    }

    /**
     * For a good SEO the strategy is to use
     * something like this schoolName-className-userName-classYear.extension
     */
    protected function upload(UploadedFile $file)
    {
        $schoolName = $this->classroomModel->getSchool()->getName();
        $className  = $this->classroomModel->getName();
        $userName   = $this->classroomModel->getUser()->getUsername();
        $classYear  = $this->classroomModel->getYear();
        $extension  = $file->guessExtension();

        $name = sprintf('%s-%s-%s-%s.%s', $schoolName, $className, $userName, $classYear, $extension);
        $directory = __DIR__.'/../../../../web/uploads';
        $file->move($directory, $file->getClientOriginalName());

        $oldName = $directory.'/'. $file->getClientOriginalName();
        $newName = $directory.'/'. $name;

        rename($oldName, $newName);

        return sprintf('uploads/%s', $name);
    }
}