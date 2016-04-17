#GooBiq-Validation Library

[![Build Status](https://travis-ci.org/jasonlam604/GooBiq-Validation.png)](https://travis-ci.org/jasonlam604/GooBiq-Validation)

## Description

PHP Validation Library

## User Guide

This is a class that assists with running a group of validators

    GooBiq\Core\Validation\Validator.php

Available Methods

- ``add`` -- Add a validator to group of validations to be done
- ``disableStopOnError`` -- Disable Stop on first error
- ``disableThrowExceptionOnError`` -- Disable throws exception on first error
- ``enableStopOnError`` -- Enable throws exception on first error
- ``enableThrowExceptionOnError`` -- Enable throws exception on first error
- ``getErrorMessages`` -- Get Error messages, if any exist
- ``isValid`` -- Validate all validators added (see add)

### Available Validators

* Alphanumeric with spaces and dashes
* Alphanumeric with spaces 
* Alphanumeric
* Alpha
* Date
* Decimal
* Email
* IPv4
* IPv6
* Number
* Password
* Phone
* Regex
* URL

All found under the namespace

    GooBiq\Core\Validation\Validators

### Example - Basic Usage

Below is an example of validation for first name, last name  and middle that enforces
alpha text. In this example both first name and last name fail but middle name is passes.

### Code Snippet

    use GooBiq\Core\Validation\Validator;
    use GooBiq\Core\Validation\Validator\AlphaValidator;
    .
    .
    .
    $firstNameVal = new AlphaValidator('Johnny!');
    $lastNameVal = new AlphaValidator('Doe!');
    $middleNameVal = new AlphaValidator('Chuck');
        
    $validator = new Validator();
        
    $validator->add($firstNameVal);
    $validator->add($lastNameVal);
        
    if( $validator->validate() == false) {
        print_r($validator->getErrorMessage());
    }
    
### Code Output
  
    Array
    (
        [0] => Invalid, Johnny! does not consist of all letters
        [1] => Invalid, Doe! does not consist of all letters
    )

### Example - Custom Error Messages

In this example the $firstNameVal set a custom error message.  Noticed the validator
doesn't decided to or not to output the given value in the message. You decide to build
the message as you see fit.

In the example below you will notice you have the option to override any of error messages
in any of the validators.

### Code Snippet

    use GooBiq\Core\Validation\Validator;
    use GooBiq\Core\Validation\Validator\AlphaValidator;
    .
    .
    .
    $firstname = 'Johnny!';
    $firstNameVal = new AlphaValidator($firstname);
    $firstNameVal->setErrorMessage("You Entered a BAD First name of " . $firstname);
    
    $lastNameVal = new AlphaValidator('Doe!');
    $middleNameVal = new AlphaValidator('Chuck');
        
    $validator = new Validator();
        
    $validator->add($firstNameVal);
    $validator->add($lastNameVal);
        
    if( $validator->validate() == false) {
        print_r($validator->getErrorMessage());
    }
    
### Code Output
  
    Array
    (
        [0] => You Entered a BAD First name of Johnny!
        [1] => Invalid, Doe! does not consist of all letters
    )
    
# Stop on First Error

If you want the validator to stop on the first error then invoke 'enableStopOnError'
that will then produce only one error message (the first error it runs into), 
assuming there is one or more errors.

### Code Snippet

    use GooBiq\Core\Validation\Validator;
    use GooBiq\Core\Validation\Validator\AlphaValidator;
    .
    .
    .
    $firstNameVal = new AlphaValidator('Johnny!');
    $lastNameVal = new AlphaValidator('Doe!');
    $middleNameVal = new AlphaValidator('Chuck');
        
    $validator = new Validator();
    $validator->enableStopOnError();
        
    $validator->add($firstNameVal);
    $validator->add($lastNameVal);
    $validator->add($middleNameVal);
        
    if( $validator->validate() == false) {
        print_r($validator->getErrorMessage());
    }
    
### Code Output
  
    Array
    (
        [0] => You Entered a BAD First name of Johnny!
    )

# Throw Exception on First Error

If you want the validator to throw an exception (GooBiqCoreException) on the
first error then invoke 'enableThrowExceptionOnError' that will produce an exception.

### Code Snippet

    use GooBiq\Core\Validation\Validator;
    use GooBiq\Core\Validation\Validator\AlphaValidator;
    .
    .
    .
    $firstNameVal = new AlphaValidator('Johnny!');
    $lastNameVal = new AlphaValidator('Doe!');
    $middleNameVal = new AlphaValidator('Chuck');
        
    $validator = new Validator();
    $validator->enableThrowExceptionOnError();
        
    $validator->add($firstNameVal);
    $validator->add($lastNameVal);
    $validator->add($middleNameVal);
        
    if( $validator->validate() == false) {
        print_r($validator->getErrorMessage());
    }
    
### Code Output
  
    GooBiq\Core\Exception\GooBiqCoreException: Invalid, Johnny! does not consist of all letters

# Reset
For whatever reason if you happen to use the same instance of the Validator class and need to reset the validation after an error has occured invoked 'reset'.    
    
# Making Your Own Custom Validator

More then likley your application will require validations not available in the generic set of validators.

To continue using the validator helper (GooBiq\Core\Validation\Validtor.php) we simply extend the base validator
available at GooBiq\Core\Validation\Validtors\BaseValidtor.php.  Best to illustrate this with a code example, see below, this example validates a username.

### Code Snippet - Custom Validator

    namespace App\Validation; // Your Own namespace, assumption you have a autoloader working
    
    // Extends the GooBiq Base Validator
    use GooBiq\Core\Validation\Validators\BaseValidator;
    
    class UsernameValidator extends BaseValidator
    {
    
        // Contructor takes in the value to validate
        public function __construct($value)
        {
            parent::__construct($value);
        }
    
        // Over-ride method and input your rule, in this case a regex for username
        // that validates the input only consists of alphanumeric values with 
        // min 5 length and max 20 length
        protected function validationRules()
        {
            if (preg_match('/^[a-z\d_]{5,20}$/i', $this->getValue())) {
                // This is required by the GooBiq\Core\Validation\Validator when 
                // processing all validator so it knows this particular validator
                // passed the validaiton check
                $this->validationPass();
                
            } else {
                
                // If no custom error message is given the use the default which set below
                if(empty($this->getErrorMessage()))
                    $this->setErrorMessage('Invalid username ' . $this->getValue() . 
                                           ' Username may only consist of alphanumeric '.
                                           ' values (a-z, A-Z, 0-9), underscores, and ' .
                                           ' has minimum 5 character and maximum 20 character.');
                
                // Let the  GooBiq\Core\Validation\Validator helper know this validation failed
                $this->validationFailed();
            }
        }
    
    }

### Code Snippet - Using the Custom Validator

    // GooBiq Validator Helper
    use GooBiq\Core\Validation\Validator;
    
    // Your Custom Validator (your namespace)
    use App\Validation\UsernameValidator;

    .
    .
    .
    
    // Using a RESTController GET method (you can ignore the REST portion not required)
    public function executeGET()
    {   
        // Normally of course you would get the username from the HTTP Request
        $username = 'Johe Doken!'; 
        
        // Instantiate your custom UsernameValidator and input the username
        // into the constructor
        $usernameValidator = new UsernameValidator($username);
        
        // Instantiate the Valdator Helper
        $validator = new Validator();
        
        // Add the customer validator
        $validator->add($usernameValidator);
        
        // More then likely in your application you would have a few more
        // validators like 'password' ...
        .
        .
        .
        
        if( $validator->validate() == false) {
            // Handle errors appropriately if any error occurered
            print_r($validator->getErrorMessage());
        }
        
        // REST Response
        $this->setContent(.......);
    }

## Current Stable Release 

Release v1.0.0

## Creator

[Jason Lam](https://www.jasonlam604.com)

## Copyright and license

Code released under [the MIT license](https://github.com/jasonlam604/GooBiq-Validation/blob/master/LICENSE). 