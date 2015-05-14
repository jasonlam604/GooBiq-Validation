<?php
namespace GooBiq\Core\Validation\Validators;

use GooBiq\Core\Validation\Validators\BaseValidator;

/**
 * IPV4Validator
 *
 * @author Jason Lam <jasonlam604@gmail.com>
 * @copyright 2015 Jason Lam
 * @package /GooBiq/Core/Validation/Validators
 * @license MIT LICENSE http://opensource.org/licenses/MIT
 */
class IPV4Validator extends BaseValidator
{

    public function __construct($value)
    {
        parent::__construct($value);
    }

    protected function validationRules()
    {
        if (filter_var($this->getValue(), FILTER_VALIDATE_IP) !== FALSE) {
            $this->validationPass();
        } else {
            if (empty($this->getErrorMessage()))
                $this->setErrorMessage('Invalid IPv4, ' . $this->getValue());
            $this->validationFailed();
        }
    }
}