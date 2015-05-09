<?php
namespace GooBiq\Core\Validation\Validators;

use GooBiq\Core\Validation\Validators\LengthValidator;
use GooBiq\Core\Exception\GooBiqCoreException;
use GooBiq\Core\Exception\ExceptionCode;

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
            throw new GooBiqCoreException('Max or Min values for range is invalid', ExceptionCode::VALIDATION_INVALID_RANGE);
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