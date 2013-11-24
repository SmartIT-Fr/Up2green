<?php

namespace Up2green\EducationBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

use Symfony\Component\Validator\Constraints as Assert;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * Classroom entity
 *
 * @ORM\Entity(repositoryClass="Up2green\EducationBundle\Repository\ClassroomRepository")
 * @ORM\Table(name="classroom")
 *
 * @Gedmo\Uploadable(path="/uploads/classrooms")
 */
class Classroom
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(length=30, unique=true)
     * @Assert\Length(max=30)
     */
    protected $name;

    /**
     * @ORM\Column(type="integer")
     * @Assert\NotBlank
     */
    protected $year;

    /**
     * @ORM\Column(nullable=true)
     * @Assert\Image
     * @Gedmo\UploadableFileName
     */
    protected $picture;

    /**
     * @ORM\Column(type="text")
     * @Assert\Length(max=2000)
     */
    protected $description;

    /**
     * @ORM\ManyToOne(targetEntity="Up2green\EducationBundle\Entity\School", inversedBy="classrooms", cascade={"remove"})
     * @ORM\JoinColumn(name="school_id", referencedColumnName="id", nullable=false, onDelete="CASCADE")
     */
    protected $school;

    /**
     * @ORM\ManyToOne(targetEntity="Up2green\UserBundle\Entity\User", inversedBy="classrooms", cascade={"remove"})
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id", nullable=false, onDelete="SET NULL")
     */
    protected $user;

    /**
     * @ORM\ManyToOne(targetEntity="Up2green\ReforestationBundle\Entity\Partner", inversedBy="classrooms")
     * @ORM\JoinColumn(name="partner_id", referencedColumnName="id", nullable=true, onDelete="SET NULL")
     */
    protected $partner;

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
     * @Gedmo\Slug(fields={"name"})
     * @ORM\Column(length=30, unique=true)
     */
    protected $slug;

    /**
     * @return string
     */
    public function __toString()
    {
        return (string)$this->name;
    }
}
