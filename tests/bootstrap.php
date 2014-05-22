<?php

$facebooksdk_path = implode(DIRECTORY_SEPARATOR, array(dirname(dirname(__FILE__)), 'compiled','FacebookSdk.'));

if (extension_loaded('bz2')) {
    require_once 'phar://' . $facebooksdk_path . 'bz2';
} elseif (extension_loaded('zlib')) {
    require_once 'phar://' . $facebooksdk_path . 'gz';
} else {
    require_once 'phar://' . $facebooksdk_path . 'phar';
}

use Facebook\FacebookSDKException;

if (!file_exists(__DIR__ . '/FacebookTestCredentials.php')) {
  throw new FacebookSDKException(
    'You must create a FacebookTestCredentials.php file from FacebookTestCredentials.php.dist'
  );
}

require_once __DIR__ . '/FacebookTestCredentials.php';
require_once __DIR__ . '/FacebookTestHelper.php';

$baseDir = str_replace('/tests', '', __DIR__);
define('APPLICATION_PATH', $baseDir);