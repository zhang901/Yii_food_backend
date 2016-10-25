<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Giang
 * Date: 3/5/14
 * Time: 2:18 PM
 * To change this template use File | Settings | File Templates.
 */

class ShowGuestTableAction extends CAction{
    public function run(){
        $name = array();
        $status = '"'.Constants::STATUS_CREATED.'","'.Constants::STATUS_IN_PROCESS.'","'.Constants::STATUS_READY.'"';
        $criteria = new CDbCriteria();
        $criteria->addCondition(' `order_status` IN (' . $status . ') ');
        $criteria->order = "order_name";
        $table = Order::model()->findAll($criteria);
        //var_dump($table);exit;
        if(count($table)>0)
        {
            foreach($table as $item)
            {
                $tab = TableSeats::model()->findByPk($item->table_id);
                if(count($tab)>0)
                {
                    $title = $tab->title;
					$guestNameWithTable = $item->order_name;
					if (!in_array($guestNameWithTable, $name))
						$name[] = $item->order_name;
                }
            }
            //$allName = array_unique($name);

            ApiController::sendResponse(200, CJSON::encode(array(
                'status' => Constants::SUCCESS,
                'name'=>$name,
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