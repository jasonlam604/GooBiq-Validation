<?php

use GooBiq\Core\Validation\Validator;
use GooBiq\Core\Validation\Validators\NumberValidator;

/**
 * NumberTest
 * 
 * @author Jason Lam
 * 
 * @see Goobiq\Core\Validation\Validators\NumberValidator
 */
class NumberTest extends PHPUnit_Framework_TestCase {

    public function testValidNumbers()
    {
        $validator = new Validator();
        $validator->add(new NumberValidator(-1));
        $validator->add(new NumberValidator(-0));
        $validator->add(new NumberValidator(0));
        $validator->add(new NumberValidator(1));
        $validator->add(new NumberValidator(1234567890));
        $validator->add(new NumberValidator(-1234567890));
        $validator->add(new NumberValidator(0000000001));
        $validator->add(new NumberValidator('-1'));
        $validator->add(new NumberValidator('-0'));
        $validator->add(new NumberValidator('0'));
        $validator->add(new NumberValidator('1'));
        $validator->add(new NumberValidator('1234567890'));
        $validator->add(new NumberValidator('-1234567890'));
        $validator->validate();
        $this->assertTrue($validator->isValid());
    }    
    
    public function testInValidNumber()
    {
        $validator = new Validator();
        $validator->add(new NumberValidator('x'));
        $validator->validate();
        $this->assertFalse($validator->isValid());
    }
    
    public function testInValidNumberContainsDecimal()
    {
        $validator = new Validator();
        $validator->add(new NumberValidator(19.99));
        $validator->validate();
        $this->assertFalse($validator->isValid());
    }
    
    public function testRange()
    {
        $val = new NumberValidator(5);
        $val->setRange(4,6);
        
        $validator = new Validator();
        
        $validator->add($val);
        $validator->validate();
        
        $this->assertTrue($validator->isValid());
    }
    
    public function testInvalidRangeUpper()
    {
        $val = new NumberValidator(7);
        $val->setRange(4,6);
    
        $validator = new Validator();
    
        $validator->add($val);
        $validator->validate();
    
        $this->assertFalse($validator->isValid());
    }
    
    public function testInvalidRangeLower()
    {
        $val = new NumberValidator(3);
        $val->setRange(4,6);
    
        $validator = new Validator();
    
        $validator->add($val);
        $validator->validate();
    
        $this->assertFalse($validator->isValid());
    }
    
    /**
     * @expectedException     GooBiq\Core\Exception\GooBiqCoreException
     * @expectedExceptionCode GooBiq\Core\Exception\ExceptionCode::VALIDATION_INVALID_RANGE
     */
    public function testBadRangeValue()
    {
         $val = new NumberValidator(3);
        $val->setRange(null,6);
    }
   
}