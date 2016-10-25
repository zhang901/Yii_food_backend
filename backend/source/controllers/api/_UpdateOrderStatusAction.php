<?php

//http://localhost/matching/index.php/api/register?name=tony&email=tony@gmail.com&dob=1992-12-11&gender=2&password=123456
class UpdateOrderStatusAction extends CAction
{
    public function run()
    {


        //$deliveryId = isset($_REQUEST['deliveryId']) ? $_REQUEST['deliveryId'] : '';
        $orderId = isset($_REQUEST['orderId']) ? $_REQUEST['orderId'] : '';
        $status = isset($_REQUEST['status']) ? $_REQUEST['status'] : '';

        $order = Order::model()->findByPk($orderId);
        //var_dump($order);exit;

        if (isset($order)) {
            if($status == 2)
            {
               // echo 123;
                if($order->order_status != $status)
                {

                    $order->order_status = Constants::STATUS_DELIVERED;
                    if ($order->save(false)) {
                        ApiController::sendResponse(200, CJSON::encode(array(
                            'status' => 'SUCCESS',
                            'data' => '',
                            'message' => 'Order Status update successful !',)));
                }
                }
                else

                ApiController::sendResponse(200, CJSON::encode(array(
                    'status' => 'ERROR',
                    'data' => '',
                    'message' => 'Order Delivered!',)));
            }
            elseif($status == 1)
            {
               // echo 456;exit;
                $order->order_status = Constants::STATUS_PENDING;
                if ($order->save(false)) {
                    ApiController::sendResponse(200, CJSON::encode(array(
                        'status' => 'SUCCESS',
                        'data' => '',
                        'message' => 'Order Status update successful !',)));
                }
            }
            else
                ApiController::sendResponse(200, CJSON::encode(array(
                    'status' => 'SUCCESS',
                    'data' => '',
                    'message' => 'Order Status not available !',)));



        } else {
            ApiController::sendResponse(200, CJSON::encode(array(
                'status' => 'ERROR',
                'data' => '',
                'message' => 'Order does not exist!',)));
            exit;
        }


    }
}