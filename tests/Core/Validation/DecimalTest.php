<?php

use GooBiq\Core\Exception\ExceptionCode;
use GooBiq\Core\Exception\GooBiqCoreException;
use GooBiq\Core\Validation\Validator;
use GooBiq\Core\Validation\Validators\DecimalValidator;

/**
 * Decimal Test
 * 
 * @author Jason Lam
 * 
 * @see Goobiq\Core\Validation\Validators\DecimalValidator
 */
class DecimalTest extends PHPUnit_Framework_TestCase {

    public function testValidDecimal()
    {
        $validator = new Validator();

        $validator->add(new DecimalValidator(987654321.123456789));
        $validator->add(new DecimalValidator(987654321));
        $validator->add(new DecimalValidator(.123456789));
        $validator->add(new DecimalValidator(0.123456789));
        $validator->add(new DecimalValidator(1));
        $validator->add(new DecimalValidator(1.1));
        $validator->add(new DecimalValidator(0));
        $validator->add(new DecimalValidator(0.0));
        $validator->add(new DecimalValidator(0.00));
        $validator->add(new DecimalValidator(-0));
        $validator->add(new DecimalValidator(-0.0));
        $validator->add(new DecimalValidator(-0.00));
        $validator->add(new DecimalValidator(-1.1));
        $validator->add(new DecimalValidator(-1));
        $validator->add(new DecimalValidator(-0.123456789));
        $validator->add(new DecimalValidator(-.123456789));
        $validator->add(new DecimalValidator(-987654321));
        $validator->add(new DecimalValidator(-987654321.123456789));
        
        $validator->validate();
        $this->assertTrue($validator->isValid());
    }
    
    public function testValidDecimalUsingStringInputs()
    {
        $validator = new Validator();
    
        $validator->add(new DecimalValidator('987654321.123456789'));
        $validator->add(new DecimalValidator('987654321'));
        $validator->add(new DecimalValidator('.123456789'));
        $validator->add(new DecimalValidator('0.123456789'));
        $validator->add(new DecimalValidator('1'));
        $validator->add(new DecimalValidator('1.1'));
        $validator->add(new DecimalValidator('0'));
        $validator->add(new DecimalValidator('0.0'));
        $validator->add(new DecimalValidator('0.00'));
        $validator->add(new DecimalValidator('-0'));
        $validator->add(new DecimalValidator('-0.0'));
        $validator->add(new DecimalValidator('-0.00'));
        $validator->add(new DecimalValidator('-1.1'));
        $validator->add(new DecimalValidator('-1'));
        $validator->add(new DecimalValidator('-0.123456789'));
        $validator->add(new DecimalValidator('-.123456789'));
        $validator->add(new DecimalValidator('-987654321'));
        $validator->add(new DecimalValidator('-987654321.123456789'));
    
        $validator->validate();
        $this->assertTrue($validator->isValid());
    }
    
    public function testValidDecimalWithInRange()
    {
        $validator = new Validator();
        
        $val = new DecimalValidator(199.99);
        $val->setRange(0,200);
        $validator->add($val);
        $validator->validate();
        $this->assertTrue($validator->isValid());
    }
    
    public function testDecimalOutsideUpperRange()
    {
        $validator = new Validator();
    
        $val = new DecimalValidator(200.00000001);
        $val->setRange(0,200);
        $validator->add($val);
        $validator->validate();
        $this->assertFalse($validator->isValid()); 
    }
    
    public function testDecimalOutsideLowerRange()
    {
        $validator = new Validator();
    
        $val = new DecimalValidator(0);
        $val->setRange(100,200);
        $validator->add($val);
        $validator->validate();
        $this->assertFalse($validator->isValid());
    }

    public function testValidDecimalExactLength()
    {
        $validator = new Validator();
    
        $val = new DecimalValidator(12345);
        $val->checkExactLength(5);
        $validator->add($val);
        $validator->validate();
        $this->assertTrue($validator->isValid());
    }
    
    public function testInvalidDecimalExactLength()
    {
        $validator = new Validator();
    
        $val = new DecimalValidator(12345);
        $val->checkExactLength(1);
        $validator->add($val);
        $validator->validate();
        $this->assertFalse($validator->isValid());
    }
    
    public function testValidMaxLength()
    {
        $val = new DecimalValidator(12345);
        $val->checkMaxLength(5);
        $validator = new Validator();
        $validator->add($val);
        $validator->validate();
        $this->assertTrue($validator->isValid());
    }
    
    public function testInValidMaxLength()
    {
        $val = new DecimalValidator(123456);
        $val->checkMaxLength(5);
        $validator = new Validator();
        $validator->add($val);
        $validator->validate();
        $this->assertFalse($validator->isValid());
    }
    
    public function testValidMinLength()
    {
        $val = new DecimalValidator(12345);
        $val->checkMinLength(5);
        $validator = new Validator();
        $validator->add($val);
        $validator->validate();
        $this->assertTrue($validator->isValid());
    }
    
    public function testInValidMinLength()
    {
        $val = new DecimalValidator(123);
        $val->checkMinLength(4);
        $validator = new Validator();
        $validator->add($val);
        $validator->validate();
        $this->assertFalse($validator->isValid());
    }
}