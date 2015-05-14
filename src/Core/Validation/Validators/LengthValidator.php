<?php
namespace GooBiq\Core\Validation\Validators;

use GooBiq\Core\Validation\GooBiqValidationException;
use GooBiq\Core\Validation\Validator;

/**
 * LengthValidator
 *
 * @author Jason Lam <jasonlam604@gmail.com>
 * @copyright 2015 Jason Lam
 * @package /GooBiq/Core/Validation/Validators
 * @license MIT LICENSE http://opensource.org/licenses/MIT
 */
abstract class LengthValidator extends BaseValidator
{

    private $maxLength;

    private $minLength;

    private $exactLength;

    public function __construct($value)
    {
        parent::__construct($value);
    }

    public function validate()
    {
        if ($this->validateLength()) {
            parent::validate();
        }
    }

    private function validateLength()
    {
        if ($this->validateExactLength() && $this->validateMaxLength() && $this->validateMinLength()) {
            return true;
        } else {
            return false;
        }
    }

    private function validateExactLength()
    {
        if ($this->exactLength <= 0)
            return true;
        
        if (strlen($this->getValue()) == $this->exactLength) {
            $this->validationPass();
            return true;
        } else {
            $this->validationFailed();
            $msg = $this->getErrorMessage();
            if (empty($msg))
                $this->setErrorMessage('The length of ' . $this->getValue() . ' is not exactly ' . $this->exactLength);
            return false;
        }
    }

    private function validateMaxLength()
    {
        if ($this->maxLength <= 0)
            return true;
        
        if (strlen($this->getValue()) <= $this->maxLength) {
            $this->validationPass();
            return true;
        } else {
            $this->validationFailed();
            if (empty($this->getErrorMessage()))
                $this->setErrorMessage('The length of ' . $this->getValue() . ' is exceeds the maximum length of ' . $this->maxLength);
            return false;
        }
    }

    private function validateMinLength()
    {
        if ($this->minLength <= 0)
            return true;
        
        if (strlen($this->getValue()) >= $this->minLength) {
            $this->validationPass();
            return true;
        } else {
            $this->validationFailed();
            if (empty($this->getErrorMessage()))
                $this->setErrorMessage('The length of ' . $this->getValue() . ' is less then minimum required length of ' . $this->minLength);
            return false;
        }
    }

    public function checkMaxLength($length)
    {
        if (is_numeric($length) && $length > 0)
            $this->maxLength = $length;
        else
            throw new GooBiqValidationException('Max length not a numeric value or not greater then 0', Validator::VALIDATION_INVALID_MAX_LENGTH);
    }

    public function checkMinLength($length)
    {
        if (is_numeric($length) && $length > 0)
            $this->minLength = $length;
        else
            throw new GooBiqValidationException('Min length not a numeric value or not greater then 0', Validator::VALIDATION_INVALID_MIN_LENGTH);
    }

    public function checkExactLength($length)
    {
        if (is_numeric($length) && $length > 0)
            $this->exactLength = $length;
        else
            throw new GooBiqValidationException('Exact length not matching', Validator::VALIDATION_INVALID_EXACT_LENGTH);
    }
}