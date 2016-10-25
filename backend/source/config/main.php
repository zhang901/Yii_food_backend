<?php
/**
 * Created by Lorge 
 *
 * User: Only Love.
 * Date: 12/15/13 - 9:00 AM
 */

if(!isset($root_dir)) $root_dir = dirname(dirname(dirname(dirname(__FILE__))));
$site_base_url = '/fastfood';

Yii::setPathOfAlias('common', $root_dir . '/common/');
Yii::setPathOfAlias('backend', $root_dir . '/backend/source/');
// Config upload dirs file
Yii::setPathOfAlias('uploads', $root_dir . '/uploads/');

define('SITEURL', 'http://localhost/');

return CMap::mergeArray(
    require($root_dir . '/common/config/main.php'),
    array(
        'name' => 'Restaurant',
        'basePath' => $root_dir . '/backend/source/',
        'runtimePath' => $root_dir . '/backend/source/runtime/',
        'defaultController' => 'site/login',
        'preload' => array('log'),
        'language' => 'en',
        'import' => array(
            'backend.components.*',
            'backend.controllers.*',
            'backend.models.*',
            'backend.libraries.*',
            'backend.messages.*',
        ),
        'components' => array(
            'assetManager'=>array(
                'basePath'=>$root_dir . '/backend/static/assets/',
                'baseUrl'=>$site_base_url.'/backend/static/assets/'
            ),
            'clientScript' => array(
                'coreScriptPosition'=>CClientScript::POS_END,
                'defaultScriptPosition'=>CClientScript::POS_END,
                'defaultScriptFilePosition'=>CClientScript::POS_END
            ),
            'user'=>array(
                'allowAutoLogin'=>true,
                'class' => 'backend.components.WebUser',
                'loginUrl'=>array('site/login'),
            ),
            'errorHandler' => array(
                'errorAction'=>'site/error'
            ),
            'urlManager'=>array(
                'urlFormat'=>'path',
                'caseSensitive' => true,
                'rules'=>array(
                    '<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
                    'api/menu/list'=>'api/listMenus',
                    'api/dish/promotion/list'=>'api/listDishPromotion',
                    'api/restaurant/list'=>'api/listRestaurant',
                    'api/order/create'=>'api/order',
                    'api/reservation/create'=>'api/reservation',
                    'api/restaurant/contact'=>'api/restaurantContact',

                    //'api/menu/detail'=>'api/listMenuDetail',
                    'api/consulting/detail'=>'api/listConsultingDetail',
                    'api/media/list/video'=>'api/listMediaVideo',
                    'api/media/list/consulating'=>'api/listMediaConsulting',
                    'api/media/list/news'=>'api/listMediaNews',
                    'api/media/list/album'=>'api/listMediaAlbum',
                ),
                'showScriptName'=>false,
                'urlSuffix'=>'.html',
            ),
            'mail' => array(
                'viewPath' => 'backend.views.mail',
            ),
        ),
    ),
    (file_exists(dirname(__FILE__) . '/main-env.php') ? require(dirname(__FILE__) . '/main-env.php') : array()),
    (file_exists(dirname(__FILE__) . '/main-local.php') ? require(dirname(__FILE__) . '/main-local.php') : array())
);