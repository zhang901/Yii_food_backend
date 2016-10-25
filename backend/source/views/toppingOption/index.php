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
                <h4 class="title"><?php echo Yii::t('common', 'title.toppingOptions'); ?></h4>
            </div>
            <div class="col-xs-6 text-right">
                <a class="btn btn-primary inline" href="<?php echo Yii::app()->createUrl('toppingOption/create'); ?>"><?php echo Yii::t('common', 'btn.create'); ?></a>
            </div>
        </div>
        <hr class="line"/>
    </div>
</div>

<div class="row">
    <div class="col-xs-12">
        <?php $this->widget('zii.widgets.grid.CGridView', array(
            'id'=>'news-grid',
            'dataProvider'=>$model->with('parent', 'toppings')->search(),
            'columns'=>array(
                array(
                    'header' => Yii::t("common", "label.cookingMethodName"),
                    'type' => 'raw',
                    'value' => function ($data) {
                        return $data->cm_name;
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
                    'header' => Yii::t("common", "label.cookingMethodDesc"),
                    'type' => 'raw',
                    'value' => function ($data) {
                        return $data->cm_desc;
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
                    'header' => Yii::t("common", "label.relates"),
                    'type' => 'raw',
                    'value' => function ($data) {
                        $c = count($data->toppings);
                        if($c){
                            return '<label class="label label-success">'.$c.'</label>';
                        }
                        return '<label class="label label-default">'.$c.'</label>';
                    },
                    'headerHtmlOptions' => array(
                        'width' => '5%',
                        'style' => 'text-align: center; vertical-align: middle;'
                    ),
                    'htmlOptions' => array(
                        'style' => 'text-align: center; vertical-align: middle;'
                    ),

                ),
                array(
                    'header' => Yii::t('common', 'label.update'),
                    'type' => 'raw',
                    'value' => function ($data) {
                        return '<a data-toggle="tooltip" data-placement="top" data-original-title="'.Yii::t('common', 'label.update').'" href="'.Yii::app()->createUrl('toppingOption/update', array('id'=>$data->cm_id)).'" class="glyphicon glyphicon-edit"></a>';
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
                        $c = count($data->toppings);
                        if($c){
                            return '<a data-toggle="tooltip" data-placement="top" data-original-title="'.Yii::t('common', 'msg.pleaseRemoveRelate').'" href="javascript:;" class="glyphicon glyphicon-ban-circle"></a>';
                        }
                        return '<a data-toggle="tooltip" data-placement="top" data-original-title="'.Yii::t('common', 'label.delete').'" href="'.Yii::app()->createUrl('toppingOption/delete', array('id'=>$data->cm_id)).'" onclick="return confirm(\''.Yii::t('common', 'msg.confirmDelete').'\');" class="glyphicon glyphicon-trash"></a>';
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