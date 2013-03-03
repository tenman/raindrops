<?php
/**
 * PEAR for WordPress theme Raindrops
 *
 * ver 1.103 prefixed member function and globals
 * License: The PHP License, version 3.0
 * License URI: http://www.php.net/license/3_0.txt
 * @package Raindrops
 */
?>
<?php
/**
 * raindrops_CSS_Color extends PEAR for WordPress theme Raindrops
 *
 * ver 1.103 prefixed member function
 * License: GNU General Public License v2.0
 * License URI: http://www.gnu.org/licenses/gpl-2.0.html
 * @package Raindrops
 */
?>
<?php
/**
 * PEAR, the PHP Extension and Application Repository
 *
 * PEAR class and PEAR_Error class
 *
 * PHP versions 4 and 5
 *
 * LICENSE: This source file is subject to version 3.0 of the PHP license
 * that is available through the world-wide-web at the following URI:
 * http://www.php.net/license/3_0.txt.  If you did not receive a copy of
 * the PHP License and are unable to obtain it through the web, please
 * send a note to license@php.net so we can mail you a copy immediately.
 *
 * @category   pear
 * @package    PEAR
 * @author     Sterling Hughes <sterling@php.net>
 * @author     Stig Bakken <ssb@php.net>
 * @author     Tomas V.V.Cox <cox@idecnet.com>
 * @author     Greg Beaver <cellog@php.net>
 * @copyright  1997-2008 The PHP Group
 * @license    http://www.php.net/license/3_0.txt  PHP License 3.0
 * @version    CVS: $Id: PEAR.php,v 1.104 2008/01/03 20:26:34 cellog Exp $
 * @link       http://pear.php.net/package/PEAR
 * @since      File available since Release 0.1
 */

/**#@+
 * ERROR constants
 */
define('RAINDROPS_PEAR_ERROR_RETURN',     1);
define('RAINDROPS_PEAR_ERROR_PRINT',      2);
define('RAINDROPS_PEAR_ERROR_TRIGGER',    4);
define('RAINDROPS_PEAR_ERROR_DIE',        8);
define('RAINDROPS_PEAR_ERROR_CALLBACK',  16);
/**
 * WARNING: obsolete
 * @deprecated
 */
define('RAINDROPS_PEAR_ERROR_EXCEPTION', 32);
/**#@-*/
define('RAINDROPS_PEAR_ZE2', (function_exists('version_compare') &&
                    version_compare(zend_version(), "2-dev", "ge")));

if (substr(PHP_OS, 0, 3) == 'WIN') {
    define('RAINDROPS_OS_WINDOWS', true);
    define('RAINDROPS_OS_UNIX',    false);
    define('RAINDROPS_PEAR_OS',    'Windows');
} else {
    define('RAINDROPS_OS_WINDOWS', false);
    define('RAINDROPS_OS_UNIX',    true);
    define('RAINDROPS_PEAR_OS',    'Unix'); // blatant assumption
}

// instant backwards compatibility
if (!defined('PATH_SEPARATOR')) {
    if (RAINDROPS_OS_WINDOWS) {
        define('PATH_SEPARATOR', ';');
    } else {
        define('PATH_SEPARATOR', ':');
    }
}

$GLOBALS['_raindrops_PEAR_default_error_mode']     = RAINDROPS_PEAR_ERROR_RETURN;
$GLOBALS['_raindrops_PEAR_default_error_options']  = E_USER_NOTICE;
$GLOBALS['_raindrops_PEAR_destructor_object_list'] = array();
$GLOBALS['_raindrops_PEAR_shutdown_funcs']         = array();
$GLOBALS['_raindrops_PEAR_error_handler_stack']    = array();

//@ini_set('track_errors', true);

/**
 * Base class for other PEAR classes.  Provides rudimentary
 * emulation of destructors.
 *
 * If you want a destructor in your class, inherit PEAR and make a
 * destructor method called _yourclassname (same name as the
 * constructor, but with a "_" prefix).  Also, in your constructor you
 * have to call the PEAR constructor: $this->PEAR();.
 * The destructor method will be called without parameters.  Note that
 * at in some SAPI implementations (such as Apache), any output during
 * the request shutdown (in which destructors are called) seems to be
 * discarded.  If you need to get any debug information from your
 * destructor, use error_log(), syslog() or something similar.
 *
 * IMPORTANT! To use the emulated destructors you need to create the
 * objects by reference: $obj =& new PEAR_child;
 *
 * @category   pear
 * @package    PEAR
 * @author     Stig Bakken <ssb@php.net>
 * @author     Tomas V.V. Cox <cox@idecnet.com>
 * @author     Greg Beaver <cellog@php.net>
 * @copyright  1997-2006 The PHP Group
 * @license    http://www.php.net/license/3_0.txt  PHP License 3.0
 * @version    Release: 1.7.1
 * @link       http://pear.php.net/package/PEAR
 * @see        PEAR_Error
 * @since      Class available since PHP 4.0.2
 * @link        http://pear.php.net/manual/en/core.pear.php#core.pear.pear
 */
class raindrops_PEAR
{
    // {{{ properties

    /**
     * Whether to enable internal debug messages.
     *
     * @var     bool
     * @access  private
     */
    var $_debug = false;

    /**
     * Default error mode for this object.
     *
     * @var     int
     * @access  private
     */
    var $_default_error_mode = null;

    /**
     * Default error options used for this object when error mode
     * is PEAR_ERROR_TRIGGER.
     *
     * @var     int
     * @access  private
     */
    var $_default_error_options = null;

    /**
     * Default error handler (callback) for this object, if error mode is
     * PEAR_ERROR_CALLBACK.
     *
     * @var     string
     * @access  private
     */
    var $_default_error_handler = '';

    /**
     * Which class to use for error objects.
     *
     * @var     string
     * @access  private
     */
    var $_error_class = 'PEAR_Error';

    /**
     * An array of expected errors.
     *
     * @var     array
     * @access  private
     */
    var $_expected_errors = array();

    // }}}

    // {{{ constructor

    /**
     * Constructor.  Registers this object in
     * $_PEAR_destructor_object_list for destructor emulation if a
     * destructor object exists.
     *
     * @param string $error_class  (optional) which class to use for
     *        error objects, defaults to PEAR_Error.
     * @access public
     * @return void
     */
    function raindrops_PEAR($error_class = null)
    {
        $classname = strtolower(get_class($this));
        if ($this->_debug) {
            print "raindrops_PEAR constructor called, class=$classname\n";
        }
        if ($error_class !== null) {
            $this->_error_class = $error_class;
        }
        while ($classname && strcasecmp($classname, "raindrops_pear")) {
            $destructor = "_$classname";
            if (method_exists($this, $destructor)) {
                global $_raindrops_PEAR_destructor_object_list;
                $_raindrops_PEAR_destructor_object_list[] = &$this;
                if (!isset($GLOBALS['_raindrops_PEAR_SHUTDOWN_REGISTERED'])) {
                    register_shutdown_function("_raindrops_PEAR_call_destructors");
                    $GLOBALS['_raindrops_PEAR_SHUTDOWN_REGISTERED'] = true;
                }
                break;
            } else {
                $classname = get_parent_class($classname);
            }
        }
    }

    // }}}
    // {{{ destructor

    /**
     * Destructor (the emulated type of...).  Does nothing right now,
     * but is included for forward compatibility, so subclass
     * destructors should always call it.
     *
     * See the note in the class desciption about output from
     * destructors.
     *
     * @access public
     * @return void
     */
    function _raindrops_PEAR() {
        if ($this->_debug) {
            printf("raindrops_PEAR destructor called, class=%s\n", strtolower(get_class($this)));
        }
    }

    // }}}
    // {{{ raindrops_getStaticProperty()

    /**
    * If you have a class that's mostly/entirely static, and you need static
    * properties, you can use this method to simulate them. Eg. in your method(s)
    * do this: $myVar = &raindrops_PEAR::getStaticProperty('myclass', 'myVar');
    * You MUST use a reference, or they will not persist!
    *
    * @access public
    * @param  string $class  The calling classname, to prevent clashes
    * @param  string $var    The variable to retrieve.
    * @return mixed   A reference to the variable. If not set it will be
    *                 auto initialised to NULL.
    */
    function &raindrops_getStaticProperty($class, $var)
    {
        static $properties;
        if (!isset($properties[$class])) {
            $properties[$class] = array();
        }
        if (!array_key_exists($var, $properties[$class])) {
            $properties[$class][$var] = null;
        }
        return $properties[$class][$var];
    }

    // }}}
    // {{{ registerShutdownFunc()

    /**
    * Use this function to register a shutdown method for static
    * classes.
    *
    * @access public
    * @param  mixed $func  The function name (or array of class/method) to call
    * @param  mixed $args  The arguments to pass to the function
    * @return void
    */
    function raindrops_registerShutdownFunc($func, $args = array())
    {
        // if we are called statically, there is a potential
        // that no shutdown func is registered.  Bug #6445
        if (!isset($GLOBALS['_raindrops_PEAR_SHUTDOWN_REGISTERED'])) {
            register_shutdown_function("_raindrops_PEAR_call_destructors");
            $GLOBALS['_raindrops_PEAR_SHUTDOWN_REGISTERED'] = true;
        }
        $GLOBALS['_raindrops_PEAR_shutdown_funcs'][] = array($func, $args);
    }

    // }}}
    // {{{ raindrops_isError()

    /**
     * Tell whether a value is a PEAR error.
     *
     * @param   mixed $data   the value to test
     * @param   int   $code   if $data is an error object, return true
     *                        only if $code is a string and
     *                        $obj->raindrops_getMessage() == $code or
     *                        $code is an integer and $obj->getCode() == $code
     * @access  public
     * @return  bool    true if parameter is an error
     */
    function raindrops_isError($data, $code = null)
    {
        if (is_a($data, 'raindrops_PEAR_Error')) {
            if (is_null($code)) {
                return true;
            } elseif (is_string($code)) {
                return $data->raindrops_getMessage() == $code;
            } else {
                return $data->raindrops_getCode() == $code;
            }
        }
        return false;
    }

    // }}}
    // {{{ raindrops_setErrorHandling()

    /**
     * Sets how errors generated by this object should be handled.
     * Can be invoked both in objects and statically.  If called
     * statically, setErrorHandling sets the default behaviour for all
     * PEAR objects.  If called in an object, setErrorHandling sets
     * the default behaviour for that object.
     *
     * @param int $mode
     *        One of PEAR_ERROR_RETURN, PEAR_ERROR_PRINT,
     *        PEAR_ERROR_TRIGGER, PEAR_ERROR_DIE,
     *        PEAR_ERROR_CALLBACK or PEAR_ERROR_EXCEPTION.
     *
     * @param mixed $options
     *        When $mode is PEAR_ERROR_TRIGGER, this is the error level (one
     *        of E_USER_NOTICE, E_USER_WARNING or E_USER_ERROR).
     *
     *        When $mode is PEAR_ERROR_CALLBACK, this parameter is expected
     *        to be the callback function or method.  A callback
     *        function is a string with the name of the function, a
     *        callback method is an array of two elements: the element
     *        at index 0 is the object, and the element at index 1 is
     *        the name of the method to call in the object.
     *
     *        When $mode is PEAR_ERROR_PRINT or PEAR_ERROR_DIE, this is
     *        a printf format string used when printing the error
     *        message.
     *
     * @access public
     * @return void
     * @see PEAR_ERROR_RETURN
     * @see PEAR_ERROR_PRINT
     * @see PEAR_ERROR_TRIGGER
     * @see PEAR_ERROR_DIE
     * @see PEAR_ERROR_CALLBACK
     * @see PEAR_ERROR_EXCEPTION
     *
     * @since PHP 4.0.5
     */

    function raindrops_setErrorHandling($mode = null, $options = null)
    {
        if (isset($this) && is_a($this, 'raindrops_PEAR')) {
            $setmode     = &$this->_default_error_mode;
            $setoptions  = &$this->_default_error_options;
        } else {
            $setmode     = &$GLOBALS['_raindrops_PEAR_default_error_mode'];
            $setoptions  = &$GLOBALS['_raindrops_PEAR_default_error_options'];
        }

        switch ($mode) {
            case RAINDROPS_PEAR_ERROR_EXCEPTION:
            case PEAR_ERROR_RETURN:
            case RAINDROPS_PEAR_ERROR_PRINT:
            case RAINDROPS_PEAR_ERROR_TRIGGER:
            case RAINDROPS_PEAR_ERROR_DIE:
            case null:
                $setmode = $mode;
                $setoptions = $options;
                break;

            case RAINDROPS_PEAR_ERROR_CALLBACK:
                $setmode = $mode;
                // class/object method callback
                if (is_callable($options)) {
                    $setoptions = $options;
                } else {
                    trigger_error("invalid error callback", E_USER_WARNING);
                }
                break;

            default:
                trigger_error("invalid error mode", E_USER_WARNING);
                break;
        }
    }

    // }}}
    // {{{ raindrops_expectError()

    /**
     * This method is used to tell which errors you expect to get.
     * Expected errors are always returned with error mode
     * PEAR_ERROR_RETURN.  Expected error codes are stored in a stack,
     * and this method pushes a new element onto it.  The list of
     * expected errors are in effect until they are popped off the
     * stack with the raindrops_popExpect() method.
     *
     * Note that this method can not be called statically
     *
     * @param mixed $code a single error code or an array of error codes to expect
     *
     * @return int     the new depth of the "expected errors" stack
     * @access public
     */
    function raindrops_expectError($code = '*')
    {
        if (is_array($code)) {
            array_push($this->_expected_errors, $code);
        } else {
            array_push($this->_expected_errors, array($code));
        }
        return sizeof($this->_expected_errors);
    }

    // }}}
    // {{{ raindrops_popExpect()

    /**
     * This method pops one element off the expected error codes
     * stack.
     *
     * @return array   the list of error codes that were popped
     */
    function raindrops_popExpect()
    {
        return array_pop($this->_expected_errors);
    }

    // }}}
    // {{{ _raindrops_checkDelExpect()

    /**
     * This method checks unsets an error code if available
     *
     * @param mixed error code
     * @return bool true if the error code was unset, false otherwise
     * @access private
     * @since PHP 4.3.0
     */
    function _raindrops_checkDelExpect($error_code)
    {
        $deleted = false;

        foreach ($this->_expected_errors AS $key => $error_array) {
            if (in_array($error_code, $error_array)) {
                unset($this->_expected_errors[$key][array_search($error_code, $error_array)]);
                $deleted = true;
            }

            // clean up empty arrays
            if (0 == count($this->_expected_errors[$key])) {
                unset($this->_expected_errors[$key]);
            }
        }
        return $deleted;
    }

    // }}}
    // {{{ raindrops_delExpect()

    /**
     * This method deletes all occurences of the specified element from
     * the expected error codes stack.
     *
     * @param  mixed $error_code error code that should be deleted
     * @return mixed list of error codes that were deleted or error
     * @access public
     * @since PHP 4.3.0
     */
    function raindrops_delExpect($error_code)
    {
        $deleted = false;

        if ((is_array($error_code) && (0 != count($error_code)))) {
            // $error_code is a non-empty array here;
            // we walk through it trying to unset all
            // values
            foreach($error_code as $key => $error) {
                if ($this->_raindrops_checkDelExpect($error)) {
                    $deleted =  true;
                } else {
                    $deleted = false;
                }
            }
            return $deleted ? true : raindrops_PEAR::raindrops_raiseError("The expected error you submitted does not exist"); // IMPROVE ME
        } elseif (!empty($error_code)) {
            // $error_code comes alone, trying to unset it
            if ($this->_raindrops_checkDelExpect($error_code)) {
                return true;
            } else {
                return raindrops_PEAR::raindrops_raiseError("The expected error you submitted does not exist"); // IMPROVE ME
            }
        } else {
            // $error_code is empty
            return raindrops_PEAR::raindrops_raiseError("The expected error you submitted is empty"); // IMPROVE ME
        }
    }

    // }}}
    // {{{ raiseError()

    /**
     * This method is a wrapper that returns an instance of the
     * configured error class with this object's default error
     * handling applied.  If the $mode and $options parameters are not
     * specified, the object's defaults are used.
     *
     * @param mixed $message a text error message or a PEAR error object
     *
     * @param int $code      a numeric error code (it is up to your class
     *                  to define these if you want to use codes)
     *
     * @param int $mode      One of PEAR_ERROR_RETURN, PEAR_ERROR_PRINT,
     *                  PEAR_ERROR_TRIGGER, PEAR_ERROR_DIE,
     *                  PEAR_ERROR_CALLBACK, PEAR_ERROR_EXCEPTION.
     *
     * @param mixed $options If $mode is PEAR_ERROR_TRIGGER, this parameter
     *                  specifies the PHP-internal error level (one of
     *                  E_USER_NOTICE, E_USER_WARNING or E_USER_ERROR).
     *                  If $mode is PEAR_ERROR_CALLBACK, this
     *                  parameter specifies the callback function or
     *                  method.  In other error modes this parameter
     *                  is ignored.
     *
     * @param string $userinfo If you need to pass along for example debug
     *                  information, this parameter is meant for that.
     *
     * @param string $error_class The returned error object will be
     *                  instantiated from this class, if specified.
     *
     * @param bool $skipmsg If true, raiseError will only pass error codes,
     *                  the error message parameter will be dropped.
     *
     * @access public
     * @return object   a PEAR error object
     * @see PEAR::setErrorHandling
     * @since PHP 4.0.5
     */
    function &raindrops_raiseError($message = null,
                         $code = null,
                         $mode = null,
                         $options = null,
                         $userinfo = null,
                         $error_class = null,
                         $skipmsg = false)
    {
        // The error is yet a PEAR error object
        if (is_object($message)) {
            $code        = $message->raindrops_getCode();
            $userinfo    = $message->raindrops_getUserInfo();
            $error_class = $message->raindrops_getType();
            $message->error_message_prefix = '';
            $message     = $message->raindrops_getMessage();
        }

        if (isset($this) && isset($this->_expected_errors) && sizeof($this->_expected_errors) > 0 && sizeof($exp = end($this->_expected_errors))) {
            if ($exp[0] == "*" ||
                (is_int(reset($exp)) && in_array($code, $exp)) ||
                (is_string(reset($exp)) && in_array($message, $exp))) {
                $mode = RAINDROPS_PEAR_ERROR_RETURN;
            }
        }
        // No mode given, try global ones
        if ($mode === null) {
            // Class error handler
            if (isset($this) && isset($this->_default_error_mode)) {
                $mode    = $this->_default_error_mode;
                $options = $this->_default_error_options;
            // Global error handler
            } elseif (isset($GLOBALS['_raindrops_PEAR_default_error_mode'])) {
                $mode    = $GLOBALS['_raindrops_PEAR_default_error_mode'];
                $options = $GLOBALS['_raindrops_PEAR_default_error_options'];
            }
        }

        if ($error_class !== null) {
            $ec = $error_class;
        } elseif (isset($this) && isset($this->_error_class)) {
            $ec = $this->_error_class;
        } else {
            $ec = 'raindrops_PEAR_Error';
        }
        if (intval(PHP_VERSION) < 5) {
            // little non-eval hack to fix bug #12147
            //include 'PEAR/FixPHP5PEARWarnings.php';
            //return $a;
        }
        if ($skipmsg) {
            $a = new $ec($code, $mode, $options, $userinfo);
        } else {
            $a = new $ec($message, $code, $mode, $options, $userinfo);
        }
        return $a;
    }

    // }}}
    // {{{ raindrops_throwError()

    /**
     * Simpler form of raiseError with fewer options.  In most cases
     * message, code and userinfo are enough.
     *
     * @param string $message
     *
     */
    function &raindrops_throwError($message = null,
                         $code = null,
                         $userinfo = null)
    {
        if (isset($this) && is_a($this, 'PEAR')) {
            $a = &$this->raindrops_raiseError($message, $code, null, null, $userinfo);
            return $a;
        } else {
            $a = &raindrops_PEAR::raindrops_raiseError($message, $code, null, null, $userinfo);
            return $a;
        }
    }

    // }}}
    function raindrops_staticPushErrorHandling($mode, $options = null)
    {
        $stack = &$GLOBALS['_raindrops_PEAR_error_handler_stack'];
        $def_mode    = &$GLOBALS['_raindrops_PEAR_default_error_mode'];
        $def_options = &$GLOBALS['_raindrops_PEAR_default_error_options'];
        $stack[] = array($def_mode, $def_options);
        switch ($mode) {
            case RAINDROPS_PEAR_ERROR_EXCEPTION:
            case RAINDROPS_PEAR_ERROR_RETURN:
            case RAINDROPS_PEAR_ERROR_PRINT:
            case RAINDROPS_PEAR_ERROR_TRIGGER:
            case RAINDROPS_PEAR_ERROR_DIE:
            case null:
                $def_mode = $mode;
                $def_options = $options;
                break;

            case RAINDROPS_PEAR_ERROR_CALLBACK:
                $def_mode = $mode;
                // class/object method callback
                if (is_callable($options)) {
                    $def_options = $options;
                } else {
                    trigger_error("invalid error callback", E_USER_WARNING);
                }
                break;

            default:
                trigger_error("invalid error mode", E_USER_WARNING);
                break;
        }
        $stack[] = array($mode, $options);
        return true;
    }

    function raindrops_staticPopErrorHandling()
    {
        $stack = &$GLOBALS['_raindrops_PEAR_error_handler_stack'];
        $setmode     = &$GLOBALS['_raindrops_PEAR_default_error_mode'];
        $setoptions  = &$GLOBALS['_raindrops_PEAR_default_error_options'];
        array_pop($stack);
        list($mode, $options) = $stack[sizeof($stack) - 1];
        array_pop($stack);
        switch ($mode) {
            case RAINDROPS_PEAR_ERROR_EXCEPTION:
            case RAINDROPS_PEAR_ERROR_RETURN:
            case RAINDROPS_PEAR_ERROR_PRINT:
            case RAINDROPS_PEAR_ERROR_TRIGGER:
            case RAINDROPS_PEAR_ERROR_DIE:
            case null:
                $setmode = $mode;
                $setoptions = $options;
                break;

            case RAINDROPS_PEAR_ERROR_CALLBACK:
                $setmode = $mode;
                // class/object method callback
                if (is_callable($options)) {
                    $setoptions = $options;
                } else {
                    trigger_error("invalid error callback", E_USER_WARNING);
                }
                break;

            default:
                trigger_error("invalid error mode", E_USER_WARNING);
                break;
        }
        return true;
    }

    // {{{ raindrops_pushErrorHandling()

    /**
     * Push a new error handler on top of the error handler options stack. With this
     * you can easily override the actual error handler for some code and restore
     * it later with popErrorHandling.
     *
     * @param mixed $mode (same as setErrorHandling)
     * @param mixed $options (same as setErrorHandling)
     *
     * @return bool Always true
     *
     * @see PEAR::setErrorHandling
     */
    function raindrops_pushErrorHandling($mode, $options = null)
    {
        $stack = &$GLOBALS['_raindrops_PEAR_error_handler_stack'];
        if (isset($this) && is_a($this, 'PEAR')) {
            $def_mode    = &$this->_default_error_mode;
            $def_options = &$this->_default_error_options;
        } else {
            $def_mode    = &$GLOBALS['_raindrops_PEAR_default_error_mode'];
            $def_options = &$GLOBALS['_raindrops_PEAR_default_error_options'];
        }
        $stack[] = array($def_mode, $def_options);

        if (isset($this) && is_a($this, 'PEAR')) {
            $this->raindrops_setErrorHandling($mode, $options);
        } else {
            raindrops_PEAR::raindrops_setErrorHandling($mode, $options);
        }
        $stack[] = array($mode, $options);
        return true;
    }

    // }}}
    // {{{ raindrops_popErrorHandling()

    /**
    * Pop the last error handler used
    *
    * @return bool Always true
    *
    * @see PEAR::pushErrorHandling
    */
    function raindrops_popErrorHandling()
    {
        $stack = &$GLOBALS['_raindrops_PEAR_error_handler_stack'];
        array_pop($stack);
        list($mode, $options) = $stack[sizeof($stack) - 1];
        array_pop($stack);
        if (isset($this) && is_a($this, 'PEAR')) {
            $this->raindrops_setErrorHandling($mode, $options);
        } else {
            raindrops_PEAR::raindrops_setErrorHandling($mode, $options);
        }
        return true;
    }

    // }}}
    // {{{ raindrops_loadExtension()

    /**
    * OS independant PHP extension load. Remember to take care
    * on the correct extension name for case sensitive OSes.
    *
    * @param string $ext The extension name
    * @return bool Success or not on the dl() call
    */
    function raindrops_loadExtension($ext)
    {
        if (!extension_loaded($ext)) {
            // if either returns true dl() will produce a FATAL error, stop that
            if ((ini_get('enable_dl') != 1) || (ini_get('safe_mode') == 1)) {
                return false;
            }
            if (RAINDROPS_OS_WINDOWS) {
                $suffix = '.dll';
            } elseif (PHP_OS == 'HP-UX') {
                $suffix = '.sl';
            } elseif (PHP_OS == 'AIX') {
                $suffix = '.a';
            } elseif (PHP_OS == 'OSX') {
                $suffix = '.bundle';
            } else {
                $suffix = '.so';
            }
            return @dl('php_'.$ext.$suffix) || @dl($ext.$suffix);
        }
        return true;
    }

    // }}}
}

// {{{ _PEAR_call_destructors()

function _raindrops_PEAR_call_destructors()
{
    global $_raindrops_PEAR_destructor_object_list;
    if (is_array($_raindrops_PEAR_destructor_object_list) &&
        sizeof($_raindrops_PEAR_destructor_object_list))
    {
        reset($_raindrops_PEAR_destructor_object_list);
        if (raindrops_PEAR::raindrops_getStaticProperty('PEAR', 'destructlifo')) {
            $_raindrops_PEAR_destructor_object_list = array_reverse($_raindrops_PEAR_destructor_object_list);
        }
        while (list($k, $objref) = each($_raindrops_PEAR_destructor_object_list)) {
            $classname = get_class($objref);
            while ($classname) {
                $destructor = "_$classname";
                if (method_exists($objref, $destructor)) {
                    $objref->$destructor();
                    break;
                } else {
                    $classname = get_parent_class($classname);
                }
            }
        }
        // Empty the object list to ensure that destructors are
        // not called more than once.
        $_raindrops_PEAR_destructor_object_list = array();
    }

    // Now call the shutdown functions
    if (is_array($GLOBALS['_raindrops_PEAR_shutdown_funcs']) AND !empty($GLOBALS['_raindrops_PEAR_shutdown_funcs'])) {
        foreach ($GLOBALS['_raindrops_PEAR_shutdown_funcs'] as $value) {
            call_user_func_array($value[0], $value[1]);
        }
    }
}

// }}}
/**
 * Standard PEAR error class for PHP 4
 *
 * This class is supserseded by {@link PEAR_Exception} in PHP 5
 *
 * @category   pear
 * @package    PEAR
 * @author     Stig Bakken <ssb@php.net>
 * @author     Tomas V.V. Cox <cox@idecnet.com>
 * @author     Gregory Beaver <cellog@php.net>
 * @copyright  1997-2006 The PHP Group
 * @license    http://www.php.net/license/3_0.txt  PHP License 3.0
 * @version    Release: 1.7.1
 * @link       http://pear.php.net/manual/en/core.pear.pear-error.php
 * @see        PEAR::raiseError(), PEAR::throwError()
 * @since      Class available since PHP 4.0.2
 */
class raindrops_PEAR_Error
{
    // {{{ properties

    var $error_message_prefix = '';
    var $mode                 = RAINDROPS_PEAR_ERROR_RETURN;
    var $level                = E_USER_NOTICE;
    var $code                 = -1;
    var $message              = '';
    var $userinfo             = '';
    var $backtrace            = null;

    // }}}
    // {{{ constructor

    /**
     * PEAR_Error constructor
     *
     * @param string $message  message
     *
     * @param int $code     (optional) error code
     *
     * @param int $mode     (optional) error mode, one of: PEAR_ERROR_RETURN,
     * PEAR_ERROR_PRINT, PEAR_ERROR_DIE, PEAR_ERROR_TRIGGER,
     * PEAR_ERROR_CALLBACK or PEAR_ERROR_EXCEPTION
     *
     * @param mixed $options   (optional) error level, _OR_ in the case of
     * PEAR_ERROR_CALLBACK, the callback function or object/method
     * tuple.
     *
     * @param string $userinfo (optional) additional user/debug info
     *
     * @access public
     *
     */
    function raindrops_PEAR_Error($message = 'unknown error', $code = null,
                        $mode = null, $options = null, $userinfo = null)
    {
        if ($mode === null) {
            $mode = RAINDROPS_PEAR_ERROR_RETURN;
        }
        $this->message   = $message;
        $this->code      = $code;
        $this->mode      = $mode;
        $this->userinfo  = $userinfo;
        if (!raindrops_PEAR::raindrops_getStaticProperty('raindrops_PEAR_Error', 'skiptrace')) {
            $this->backtrace = debug_backtrace();
            if (isset($this->backtrace[0]) && isset($this->backtrace[0]['object'])) {
                unset($this->backtrace[0]['object']);
            }
        }
        if ($mode & RAINDROPS_PEAR_ERROR_CALLBACK) {
            $this->level = E_USER_NOTICE;
            $this->callback = $options;
        } else {
            if ($options === null) {
                $options = E_USER_NOTICE;
            }
            $this->level = $options;
            $this->callback = null;
        }
        if ($this->mode & RAINDROPS_PEAR_ERROR_PRINT) {
            if (is_null($options) || is_int($options)) {
                $format = "%s";
            } else {
                $format = $options;
            }
            printf($format, $this->raindrops_getMessage());
        }
        if ($this->mode & RAINDROPS_PEAR_ERROR_TRIGGER) {
            trigger_error($this->raindrops_getMessage(), $this->level);
        }
        if ($this->mode & RAINDROPS_PEAR_ERROR_DIE) {
            $msg = $this->raindrops_getMessage();
            if (is_null($options) || is_int($options)) {
                $format = "%s";
                if (substr($msg, -1) != "\n") {
                    $msg .= "\n";
                }
            } else {
                $format = $options;
            }
            die(sprintf($format, $msg));
        }
        if ($this->mode & RAINDROPS_PEAR_ERROR_CALLBACK) {
            if (is_callable($this->callback)) {
                call_user_func($this->callback, $this);
            }
        }
        if ($this->mode & RAINDROPS_PEAR_ERROR_EXCEPTION) {
            trigger_error("RAINDROPS_PEAR_ERROR_EXCEPTION is obsolete, use class PEAR_Exception for exceptions", E_USER_WARNING);
            //eval('$e = new Exception($this->message, $this->code);throw($e);');
        }
    }

    // }}}
    // {{{ raindrops_getMode()

    /**
     * Get the error mode from an error object.
     *
     * @return int error mode
     * @access public
     */
    function raindrops_getMode() {
        return $this->mode;
    }

    // }}}
    // {{{ raindrops_getCallback()

    /**
     * Get the callback function/method from an error object.
     *
     * @return mixed callback function or object/method array
     * @access public
     */
    function raindrops_getCallback() {
        return $this->callback;
    }

    // }}}
    // {{{ raindrops_getMessage()


    /**
     * Get the error message from an error object.
     *
     * @return  string  full error message
     * @access public
     */
    function raindrops_getMessage()
    {
        return ($this->error_message_prefix . $this->message);
    }


    // }}}
    // {{{ raindrops_getCode()

    /**
     * Get error code from an error object
     *
     * @return int error code
     * @access public
     */
     function raindrops_getCode()
     {
        return $this->code;
     }

    // }}}
    // {{{ raindrops_getType()

    /**
     * Get the name of this error/exception.
     *
     * @return string error/exception name (type)
     * @access public
     */
    function raindrops_getType()
    {
        return get_class($this);
    }

    // }}}
    // {{{ raindrops_getUserInfo()

    /**
     * Get additional user-supplied information.
     *
     * @return string user-supplied information
     * @access public
     */
    function raindrops_getUserInfo()
    {
        return $this->userinfo;
    }

    // }}}
    // {{{ raindrops_getDebugInfo()

    /**
     * Get additional debug information supplied by the application.
     *
     * @return string debug information
     * @access public
     */
    function raindrops_getDebugInfo()
    {
        return $this->raindrops_getUserInfo();
    }

    // }}}
    // {{{ raindrops_getBacktrace()

    /**
     * Get the call backtrace from where the error was generated.
     * Supported with PHP 4.3.0 or newer.
     *
     * @param int $frame (optional) what frame to fetch
     * @return array Backtrace, or NULL if not available.
     * @access public
     */
    function raindrops_getBacktrace($frame = null)
    {
        if (defined('RAINDROPS_PEAR_IGNORE_BACKTRACE')) {
            return null;
        }
        if ($frame === null) {
            return $this->backtrace;
        }
        return $this->backtrace[$frame];
    }

    // }}}
    // {{{ raindrops_addUserInfo()

    function raindrops_addUserInfo($info)
    {
        if (empty($this->userinfo)) {
            $this->userinfo = $info;
        } else {
            $this->userinfo .= " ** $info";
        }
    }

    // }}}
    // {{{ raindrops_toString()
    function __raindrops_toString()
    {
        return $this->raindrops_getMessage();
    }
    // }}}
    // {{{ raindrops_toString()

    /**
     * Make a string representation of this object.
     *
     * @return string a string with an object summary
     * @access public
     */
    function raindrops_toString() {
        $modes = array();
        $levels = array(E_USER_NOTICE  => 'notice',
                        E_USER_WARNING => 'warning',
                        E_USER_ERROR   => 'error');
        if ($this->mode & RAINDROPS_PEAR_ERROR_CALLBACK) {
            if (is_array($this->callback)) {
                $callback = (is_object($this->callback[0]) ?
                    strtolower(get_class($this->callback[0])) :
                    $this->callback[0]) . '::' .
                    $this->callback[1];
            } else {
                $callback = $this->callback;
            }
            return sprintf('[%s: message="%s" code=%d mode=callback '.
                           'callback=%s prefix="%s" info="%s"]',
                           strtolower(get_class($this)), $this->message, $this->code,
                           $callback, $this->error_message_prefix,
                           $this->userinfo);
        }
        if ($this->mode & RAINDROPS_PEAR_ERROR_PRINT) {
            $modes[] = 'print';
        }
        if ($this->mode & RAINDROPS_PEAR_ERROR_TRIGGER) {
            $modes[] = 'trigger';
        }
        if ($this->mode & RAINDROPS_PEAR_ERROR_DIE) {
            $modes[] = 'die';
        }
        if ($this->mode & RAINDROPS_PEAR_ERROR_RETURN) {
            $modes[] = 'return';
        }
        return sprintf('[%s: message="%s" code=%d mode=%s level=%s '.
                       'prefix="%s" info="%s"]',
                       strtolower(get_class($this)), $this->message, $this->code,
                       implode("|", $modes), $levels[$this->level],
                       $this->error_message_prefix,
                       $this->userinfo);
    }

    // }}}
}

/*
 * Local Variables:
 * mode: php
 * tab-width: 4
 * c-basic-offset: 4
 * End:
 */
?>
<?php
/*
 csscolor.php
 Copyright 2004 Patrick Fitzgerald
 http://www.barelyfitz.com/projects/csscolor/

 This program is free software; you can redistribute it and/or modify
 it under the terms of the GNU General Public License as published by
 the Free Software Foundation; either version 2 of the License, or
 (at your option) any later version.

 This program is distributed in the hope that it will be useful,
 but WITHOUT ANY WARRANTY; without even the implied warranty of
 MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 GNU General Public License for more details.

 You should have received a copy of the GNU General Public License
 along with this program; if not, write to the Free Software
 Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA
*/
/**
 * Include PEAR.php
 *
 *
 *
 *
 */


define('RAINDROPS_CSS_COLOR_ERROR', 100);
/**
 * Class CSS_Color
 *
 *
 *
 * @package CSS_Color
 */
class raindrops_CSS_Color extends raindrops_PEAR
{
  //==================================================
  //==PARAMETERS======================================
  //==================================================

  // $this->bg = array of CSS color values
  // $this->bg[0] is the bg color
  // $this->bg['+1'..'+5'] are lighter colors
  // $this->bg['-1'..'-5'] are darker colors
  var $bg = array();

  // $this->fg = array of foreground colors.
  // Each color corresponds to a background color.
  var $fg = array();

  // brightDiff is the minimum brightness difference
  // between the background and the foreground.
  // Note: you should not change this directly,
  // instead use setBrightDiff() and getBrightDiff()
  var $minBrightDiff = 126;

  // colorDiff is the minimum color difference
  // between the background and the foreground.
  // Note: you should not change this directly,
  // instead use setColorDiff() and getColorDiff()
  var $minColorDiff = 500;

  //==================================================
  //==CONSTRUCTOR=====================================
  //==================================================

  function raindrops_CSS_Color($bgHex, $fgHex='')
  {
    // This is the constructor method for the class,
    // which is called when a new object is created.

    // Initialize this PEAR object so I can
    // use the PEAR error return mechanism
    $this->raindrops_PEAR();

    // Initialize the palette
    $this->raindrops_setPalette($bgHex, $fgHex);
  }

  //==================================================
  //==METHODS=========================================
  //==================================================

  //--------------------------------------------------
  function raindrops_setPalette($bgHex, $fgHex = '')
  {
    // Initialize the color palettes

    // If a foreground color was not specified,
    // just use the background color.
    if (!$fgHex) {
      $fgHex = $bgHex;
    }

    // Clear the existing palette
    $this->bg = array();
    $this->fg = array();

    // Make sure we got a valid hex value
    if (!$this->raindrops_isHex($bgHex)) {
      $this->raindrops_raiseError("background color '$bgHex' is not a hex color value",
            __FUNCTION__, __LINE__);
      return false;
    }

    // Set the bg color
    $this->bg[0] = $bgHex;

    $this->bg['+1'] = $this->raindrops_lighten($bgHex, .85);
    $this->bg['+2'] = $this->raindrops_lighten($bgHex, .75);
    $this->bg['+3'] = $this->raindrops_lighten($bgHex, .5);
    $this->bg['+4'] = $this->raindrops_lighten($bgHex, .25);
    $this->bg['+5'] = $this->raindrops_lighten($bgHex, .1);

    $this->bg['-1'] = $this->raindrops_darken($bgHex, .85);
    $this->bg['-2'] = $this->raindrops_darken($bgHex, .75);
    $this->bg['-3'] = $this->raindrops_darken($bgHex, .5);
    $this->bg['-4'] = $this->raindrops_darken($bgHex, .25);
    $this->bg['-5'] = $this->raindrops_darken($bgHex, .1);

    // Make sure we got a valid hex value
    if (!$this->raindrops_isHex($fgHex)) {
      $this->raindrops_raiseError("background color '$bgHex' is not a hex color value",
            __FUNCTION__, __LINE__);
      return false;
    }

    // Set up the foreground colors
    $this->fg[0]    = $this->raindrops_calcFG( $this->bg[0], $fgHex);
    $this->fg['+1'] = $this->raindrops_calcFG( $this->bg['+1'], $fgHex);
    $this->fg['+2'] = $this->raindrops_calcFG( $this->bg['+2'], $fgHex);
    $this->fg['+3'] = $this->raindrops_calcFG( $this->bg['+3'], $fgHex);
    $this->fg['+4'] = $this->raindrops_calcFG( $this->bg['+4'], $fgHex);
    $this->fg['+5'] = $this->raindrops_calcFG( $this->bg['+5'], $fgHex);
    $this->fg['-1'] = $this->raindrops_calcFG( $this->bg['-1'], $fgHex);
    $this->fg['-2'] = $this->raindrops_calcFG( $this->bg['-2'], $fgHex);
    $this->fg['-3'] = $this->raindrops_calcFG( $this->bg['-3'], $fgHex);
    $this->fg['-4'] = $this->raindrops_calcFG( $this->bg['-4'], $fgHex);
    $this->fg['-5'] = $this->raindrops_calcFG( $this->bg['-5'], $fgHex);
  }

  //--------------------------------------------------
  function raindrops_lighten($hex, $percent)
  {
    return $this->raindrops_mix($hex, $percent, 255);
  }

  //--------------------------------------------------
  function raindrops_darken($hex, $percent)
  {
    return $this->raindrops_mix($hex, $percent, 0);
  }

  //--------------------------------------------------
  function raindrops_mix($hex, $percent, $mask)
  {

    // Make sure inputs are valid
    if (!is_numeric($percent) || $percent < 0 || $percent > 1) {
      $this->raindrops_raiseError("percent=$percent is not valid",
            __FUNCTION__, __LINE__);
      return false;
    }

    if (!is_int($mask) || $mask < 0 || $mask > 255) {
      $this->raindrops_raiseError("mask=$mask is not valid",
            __FUNCTION__, __LINE__);
      return false;
    }

    $rgb = $this->raindrops_hex2RGB($hex);
    if (!is_array($rgb)) {
      // hex2RGB will raise an error
      return false;
    }

    for ($i=0; $i<3; $i++) {
      $rgb[$i] = round($rgb[$i] * $percent) + round($mask * (1-$percent));

      // In case rounding up causes us to go to 256
      if ($rgb[$i] > 255) {
    $rgb[$i] = 255;
      }

    }
    return $this->raindrops_RGB2Hex($rgb);
  }

  //--------------------------------------------------
  function raindrops_hex2RGB($hex)
  {
    //
    // Given a hex color (rrggbb or rgb),
    // returns an array (r, g, b) with decimal values
    // If $hex is not the correct format,
    // returns false.
    //
    // example:
    // $d = hex2RGB('#abc');
    // if (!$d) { error }

    // Regexp for a valid hex digit
    $d = '[a-fA-F0-9]';

    // Make sure $hex is valid
    if (preg_match("/^($d$d)($d$d)($d$d)\$/", $hex, $rgb)) {

      return array(
           hexdec($rgb[1]),
           hexdec($rgb[2]),
           hexdec($rgb[3])
           );
    }
    if (preg_match("/^($d)($d)($d)$/", $hex, $rgb)) {

      return array(
           hexdec($rgb[1] . $rgb[1]),
           hexdec($rgb[2] . $rgb[2]),
           hexdec($rgb[3] . $rgb[3])
           );
    }

    $this->raindrops_raiseError("cannot convert hex '$hex' to RGB", __FUNCTION__, __LINE__);
    return false;
  }

  //--------------------------------------------------
  function raindrops_RGB2Hex($rgb)
  {
    // Given an array(rval,gval,bval) consisting of
    // decimal color values (0-255), returns a hex string
    // suitable for use with CSS.
    // Returns false if the input is not in the correct format.
    // Example:
    // $h = RGB2Hex(array(255,0,255));
    // if (!$h) { error };

    // Make sure the input is valid
    if(!$this->raindrops_isRGB($rgb)) {
      $this->raindrops_raiseError("RGB value is not valid", __FUNCTION__, __LINE__);
      return false;
    }

    $hex = "";
    for($i=0; $i < 3; $i++) {

      // Convert the decimal digit to hex
      $hexDigit = dechex($rgb[$i]);

      // Add a leading zero if necessary
      if(strlen($hexDigit) == 1) {
    $hexDigit = "0" . $hexDigit;
      }

      // Append to the hex string
      $hex .= $hexDigit;
    }

    // Return the complete hex string
    return $hex;
  }

  //--------------------------------------------------
  function raindrops_isHex($hex)
  {
    // Returns true if $hex is a valid CSS hex color.
    // The "#" character at the start is optional.

    // Regexp for a valid hex digit
    $d = '[a-fA-F0-9]';

    // Make sure $hex is valid
    if (preg_match("/^#?$d$d$d$d$d$d\$/", $hex) ||
    preg_match("/^#?$d$d$d\$/", $hex)) {
      return true;
    }
    return false;
  }

  //--------------------------------------------------
  function raindrops_isRGB($rgb)
  {
    // Returns true if $rgb is an array with three valid
    // decimal color digits.

    if (!is_array($rgb) || count($rgb) != 3) {
      return false;
    }

    for($i=0; $i < 3; $i++) {

      // Get the decimal digit
      $dec = intval($rgb[$i]);

      // Make sure the decimal digit is between 0 and 255
      if (!is_int($dec) || $dec < 0 || $dec > 255) {
    return false;
      }
    }

    return true;
  }

  //--------------------------------------------------
  function raindrops_calcFG($bgHex, $fgHex)
  {
    // Given a background color $bgHex and a foreground color $fgHex,
    // modifies the foreground color so it will have enough contrast
    // to be seen against the background color.
    //
    // The following parameters are used:
    // $this->minBrightDiff
    // $this->minColorDiff

    // Loop through brighter and darker versions
    // of the foreground color.
    // The numbers here represent the amount of
    // foreground color to mix with black and white.
    foreach (array(1, 0.75, 0.5, 0.25, 0) as $percent) {

      $darker = $this->raindrops_darken($fgHex, $percent);
      $lighter = $this->raindrops_lighten($fgHex, $percent);

      $darkerBrightDiff  = $this->raindrops_brightnessDiff($bgHex, $darker);
      $lighterBrightDiff = $this->raindrops_brightnessDiff($bgHex, $lighter);

      if ($lighterBrightDiff > $darkerBrightDiff) {
    $newFG = $lighter;
    $newFGBrightDiff = $lighterBrightDiff;
      } else {
    $newFG = $darker;
    $newFGBrightDiff = $darkerBrightDiff;
      }
      $newFGColorDiff = $this->raindrops_colorDiff($bgHex, $newFG);

      if ($newFGBrightDiff >= $this->minBrightDiff &&
      $newFGColorDiff >= $this->minColorDiff) {
    break;
      }
    }

    return $newFG;
  }

  //--------------------------------------------------
  function raindrops_getMinBrightDiff()
  {
    return $this->minBrightDiff;
  }
  function raindrops_setMinBrightDiff($b, $resetPalette = true)
  {
    $this->minBrightDiff = $b;
    if ($resetPalette) {
      $this->raindrops_setPalette($this->bg[0],$this->fg[0]);
    }
  }

  //--------------------------------------------------
  function raindrops_getMinColorDiff()
  {
    return $this->minColorDiff;
  }
  function raindrops_setMinColorDiff($d, $resetPalette = true)
  {
    $this->minColorDiff = $d;
    if ($resetPalette) {
      $this->raindrops_setPalette($this->bg[0],$this->fg[0]);
    }
  }

  //--------------------------------------------------
  function raindrops_brightness($hex)
  {
    // Returns the brightness value for a color,
    // a number between zero and 178.
    // To allow for maximum readability, the difference between
    // the background brightness and the foreground brightness
    // should be greater than 125.

    $rgb = $this->raindrops_hex2RGB($hex);
    if (!is_array($rgb)) {
      // hex2RGB will raise an error
      return false;
    }

    return( (($rgb[0] * 299) + ($rgb[1] * 587) + ($rgb[2] * 114)) / 1000 );
  }

  //--------------------------------------------------
  function raindrops_brightnessDiff($hex1, $hex2)
  {
    // Returns the brightness value for a color,
    // a number between zero and 178.
    // To allow for maximum readability, the difference between
    // the background brightness and the foreground brightness
    // should be greater than 125.

    $b1 = $this->raindrops_brightness($hex1);
    $b2 = $this->raindrops_brightness($hex2);
    if (is_bool($b1) || is_bool($b2)) {
      return false;
    }
    return abs($b1 - $b2);
  }

  //--------------------------------------------------
  function raindrops_colorDiff($hex1, $hex2)
  {
    // Returns the contrast between two colors,
    // an integer between 0 and 675.
    // To allow for maximum readability, the difference between
    // the background and the foreground color should be > 500.

    $rgb1 = $this->raindrops_hex2RGB($hex1);
    $rgb2 = $this->raindrops_hex2RGB($hex2);

    if (!is_array($rgb1) || !is_array($rgb2)) {
      // hex2RGB will raise an error
      return -1;
    }

    $r1 = $rgb1[0];
    $g1 = $rgb1[1];
    $b1 = $rgb1[2];

    $r2 = $rgb2[0];
    $g2 = $rgb2[1];
    $b2 = $rgb2[2];

    return(abs($r1-$r2) + abs($g1-$g2) + abs($b1-$b2));
  }

  //--------------------------------------------------
  function &raindrops_raiseError($message, $method, $line)
  {
    $error = raindrops_PEAR::raindrops_raiseError(sprintf("%s.%s() line %d: %s",
                      get_class($this), $method, $line, $message),
                  RAINDROPS_CSS_COLOR_ERROR);
  }

}

?>