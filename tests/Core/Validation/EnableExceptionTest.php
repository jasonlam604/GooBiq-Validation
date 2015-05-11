<?php

use GooBiq\Core\Validation\Validator;
use GooBiq\Core\Validation\Validators\AlphaValidator;

/**
 * EnableExceptionTest
 * 
 * @author Jason Lam
 * 
 */
class EnableExceptionTest extends PHPUnit_Framework_TestCase {

    /**
     * @expectedException     GooBiq\Core\Exception\GooBiqCoreException
     * @expectedExceptionCode GooBiq\Core\Exception\ExceptionCode::VALIDATION_ERROR
     */
    public function testValidAlpha()
    {
        $validator = new Validator();
        $validator->enableThrowExceptionOnError();
        $validator->add(new AlphaValidator('aaa111'));
        $validator->validate();
    }
}