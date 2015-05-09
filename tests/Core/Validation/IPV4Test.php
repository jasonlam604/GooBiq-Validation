<?php

use GooBiq\Core\Validation\Validator;
use GooBiq\Core\Validation\Validators\IPV4Validator;

/**
 * IPV4Test
 * 
 * @author Jason Lam
 * 
 * @see Goobiq\Core\Validation\Validators\IPV4Validator
 */
class IPV4Test extends PHPUnit_Framework_TestCase {

    public function testValidIPv4()
    {
        $validator = new Validator();
        $validator->add(new IPV4Validator('192.168.1.1'));
        $validator->validate();
        $this->assertTrue($validator->isValid());
    }
    
    public function testInValidIPv4()
    {
        $validator = new Validator();
        $validator->add(new IPV4Validator('192.168.1.1.1'));
        $validator->validate();
        $this->assertFalse($validator->isValid());
    }

}