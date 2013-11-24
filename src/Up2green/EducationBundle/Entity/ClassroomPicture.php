<?php

namespace Up2green\EducationBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * ClassroomPicture entity
 *
 * @ORM\Entity()
 * @ORM\Table(name="classroom_picture")
 * @Gedmo\Uploadable(pathMethod="getPath")
 */
class ClassroomPicture
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column()
     */
    protected $student;

    /**
     * @ORM\Column(name="picture")
     * @Assert\Image
     * @Gedmo\UploadableFileName
     */
    protected $picture;

    /**
     * @ORM\ManyToOne(targetEntity="Up2green\EducationBundle\Entity\Classroom", cascade={"remove"})
     * @ORM\JoinColumn(name="partner_id", referencedColumnName="id", nullable=false, onDelete="CASCADE")
     */
    protected $classroom;

    /**
     * @ORM\ManyToOne(targetEntity="Up2green\ReforestationBundle\Entity\Program")
     * @ORM\JoinColumn(name="partner_id", referencedColumnName="id", nullable=false)
     */
    protected $program;

    /**
     * @ORM\Column(name="created_at", type="datetime")
     * @Gedmo\Timestampable(on="create")
     */
    protected $createdAt;

    /**
     * @ORM\Column(name="updated_at", type="datetime", nullable=true)
     * @Gedmo\Timestampable(on="update")
     */
    protected $updatedAt;

    /**
     * @return string
     */
    public function __toString()
    {
        return (string) $this->student;
    }

    /**
     * @return string
     */
    public function getPath()
    {
        return sprintf("/uploads/classrooms/%d", $this->classroom->getId());
    }
}
