<?php
/**
 * Created by Lorge
 *
 * User: Only Love.
 * Date: 12/27/13 - 9:44 AM
 */
?>

<div class="row">
    <div class="col-xs-12">
        <div class="row">
            <div class="col-xs-6">
                <h4 class="title"><?php echo 'My Orders'; ?></h4>
            </div>
            <div class="col-xs-6 text-right">
            </div>
        </div>
        <hr class="line"/>
    </div>
</div>

<div class="row">
    <div class="col-xs-12">
        <?php $this->widget('zii.widgets.grid.CGridView', array(
            'id'=>'order-grid',
            'dataProvider'=>$model->myOrders(),
            'columns'=>array(
                'order_id',
                array(
                    'header' => Yii::t("common", "label.orderName"),
                    'type' => 'raw',
                    'value' => function ($data) {
                        return $data->order_name;
                    },
                    'headerHtmlOptions' => array(
                    ),

                ),
                array(
                    'header' => 'Address',
                    'type' => 'raw',
                    'value' => function ($data) {
                            return $data->order_address;
                        },
                    'headerHtmlOptions' => array(
                        'width' => '10%',
                    ),

                ),
                array(
                    'header' => Yii::t("common", "label.orderTel"),
                    'type' => 'raw',
                    'value' => function ($data) {
                        return $data->order_tel;
                    },
                    'headerHtmlOptions' => array(
                        'width' => '10%',
                    ),

                ),
                array(
                    'header' => Yii::t("common", "label.orderPrice"),
                    'type' => 'raw',
                    'value' => function ($data) {
                        return $data->order_price;
                    },
                    'headerHtmlOptions' => array(
                        'width' => '10%',
                    ),

                ),
                array(
                    'header' => Yii::t("common", "label.orderTime"),
                    'type' => 'raw',
                    'value' => function ($data) {
                        return $data->created;
                    },
                    'headerHtmlOptions' => array(
                        'width' => '10%',
                    ),

                ),
                array(
                    'header' => Yii::t("common", "label.orderStatus"),
                    'type' => 'raw',
                    'value' => function ($data) {
                            //return $data->order_status;
                        if($data->order_status == Constants::STATUS_CREATED){
                            return "<label class='label label-danger'>Created</label>".
                            '<a style="margin-left:10px;" data-toggle="tooltip" data-placement="top" data-original-title="'.Yii::t('common', 'label.update').'" href="'.Yii::app()->createUrl('order/update', array('id'=>$data->order_id)).'" class="glyphicon glyphicon-edit"></a>';
                        }

                        elseif($data->order_status == Constants::STATUS_REJECT){
                            return "<label class='label label-warning'>Reject</label>".
                            '<a style="margin-left:10px;" data-toggle="tooltip" data-placement="top" data-original-title="'.Yii::t('common', 'label.update').'" href="'.Yii::app()->createUrl('order/update', array('id'=>$data->order_id)).'" class="glyphicon glyphicon-edit"></a>';

                        }

                        elseif($data->order_status == Constants::STATUS_IN_PROCESS){
                            return "<label class='label label-default'>In Process</label>".
                            '<a style="margin-left:10px;" data-toggle="tooltip" data-placement="top" data-original-title="'.Yii::t('common', 'label.update').'" href="'.Yii::app()->createUrl('order/update', array('id'=>$data->order_id)).'" class="glyphicon glyphicon-edit"></a>';

                        }

                        elseif($data->order_status == Constants::STATUS_READY){
                            return "<label class='label label-default'>Ready</label>".
                            '<a style="margin-left:10px;" data-toggle="tooltip" data-placement="top" data-original-title="'.Yii::t('common', 'label.update').'" href="'.Yii::app()->createUrl('order/update', array('id'=>$data->order_id)).'" class="glyphicon glyphicon-edit"></a>';

                        }

                        elseif($data->order_status == Constants::STATUS_PENDING){
                            return "<label class='label label-default'>Pending</label>".
                            '<a style="margin-left:10px;" data-toggle="tooltip" data-placement="top" data-original-title="'.Yii::t('common', 'label.update').'" href="'.Yii::app()->createUrl('order/update', array('id'=>$data->order_id)).'" class="glyphicon glyphicon-edit"></a>';

                        }

                        elseif($data->order_status == Constants::STATUS_DELIVERED){
                            return "<label class='label label-warning'>Delivered</label>".
                            '<a style="margin-left:10px;" data-toggle="tooltip" data-placement="top" data-original-title="'.Yii::t('common', 'label.update').'" href="'.Yii::app()->createUrl('order/update', array('id'=>$data->order_id)).'" class="glyphicon glyphicon-edit"></a>';

                        }

                        else
                            return "<label class='label label-danger'>Fail</label>".
                            '<a style="margin-left:10px;" data-toggle="tooltip" data-placement="top" data-original-title="'.Yii::t('common', 'label.update').'" href="'.Yii::app()->createUrl('order/update', array('id'=>$data->order_id)).'" class="glyphicon glyphicon-edit"></a>';

                            //}
                    },
                    'headerHtmlOptions' => array(
                        'width' => '10%',
                    ),

                ),

                array(
                    'header' => Yii::t('common', 'label.detail'),
                    'type' => 'raw',
                    'value' => function ($data) {
                        return '<a data-toggle="tooltip" data-placement="top" data-original-title="'.Yii::t('common', 'label.detail').'" href="'.Yii::app()->createUrl('order/view', array('id'=>$data->order_id)).'" class="glyphicon glyphicon-eye-open"></a>';
                    },
                    'headerHtmlOptions' => array(
                        'width' => '5%',
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
                            return '<a data-toggle="tooltip" data-placement="top" data-original-title="'.Yii::t('common', 'label.update').'" href="'.Yii::app()->createUrl('order/update', array('id'=>$data->order_id)).'" class="glyphicon glyphicon-edit"></a>';
                        },
                    'headerHtmlOptions' => array(
                        'width' => '5%',
                        'class' => 'center'
                    ),
                    'htmlOptions' => array(
                        'class' => 'center'
                    ),
                ),*/
                /*array(
                    'header' => Yii::t('common', 'label.delete'),
                    'type' => 'raw',
                    'value' => function ($data) {
                        return '<a data-toggle="tooltip" data-placement="top" data-original-title="'.Yii::t('common', 'label.delete').'" href="'.Yii::app()->createUrl('order/delete', array('id'=>$data->order_id)).'" onclick="return confirm(\''.Yii::t('common', 'msg.confirmDelete').'\');" class="glyphicon glyphicon-trash"></a>';
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
                    'header' => 'Cancel',
                    'type' => 'raw',
                    'value' => function ($data) {
                            if(Yii::app()->user->role == 3)
                            {
                                return '<a data-toggle="tooltip" data-placement="top" data-original-title="'.'Cancel'.'" href="'.Yii::app()->createUrl('order/cancel', array('id'=>$data->order_id)).'"  class="glyphicon glyphicon-remove"></a>';
                            }
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
<?php
Yii::app()->clientScript->registerScript('order_refresh', "
    var tm = setInterval(function(){
        $('#order-grid').yiiGridView('update', {});
    }, 5000);
");
?>