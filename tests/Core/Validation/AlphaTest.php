<?php

use GooBiq\Core\Validation\Validator;
use GooBiq\Core\Validation\Validators\AlphaValidator;

/**
 * AlphaTest
 * 
 * @author Jason Lam
 * 
 * @see Goobiq\Core\Validation\Validators\AlphaValidator
 */
class AlphaTest extends PHPUnit_Framework_TestCase {

    public function testValidAlpha()
    {
        $validator = new Validator();
        $validator->add(new AlphaValidator('abcdedfghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'));
        $validator->validate();
        $this->assertTrue($validator->isValid());
    }
    
    public function testInValidAlphaNumeric()
    {
        $validator = new Validator();
        $validator->add(new AlphaValidator('9999999abcdedfghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'));
        $validator->validate();
        $this->assertFalse($validator->isValid());
    }
    
    public function testValidExactLength()
    {
        $val = new AlphaValidator('ABC');
        $val->checkExactLength(3);
        $validator = new Validator();
        $validator->add($val);
        $validator->validate();
        $this->assertTrue($validator->isValid());
    }
    
    public function testInValidExactLength()
    {
        $val = new AlphaValidator('ABC');
        $val->checkExactLength(1);
        $validator = new Validator();
        $validator->add($val);
        $validator->validate();
        $this->assertFalse($validator->isValid());
    }
    
    public function testValidMaxLength()
    {
        $val = new AlphaValidator('ABC');
        $val->checkMaxLength(3);
        $validator = new Validator();
        $validator->add($val);
        $validator->validate();
        $this->assertTrue($validator->isValid());
    }
    
    public function testInValidMaxLength()
    {
        $val = new AlphaValidator('ABC');
        $val->checkMaxLength(2);
        $validator = new Validator();
        $validator->add($val);
        $validator->validate();
        $this->assertFalse($validator->isValid());
    }
    
    public function testValidMinLength()
    {
        $val = new AlphaValidator('ABC');
        $val->checkMinLength(3);
        $validator = new Validator();
        $validator->add($val);
        $validator->validate();
        $this->assertTrue($validator->isValid());
    }
    
    public function testInValidMinLength()
    {
        $val = new AlphaValidator('ABC');
        $val->checkMinLength(4);
        $validator = new Validator();
        $validator->add($val);
        $validator->validate();
        $this->assertFalse($validator->isValid());
    }
    
}