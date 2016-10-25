<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Giang
 * Date: 3/5/14
 * Time: 2:18 PM
 * To change this template use File | Settings | File Templates.
 */

class OrderAction extends CAction{
    public function run(){
        $data = $_REQUEST;
        // ApiController::sendResponse(400, CJSON::encode(array(
        // 'status' => Constants::ERROR,
        // 'name' => $data['name'],
        // 'tel' => $data['tel'],
        // 'products' => $data["products"],
        // 'time' => $data['time'],
        // 'message' => 'eat sheet'
        // )));
        // die;
		/*ApiController::sendResponse(200, CJSON::encode(array(
                    'status' => Constants::ERROR,
                    'data' => 'type: '.$data['type'].' name: '.$data['name'].' tel: '.$data['tel'].' time: '.$data['time'].' address: '.$data['address'].' payment_type: '.$data['payment_type'].' table_id: '.$data['table_id'].' seats_number: '.$data['seats_number'],
					//'data' => 'type: '.isset($data['time']),
                    'message' => 'abc'
                )));
		die;*/
        if( isset($data['type']) && isset($data['name']) && isset($data['tel']) && isset($data["products"]) && is_array($data["products"])&& isset($data['time']) && isset($data['address']) && isset($data['payment_type']) && isset($data['table_id']) && isset($data['seats_number']))
        {
		
            if($data['type'] === '1') //dang nhap
            {
				
				$isOldCustomer = strrpos($data['name'], ")");
				
				$name = $data['name'];
				if ($isOldCustomer === false){
					// new customer here
					
					$table_id = $data['table_id'];
					$tab = TableSeats::model()->findByPk($table_id);
					if(count($tab)>0)
					{
						$name = $tab->title .') '.$name;
					}
				}
				
                $model = new Order();
                //$model->order_id = StringUtils::generateGUID();
                $model->order_name = $name;
                $model->order_tel = $data['tel'];
                $model->order_email = isset($data['email']) && !empty($data['email']) ? $data['email'] : "";
                $model->order_price = 0;
                $model->order_topping_price = 0;
                $model->order_address = $data['address'];
                $model->payment_type = $data['payment_type'];
                $model->user_id = $data['userId'];
				$model->table_id = $data['table_id'];
                $model->seats_number = $data['seats_number'];
                //$model->order_status = 0;
            }
            else
            {
                $model = new Order();
               // $model->order_id = StringUtils::generateGUID();
                $model->order_name = $data['name'];
                $model->order_tel = $data['tel'];
                $model->order_email = isset($data['email']) && !empty($data['email']) ? $data['email'] : "no-email@mail.com";
                $model->order_price = 0;
                $model->order_topping_price = 0;
                $model->order_address = $data['address'];
                $model->deviceId = $data['deviceId'];
                $model->payment_type = $data['payment_type'];
                //$model->order_status = 0;
            }
            $arr = array();
            $arrItems = array();
            try{
                // echo '<pre>'; var_dump($data["products"]); die;
                foreach($data["products"] as $food){
                    $arrTemp = CJSON::decode($food);
                    $arr[] = $arrTemp;
                    if(isset($arrTemp["id"]) && isset($arrTemp["sl"]) && is_numeric($arrTemp["sl"])){
                        $sl = intval($arrTemp["sl"]);
                        $itemOptionPrice = 0;
                        $food = Dish::model()->findByPk($arrTemp["id"]);
                        if($food != null){
                            $itemPrice = $food->dish_price; //(isset($food->dish_promotion)?$food->dish_promotion:$food->dish_price);
                            $toppings = isset($arrTemp['toppings']) ? $arrTemp['toppings'] : array();
                            $str = "";

                            if(count($toppings)>0){
                                foreach($toppings as $toppingsIndex=>$toppingsValue){
                                    /** @var Relishes $top */
                                    foreach($toppingsValue as $topping=>$toppingOption){

                                        $top = Relishes::model()->findByPk($topping);
                                        if($top!=null){

                                            $itemOptionPrice += $top->relish_price;
                                            $topOption = CookingMethod::model()->findByPk($toppingOption);
                                            if($toppingOption != null){
                                                $str = $str . ", " . $top->relish_name . " - " . $topOption->cm_name;
                                            }else{
                                                $str = $str . ", " . $top->relish_name;
                                            }
                                        }
                                    }
                                }
                                $str = !empty($str) ? substr($str,2,strlen($str)) : $str;
                            }
                            $model->order_price += ($itemPrice + $itemOptionPrice) * $sl;

                            $cookingMethodStr = "";
                            if(isset($arrTemp['cookingMethod']) && !empty($arrTemp['cookingMethod'])){
                                /** @var CookingMethod $cookingMethod */
                                $cookingMethod = CookingMethod::model()->findByPk($arrTemp['cookingMethod']);
                                if($cookingMethod != null && $cookingMethod->cm_type == Constants::TYPE_MENU){
                                    if($cookingMethod->cm_parent_id != 0){
                                        $cookingMethodParent = CookingMethod::model()->findByPk($cookingMethod->cm_parent_id);
                                        if($cookingMethodParent != null && $cookingMethodParent->cm_type == Constants::TYPE_MENU){
                                            $cookingMethodStr = $cookingMethodParent->cm_name . " - " . $cookingMethod->cm_name;
                                        }else{
                                            $cookingMethodStr = $cookingMethod->cm_name;
                                        }
                                    }else{
                                        $cookingMethodStr = $cookingMethod->cm_name;
                                    }
                                }
                            }
                            $arrItems[] = array(
                                'itemPrice'=>$itemPrice,
                                'itemOptionPrice'=>$itemOptionPrice,
                                'cookingMethod'=>$cookingMethodStr,
                                'toppings'=>$str,
                                'json'=>$arrTemp,
                                'item'=>$food,
                            );
                        }
                    }
                }
                $model->order_foods = CJSON::encode($arr);
            }catch(Exception $e){
                $model->order_foods = "error";
				ApiController::sendResponse(200, CJSON::encode(array(
                    'status' => Constants::ERROR,
                    'data' => 'type: '.$data['type'].' name: '.$data['name'].' tel: '.$data['tel'].' time: '.$data['time'].' address: '.$data['address'].' payment_type: '.$data['payment_type'].' table_id: '.$data['table_id'].' seats_number: '.$data['seats_number'],
					//'data' => 'type: '.isset($data['time']),
                    'message' => 'abc'
                )));
				die;
            }
            $model->order_requirement = isset($data['instruction'])?$data['instruction']:"";
            $model->order_time = isset($data['time']) && !empty($data['time']) ? $data['time'] : '';
            $model->order_status = Constants::STATUS_CREATED;
            $model->created = $model->updated = DateTimeUtils::now();

            $ts = Yii::app()->db->beginTransaction();
            if($result = $model->save(false)){
                if(isset($data['table_id']) && isset($data['seats_number']))
                {
                    $table = TableSeats::model()->findByPk($data['table_id']);
                    if(count($table)>0)
                    {
                        $table->occupied = $table->occupied + $data['seats_number'];
                        $table->save(false);
                    }
                }

				
            }
            if($result){
                $result = true;

                foreach($arrItems as $item){
                    $orderItem = new OrderItem();
                    $orderItem->oi_order_id = $model->order_id;
                    $orderItem->oi_id = StringUtils::generateGUID();
                    $orderItem->oi_dish_id = $item["json"]["id"];
                    $orderItem->oi_dish_price = $item["itemPrice"];
                    $orderItem->oi_topping_price = $item["itemOptionPrice"];
                    $orderItem->oi_instruction = $item["json"]["instruction"];
                    $orderItem->oi_toppings = $item["toppings"];
                    $orderItem->oi_cooking_method = $item["cookingMethod"];
                    $orderItem->oi_dish_quantity = intval($item["json"]["sl"]);
                    $orderItem->oi_is_panini = isset($item["json"]["panini"]) ? ((($item["json"]["panini"]) == "true") ? 1 : 0) : 0;

                    $result = $result && $orderItem->save();
                    if(!$result){
                        $dd[] =$orderItem->getErrors();
                    }
                }
                if($result){
                    $ts->commit();
					Order::model()->notifyStatus($model->order_id);
                    $bank_info = '';
                    $type = $data['payment_type']; // bank transfer/ paypal/ pay on delivery
                    if($type = 'bank transfer')
                    {
                        $bank_info =  Settings::model()->findByKey(Constants::SETTING_BANK_INFO)->setting_value;
                    }
                    ApiController::sendResponse(200, CJSON::encode(array(
                        'status' => Constants::SUCCESS,
                        'data' => '',
                        'orderId'=>$model->order_id,
                        'bankInfo'=>$bank_info,
                        'message' => 'OK',
                    )));
                }else{
                    $ts->rollBack();
                    ApiController::sendResponse(200, CJSON::encode(array(
                        'status' => Constants::ERROR,
                        'data' => $dd,
                        'message' => Yii::t('common', 'msg.notCreate')
                    )));
                }

            }else{
                $ts->rollBack();
                ApiController::sendResponse(200, CJSON::encode(array(
                    'status' => Constants::ERROR,
                    'data' => $model->getErrors(),
                    'message' => Yii::t('common', 'msg.notCreate')
                )));
            }
            // }

        }else{
            ApiController::sendResponse(400, CJSON::encode(array(
                'status' => Constants::ERROR,
                'data' => '',
                'message' => Yii::t('common', 'msg.badRequest')
            )));
        }
    }
}