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
 * @Gedmo\Uploadable(filenameGenerator="ALPHANUMERIC", appendNumber=true, pathMethod="getPath")
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
     * @Gedmo\UploadableFileName
     */
    protected $picture;

    /**
     * @Assert\Image
     */
    protected $pictureFile;

    /**
     * @var Classroom
     *
     * @ORM\ManyToOne(targetEntity="Up2green\EducationBundle\Entity\Classroom", cascade={"remove"}, inversedBy="classroomPictures")
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
    public function getPath($defaultPath = '')
    {
        return sprintf("%s/uploads/classrooms/pictures", $defaultPath);
    }

    /**
     * @param Classroom $classroom
     */
    public function setClassroom(Classroom $classroom)
    {
        $this->classroom = $classroom;
    }

    /**
     * @return Classroom
     */
    public function getClassroom()
    {
        return $this->classroom;
    }

    /**
     * @param \DateTime $createdAt
     */
    public function setCreatedAt(\DateTime $createdAt)
    {
        $this->createdAt = $createdAt;
    }

    /**
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * @param integer $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return integer
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
     * @param mixed $pictureFile
     */
    public function setPictureFile($pictureFile)
    {
        $this->pictureFile = $pictureFile;
    }

    /**
     * @return mixed
     */
    public function getPictureFile()
    {
        return $this->pictureFile;
    }

    /**
     * @param Program $program
     */
    public function setProgram(Program $program)
    {
        $this->program = $program;
    }

    /**
     * @return Program
     */
    public function getProgram()
    {
        return $this->program;
    }

    /**
     * @param string $student
     */
    public function setStudent($student)
    {
        $this->student = $student;
    }

    /**
     * @return string
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
