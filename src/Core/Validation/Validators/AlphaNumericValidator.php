<?php
namespace GooBiq\Core\Validation\Validators;

use GooBiq\Core\Validation\Validators\LengthValidator;

/**
 * AlphaNumericValidator
 *
 * @author Jason Lam <jasonlam604@gmail.com>
 * @copyright 2015 Jason Lam
 * @package /GooBiq/Core/Validation/Validators
 * @license MIT LICENSE http://opensource.org/licenses/MIT
 */
class AlphaNumericValidator extends LengthValidator
{

    public function __construct($value)
    {
        parent::__construct($value);
    }

    protected function validationRules()
    {
        if (ctype_alnum($this->getValue())) {
            $this->validationPass();
        } else {
            if (empty($this->getErrorMessage()))
                $this->setErrorMessage('Invalid, ' . $this->getValue() . ' does not consist of all letters or digits');
            $this->validationFailed();
        }
    }
}