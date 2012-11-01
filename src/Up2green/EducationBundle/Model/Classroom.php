<?php

namespace Up2green\EducationBundle\Model;

use Symfony\Component\HttpFoundation\File\UploadedFile;
use Up2green\EducationBundle\Model\om\BaseClassroom;

/**
 * Classroom entity
 */
class Classroom extends BaseClassroom
{
    public $uploadedFile;

    /**
     * When a school is created, we set the year property to the actual year
     */
    public function __construct()
    {
        $this->year = date('Y');
    }

    /**
     * @return UploadedFile
     */
    public function getUploadedFile()
    {
        return $this->uploadedFile;
    }

    /**
     * @param UploadedFile $uploadedFile
     */
    public function setUploadedFile(UploadedFile $uploadedFile)
    {
        $this->uploadedFile = $uploadedFile;
    }

    /**
     * @param PropelPDO $con
     *
     * @return int
     */
    public function save(PropelPDO $con = null)
    {
        $this->upload();

        return parent::save($con);
    }

    /**
     * @return null
     */
    public function upload()
    {
        if (!$this->uploadedFile instanceof UploadedFile) {
            return;
        }

        $webDirectory = __DIR__.'/../../../../web';

        // Purge old picture file
        if (!empty($this->picture)) {
            @unlink($webDirectory . $this->picture);
        }

        $path      = sprintf('/uploads/classrooms/%d/', $this->getClassroom()->getId());
        $extension = $this->uploadedFile->guessExtension();

        if (!$extension) {
            // extension cannot be guessed
            $extension = 'bin';
        }

        $filename = sprintf('photo.%s', $extension);

        $this->uploadedFile->move($webDirectory . $path, $filename);

        $this->setPicture($path . $filename);
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->name;
    }
}
