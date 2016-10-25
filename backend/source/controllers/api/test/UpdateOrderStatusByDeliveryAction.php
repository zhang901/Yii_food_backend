<?php

//http://localhost/matching/index.php/api/register?name=tony&email=tony@gmail.com&dob=1992-12-11&gender=2&password=123456
class UpdateOrderStatusByDeliveryAction extends CAction
{
    public function run()
    {


        //$deliveryId = isset($_REQUEST['deliveryId']) ? $_REQUEST['deliveryId'] : '';
        $orderId = isset($_REQUEST['orderId']) ? $_REQUEST['orderId'] : '';
        $status = isset($_REQUEST['status']) ? $_REQUEST['status'] : '';

        $order = Order::model()->findByPk($orderId);
        //var_dump($order);exit;
       // echo $status;exit;
        if (isset($order))
        {
            if($status == 4)
            {
                if($order->order_status != 5 )
                {
                    $order->order_status = Constants::STATUS_DELIVERED;
                    if ($order->save(false)) {
                        ApiController::sendResponse(200, CJSON::encode(array(
                            'status' => 'SUCCESS',
                            'data' => '',
                            'message' => 'Update order status successful !',)));
                    }
                }
                else
                {

                        ApiController::sendResponse(200, CJSON::encode(array(
                            'status' => 'ERROR',
                            'data' => '',
                            'message' => 'Order failed !',)));

                }



            }
            else
            {
                if($order->order_status == 5 )
                {
                    ApiController::sendResponse(200, CJSON::encode(array(
                        'status' => 'ERROR',
                        'data' => '',
                        'message' => 'Order failed !',)));
                }
                else
                {
                    $order->order_status = Constants::STATUS_FAIL;
                    if ($order->save(false)) {
                        ApiController::sendResponse(200, CJSON::encode(array(
                            'status' => 'SUCCESS',
                            'data' => '',
                            'message' => 'Update order status successful !',)));
                    }
                }

            }




        } else {
            ApiController::sendResponse(200, CJSON::encode(array(
                'status' => 'ERROR',
                'data' => '',
                'message' => 'Order does not exist!',)));
            exit;
        }


    }
}