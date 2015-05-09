<?php

use GooBiq\Core\Validation\Validator;
use GooBiq\Core\Validation\Validators\IPV6Validator;

/**
 * IPV6Test
 * 
 * @author Jason Lam
 * 
 * @see Goobiq\Core\Validation\Validators\IPV6Validator
 */
class IPV6Test extends PHPUnit_Framework_TestCase {

    public function testValidIPv6()
    {
        $validator = new Validator();
        $validator->add(new IPV6Validator('2001:cdba:0000:0000:0000:0000:3257:9652'));
        $validator->validate();
        $this->assertTrue($validator->isValid());
    }
    
    public function testInValidIPv6()
    {
        $validator = new Validator();
        $validator->add(new IPV6Validator('bad ipv6'));
        $validator->validate();
        $this->assertFalse($validator->isValid());
    }

}