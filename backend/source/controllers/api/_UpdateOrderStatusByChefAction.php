<?php

//http://localhost/matching/index.php/api/register?name=tony&email=tony@gmail.com&dob=1992-12-11&gender=2&password=123456
class UpdateOrderStatusByChefAction extends CAction
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
            if($status != 1)
            {
                //echo 123;
                if($order->order_status != 1)
                {
                    //echo 123;exit;
                    if($status == 2)
                    {
                        //echo 123;
                        $order->order_status = Constants::STATUS_IN_PROCESS;
                        if ($order->save(false)) {
                            ApiController::sendResponse(200, CJSON::encode(array(
                                'status' => 'SUCCESS',
                                'data' => '',
                                'message' => 'Update order status successful !',)));
                        }
                    }
                    else
                    {
                       // echo 456;exit;
                        if($order->order_status != $status)
                        {
                           // echo 123;exit;
                            $order->order_status = Constants::STATUS_READY;
                            if ($order->save(false)) {
                                ApiController::sendResponse(200, CJSON::encode(array(
                                    'status' => 'SUCCESS',
                                    'data' => '',
                                    'message' => 'Update order status successful !',)));
                            }
                        }
                        else
                            ApiController::sendResponse(200, CJSON::encode(array(
                                'status' => 'ERROR',
                                'data' => '',
                                'message' => 'Order Ready!',)));
                    }
                }
                else
                    ApiController::sendResponse(200, CJSON::encode(array(
                        'status' => 'ERROR',
                        'data' => '',
                        'message' => 'Order Rejected!',)));


            }
            else
            {
                //echo 456;exit;
                $order->order_status = Constants::STATUS_REJECT;
                if ($order->save(false)) {
                    ApiController::sendResponse(200, CJSON::encode(array(
                        'status' => 'SUCCESS',
                        'data' => '',
                        'message' => 'Update order status successful  !',)));
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