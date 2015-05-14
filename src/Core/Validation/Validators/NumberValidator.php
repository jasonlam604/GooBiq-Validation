<?php
namespace GooBiq\Core\Validation\Validators;

use GooBiq\Core\Validation\Validators\LengthValidator;
use GooBiq\Core\Validation\GooBiqValidationException;
use GooBiq\Core\Validation\Validator;

/**
 * NumberValidator
 *
 * Validates the value to 'true' if it contains ONLY digits
 *
 * 3859 => valid
 * 3.43 => invalid
 * 3x344 => invalid
 *
 * @author Jason Lam <jasonlam604@gmail.com>
 * @copyright 2015 Jason Lam
 * @package /GooBiq/Core/Validation/Validators
 * @license MIT LICENSE http://opensource.org/licenses/MIT
 */
class NumberValidator extends LengthValidator
{

    private $max;

    private $min;

    public function __construct($value)
    {
        parent::__construct($value);
    }

    public function setRange($min, $max)
    {
        if (filter_var($max, FILTER_VALIDATE_INT) !== FALSE && filter_var($min, FILTER_VALIDATE_INT) !== FALSE) {
            $this->max = intval($max);
            $this->min = intval($min);
        } else {
            throw new GooBiqValidationException('Max or Min values for range is invalid', Validator::VALIDATION_INVALID_RANGE);
        }
    }

    private function checkMax()
    {
        if ($this->max == NULL)
            return true;
        
        if (intval($this->getValue()) <= $this->max)
            return true;
        else
            return false;
    }

    private function checkMin()
    {
        if ($this->min == NULL)
            return true;
        
        if (intval($this->getValue()) >= $this->min)
            return true;
        else
            return false;
    }

    protected function validationRules()
    {
        if (filter_var($this->getValue(), FILTER_VALIDATE_INT) !== FALSE) {
            if ($this->checkMin() && $this->checkMax()) {
                $this->validationPass();
            } else {
                $this->setErrorMessage('Invalid, ' . $this->getValue() . ' out of max or min range');
                $this->validationFailed();
            }
        } else {
            if (empty($this->getErrorMessage()))
                $this->setErrorMessage('Invalid, ' . $this->getValue() . ' does not consist of only numbers');
            $this->validationFailed();
        }
    }
}