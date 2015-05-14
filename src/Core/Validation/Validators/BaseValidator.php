<?php
namespace GooBiq\Core\Validation\Validators;

use GooBiq\Core\Validation\Validators\ValidateInterface;

/**
 * BaseValidator
 *
 * @author Jason Lam <jasonlam604@gmail.com>
 * @copyright 2015 Jason Lam
 * @package /GooBiq/Core/Validation/Validators
 * @license MIT LICENSE http://opensource.org/licenses/MIT
 */
abstract class BaseValidator implements ValidateInterface
{

    private $value;

    private $valid;

    private $errorMessage;

    public function __construct($value)
    {
        $this->value = $value;
    }

    abstract protected function validationRules();

    public function validate()
    {
        $this->validationRules();
    }

    public function setErrorMessage($errorMessage)
    {
        $this->errorMessage = $errorMessage;
    }

    public function getErrorMessage()
    {
        return $this->errorMessage;
    }

    public function getValue()
    {
        return $this->value;
    }

    protected function validationPass()
    {
        $this->valid = true;
    }

    protected function validationFailed()
    {
        $this->valid = false;
    }

    public function isValid()
    {
        return $this->valid;
    }
}