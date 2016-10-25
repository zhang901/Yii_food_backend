<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Giang
 * Date: 3/5/14
 * Time: 2:18 PM
 * To change this template use File | Settings | File Templates.
 */

class MenusAction extends CAction{
    public function run(){
        $products = Menus::model()->findAll();
        $result = array();
        foreach($products as $product){
            $result[] = array(
                'id' => $product->menu_id,
                'name' => $product->menu_name,
                'small_thumb'=>SITEURL.Yii::app()->createUrl('site/image', array('id'=>$product->menu_id,'f'=>$product->menu_thumb,'t'=>Constants::TYPE_MENU)),
                'description' => $product->menu_desc,
            );
        }
        if(count($result) > 0){
            ApiController::sendResponse(200, CJSON::encode(array(
                'status' => Constants::SUCCESS,
                'data' => $result,
                'message' => '',
            )));
        }else{
            ApiController::sendResponse(200, CJSON::encode(array(
                'status' => Constants::ERROR,
                'data' => '',
                'message' => Yii::t('common', 'msg.notFound')
            )));
        }
    }
}