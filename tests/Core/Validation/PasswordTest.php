<?php
use GooBiq\Core\Validation\Validator;
use GooBiq\Core\Validation\Validators\PasswordValidator;

/**
 * PasswordTest
 *
 * @author Jason Lam
 *        
 * @see Goobiq\Core\Validation\Validators\PasswordValidator
 */
class PasswordTest extends PHPUnit_Framework_TestCase
{

    public function testValidPassword()
    {
        $validator = new Validator();
        $validator->add(new PasswordValidator('MyPaszw0rd!'));
        $validator->validate();
        $this->assertTrue($validator->isValid());
    }
    
    public function testValidPasswordNoSpecialSymbols()
    {
        $validator = new Validator();
        $validator->add(new PasswordValidator('MyPaszw0rd'));
        $validator->validate();
        $this->assertTrue($validator->isValid());
    }
    
    public function testMissingAtLeastOneCapLetter()
    {
        $validator = new Validator();
        $validator->add(new PasswordValidator('pazsw0rd!'));
        $validator->validate();
        $this->assertTrue(!$validator->isValid());
    }

    public function testMissingAtLeastOneLowerLetter()
    {
        $validator = new Validator();
        $validator->add(new PasswordValidator('PAZSW0RD!'));
        $validator->validate();
        $this->assertTrue(!$validator->isValid());
    }
    
    public function testMissingAtLeastOneDigit()
    {
        $validator = new Validator();
        $validator->add(new PasswordValidator('PaZswOrd!'));
        $validator->validate();
        $this->assertTrue(!$validator->isValid());
    }
  
}