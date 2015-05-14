<?php
use GooBiq\Core\Validation\Validator;
use GooBiq\Core\Validation\Validators\PhoneNumberValidator;

/**
 * PhoneNumberTest
 *
 * @author Jason Lam
 *        
 * @see Goobiq\Core\Validation\Validators\PhoneNumberValidator
 */
class PhoneNumberTest extends PHPUnit_Framework_TestCase
{

    public function testValidPhoneNumbers()
    {
        $validator = new Validator();
        $validator->add(new PhoneNumberValidator('555-5555'));
        $validator->add(new PhoneNumberValidator('(555) 555 5555'));
        $validator->add(new PhoneNumberValidator('+1 (555) 555.5555'));
        
        $validator->validate();
        $this->assertTrue($validator->isValid());
    }

    public function testInValidPhoneNumber1()
    {
        $validator = new Validator();
        $validator->add(new PhoneNumberValidator('5554-5555'));
        $validator->validate();
        $this->assertFalse($validator->isValid());
    }

    public function testInValidPhoneNumber2()
    {
        $validator = new Validator();
        $validator->add(new PhoneNumberValidator('x'));
        $validator->validate();
        $this->assertFalse($validator->isValid());
    }

    public function testInValidPhoneNumber3()
    {
        $validator = new Validator();
        $validator->add(new PhoneNumberValidator(''));
        $validator->validate();
        $this->assertFalse($validator->isValid());
    }

    public function testInValidPhoneNumber4()
    {
        $validator = new Validator();
        $validator->add(new PhoneNumberValidator('55556'));
        $validator->validate();
        $this->assertFalse($validator->isValid());
    }
}