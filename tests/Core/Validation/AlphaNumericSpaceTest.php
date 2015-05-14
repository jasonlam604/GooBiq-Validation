<?php
use GooBiq\Core\Validation\Validator;
use GooBiq\Core\Validation\Validators\AlphaNumericSpaceValidator;

/**
 * AlphaNumericSpaceTest
 *
 * @author Jason Lam
 *        
 * @see Goobiq\Core\Validation\Validators\AlphaNumericSpaceValidator
 */
class AlphaNumericSpaceTest extends PHPUnit_Framework_TestCase
{

    public function testValidAlphaNumericSpace()
    {
        $val = new AlphaNumericSpaceValidator('Jack1 Number ');
        $validator = new Validator();
        $validator->add($val);
        $validator->validate();
        $this->assertTrue($validator->isValid());
    }

    public function testInValidAlphaNumericSpace()
    {
        $val = new AlphaNumericSpaceValidator('Jack Number 9-');
        $validator = new Validator();
        $validator->add($val);
        $validator->validate();
        $this->assertFalse($validator->isValid());
    }

    public function testValidExactLength()
    {
        $val = new AlphaNumericSpaceValidator('A 1');
        $val->checkExactLength(3);
        $validator = new Validator();
        $validator->add($val);
        $validator->validate();
        $this->assertTrue($validator->isValid());
    }

    public function testInValidExactLength()
    {
        $val = new AlphaNumericSpaceValidator('A 1');
        $val->checkExactLength(1);
        $validator = new Validator();
        $validator->add($val);
        $validator->validate();
        $this->assertFalse($validator->isValid());
    }

    public function testValidMaxLength()
    {
        $val = new AlphaNumericSpaceValidator('ABC');
        $val->checkMaxLength(3);
        $validator = new Validator();
        $validator->add($val);
        $validator->validate();
        $this->assertTrue($validator->isValid());
    }

    public function testInValidMaxLength()
    {
        $val = new AlphaNumericSpaceValidator('ABC');
        $val->checkMaxLength(2);
        $validator = new Validator();
        $validator->add($val);
        $validator->validate();
        $this->assertFalse($validator->isValid());
    }

    public function testValidMinLength()
    {
        $val = new AlphaNumericSpaceValidator('ABC');
        $val->checkMinLength(3);
        $validator = new Validator();
        $validator->add($val);
        $validator->validate();
        $this->assertTrue($validator->isValid());
    }

    public function testInValidMinLength()
    {
        $val = new AlphaNumericSpaceValidator('ABC');
        $val->checkMinLength(4);
        $validator = new Validator();
        $validator->add($val);
        $validator->validate();
        $this->assertFalse($validator->isValid());
    }
}