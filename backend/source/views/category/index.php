<?php
/**
 * Created by Lorge
 *
 * User: Only Love.
 * Date: 12/27/13 - 9:44 AM
 *
 * @var CActiveForm $form
 * @var MenuSearchForm $searchModel
 */
?>

<div class="row">
    <div class="col-xs-12">
        <?php echo $this->renderPartial("_searchForm", array('searchModel'=>$searchModel)); ?>
        <hr class="line"/>
    </div>
</div>

<div class="row">
    <div class="col-xs-12">
        <?php $this->widget('zii.widgets.grid.CGridView', array(
            'id'=>'menu-grid',
            'dataProvider'=>$model->search($searchModel),
            'columns'=>array(
                array(
                    'header' => Yii::t("common", "label.menuId"),
                    'type' => 'raw',
                    'value' => function ($data) {
                        //return '<div class="item-image"><img class="image-small-thumb" src="'.Yii::app()->createUrl('site/image', array('id' => $data->menu_id, 'f'=>$data->menu_thumb, 't'=>Constants::TYPE_MENU)).'"/></div>';
                            return '<div class="item-image"><img class="image-small-thumb" src="'.Yii::app()->request->baseUrl.'/uploads/menu/'.$data->menu_id.'/'.$data->menu_thumb.'"/></div>';
                        },
                    'headerHtmlOptions' => array(
                        'width' => '8%',
                        'class' => 'center'

                    ),
                   // 'visible'=>false,
                    'htmlOptions' => array(
                        'class' => 'center'
                    ),
                ),
                array(
                    'header' => Yii::t("common", "label.menuName"),
                    'type' => 'raw',
                    'value' => function ($data) {
                        if(isset($data->menu_language)){
                            return $data->menu_language->menu_name;
                        }
                        return '';
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
                    'header' => Yii::t("common", "label.menuDesc"),
                    'type' => 'raw',
                    'value' => function ($data) {
                        if(isset($data->menu_language)){
                            return StringUtils::subString($data->menu_language->menu_desc, 300, true, true);
                        }
                        return '';
                    },
                    'headerHtmlOptions' => array(
                        'class' => 'center'
                    ),
                    'htmlOptions' => array(
                        'class' => 'center'
                    ),

                ),
//                array(
//                    'header' => Yii::t("common", "label.panini"),
//                    'type' => 'raw',
//                    'value' => function ($data) {
//                        echo $data->menu_is_panini ? '<i class="glyphicon glyphicon-ok"></i>': '';
//                    },
//                    'headerHtmlOptions' => array(
//                        'width' => '5%',
//                        'class' => 'center'
//                    ),
//                    'htmlOptions' => array(
//                        'class' => 'center'
//                    ),
//                ),
                array(
                    'header' => Yii::t("common", "label.relates"),
                    'type' => 'raw',
                    'value' => function ($data) {
                        $c = count($data->dish);
                        if($c){
                            return '<label class="label label-success">'.$c.'</label>';
                        }
                        return '<label class="label label-default">'.$c.'</label>';
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
                    'header' => Yii::t("common", "label.orderNumber"),
                    'type' => 'raw',
                    'value' => function ($data) {
                            if(isset($data->order_number)){
                                return $data->order_number;
                            }
                            return 0;
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
                        return '<a data-toggle="tooltip" data-placement="top" data-original-title="'.Yii::t('common', 'label.update').'" href="'.Yii::app()->createUrl('category/update', array('id'=>$data->menu_id)).'" class="glyphicon glyphicon-edit"></a>';
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
                        $c = count($data->dish);
                        if($c){
                            return '<a data-toggle="tooltip" data-placement="top" data-original-title="'.Yii::t('common', 'msg.pleaseRemoveRelate').'" href="javascript:;" class="glyphicon glyphicon-ban-circle"></a>';
                        }
                        return '<a data-toggle="tooltip" data-placement="top" data-original-title="'.Yii::t('common', 'label.delete').'" href="'.Yii::app()->createUrl('category/delete', array('id'=>$data->menu_id)).'" onclick="return confirm(\''.Yii::t('common', 'msg.confirmDelete').'\');" class="glyphicon glyphicon-trash"></a>';
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