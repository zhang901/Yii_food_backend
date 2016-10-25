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
                <h4 class="title"><?php echo Yii::t('common', 'label.topping'); ?></h4>
            </div>
            <div class="col-xs-6 text-right">
                <a class="btn btn-primary inline" href="<?php echo Yii::app()->createUrl('relish/create'); ?>"><?php echo Yii::t('common', 'btn.create'); ?></a>
            </div>
        </div>
        <hr class="line"/>
    </div>
</div>

<div class="row">
    <div class="col-xs-12">
        <?php $this->widget('zii.widgets.grid.CGridView', array(
            'id'=>'relish-grid',
            'dataProvider'=>$model->search(),
            'columns'=>array(
                array(
                    'header' => Yii::t("common", "label.name"),
                    'type' => 'raw',
                    'value' => function ($data) {
                        return $data->relish_name;
                    },
                    'headerHtmlOptions' => array(
                        'width' => '20%',
                        'class' => 'center'
                    ),
                    'htmlOptions' => array(
                        'class' => 'center'
                    ),

                ),
                array(
                    'header' => Yii::t("common", "label.price"),
                    'type' => 'raw',
                    'value' => function ($data) {
                        return $data->relish_price;
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
                    'header' => Yii::t("common", "label.desc"),
                    'type' => 'raw',
                    'value' => function ($data) {
                        return $data->relish_desc;
                    },
                    'headerHtmlOptions' => array(
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
                        return '<a data-toggle="tooltip" data-placement="top" data-original-title="'.Yii::t('common', 'label.update').'" href="'.Yii::app()->createUrl('relish/update', array('id'=>$data->relish_id)).'" class="glyphicon glyphicon-edit"></a>';
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
                        return '<a data-toggle="tooltip" data-placement="top" data-original-title="'.Yii::t('common', 'label.delete').'" href="'.Yii::app()->createUrl('relish/delete', array('id'=>$data->relish_id)).'" onclick="return confirm(\''.Yii::t('common', 'msg.confirmDelete').'\');" class="glyphicon glyphicon-trash"></a>';
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