<?php
namespace GooBiq\Core\Validation\Validators;

use GooBiq\Core\Validation\Validators\LengthValidator;

/**
 * RegexValidator
 *
 * @author Jason Lam <jasonlam604@gmail.com>
 * @copyright 2015 Jason Lam
 * @package /GooBiq/Core/Validation/Validators
 * @license MIT LICENSE http://opensource.org/licenses/MIT
 */
class RegexValidator extends LengthValidator
{

    private $regexPattern;

    public function __construct($value, $regexPattern)
    {
        parent::__construct($value);
        $this->regexPattern = $regexPattern;
    }

    protected function validationRules()
    {
        if (preg_match($this->regexPattern, $this->getValue())) {
            $this->validationPass();
        } else {
            if (empty($this->getErrorMessage()))
                $this->setErrorMessage($this->getValue() . ' does not match the regex pattern');
            $this->validationFailed();
        }
    }
}