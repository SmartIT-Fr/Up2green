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
    public function save(\PropelPDO $con = null)
    {
        $this->upload();

        return parent::save($con);
    }

    /**
     * Code to be run after deleting the object in database
     *
     * @param PropelPDO $con
     *
     * @return boolean
     * @todo We should remove all the directory, not only the image here
     */
    public function preDelete(\PropelPDO $con = null)
    {
        // Purge picture file
        if (!empty($this->picture)) {
            @unlink(__DIR__.'/../../../../web' . $this->picture);
        }

        return true;
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

        $path      = '/uploads/classrooms/';
        $extension = $this->uploadedFile->guessExtension();

        if (!$extension) {
            // extension cannot be guessed
            $extension = 'bin';
        }

        $filename = sprintf('%s.%s', uniqid(), $extension);

        $this->uploadedFile->move($webDirectory . $path, $filename);
        $this->uploadedFile = null;

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
