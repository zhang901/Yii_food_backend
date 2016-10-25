<?php

//http://localhost/matching/index.php/api/register?name=tony&email=tony@gmail.com&dob=1992-12-11&gender=2&password=123456
class UpdateOrderAction extends CAction
{
    public function run()
    {

        $orderId = isset($_REQUEST['orderId']) ? $_REQUEST['orderId'] : '';
        $deliveryId = isset($_REQUEST['deliveryId']) ? $_REQUEST['deliveryId'] : '';
        $chefId = isset($_REQUEST['chefId']) ? $_REQUEST['chefId'] : '';
        $status = isset($_REQUEST['status']) ? $_REQUEST['status'] : '';


        $order = Order::model()->findByPk($orderId);
        if (count($order)>0)
        {
            if(strlen($deliveryId)>0)
            {
                $order->delivery_id = $deliveryId;
                $order->order_status = $status;
                if($order->save(false))
                {
			Order::model()->notifyStatus($orderId);                    
                }
            }
            else
            {
                $order->chef_id = $chefId;
                $order->order_status = $status;                
                if($order->save(false))
                {
			Order::model()->notifyStatus($orderId);   
		}
            }
	    ApiController::sendResponse(200, CJSON::encode(array(
                        'status' => Constants::SUCCESS,
                        //'data' => '',
                        'message' => 'OK',
            )));
	} else {
            ApiController::sendResponse(200, CJSON::encode(array(
                'status' => 'ERROR',
                'data' => '',
                'message' => 'Order does not exist!',)));
            exit;
        }


    }
}