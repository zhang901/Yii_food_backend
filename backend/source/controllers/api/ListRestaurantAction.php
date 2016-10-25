<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Giang
 * Date: 3/5/14
 * Time: 2:18 PM
 * To change this template use File | Settings | File Templates.
 */

class ListRestaurantAction extends CAction{
    public function run(){
        $products = Location::model()->findAll();
        $result = array();
        /** @var Location $product */
        foreach($products as $product){
            $result[] = array(
                'id' => $product->location_id,
                'name' => $product->location_name,
                'address' => $product->location_address,
                'tel'=> $product->location_tel,
                'open_hour' => $product->location_open_hour,
                'last_order_hour' => $product->location_last_order_hour,
                'latitude' => $product->location_latitude,
                'longitude' => $product->location_longitude,
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