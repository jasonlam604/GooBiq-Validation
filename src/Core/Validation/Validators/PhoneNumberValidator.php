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
 *         
 * @license MIT LICENSE
 *         
 *          Permission is hereby granted, free of charge, to any person obtaining
 *          a copy of this software and associated documentation files (the
 *          "Software"), to deal in the Software without restriction, including
 *          without limitation the rights to use, copy, modify, merge, publish,
 *          distribute, sublicense, and/or sell copies of the Software, and to
 *          permit persons to whom the Software is furnished to do so, subject to
 *          the following conditions:
 *         
 *          The above copyright notice and this permission notice shall be
 *          included in all copies or substantial portions of the Software.
 *         
 *          THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND,
 *          EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF
 *          MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND
 *          NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE
 *          LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION
 *          OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION
 *          WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
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