<?php
namespace GooBiq\Core\Validation\Validators;

/**
 * PasswordValidator
 *
 * Must be 8 minimum in length maximum of 16 length
 * Must contain at least one upper case letter
 * Must contain at least one lower case letter
 * Must contain at least one number
 * May contain special characters such as #, !, ?, ^, or @
 *
 * Error message by default is intentionally vague.
 *
 * @author Jason Lam <jasonlam604@gmail.com>
 * @copyright 2015 Jason Lam
 * @package /GooBiq/Core/Validation/Validators
 * @license MIT LICENSE http://opensource.org/licenses/MIT
 */
class PasswordValidator extends BaseValidator
{

    const FILTER_PASSWORD = '/^(?=^.{8,16}$)(?=.*[0-9])(?=.*[A-Z])(?=.*[a-z])(?=.*[!@#$%*-_=+.])(?!.*?(.)\1{1,})^.*$/';

    private $regexFilter;

    public function __construct($value)
    {
        parent::__construct($value);
    }

    public function setPasswordFilter($regexFilter)
    {
        $this->regexFilter = $regexFilter;
    }

    protected function validationRules()
    {
        if (! isset($this->regexFilter))
            $this->regexFilter = self::FILTER_PASSWORD;
        
        if (preg_match($this->regexFilter, $this->getValue())) {
            $this->validationPass();
        } else {
            if (empty($this->getErrorMessage()))
                $this->setErrorMessage('Not a valid password');
            $this->validationFailed();
        }
    }
}