<?php
namespace GooBiq\Core\Validation\Validators;

use GooBiq\Core\Validation\GooBiqValidationException;
use GooBiq\Core\Validation\Validators\LengthValidator;
use GooBiq\Core\Validation\Validator;

/**
 * DecimalValidator
 *
 * @author Jason Lam <jasonlam604@gmail.com>
 * @copyright 2015 Jason Lam
 * @package /GooBiq/Core/Validation/Validators
 * @license MIT LICENSE http://opensource.org/licenses/MIT
 */
class DecimalValidator extends LengthValidator
{

    private $max;

    private $min;

    public function __construct($value)
    {
        parent::__construct($value);
    }

    public function setRange($min, $max)
    {
        if (filter_var($max, FILTER_VALIDATE_FLOAT) !== false && filter_var($min, FILTER_VALIDATE_FLOAT) !== false) {
            $this->max = floatval($max);
            $this->min = floatval($min);
        } else {
            throw new GooBiqValidationException('Max or Min value is invalid', Validator::VALIDATION_INVALID_MAX_OR_MIN);
        }
    }

    private function checkMax()
    {
        if ($this->max == NULL)
            return true;
        
        if (floatval($this->getValue()) <= $this->max)
            return true;
        else
            return false;
    }

    private function checkMin()
    {
        if ($this->min == NULL)
            return true;
        
        if (floatval($this->getValue()) >= $this->min)
            return true;
        else
            return false;
    }

    protected function validationRules()
    {
        if (filter_var($this->getValue(), FILTER_VALIDATE_FLOAT) !== false) {
            if ($this->checkMin() && $this->checkMax()) {
                $this->validationPass();
            } else {
                $this->setErrorMessage('Invalid, ' . $this->getValue() . ' out of max or min range');
                $this->validationFailed();
            }
        } else {
            if (empty($this->getErrorMessage()))
                $this->setErrorMessage('Invalid, ' . $this->getValue() . ' is not a valid number');
            $this->validationFailed();
        }
    }
}