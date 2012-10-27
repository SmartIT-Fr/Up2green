<?php

namespace Up2green\EducationBundle\Model;

use Symfony\Component\HttpFoundation\File\UploadedFile;
use Up2green\EducationBundle\Model\om\BaseClassroom;

/**
 * Classroom entity
 */
class Classroom extends BaseClassroom
{
    public $pictureFile;

    /**
     * When a school is created, we set the year property to the actual year
     */
    public function __construct()
    {
        $this->year = date('Y');
    }

    /**
     * @param \PropelPDO $con
     */
    public function save(\PropelPDO $con = null)
    {
        if (null !== $this->pictureFile) {
            $this->picture = $this->upload($this->pictureFile);
        }

        parent::save($con);
    }

    /**
     * @param UploadedFile $file
     *
     * For a good SEO the strategy is to use
     * something like this schoolName-className-userName-classYear.extension
     *
     * @return string
     */
    protected function upload(UploadedFile $file)
    {
        $schoolName = $this->getSchool()->getName();
        $className  = $this->getName();
        $userName   = $this->getUser()->getUsername();
        $classYear  = $this->getYear();
        $extension  = $file->guessExtension();

        $name = sprintf('%s-%s-%s-%s.%s', $schoolName, $className, $userName, $classYear, $extension);
        $directory = __DIR__.'/../../../../web/uploads';
        $file->move($directory, $file->getClientOriginalName());

        $oldName = $directory.'/'. $file->getClientOriginalName();
        $newName = $directory.'/'. $name;

        rename($oldName, $newName);

        return sprintf('uploads/%s', $name);
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->name;
    }
}
