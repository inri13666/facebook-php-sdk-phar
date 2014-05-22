<?php
/**
 * User  : Nikita.Makarov
 * Date  : 5/21/14
 * Time  : 1:17 PM
 * E-Mail: nikita.makarov@effective-soft.com
 */


$facebooksdk_path = implode(DIRECTORY_SEPARATOR, array(dirname(dirname(__FILE__)), 'compiled')) . DIRECTORY_SEPARATOR . 'FacebookSdk.';

if (extension_loaded('bz2')) {
    require_once 'phar://' . $facebooksdk_path . 'bz2';
} elseif (extension_loaded('zlib')) {
    require_once 'phar://' . $facebooksdk_path . 'gz';
} else {
    require_once 'phar://' . $facebooksdk_path . 'phar';
}

if(!session_id()){
    session_start();
}
\Facebook\FacebookSession::setDefaultApplication('APP_ID', 'APP_SECRET');
$helper = new \Facebook\FacebookRedirectLoginHelper('http://localhost/auth/flogin');
$loginUrl = $helper->getLoginUrl();
var_dump($loginUrl);