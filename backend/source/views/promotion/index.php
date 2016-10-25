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
            'id'=>'promotion-grid',
            'dataProvider'=>$model->search($searchModel),
            'columns'=>array(
                array(
                    'header' => 'Thumb',
                    'type' => 'raw',
                    'value' => function ($data) {
//                            return '<div class="item-image"><img class="image-small-thumb" src="'.Yii::app()->createUrl('site/image', array('id' => $data->id, 'f'=>$data->image, 't'=>Constants::TYPE_PROMOTION)).'"/></div>';
                            return '<div class="item-image"><img class="image-small-thumb" src="'.Yii::app()->request->baseUrl.'/uploads/promotion/'.$data->id.'/'.$data->image.'"/></div>';
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
                    'header' => Yii::t("common", "label.categoryId"),
                    'type' => 'raw',
                    'value' => function ($data) {
                            if(isset($data->categoryId)){
                                $id= $data->categoryId;
                                $cate= Menus::model()->findByPk($id);
                                if(count($cate)>0)
                                    return $cate->menu_name;
                                else
                                    return '';
                            }
                            return '';
                        },
                    'headerHtmlOptions' => array(
                        'width' => '10%',
                    ),

                ),
                array(
                    'header' => Yii::t("common", "label.title"),
                    'type' => 'raw',
                    'value' => function ($data) {
                            if(isset($data->title)){
                                return $data->title;
                            }
                            return '';
                        },
                    'headerHtmlOptions' => array(
                        'width' => '10%',
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
                    'header' => Yii::t("common", "label.description"),
                    'type' => 'raw',
                    'value' => function ($data) {
                            return $data->description;
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
                    'header' => Yii::t("common", "label.startDate"),
                    'type' => 'raw',
                    'value' => function ($data) {
                            return $data->startDate;
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
                    'header' => Yii::t("common", "label.endDate"),
                    'type' => 'raw',
                    'value' => function ($data) {
                            return $data->endDate;
                        },
                    'headerHtmlOptions' => array(
                        'width' => '15%',
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
                            return $data->order_number;
                        },
                    'headerHtmlOptions' => array(
                        'width' => '5%',
                       'class' => 'center'
                    ),
                    'htmlOptions' => array(
                        'class' => 'center',
                    ),

                ),
                array(
                    'header' => Yii::t("common", "label.status"),
                    'type' => 'raw',
                    'value' => function ($data) {
                            if($data->status == 1)
                                return 'Active';
                            else
                                return 'Inactive';
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
                    'header' => Yii::t("common", "label.dateCreated"),
                    'type' => 'raw',
                    'value' => function ($data) {
                                return $data->dateCreated;
                        },
                    'headerHtmlOptions' => array(
                        'width' => '10%',
                        'class' => 'center'
                    ),
                    'htmlOptions' => array(
                        'class' => 'center'
                    ),

                ),
                /*array(
                    'header' => Yii::t('common', 'label.update'),
                    'type' => 'raw',
                    'value' => function ($data) {
                            return '<a data-toggle="tooltip" data-placement="top" data-original-title="'.Yii::t('common', 'label.update').'" href="'.Yii::app()->createUrl('account/update', array('id'=>$data->id)).'" class="glyphicon glyphicon-edit"></a>';
                        },
                    'headerHtmlOptions' => array(
                        'width' => '5%',
                        'class' => 'center'
                    ),
                    'htmlOptions' => array(
                        'class' => 'center'
                    ),
                ),*/
                array(
                    //'header' => Yii::t('common', 'label.delete'),
                    'type' => 'raw',
                    'value' => function ($data) {
                            return '<a data-toggle="tooltip" data-placement="top" data-original-title="'.Yii::t('common', 'label.update').'" href="'.Yii::app()->createUrl('promotion/update', array('id'=>$data->id)).'" class="glyphicon glyphicon-edit"></a>'.
                            '<a style="margin-left:10px" data-toggle="tooltip" data-placement="top" data-original-title="'.Yii::t('common', 'label.delete').'" href="'.Yii::app()->createUrl('promotion/delete', array('id'=>$data->id)).'" onclick="return confirm(\''.Yii::t('common', 'msg.confirmDelete').'\');" class="glyphicon glyphicon-trash"></a>';
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