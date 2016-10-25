<?php

//http://localhost/matching/index.php/api/register?name=tony&email=tony@gmail.com&dob=1992-12-11&gender=2&password=123456
class UpdateOrderStatusByDeliveryAction extends CAction
{
    public function run()
    {


        //$deliveryId = isset($_REQUEST['deliveryId']) ? $_REQUEST['deliveryId'] : '';
        $orderId = isset($_REQUEST['orderId']) ? $_REQUEST['orderId'] : '';
        $status = isset($_REQUEST['status']) ? $_REQUEST['status'] : '';

        //$criteria = new CDbCriteria();
        // $criteria->compare('order_id',$orderId);
        //$criteria->condition = "order_status = 3";
        $order = Order::model()->findByPk($orderId);
        //var_dump($order);exit;
        // echo $status;exit;
        if (count($order)>0)
        {
            if(strlen($status)>0)
            {
                if($order->order_status != Constants::STATUS_PENDING)
                {
                    $order->order_status = Constants::STATUS_PENDING;
                    if ($order->save(false)) {
                        ApiController::sendResponse(200, CJSON::encode(array(
                            'status' => Constants::SUCCESS,
                            // 'data' => '',
                            'message' => 'Orders Pending !',)));
                    }
                }
                else
                {
                    if($status == Constants::STATUS_DELIVERED)
                    {
                        $order->order_status = Constants::STATUS_DELIVERED;
                        if ($order->save(false)) {
                            ApiController::sendResponse(200, CJSON::encode(array(
                                'status' => Constants::SUCCESS,
                                // 'data' => '',
                                'message' => 'Orders Delivered !',)));
                        }
                    }
                    else
                    {
                        $order->order_status = Constants::STATUS_FAIL;
                        if ($order->save(false)) {
                            ApiController::sendResponse(200, CJSON::encode(array(
                                'status' => Constants::SUCCESS,
                                // 'data' => '',
                                'message' => 'Orders Failed !',)));
                        }
                    }
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