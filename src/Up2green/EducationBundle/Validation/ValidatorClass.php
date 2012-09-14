<?php
namespace Up2green\EducationBundle\Validation;

use Symfony\Component\Validator\ExecutionContext;
use Up2green\EducationBundle\DomainObject;
use Symfony\Component\Form\FormError;

class ValidatorClass
{
    public static function isSchoolValid(DomainObject\School $school, ExecutionContext $context)
    {
        if (DomainObject\School::SCHOOL_IN === $school->school) {
            if (null === $school->school_list) {
                $context->addViolation( "form.validation.school_list", array(), null);
            }
        } elseif (DomainObject\School::SCHOOL_OUT === $school->school) {
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