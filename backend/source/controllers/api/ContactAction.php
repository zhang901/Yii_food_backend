<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Giang
 * Date: 3/5/14
 * Time: 2:18 PM
 * To change this template use File | Settings | File Templates.
 */

class ContactAction extends CAction{
    public function run(){
        $data = $_POST;
        if(isset($data['email']) && isset($data['content'])){
            $result = new Contact();
            $result->contact_id = DateTimeUtils::nowStr();
            $result->contact_email = $data['email'];
            $result->contact_content = $data['content'];
            $result->created = date('Y-m-d H:i:s');

            if($result->save()){
                ApiController::sendResponse(200, CJSON::encode(array(
                    'status' => Constants::SUCCESS,
                    'data' => '',
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