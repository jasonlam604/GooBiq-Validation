<?php
use GooBiq\Core\Validation\Validator;
use GooBiq\Core\Validation\Validators\URLValidator;

/**
 * URLTest
 *
 * @author Jason Lam
 *        
 * @see Goobiq\Core\Validation\Validators\URLValidator
 */
class URLTest extends PHPUnit_Framework_TestCase
{

    public function testValidUrls()
    {
        $validator = new Validator();
        $validator->add(new URLValidator('http://www.goobiqframework.com'));
        $validator->add(new URLValidator('http://goobiqframework.com'));
        $validator->add(new URLValidator('file://goobiqframework'));
        $validator->add(new URLValidator('ssh://goobiqframework'));
        $validator->validate();
        $this->assertTrue($validator->isValid());
    }

    public function testRemoveInvalidCharacters()
    {
        $urlValidation = new URLValidator('http://www. goobiq framework. com');
        
        // Sanitize not enabled, assertFalse should be valid, url fails
        $validator = new Validator();
        $validator->add($urlValidation);
        $validator->validate();
        $this->assertFalse($validator->isValid());
        
        // Santized enabled, validatio passes because spaces are removed
        $urlValidation->enableSanitize();
        
        $validator = new Validator();
        $validator->add($urlValidation);
        $validator->validate();
        $this->assertTrue($validator->isValid());
    }

    public function testInvalidUrl()
    {
        $validator = new Validator();
        $validator->add(new URLValidator('http://www.goobiqframework.com!'));
        $validator->validate();
        $this->assertFalse($validator->isValid());
    }

    public function testPathExists()
    {
        // Test fails with no Path
        $urlValidation1 = new URLValidator('http://www.goobiqframework.com');
        $urlValidation1->enablePathExistsCheck();
        $validator = new Validator();
        $validator->add($urlValidation1);
        $validator->validate();
        $this->assertFalse($validator->isValid());
        
        // Test pass with Path
        $urlValidation2 = new URLValidator('http://www.goobiqframework.com/path');
        $urlValidation2->enablePathExistsCheck();
        $validator = new Validator();
        $validator->add($urlValidation2);
        $validator->validate();
        $this->assertTrue($validator->isValid());
    }
    
    public function testQueryExists()
    {
        $urlValidation1 = new URLValidator('http://www.goobiqframework.com');
        $urlValidation1->enableQueryExistsCheck();
        $validator = new Validator();
        $validator->add($urlValidation1);
        $validator->validate();
        $this->assertFalse($validator->isValid());
    
        
        $urlValidation2 = new URLValidator('http://www.goobiqframework.com?key=value');
        $urlValidation2->enableQueryExistsCheck();
        $validator = new Validator();
        $validator->add($urlValidation2);
        $validator->validate();
        $this->assertTrue($validator->isValid());
    }
}