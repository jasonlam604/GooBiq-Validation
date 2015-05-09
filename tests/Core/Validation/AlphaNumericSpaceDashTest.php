<?php

use GooBiq\Core\Validation\Validator;
use GooBiq\Core\Validation\Validators\AlphaNumericSpaceDashValidator;

/**
 * AlphaNumericSpaceDashTest
 * 
 * @author Jason Lam
 * 
 * @see Goobiq\Core\Validation\Validators\AlphaNumericSpaceDashValidator
 */
class AlphaNumericSpaceDashTest extends PHPUnit_Framework_TestCase {

    public function testValidAlphaNumericSpaceDash()
    {
        $val = new AlphaNumericSpaceDashValidator('Jack Number9-');
        $validator = new Validator();
        $validator->add($val);
        $validator->validate();
        $this->assertTrue($validator->isValid());
    }
    
    public function testInValidAlphaNumericSpaceDach()
    {
        $val = new AlphaNumericSpaceDashValidator('Jack Number9-!');
        $validator = new Validator();
        $validator->add($val);
        $validator->validate();
        $this->assertFalse($validator->isValid());
    }
    
    public function testValidExactLength()
    {
        $val = new AlphaNumericSpaceDashValidator('A -');
        $val->checkExactLength(3);
        $validator = new Validator();
        $validator->add($val);
        $validator->validate();
        $this->assertTrue($validator->isValid());
    }
    
    public function testInValidExactLength()
    {
        $val = new AlphaNumericSpaceDashValidator('A -');
        $val->checkExactLength(1);
        $validator = new Validator();
        $validator->add($val);
        $validator->validate();
        $this->assertFalse($validator->isValid());
    }
    
    public function testValidMaxLength()
    {
        $val = new AlphaNumericSpaceDashValidator('A -');
        $val->checkMaxLength(3);
        $validator = new Validator();
        $validator->add($val);
        $validator->validate();
        $this->assertTrue($validator->isValid());
    }
    
    public function testInValidMaxLength()
    {
        $val = new AlphaNumericSpaceDashValidator('A -');
        $val->checkMaxLength(2);
        $validator = new Validator();
        $validator->add($val);
        $validator->validate();
        $this->assertFalse($validator->isValid());
    }
    
    public function testValidMinLength()
    {
        $val = new AlphaNumericSpaceDashValidator('A -');
        $val->checkMinLength(3);
        $validator = new Validator();
        $validator->add($val);
        $validator->validate();
        $this->assertTrue($validator->isValid());
    }
    
    public function testInValidMinLength()
    {
        $val = new AlphaNumericSpaceDashValidator('A -');
        $val->checkMinLength(4);
        $validator = new Validator();
        $validator->add($val);
        $validator->validate();
        $this->assertFalse($validator->isValid());
    }
}