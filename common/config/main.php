<?php
/**
 * Created by L'orge.
 * User: Only Love.
 * Date: 11/23/13 - 9:49 PM
 *
 * Please keep copyright headers of source code files when use it.
 * Thank you!
 */
Yii::setPathOfAlias('root', $root_dir);
Yii::setPathOfAlias('common', $root_dir . '/common/');
return CMap::mergeArray(
    array(
        // Autoloading model and component classes
        'import'=>array(
            'common.models.*',
            'common.components.*',
            'common.messages.*',
            'common.extensions.*',
            'common.lib.*',

            // autoload widgets
            'common.extensions.yii-mail.*',
            'common.extensions.select2.*',
        ),

        // Define the modules of project
        'modules'=>array(
            // Enable yii code generator
            'gii'=>array(
                'class'=>'system.gii.GiiModule',
                'password'=>'admin',
                'ipFilters'=>array('127.0.0.1','::1'),
                'generatorPaths'=>array(
                    'common.extensions.gii',
                ),
            ),
        ),

        // Define the behaviors of project
        'behaviors'=>array(
            'onBeginRequest' => array(
                'class' => 'common.components.behaviors.LanguageBehavior'
            ),
        ),

        // Define the components of project
        'components'=>array(
            'cache'  => array(
                'class'  => 'system.caching.CFileCache',
            ),
            'db'=>array(
                'class' => 'CDbConnection',
                'connectionString' => 'mysql:host=localhost;dbname=fast_food',
                'emulatePrepare' => true,
                'username' => 'root',
                'password' => '',
                'charset' => 'utf8',
            ),
            'commonMessages'=>array(
                'class'=>'CPhpMessageSource',
                'basePath'=>Yiibase::getPathOfAlias('common').DIRECTORY_SEPARATOR.'messages',
            ),
            'mail' => array(
                'class' => 'common.extensions.yii-mail.YiiMail',
                'transportType'=>'smtp',
                'transportOptions'=>array(
                    'host'=>'smtp.gmail.com',
                    'username'=>'fruity.tester@gmail.com',
                    'password'=>'trollerlvlmax',
                    'port'=>'465',
                    'encryption' => 'tls',
                ),
                'logging' => true,
                'dryRun' => false
            ),
        ),

        'params'=>array(
        ),
    ),
    (file_exists(dirname(__FILE__) . '/main-env.php') ? require(dirname(__FILE__) . '/main-env.php') : array()),
    (file_exists(dirname(__FILE__) . '/main-local.php') ? require(dirname(__FILE__) . '/main-local.php') : array())
);