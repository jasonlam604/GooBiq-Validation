<?php
namespace GooBiq\Core\Validation\Validators;

use GooBiq\Core\Validation\Validators\BaseValidator;

/**
 * PhoneNumberValidator
 *
 * Very basic phone number checker, remove things such as dashes, periods, braces, spaces
 * then checks if the phone numbers is length; default length checkes are 7, 10 or 11
 *
 * ie: 555-5555, (555) 555 5555, +1 (555) 555.5555
 *
 * @author Jason Lam <jasonlam604@gmail.com>
 * @copyright 2015 Jason Lam
 * @package /GooBiq/Core/Validation/Validators
 * @license MIT LICENSE http://opensource.org/licenses/MIT
 */
class PhoneNumberValidator extends BaseValidator
{

    private $validLengths = array(
        7,
        10,
        11
    );

    public function __construct($value)
    {
        parent::__construct($value);
    }

    public function setValidPhoneLengths(array $validLengths)
    {
        $this->validLengths = $validLengths;
    }

    protected function validationRules()
    {
        $value = preg_replace('/\D+/', '', $this->getValue());
        
        if (in_array(strlen($value), $this->validLengths)) {
            $this->validationPass();
        } else {
            if (empty($this->getErrorMessage()))
                $this->setErrorMessage('Invalid phone number, ' . $this->getValue());
            $this->validationFailed();
        }
    }
}