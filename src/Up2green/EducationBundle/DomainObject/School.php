<?php
namespace Up2green\EducationBundle\DomainObject;

use Symfony\Component\Form\FormError;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\ExecutionContext;
use Up2green\EducationBundle\Model;

/**
 * School domain object
 *
 * @Assert\Callback(methods={
 *     { "Up2green\EducationBundle\DomainObject\School", "isSchoolValid"}
 * })
 */
class School implements DomainObjectInterface
{
    const SCHOOL_IN  = 'school_in';
    const SCHOOL_OUT = 'school_out';

    public static $schoolChoices = array(
        self::SCHOOL_IN     => 'form.school_type.school_in',
        self::SCHOOL_OUT    => 'form.school_type.school_out'
    );

    /**
     * @Assert\NotBlank()
     */
    public $school;

    public $schoolList;
    public $name;
    public $address;

    protected $schoolModel;

    /**
     * @param object $schoolModel
     */
    public function __construct($schoolModel = null)
    {
        $this->schoolModel  = null === $schoolModel ? new Model\School() : $schoolModel;
        $this->name         = $this->schoolModel->getName();
        $this->address      = $this->schoolModel->getAddress();
    }

    /**
     * Save the domain object
     */
    public function save()
    {
        // If school is true, it's because the customer choose a school in the list
        if (self::SCHOOL_IN === $this->school) {
            $schoolModel = Model\SchoolQuery::create()->findOneById($this->schoolList);
            $this->schoolModel = $schoolModel;
        }

        if (self::SCHOOL_OUT === $this->school) {
            $this->schoolModel->setName($this->name);
            $this->schoolModel->setAddress($this->address);
            $this->schoolModel->save();
        }
    }

    /**
     * @return object
     */
    public function getSchoolModel()
    {
        return $this->schoolModel;
    }

    /**
     * @param School           $school
     * @param ExecutionContext $context
     *
     * @return \Symfony\Component\Validator\ExecutionContext
     */
    public static function isSchoolValid(School $school, ExecutionContext $context)
    {
        if (School::SCHOOL_IN === $school->school) {
            if (null === $school->schoolList) {
                $context->addViolation( "form.validation.school_list", array(), null);
            }
        } elseif (School::SCHOOL_OUT === $school->school) {
            if (null === $school->name) {
                $context->getRoot()->get('school')->get('name')->addError(new FormError('form.validation.school_name'));
            }
            if (null === $school->address) {
                $context->getRoot()->get('school')->get('address')->addError(new FormError('form.validation.school_address'));
            }
        }

        return $context;
    }
}