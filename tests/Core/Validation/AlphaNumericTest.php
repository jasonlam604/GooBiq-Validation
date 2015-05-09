<?php

use GooBiq\Core\Validation\Validator;
use GooBiq\Core\Validation\Validators\AlphaNumericValidator;

/**
 * AlphaNumericTest
 * 
 * @author Jason Lam
 * 
 * @see Goobiq\Core\Validation\Validators\AlphaNumericValidator
 */
class AlphaNumericTest extends PHPUnit_Framework_TestCase {

    public function testValidAlphaValidNumeric()
    {
        $val = new AlphaNumericValidator('JackNumber9');
        $validator = new Validator();
        $validator->add($val);
        $validator->validate();
        $this->assertTrue($validator->isValid());
    }
    
    public function testInValidAlphaNumeric()
    {
        $val = new AlphaNumericValidator('JackNumber9-');
        $validator = new Validator();
        $validator->add($val);
        $validator->validate();
        $this->assertFalse($validator->isValid());
    }
    
    public function testValidExactLength()
    {
        $val = new AlphaNumericValidator('AB1');
        $val->checkExactLength(3);
        $validator = new Validator();
        $validator->add($val);
        $validator->validate();
        $this->assertTrue($validator->isValid());
    }
    
    public function testInValidExactLength()
    {
        $val = new AlphaNumericValidator('AB1');
        $val->checkExactLength(1);
        $validator = new Validator();
        $validator->add($val);
        $validator->validate();
        $this->assertFalse($validator->isValid());
    }
    
    public function testValidMaxLength()
    {
        $val = new AlphaNumericValidator('AB1');
        $val->checkMaxLength(3);
        $validator = new Validator();
        $validator->add($val);
        $validator->validate();
        $this->assertTrue($validator->isValid());
    }
    
    public function testInValidMaxLength()
    {
        $val = new AlphaNumericValidator('AB1');
        $val->checkMaxLength(2);
        $validator = new Validator();
        $validator->add($val);
        $validator->validate();
        $this->assertFalse($validator->isValid());
    }
    
    public function testValidMinLength()
    {
        $val = new AlphaNumericValidator('AB1');
        $val->checkMinLength(3);
        $validator = new Validator();
        $validator->add($val);
        $validator->validate();
        $this->assertTrue($validator->isValid());
    }
    
    public function testInValidMinLength()
    {
        $val = new AlphaNumericValidator('AB1');
        $val->checkMinLength(4);
        $validator = new Validator();
        $validator->add($val);
        $validator->validate();
        $this->assertFalse($validator->isValid());
    }
}