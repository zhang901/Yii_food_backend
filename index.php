<?php

// change the following paths if necessary
$root_dir = dirname(__FILE__);
defined('UPLOAD_DIR') or define('UPLOAD_DIR','uploads');
//$yii=dirname($root_dir).'/wc2014/common/libraries/yii-1.1.14.f0fee9/framework/yii.php';
$yii=$root_dir.'/common/lib/yii-1.1.14.f0fee9/framework/yii.php';

$config=$root_dir.'/backend/source/config/main.php';

// remove the following lines when in production mode
defined('YII_DEBUG') or define('YII_DEBUG',true);
// specify how many levels of call stack should be shown in each log message
defined('YII_TRACE_LEVEL') or define('YII_TRACE_LEVEL',3);
// On dev display all errors
if(YII_DEBUG) {
    error_reporting(-1);
    ini_set('display_errors', true);
}
date_default_timezone_set('UTC');

require_once($yii);
require_once($root_dir.'/common/components/WebApplication.php');
$app = Yii::createApplication('WebApplication', require($config));

$app->run();