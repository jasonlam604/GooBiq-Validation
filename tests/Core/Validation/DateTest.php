<?php
use GooBiq\Core\Validation\Validator;
use GooBiq\Core\Validation\Validators\DateValidator;

/**
 * DateTest
 *
 * @author Jason Lam
 *        
 * @see Goobiq\Core\Validation\Validators\DateValidator
 */
class DateTest extends PHPUnit_Framework_TestCase
{

    public function testValidDate()
    {
        date_default_timezone_set('America/Vancouver');
        
        $date1 = new DateValidator('January 1st');
        $date2 = new DateValidator('2015-03-15');
        $date3 = new DateValidator('1 week ago');
        
        $validator = new Validator();
        $validator->add($date1);
        $validator->add($date2);
        $validator->add($date3);
        
        $validator->validate();
        $this->assertTrue($validator->isValid());
    }

    public function testInValidDate()
    {
        date_default_timezone_set('America/Vancouver');
        $date1 = new DateValidator('Bad Date Input');
        $validator = new Validator();
        $validator->add($date1);
        $validator->validate();
        $this->assertFalse($validator->isValid());
    }
}