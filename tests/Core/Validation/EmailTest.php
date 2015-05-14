<?php
use GooBiq\Core\Validation\Validator;
use GooBiq\Core\Validation\Validators\EmailValidator;

/**
 * EmailTest
 *
 * @author Jason Lam
 *        
 * @see Goobiq\Core\Validation\Validators\EmailValidator
 */
class EmailTest extends PHPUnit_Framework_TestCase
{

    public function testValidEmail()
    {
        $validator = new Validator();
        $validator->add(new EmailValidator('jasonlam604@gmail.com'));
        $validator->add(new EmailValidator('x@x.org'));
        $validator->add(new EmailValidator('111@somewhere.com'));
        $validator->validate();
        $this->assertTrue($validator->isValid());
    }

    public function testInValidEmail()
    {
        $validator = new Validator();
        $validator->add(new EmailValidator('!jasonlam604@gmail.com!'));
        $validator->validate();
        $this->assertFalse($validator->isValid());
    }

    public function testValidEmailMaxLength()
    {
        $val = new EmailValidator('jasonlam604@gmail.com');
        $val->checkMaxLength(255);
        $validator = new Validator();
        $validator->add($val);
        $validator->validate();
        $this->assertTrue($validator->isValid());
    }

    public function testInValidEmailMaxLength()
    {
        $val = new EmailValidator('jasonlam604@gmail.com');
        $val->checkMaxLength(20);
        $validator = new Validator();
        $validator->add($val);
        $validator->validate();
        $this->assertFalse($validator->isValid());
    }

    public function testValidEmailMinLength()
    {
        $val = new EmailValidator('xx@x.com');
        $val->checkMinLength(8);
        $validator = new Validator();
        $validator->add($val);
        $validator->validate();
        $this->assertTrue($validator->isValid());
    }

    public function testInValidEmailMinLength()
    {
        $val = new EmailValidator('x@x.com');
        $val->checkMinLength(8);
        $validator = new Validator();
        $validator->add($val);
        $validator->validate();
        $this->assertFalse($validator->isValid());
    }
}