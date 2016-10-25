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
            'id'=>'account-grid',
            'dataProvider'=>$model->search($searchModel),
            'columns'=>array(

                array(
                    'header' => Yii::t("common", "label.user_name"),
                    'type' => 'raw',
                    'value' => function ($data) {
                            if(isset($data->username)){
                                return $data->username;
                            }
                            return '';
                        },
                    'headerHtmlOptions' => array(
                        'width' => '10%',
                    ),

                ),
                array(
                    'header' => Yii::t("common", "label.email"),
                    'type' => 'raw',
                    'value' => function ($data) {
                            if(isset($data->email)){
                                return $data->email;
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
                    'header' => Yii::t("common", "label.full_name"),
                    'type' => 'raw',
                    'value' => function ($data) {
                           return $data->full_name;
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
                    'header' => Yii::t("common", "label.phone"),
                    'type' => 'raw',
                    'value' => function ($data) {
                            return $data->phone;
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
                    'header' => Yii::t("common", "label.address"),
                    'type' => 'raw',
                    'value' => function ($data) {
                            return $data->address;
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
                    'header' => Yii::t("common", "label.role"),
                    'type' => 'raw',
                    'value' => function ($data) {
                            if( $data->role == 1)
                               return 'Delivery Man';
                            elseif($data->role == 2)
                                return 'Chef';
							elseif($data->role == 4)
								return 'Waiter';
                            else
                                return 'User';
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
                            return '<a data-toggle="tooltip" data-placement="top" data-original-title="'.Yii::t('common', 'label.update').'" href="'.Yii::app()->createUrl('account/update', array('id'=>$data->id)).'" class="glyphicon glyphicon-edit"></a>'.
                             '<a style="margin-left:10px" data-toggle="tooltip" data-placement="top" data-original-title="'.Yii::t('common', 'label.delete').'" href="'.Yii::app()->createUrl('account/delete', array('id'=>$data->id)).'" onclick="return confirm(\''.Yii::t('common', 'msg.confirmDelete').'\');" class="glyphicon glyphicon-trash"></a>';
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