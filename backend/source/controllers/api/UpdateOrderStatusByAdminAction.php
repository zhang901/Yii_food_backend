<?php

class UpdateOrderStatusByAdminAction extends CAction
{
    public function run()
    {
        $orderId = isset($_REQUEST['orderId']) ? $_REQUEST['orderId'] : '';
        $status = isset($_REQUEST['status']) ? $_REQUEST['status'] : '';

        $order = Order::model()->findByPk($orderId);

        if (count($order)>0)
        {
            if(strlen($status)>0)
            {
                $order->order_status = $status;
                if($status == Constants::STATUS_DELIVERED || $status == Constants::STATUS_REJECT || $status == Constants::STATUS_FAIL)
                {
                    $table = TableSeats::model()->findByPk($order->table_id);
                    if(count($table)>0)
                    {
                        $table->occupied = $table->occupied - $order->seats_number;
                        if(($table->occupied) >0)
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
                if ($order->save(false)) {
					Order::model()->notifyStatus($orderId); 
                    ApiController::sendResponse(200, CJSON::encode(array(
                        'status' => Constants::SUCCESS,
                        // 'data' => '',
                        'message' => 'Update orders status successful !',)));
                }
            }
            else
            {
                    ApiController::sendResponse(200, CJSON::encode(array(
                        'status' => 'ERROR',
                       // 'data' => '',
                        'message' => 'Please check again order status !',)));
            }
        } else {
            //echo 456;exit;
            ApiController::sendResponse(200, CJSON::encode(array(
                'status' => 'ERROR',
                'data' => '',
                'message' => 'Order does not exist!',)));
            //exit;
        }


    }
}