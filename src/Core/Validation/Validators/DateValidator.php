<?php
namespace GooBiq\Core\Validation\Validators;

use GooBiq\Core\Validation\Validators\BaseValidator;

/**
 * DateValidator
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