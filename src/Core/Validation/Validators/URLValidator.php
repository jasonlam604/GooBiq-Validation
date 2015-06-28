<?php
namespace GooBiq\Core\Validation\Validators;

/**
 * URLValidator
 *
 * @author Jason Lam <jasonlam604@gmail.com>
 * @copyright 2015 Jason Lam
 * @package /GooBiq/Core/Validation/Validators
 * @license MIT LICENSE http://opensource.org/licenses/MIT
 */
class URLValidator extends BaseValidator
{

    // Points to firt index in $options, a little hackish
    private static $URL_KEY = 0;
    
    private $options;
    
    private $sanitize;
    private $pathRequired;

    public function __construct($value)
    {
        parent::__construct($value);
        
        $this->sanitize = false;
        $this->options = array(
            $this->getValue(),
            FILTER_VALIDATE_URL
        );
    }

    protected function validationRules()
    {   
        if ($this->sanitize) {
           // Remove all characters except letters, digits and $-_.+!*'(),{}|\\^~[]`<>#%";/?:@&=.
           $this->options[self::$URL_KEY] = filter_var($this->options[self::$URL_KEY], FILTER_SANITIZE_URL);
        }
        
        if(call_user_func_array('filter_var', $this->options)) {
            $this->validationPass();
        } else {
            if (empty($this->getErrorMessage()))
                $this->setErrorMessage('Invalid URL, ' . $this->getValue());
            $this->validationFailed();
        }
    }

    /**
     * Flag to indicate remove invalid characters from Url
     */
    public function enableSanitize()
    {
        $this->sanitize = true;
    }
    
    /**
     * Add to filter to ensure there is path ie:  http://www.exampl.com/path-here
     */
    public function enablePathExistsCheck()
    {
        array_push($this->options, FILTER_FLAG_PATH_REQUIRED);   
    }
    
    /**
     * Add to filter to ensure there is a query string ie: http://www.example.com?xxx=yyy
     */
    public function enableQueryExistsCheck()
    {
        array_push($this->options, FILTER_FLAG_QUERY_REQUIRED);
    }
}