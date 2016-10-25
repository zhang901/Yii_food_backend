<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Giang
 * Date: 3/5/14
 * Time: 2:18 PM
 * To change this template use File | Settings | File Templates.
 */

class ListDishPromotionAction extends CAction{
    public function run(){
        /** @var Promotion $products */
        $products = Promotion::model()->findAll();
        $result = array();
        foreach($products as $product){
            $result[] = array(
                'id' => $product->promotion_id,
                'description' => $product->promotion_desc,
                'image'=>SITEURL.Yii::app()->createUrl('site/image', array('id'=>$product->promotion_id,'f'=>$product->promotion_image,'t'=>Constants::TYPE_PROMOTION)),
                'url' => $product->promotion_urls,
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