<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Giang
 * Date: 3/5/14
 * Time: 2:18 PM
 * To change this template use File | Settings | File Templates.
 */

class PromotionAction extends CAction{
    public function run(){

       // $id = isset($_REQUEST['id']) ? $_REQUEST['id'] : '1';
        $page = isset($_REQUEST['page']) ? $_REQUEST['page'] : '';

        $data= array();

        $rows_per_page = 10;
        $start_index= ($page-1)*$rows_per_page;

        $promotion = Promotion::model()->findAll('status = 1');
        $allpage = ceil(count($promotion)/$rows_per_page);

        $criteria = new CDbCriteria();
        $criteria->order = 'order_number DESC,title ASC';
        $criteria->compare('status',1);
        $criteria->limit= $rows_per_page;
        $criteria->offset= $start_index;

        $promotion = Promotion::model()->findAll($criteria);
        if(count($promotion)>0)
        {
            foreach($promotion as $item)
            {
                $path = Yii::app()->getbaseUrl(true);
                if(strlen($item->image) >0)
                {
                    $image = $path.'/uploads/promotion/'.$item->id.'/'.$item->image;
                }
                else
                    $image = $path.'/upload/noImage.jpg';

                $cate = Menus::model()->findByPk($item->categoryId);
                if(count($cate)>0)
                    $cateName = $cate->menu_name;
                else
                    $cateName = '';

                $data[] = array(
                    'id'=>$item->id,
                    'image'=>$image,
                    'categoryId'=>isset($item->categoryId) ? $item->categoryId : 'Updating',
                    'categoryName'=>$cateName,
                    'title'=>isset($item->title) ? $item->title : '',
                    'description'=>isset($item->description) ? $item->description : '',
                    'startDate'=>isset($item->startDate) ? strtotime($item->startDate)*1000 : '',
                    'endDate'=> isset($item->endDate) ? strtotime($item->endDate)*1000 : '',
                    'status'=> $item->status,
                    'dateCreated'=> strtotime($item->dateCreated)*1000
                );
            }

            ApiController::sendResponse(200, CJSON::encode(array(
                'status' => Constants::SUCCESS,
                'data' => $data,
                'numpage'=> $allpage,
                'message' => 'OK',
            )));
        }
        else
            ApiController::sendResponse(200, CJSON::encode(array(
                'status' => Constants::ERROR,
                'data' => '',
                'message' => Yii::t('common', 'msg.notFound'),
            )));






    }
}