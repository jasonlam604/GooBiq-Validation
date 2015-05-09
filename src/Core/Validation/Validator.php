<?php
namespace GooBiq\Core\Validation;

use GooBiq\Core\Exception\ExceptionCode;
use GooBiq\Core\Exception\GooBiqCoreException;
use GooBiq\Core\Validation\Validators\ValidateInterface;

/**
 * Validator
 *
 * @author Jason Lam <jasonlam604@gmail.com>
 * @copyright 2015 Jason Lam
 * @package /GooBiq/Core/Validation
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
class Validator
{

    private $validators;

    private $stopOnError;

    private $throwException;

    private $errorMessages;

    private $valid;

    public function __construct()
    {
        $this->reset();
    }

    public function reset()
    {
        $this->validators = array();
        $this->stopOnError = false;
        $this->throwException = false;
        $this->errorMessages = array();
    }

    public function enableStopOnError()
    {
        $this->stopOnError = true;
    }

    public function disableStopOnError()
    {
        $this->stopOnError = false;
    }

    public function enableThrowExceptionOnError()
    {
        $this->throwException = true;
    }

    public function disableThrowExceptionOnError()
    {
        $this->throwException = false;
    }

    public function isValid()
    {
        return $this->valid;
    }

    public function getErrorMessage()
    {
        return $this->errorMessages;
    }

    public function add(ValidateInterface $validator)
    {
        $this->validators[] = $validator;
    }

    public function validate()
    {
        $this->valid = true;
        foreach ($this->validators as $validator) {
            $validator->validate();
            
            if (! $validator->isValid()) {
                $this->valid = false;
                
                $this->errorMessages[] = $validator->getErrorMessage();
                
                if ($this->stopOnError) {
                    break;
                }
                
                if ($this->throwException) {
                    throw new GooBiqCoreException($validator->getErrorMessage(), ExceptionCode::VALIDATION_ERROR);
                }
            }
        }
    }
}