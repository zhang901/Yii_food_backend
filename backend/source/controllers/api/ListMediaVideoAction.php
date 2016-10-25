<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Giang
 * Date: 3/5/14
 * Time: 2:18 PM
 * To change this template use File | Settings | File Templates.
 */

class ListMediaVideoAction extends CAction{
    public function run(){

        $criteria = new CDbCriteria();
        $criteria->compare('media_type','video');
        $products = Media::model()->findAll($criteria);
        $result = array();
        foreach($products as $product){

                $result[] = array(
                    'id' => $product->media_id,
                    'name' => $product->media_name,
                    'description' => $product->media_desc,
                    'thumb'=>SITEURL.Yii::app()->createUrl('site/image', array('id'=>$product->media_id,'f'=>$product->media_thumb,'t'=>Constants::TYPE_MEDIA)),
                    'link' => $product->media_links,
                    'type' => $product->media_type,
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