<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Giang
 * Date: 3/5/14
 * Time: 2:18 PM
 * To change this template use File | Settings | File Templates.
 */

class ListConsultingDetailAction extends CAction{
    public function run(){
        if(isset($_REQUEST['consultingId']) && !empty($_REQUEST['consultingId'])){
            $criteria = new CDbCriteria();
            $criteria->compare('article_id', $_REQUEST['consultingId']);
            $products = Article::model()->findAll($criteria);
            $result = array();
            foreach($products as $product){
                $result[] = array(
                    'id' => $product->article_id,
                    'title' => $product->article_title,
                    'content' => $product->article_content,
                    'thumb'=>SITEURL.Yii::app()->createUrl('site/image', array('id'=>$product->article_id,'f'=>$product->article_thumb,'t'=>Constants::TYPE_ARTICLE)),
                    'author' => $product->article_author,
                    'created' => $product->created,
                    'updated' => $product->updated,
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
        }else{
            ApiController::sendResponse(400, CJSON::encode(array(
                'status' => Constants::ERROR,
                'data' => '',
                'message' => Yii::t('common', 'msg.badRequest')
            )));
        }
    }
}