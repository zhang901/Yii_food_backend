<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Giang
 * Date: 3/5/14
 * Time: 2:18 PM
 * To change this template use File | Settings | File Templates.
 */

class OrderHistoryByUserAction extends CAction{
    public function run(){
        $userId = isset($_REQUEST['userId']) ? $_REQUEST['userId'] : '';
        $deviceId = isset($_REQUEST['deviceId']) ? $_REQUEST['deviceId'] : '';
        $type = isset($_REQUEST['type']) ? $_REQUEST['type'] : '';
        $page = isset($_REQUEST['page']) ? $_REQUEST['page'] : '1';
		$table_id = isset($_REQUEST['table_id']) ? $_REQUEST['table_id'] : '-1';
		$customer = isset($_REQUEST['customer']) ? $_REQUEST['customer'] : '';
        $data= array();


        $rows_per_page = 10;
        $start_index= ($page-1)*$rows_per_page;
        if($type == 1)
        {
            $account= Account::model()->findByPk($userId);
            if(count($account)>0)
            {
                if($account->role == 0) // normal user
                {

                    $account = Order::model()->findAll('user_id ='.$userId);
                    $numaccount= count($account);
                    //var_dump($numsong);exit;
                    $allpage=ceil($numaccount/$rows_per_page);


                    $criteria = new CDbCriteria();
                    $criteria->order= 'order_id DESC';
                    $criteria->compare('user_id',$userId);
                    $criteria->limit= $rows_per_page;
                    $criteria->offset= $start_index;
                    $order = Order::model()->findAll($criteria);
                }
				elseif($account->role == 4) // waiter
                {
                    $criteria = new CDbCriteria();
                    $criteria->order= 'order_id DESC';
                    $criteria->compare('user_id',$userId);
					$criteria->compare('table_id',$table_id);
					if (strlen($customer) > 0)
					{
						$criteria->compare('customer',$customer);
						$criteria->condition = "user_id = $userId and ( order_status = 0 or order_status = 2 or order_status = 3 ) and (order_name = '$customer') "; // only show New, In process and Ready
					}
					else
						$criteria->condition = "user_id = $userId and ( order_status = 0 or order_status = 2 or order_status = 3 ) and (table_id = $table_id or $table_id = -1) "; // only show New, In process and Ready
                    $orders = Order::model()->findAll($criteria);

                    $allpage=ceil(count($orders)/$rows_per_page);

                    $criteria = new CDbCriteria();
                    $criteria->order= 'order_id DESC';
                    $criteria->compare('user_id',$userId);
                    $criteria->compare('table_id',$table_id);
                    $criteria->limit = $rows_per_page;
                    $criteria->offset = $start_index;
                    if (strlen($customer) > 0)
                    {
                        $criteria->compare('customer',$customer);
                        $criteria->condition = "user_id = $userId and ( order_status = 0 or order_status = 2 or order_status = 3 ) and (order_name = '$customer') "; // only show New, In process and Ready
                    }
                    else
                        $criteria->condition = "user_id = $userId and ( order_status = 0 or order_status = 2 or order_status = 3 ) and (table_id = $table_id or $table_id = -1) "; // only show New, In process and Ready
                    $order = Order::model()->findAll($criteria);

                }

                elseif($account->role == 1) // delivery
                {
                    $account = Order::model()->findAll("delivery_id = $userId and order_status = 6");
                    $numaccount= count($account);
                    // var_dump($numaccount);exit;
                    $allpage=ceil($numaccount/$rows_per_page);

                    $criteria = new CDbCriteria();
                    $criteria->order= 'order_id DESC';
                    $criteria->condition = " delivery_id = $userId  and order_status = 6 ";
                    $criteria->limit= $rows_per_page;
                    $criteria->offset= $start_index;
                    $order = Order::model()->findAll($criteria);
                    //var_dump($order);exit;
                }
                else // chef
                {
                    $orders = Order::model()->findAll("chef_id = $userId and ( order_status = 0 or order_status = 2 ) ");
                    $numaccount= count($orders);
                    // var_dump($numaccount);exit;
                    $allpage=ceil($numaccount/$rows_per_page);

                    $criteria = new CDbCriteria();
                    $criteria->order= 'order_id DESC';
                    $criteria->condition = "chef_id = $userId and ( order_status = 0 or order_status = 2 ) ";
                    $criteria->limit= $rows_per_page;
                    $criteria->offset= $start_index;
                    $order = Order::model()->findAll($criteria);
                    //$order = Order::model()->findAll("chef_id = $userId and ( order_status = 0 or order_status = 2 ) ");
                }
            }
        }
        else
        {
            $orders = Order::model()->findAll('deviceId = "'.$deviceId.'" ');
            $numaccount= count($orders);
            // var_dump($numaccount);exit;
            $allpage=ceil($numaccount/$rows_per_page);

            $criteria = new CDbCriteria();
            $criteria->order= 'order_id DESC';
            $criteria->condition = 'deviceId = "'.$deviceId.'" ';
            $criteria->limit= $rows_per_page;
            $criteria->offset= $start_index;
            $order = Order::model()->findAll($criteria);
        }

        $path= Yii::app()->getBaseUrl(true);
        //echo $path;exit;
        //var_dump($order);exit;

        if(count($order)>0)
        {

            foreach($order as $item)
            {
                $data_foods= array();
                $id= $item->order_id;                

               // echo( $totalitems);exit;
                $order_item = OrderItem::model()->findAll('oi_order_id = "'.$id.'" ');
                $allsl = array();
                if(count($order_item)>0)
                {
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
                }
                $totalitems= count($allsl);
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
                    'totalItems'=>$totalitems
                    //'orderItems'=>$data_items
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
                'status' => 'SUCCESS',
                'data' => '',
                'message' => 'Not found order for User',
            )));
    }
}