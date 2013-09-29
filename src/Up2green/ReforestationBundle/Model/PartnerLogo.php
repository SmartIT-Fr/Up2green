<?php

namespace Up2green\ReforestationBundle\Model;

use Symfony\Component\HttpFoundation\File\UploadedFile;
use Up2green\ReforestationBundle\Model\om\BasePartnerLogo;

/**
 * PartnerLogo entity
 */
class PartnerLogo extends BasePartnerLogo
{
    protected $uploadedFile;

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
     */
    public function preDelete(\PropelPDO $con = null)
    {
        // Purge picture file
        if (!empty($this->src)) {
            @unlink(__DIR__.'/../../../../web' . $this->src);
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
        if (!empty($this->src)) {
            @unlink($webDirectory . $this->src);
        }

        $path      = sprintf('/uploads/partners/%d/logos/', $this->getPartner()->getId());
        $extension = $this->uploadedFile->guessExtension();

        if (!$extension) {
            // extension cannot be guessed
            $extension = 'bin';
        }

        $filename = sprintf('%s.%s', uniqid(), $extension);

        $this->uploadedFile->move($webDirectory . $path, $filename);
        $this->uploadedFile = null;

        $this->setSrc($path . $filename);
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return (string) $this->getId();
    }
}
