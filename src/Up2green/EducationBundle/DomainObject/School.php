<?php
namespace Up2green\EducationBundle\DomainObject;

use Symfony\Component\Validator\Constraints as Assert;
use Up2green\EducationBundle\Entity\School as SchoolEntity;

/**
 * School domain object
 */
class School
{
    const SCHOOL_EXISTING  = 'existing';
    const SCHOOL_NEW = 'new';

    /**
     * @Assert\NotBlank()
     */
    public $choice;

    public $existing;

    /**
     * @Assert\Valid()
     */
    public $new;

    /**
     * @param object $schoolModel
     */
    public function __construct(SchoolEntity $school = null)
    {
        $this->new  = $school ?: new SchoolEntity();
    }

    /**
     * @return object
     * @Assert\NotNull(message="form.validation.school_list")
     */
    public function getSchool()
    {
        return self::SCHOOL_EXISTING === $this->choice ? $this->existing : $this->new;
    }
}
