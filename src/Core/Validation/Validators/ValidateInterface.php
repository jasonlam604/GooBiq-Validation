<?php
namespace GooBiq\Core\Validation\Validators;

/**
 * ValidateInterface
 *
 * @author Jason Lam <jasonlam604@gmail.com>
 * @copyright 2015 Jason Lam
 * @package /GooBiq/Core/Validation/Validators
 * @license MIT LICENSE http://opensource.org/licenses/MIT
 */
interface ValidateInterface
{

    public function validate();

    public function isValid();

    public function getErrorMessage();

    public function setErrorMessage($message);
}
