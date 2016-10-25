<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Giang
 * Date: 3/5/14
 * Time: 2:18 PM
 * To change this template use File | Settings | File Templates.
 */

class ShowFoodByMenuAction extends CAction{
    public function run(){

        $keyword = isset($_REQUEST['keyword']) ? $_REQUEST['keyword'] : '';
        $menu_id = isset($_REQUEST['menu_id']) ? $_REQUEST['menu_id'] : '';
        $page = isset($_REQUEST['page']) ? $_REQUEST['page'] : '1';
        $rows_per_page = 10;
        $result = array();


        $start_index= ($page-1)*$rows_per_page;
        $criteria = new CDbCriteria();
        if(strlen($keyword)!=0)
            $criteria->addCondition("dish_name LIKE '%".$keyword."%'");
		if(strlen($menu_id)!=0)
            $criteria->addCondition('dish_menu ="'.$menu_id.'"');
        $count = count(Dish::model()->findAll($criteria));
        $criteria->order = "order_number DESC,dish_name ASC";
        $criteria->limit= $rows_per_page;
        $criteria->offset= $start_index;
        $products = Dish::model()->findAll($criteria);
        if(count($products)>0)
        {
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

            ApiController::sendResponse(200, CJSON::encode(array(
                'status' => Constants::SUCCESS,
                'data' => $result,
                'numpages'=>ceil($count/$rows_per_page),
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