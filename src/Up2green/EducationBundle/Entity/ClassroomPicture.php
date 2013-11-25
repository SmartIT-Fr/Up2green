<?php

namespace Up2green\EducationBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Validator\Constraints as Assert;
use Up2green\ReforestationBundle\Entity\Program;

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
     * @var integer
     *
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var string
     *
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
     * @var Classroom
     *
     * @ORM\ManyToOne(targetEntity="Up2green\EducationBundle\Entity\Classroom", cascade={"remove"})
     * @ORM\JoinColumn(name="classroom_id", referencedColumnName="id", nullable=false, onDelete="CASCADE")
     */
    protected $classroom;

    /**
     * @var Program
     *
     * @ORM\ManyToOne(targetEntity="Up2green\ReforestationBundle\Entity\Program")
     * @ORM\JoinColumn(name="program_id", referencedColumnName="id", nullable=false)
     */
    protected $program;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_at", type="datetime")
     * @Gedmo\Timestampable(on="create")
     */
    protected $createdAt;

    /**
     * @var \DateTime
     *
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

    /**
     * @param mixed $classroom
     */
    public function setClassroom(Classroom $classroom)
    {
        $this->classroom = $classroom;
    }

    /**
     * @return mixed
     */
    public function getClassroom()
    {
        return $this->classroom;
    }

    /**
     * @param mixed $createdAt
     */
    public function setCreatedAt(\DateTime $createdAt)
    {
        $this->createdAt = $createdAt;
    }

    /**
     * @return mixed
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $picture
     */
    public function setPicture($picture)
    {
        $this->picture = $picture;
    }

    /**
     * @return mixed
     */
    public function getPicture()
    {
        return $this->picture;
    }

    /**
     * @param mixed $program
     */
    public function setProgram(Program $program)
    {
        $this->program = $program;
    }

    /**
     * @return mixed
     */
    public function getProgram()
    {
        return $this->program;
    }

    /**
     * @param mixed $student
     */
    public function setStudent($student)
    {
        $this->student = $student;
    }

    /**
     * @return mixed
     */
    public function getStudent()
    {
        return $this->student;
    }

    /**
     * @param \DateTime $updatedAt
     */
    public function setUpdatedAt(\DateTime $updatedAt)
    {
        $this->updatedAt = $updatedAt;
    }

    /**
     * @return \DateTime
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }


}
