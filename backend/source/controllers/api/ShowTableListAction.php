<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Giang
 * Date: 3/5/14
 * Time: 2:18 PM
 * To change this template use File | Settings | File Templates.
 */

class ShowTableListAction extends CAction{
    public function run(){
        $data = array();
        $criteria = new CDbCriteria();
        $criteria->compare('status',1);
        $criteria->order = "order_number ASC";
        $table = TableSeats::model()->findAll($criteria);
        if(count($table)>0)
        {
            foreach($table as $item)
            {
                $data[] = $item;
            }
            ApiController::sendResponse(200, CJSON::encode(array(
                'status' => Constants::SUCCESS,
                'data'=>$data,
                'message' => 'OK',
            )));
        }
        else
            ApiController::sendResponse(200, CJSON::encode(array(
                'status' => Constants::SUCCESS,
                'data'=>array(),
                'message' => 'OK',
            )));
    }
}