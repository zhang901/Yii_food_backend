<?php

class UpdateOrderStatusByWaiterAction extends CAction
{
    public function run()
    {
        $guest = isset($_REQUEST['guest']) ? $_REQUEST['guest'] : '';
        $status = isset($_REQUEST['status']) ? $_REQUEST['status'] : '';

        if(strlen($guest) == 0 || strlen($status) == 0 )
        {
            ApiController::sendResponse(200, CJSON::encode(array(
                'status' => Constants::ERROR,
                'message' => 'Please check again params!',
            )));
        }
        else
        {
            $allStatus = '"'.Constants::STATUS_CREATED.'","'.Constants::STATUS_IN_PROCESS.'","'.Constants::STATUS_READY.'"';

			$criteria = new CDbCriteria();
			$criteria->compare('order_name',$guest);
			//$criteria->compare('table_id',$tableId);
			$criteria->addCondition(' `order_status` IN (' . $allStatus . ') ');
			$order = Order::model()->findAll($criteria);
			if(count($order)>0)
			{
				foreach($order as $item)
				{
					$tableId = $item->table_id;
					$table = TableSeats::model()->findByPk($tableId);
					if(count($table)>0)
					{
						if($status == Constants::STATUS_DELIVERED || $status == Constants::STATUS_FAIL || $status == Constants::STATUS_REJECT)
						{
							$table->occupied = $table->occupied - $item->seats_number;
							if($table->occupied > 0)
							{
								$table->save(false);
							}
							else
							{
								$table->occupied = 0;
								$table->save(false);
							}
						}
					}
					$item->order_status = $status;
					if($item->save(false))
					{
						Order::model()->notifyStatus($item->order_id); 
					}
				}

				ApiController::sendResponse(200, CJSON::encode(array(
					'status' => Constants::SUCCESS,
					'message' => 'OK',
				)));
			}
			else
				ApiController::sendResponse(200, CJSON::encode(array(
					'status' => Constants::ERROR,
					'message' => 'ERROR',
				)));
        
        }

    }
}