<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Giang
 * Date: 3/5/14
 * Time: 2:18 PM
 * To change this template use File | Settings | File Templates.
 */

class MenuAction extends CAction{
    public function run(){
        $result = array();
		$criteria = new CDbCriteria();        
        $criteria->order = "t.order_number desc, t.menu_name asc";
        $menus = Menus::model()->with('relishes', 'methods')->findAll($criteria);
        /** @var Menus $menu */
        foreach($menus as $menu){
            $relishes = array();
            foreach($menu->relishes as $item){
                $arr = array();
                $arr["relish_id"] = $item->relish_id;
                $arr["relish_name"] = $item->relish_name;
                $arr["relish_price"] = $item->relish_price;
                $toppingOptions = CookingMethod::model()->findAllByToppingId($item->relish_id);
                $options = array();
                foreach($toppingOptions as $opt){
                    $subArr = array();
                    $subArr["method_id"] = $opt->cm_id;
                    $subArr["method_name"] = $opt->cm_name;
                    $options[] = $subArr;
                }
                $arr["relish_options"] = $options;
                $relishes[] = $arr;
            }
            $methods = array();
            foreach($menu->methods as $item){
                $arr = array();
                $arr["method_id"] = $item->cm_id;
                $arr["method_name"] = $item->cm_name;
                $subMethods = CookingMethod::model()->findAllByParentId($item->cm_id, Constants::TYPE_MENU);
                $options = array();
                foreach($subMethods as $subItem){
                    $subArr = array();
                    $subArr["method_id"] = $subItem->cm_id;
                    $subArr["method_name"] = $subItem->cm_name;
                    $options[] = $subArr;
                }
                $arr["method_sub"] = $options;
                $methods[] = $arr;
            }
            $result["menus"][] = array(
                'id' => $menu->menu_id,
                'name' => $menu->menu_name,
                'relishes'=>$relishes,
                'cooking_methods'=>$methods,
                'panini' => $menu->menu_is_panini ? true : false,
            );
        }

        $products = Dish::model()->findAll();
        foreach($products as $product){
            $result["foods"][] = array(
                'id' => $product->dish_id,
                'name' => $product->dish_name,
                'desc' => $product->dish_desc,
                'thumb'=>SITEURL.Yii::app()->createUrl('site/image', array('id'=>$product->dish_id,'f'=>$product->dish_thumb,'t'=>Constants::TYPE_PRODUCT)),
                'small_thumb'=>SITEURL.Yii::app()->createUrl('site/image', array('id'=>$product->dish_id,'f'=>$product->dish_small_thumb,'t'=>Constants::TYPE_PRODUCT)),
                'price' => $product->dish_price,
                'promotion' => $product->dish_promotion,
                'promotion_desc' => '',
                'urls_image' => $product->dish_urls_image,
                'urls_video' => $product->dish_urls_video,
                'menu' => $product->dish_menu,
            );
        }
        if(count($result) > 0){
            ApiController::sendResponse(200, CJSON::encode(array(
                'status' => Constants::SUCCESS,
                'data' => $result,
                'message' => '',
            )));
        }else{
            ApiController::sendResponse(200, CJSON::encode(array(
                'status' => Constants::ERROR,
                'data' => '',
                'message' => Yii::t('common', 'msg.notFound'),
            )));
        }
    }
}