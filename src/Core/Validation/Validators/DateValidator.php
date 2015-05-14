<?php
namespace GooBiq\Core\Validation\Validators;

use GooBiq\Core\Validation\Validators\BaseValidator;

/**
 * DateValidator
 *
 * @author Jason Lam <jasonlam604@gmail.com>
 * @copyright 2015 Jason Lam
 * @package /GooBiq/Core/Validation/Validators
 * @license MIT LICENSE http://opensource.org/licenses/MIT
 */
class DateValidator extends BaseValidator
{

    public function __construct($value)
    {
        parent::__construct($value);
    }

    protected function validationRules()
    {
        if (strtotime($this->getValue()) !== FALSE) {
            $this->validationPass();
        } else {
            if (empty($this->getErrorMessage()))
                $this->setErrorMessage('Invalid date, ' . $this->getValue());
            $this->validationFailed();
        }
    }
}