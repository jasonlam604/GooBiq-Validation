<?php
namespace GooBiq\Core\Validation\Validators;

use GooBiq\Core\Validation\Validators\LengthValidator;

/**
 * AlphaNumericSpaceDashValidator
 *
 * @author Jason Lam <jasonlam604@gmail.com>
 * @copyright 2015 Jason Lam
 * @package /GooBiq/Core/Validation/Validators
 * @license MIT LICENSE http://opensource.org/licenses/MIT
 */
class AlphaNumericSpaceDashValidator extends LengthValidator
{

    public function __construct($value)
    {
        parent::__construct($value);
    }

    protected function validationRules()
    {
        if (preg_match('/^[\w\-\s]+$/', $this->getValue())) {
            $this->validationPass();
        } else {
            if (empty($this->getErrorMessage()))
                $this->setErrorMessage('Invalid, ' . $this->getValue() . ' can only consist of letters, number, spaces and dashes');
            $this->validationFailed();
        }
    }
}