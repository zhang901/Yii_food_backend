<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Giang
 * Date: 3/5/14
 * Time: 2:18 PM
 * To change this template use File | Settings | File Templates.
 */

class ViewOrdersAction extends CAction{
    public function run()
    {
       // $orderId = isset($_REQUEST['orderId']) ? $_REQUEST['orderId'] : '';
        $page = isset($_REQUEST['page']) ? $_REQUEST['page'] : '1';
        $data= array();

        $path= Yii::app()->getBaseUrl(true);
        
            $rows_per_page = 10;
            $order = Order::model()->findAll();
            $numoder= count($order);
            //var_dump($numsong);exit;
            $allpage=ceil($numoder/$rows_per_page);

            $start_index= ($page-1)*$rows_per_page;

            $criteria = new CDbCriteria();
            $criteria->order= 'order_id DESC';
            $criteria->limit= $rows_per_page;
            $criteria->offset= $start_index;

            $order = Order::model()->findAll($criteria);
            if(count($order)>0)
            {
                foreach($order as $item)
                {
                    $data_foods = array();
                    $id= $item->order_id;
					
					$order_item = OrderItem::model()->findAll('oi_order_id = "'.$id.'" ');
					$allsl = array();					
					
                    foreach($order_item as $an_order)
                    {
						$dish= Dish::model()->findByPk($an_order->oi_dish_id);
                        $allsl[] = $an_order->oi_dish_quantity;
                        $data_foods[]= array(
                            //'topping'=>$food->topping,
                            'id'=>$an_order->oi_id,
                            'dishName'=>$dish->dish_name.' ('.$an_order->oi_toppings.')',
                            'dishPrice'=>$an_order->oi_dish_price + $an_order->oi_topping_price,
                            'sl'=>$an_order->oi_dish_quantity,
                            'panini'=> $an_order->oi_is_panini,
                            'instruction'=>$an_order->oi_instruction,
                            'cookingMethod'=>$an_order->oi_toppings,
                            'total'=> ($an_order->oi_dish_price + $an_order->oi_topping_price)*$an_order->oi_dish_quantity,
                            'category'=>'',
                            'thumb'=>$path.'/uploads/products/'.$dish->dish_id.'/'.$dish->dish_thumb

                        );
                    }
					
                    $data[] = array(
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
                        'orderAddress'=>$item->order_address,
                        'orderFoods'=>$data_foods,
                        'totalItems'=>count($allsl)
                    );
                    // }
                }
                ApiController::sendResponse(200, CJSON::encode(array(
                    'status' => 'SUCCESS',
                    'data'=>$data,
                    'numpage'=>$allpage,
                    'message' => 'OK',
                )));

            }
            else
                ApiController::sendResponse(200, CJSON::encode(array(
                    'status' => 'ERROR',
                    'data' => '',
                    'message' => 'Orders does not exist',
                )));
      //  }
    }



}