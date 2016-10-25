<?php
/**
 * Created by Lorge
 *
 * User: Only Love.
 * Date: 12/17/13 - 1:25 AM
 */

/** @var CDataProvider $dataProvider */
$dataProvider = $model->search($searchModel);
?>

<div class="row">
    <div class="col-xs-12">
        <?php echo $this->renderPartial("_searchForm", array('searchModel'=>$searchModel, 'menus' => $menus)); ?>
        <hr class="line"/>
    </div>
</div>

<div class="row">
    <div class="col-xs-12">
        <?php $this->widget('zii.widgets.grid.CGridView', array(
            'id'=>'dish-grid',
            'dataProvider'=>$dataProvider,
            'columns'=>array(
                array(
                    'header' => Yii::t('common', 'label.dishSmallThumb'),
                    'type' => 'raw',
                    'value' => function ($data) {
                        //return '<div class="item-image"><img class="image-small-thumb" src="'.Yii::app()->createUrl('site/image', array('id' => $data->dish_id, 'f'=>$data->dish_small_thumb, 't'=>Constants::TYPE_PRODUCT)).'"/></div>';
                        return '<div class="item-image"><img class="image-small-thumb" src="'.Yii::app()->request->baseUrl.'/uploads/products/'.$data->dish_id.'/'.$data->dish_small_thumb.'"/></div>';
                    },
                    'headerHtmlOptions' => array(
                        'width' => '8%',
                        'class' => 'center'
                    ),
                    'htmlOptions' => array(
                        'class' => 'center'
                    ),
                ),
                array(
                    'header' => Yii::t("common", "label.dishName"),
                    'type' => 'raw',
                    'value' => function ($data) {
                        if(isset($data->dish_language)){
                            return $data->dish_language->dish_name;
                        }else{
                            return '';
                        }
                    },
                    'headerHtmlOptions' => array(
                        'width' => '10%',
                        'class' => 'center'
                    ),
                    'htmlOptions' => array(
                        'class' => 'center'
                    ),

                ),
                array(
                    'header' => Yii::t("common", "label.dishPrice"),
                    'type' => 'raw',
                    'value' => function ($data) {
                        return $data->dish_price;
                    },
                    'headerHtmlOptions' => array(
                        'width' => '10%',
                        'class' => 'center'
                    ),
                    'htmlOptions' => array(
                        'class' => 'center'
                    ),

                ),
                array(
                    'header' => Yii::t("common", "label.dishMenu"),
                    'type' => 'raw',
                    'value' => function ($data) {
                        $menus = Menus::model()->findByPk($data->dish_menu);
                        if($menus != null){
                            return $menus->menu_name;
                        }else{
                            return Yii::t('common', 'label.noArticle');
                        }
                    },
                    'headerHtmlOptions' => array(
                        'width' => '10%',
                        'class' => 'center'
                    ),
                    'htmlOptions' => array(
                        'class' => 'center'

                    ),

                ),
                array(
                    'header' => Yii::t("common", "label.dishDesc"),
                    'type' => 'raw',
                    'value' => function ($data) {
                        if(isset($data->dish_language)){
                            return $data->dish_language->dish_desc;
                        }else{
                            return '';
                        }
                    },
                    'headerHtmlOptions' => array(
                        'width' => '50%',
                        'class' => 'center'
                    ),
                    'htmlOptions' => array(
                        'class' => 'center'
                    ),

                ),
                array(
                    'header' => Yii::t("common", "label.orderNumber"),
                    'type' => 'raw',
                    'value' => function ($data) {
                            if(isset($data->order_number)){
                                return $data->order_number;
                            }else{
                                return 0;
                            }
                        },
                    'headerHtmlOptions' => array(
                        'width' => '20px',
                        'class' => 'center'
                    ),
                    'htmlOptions' => array(
                        'class' => 'center'
                    ),

                ),
                array(
                    'header' => Yii::t('common', 'label.update'),
                    'type' => 'raw',
                    'value' => function ($data) {
                        return '<a data-toggle="tooltip" data-placement="top" data-original-title="'.Yii::t('common', 'label.update').'" href="'.Yii::app()->createUrl('dish/update', array('id'=>$data->dish_id)).'" class="glyphicon glyphicon-edit"></a>';
                    },
                    'headerHtmlOptions' => array(
                        'width' => '5%',
                        'class' => 'center'
                    ),
                    'htmlOptions' => array(
                        'class' => 'center'
                    ),
                ),
                array(
                    'header' => Yii::t('common', 'label.delete'),
                    'type' => 'raw',
                    'value' => function ($data) {
                        return '<a data-toggle="tooltip" data-placement="top" data-original-title="'.Yii::t('common', 'label.delete').'" href="'.Yii::app()->createUrl('dish/delete', array('id'=>$data->dish_id)).'" onclick="return confirm(\''.Yii::t('common', 'msg.confirmDelete').'\');" class="glyphicon glyphicon-trash"></a>';
                    },
                    'headerHtmlOptions' => array(
                        'width' => '5%',
                        'class' => 'center'
                    ),
                    'htmlOptions' => array(
                        'class' => 'center'
                    ),
                ),
            ),
            'itemsCssClass' => 'table table-bordered table-striped table-hover data-table',
        )); ?>
    </div>
</div>