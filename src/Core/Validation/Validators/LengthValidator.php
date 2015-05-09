<?php
namespace GooBiq\Core\Validation\Validators;

use GooBiq\Core\Exception\GooBiqCoreException;
use GooBiq\Core\Exception\ExceptionCode;

/**
 * LengthValidator
 *
 * @author Jason Lam <jasonlam604@gmail.com>
 * @copyright 2015 Jason Lam
 * @package /GooBiq/Core/Validation/Validators
 *         
 * @license MIT LICENSE
 *         
 *          Permission is hereby granted, free of charge, to any person obtaining
 *          a copy of this software and associated documentation files (the
 *          "Software"), to deal in the Software without restriction, including
 *          without limitation the rights to use, copy, modify, merge, publish,
 *          distribute, sublicense, and/or sell copies of the Software, and to
 *          permit persons to whom the Software is furnished to do so, subject to
 *          the following conditions:
 *         
 *          The above copyright notice and this permission notice shall be
 *          included in all copies or substantial portions of the Software.
 *         
 *          THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND,
 *          EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF
 *          MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND
 *          NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE
 *          LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION
 *          OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION
 *          WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
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
            throw new GooBiqCoreException('Max length not a numeric value or not greater then 0', ExceptionCode::VALIDATION_INVALID_MAX_LENGTH);
    }

    public function checkMinLength($length)
    {
        if (is_numeric($length) && $length > 0)
            $this->minLength = $length;
        else
            throw new GooBiqCoreException('Min length not a numeric value or not greater then 0', ExceptionCode::VALIDATION_INVALID_MIN_LENGTH);
    }

    public function checkExactLength($length)
    {
        if (is_numeric($length) && $length > 0)
            $this->exactLength = $length;
        else
            throw new GooBiqCoreException('Exact length not matching', ExceptionCode::VALIDATION_INVALID_EXACT_LENGTH);
    }
}