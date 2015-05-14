<?php
namespace GooBiq\Core\Validation\Validators;

use GooBiq\Core\Validation\Validators\LengthValidator;

/**
 * EmailValidator
 *
 * @author Jason Lam <jasonlam604@gmail.com>
 * @copyright 2015 Jason Lam
 * @package /GooBiq/Core/Validation/Validators
 * @license MIT LICENSE http://opensource.org/licenses/MIT
 */
class EmailValidator extends LengthValidator
{

    public function __construct($value)
    {
        parent::__construct($value);
    }

    protected function validationRules()
    {
        if (filter_var($this->getValue(), FILTER_VALIDATE_EMAIL) !== FALSE) {
            $this->validationPass();
        } else {
            if (empty($this->getErrorMessage()))
                $this->setErrorMessage('Invalid email address, ' . $this->getValue());
            $this->validationFailed();
        }
    }
}