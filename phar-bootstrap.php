<?php
if (!function_exists('__def')) {
    function __def($constant, $value)
    {
        if (strlen($constant) <= 0) {
            return false;
        }
        if (!defined($constant)) {
            define($constant, $value);
            return true;
        }
        //Already Defined
        return false;
    }
}
__def('DS', DIRECTORY_SEPARATOR);

if (version_compare(PHP_VERSION, '5.4.0') < 0) {
    exit("PHP must be 5.4.0+");
}

Phar::mapPhar();

if (!function_exists('FacebookSdkAutoloader')) {
    function FacebookSdkAutoloader($class)
    {
        $basePath = 'phar://' . __FILE__ . '/';
        if (is_readable($basePath . str_replace('\\', '/', $class) . '.php')) {
            require_once $basePath . str_replace('\\', '/', $class) . '.php';
        };

    }

    spl_autoload_register('FacebookSdkAutoloader');
}
/**
 * TODO: Handle cacerts.pem
 */
if (!defined('FBSDK_CA_FILE_PATH')) {
    @mkdir(sys_get_temp_dir() . DIRECTORY_SEPARATOR . 'Facebook', 0777, true);
    file_put_contents(sys_get_temp_dir() . DIRECTORY_SEPARATOR . 'Facebook' . DIRECTORY_SEPARATOR . 'fb_ca_chain_bundle.crt', file_get_contents('phar://' . __FILE__ . '/Facebook/fb_ca_chain_bundle.crt'));
    define('FBSDK_CA_FILE_PATH', sys_get_temp_dir() . DIRECTORY_SEPARATOR . 'Facebook' . DIRECTORY_SEPARATOR . 'fb_ca_chain_bundle.crt');
}
__HALT_COMPILER();
?>
