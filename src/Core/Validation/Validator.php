<?php
namespace GooBiq\Core\Validation;

use GooBiq\Core\Validation\GooBiqValidationException;
use GooBiq\Core\Validation\Validators\ValidateInterface;

/**
 * Validator
 *
 * @author Jason Lam <jasonlam604@gmail.com>
 * @copyright 2015 Jason Lam
 * @package /GooBiq/Core/Validation     
 * @license MIT LICENSE http://opensource.org/licenses/MIT
 */
class Validator
{
    
    const VALIDATION_ERROR = 800;
    
    const VALIDATION_INVALID_MAX_OR_MIN = 801;
    
    const VALIDATION_INVALID_MAX_LENGTH = 802;
    
    const VALIDATION_INVALID_MIN_LENGTH = 803;
    
    const VALIDATION_INVALID_EXACT_LENGTH = 804;
    
    const VALIDATION_INVALID_RANGE = 805;

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
                    throw new GooBiqValidationException($validator->getErrorMessage(), Validator::VALIDATION_ERROR);
                }
            }
        }
    }
}