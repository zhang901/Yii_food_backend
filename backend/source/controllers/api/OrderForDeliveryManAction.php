<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Giang
 * Date: 3/5/14
 * Time: 2:18 PM
 * To change this template use File | Settings | File Templates.
 */

class OrderForDeliveryManAction extends CAction{
    public function run(){
        $deliveryId = isset($_REQUEST['deliveryId']) ? $_REQUEST['deliveryId'] : '';

        $data= array();
        $order = Order::model()->findAll('delivery_id ='.$deliveryId);
        if(count($order)>0)
        {
            foreach($order as $item)
            {
                $id= $item->order_id;
                $foods = json_decode($item->order_foods);
                //var_dump( $foods);exit;
                foreach($foods as $food)
                {
                    $data_foods= array(
                        //'topping'=>$food->topping,
                        'id'=>$food->id,
                        'panini'=>$food->panini,
                        'sl'=>$food->sl,
                        'instruction'=>$food->instruction,
                        'cookingMethod'=>$food->cookingMethod
                    );
                }


                $data = array(
                    'id'=>$id,
                    'orderName'=>$item->order_name,
                    'orderTel'=>$item->order_tel,
                    'orderEmail'=>$item->order_email,
                    'orderRequirement'=>$item->order_requirement,
                    'orderTime'=>$item->order_time,
                    'orderPrice'=>$item->order_price,
                    'orderToppingPrice'=>$item->order_topping_price,
                    'orderStatus'=>$item->order_status,
                    'created'=>$item->created,
                    'updated'=>$item->updated,
                    'orderFoods'=>$data_foods
                );

            }
            ApiController::sendResponse(200, CJSON::encode(array(
                'status' => 'SUCCESS',
                'data'=>$data,
                'message' => 'OK',
                )));

        }
        else
        ApiController::sendResponse(200, CJSON::encode(array(
                    'status' => 'ERROR',
                    'data' => '',
                    'message' => 'Not found order for Delivery Man',
                )));
    }
}