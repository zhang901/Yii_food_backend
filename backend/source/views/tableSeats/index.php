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
        <?php echo $this->renderPartial("_searchForm"/*, array('searchModel'=>$searchModel)*/); ?>
        <hr class="line"/>
    </div>
</div>

<div class="row">
    <div class="col-xs-12">
        <?php $this->widget('zii.widgets.grid.CGridView', array(
            'id'=>'account-grid',
            'dataProvider'=>$model->search(),
            'columns'=>array(

                array(
                    'header' => 'Title',
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
                array(
                    'header' => 'Capacity',
                    'type' => 'raw',
                    'value' => function ($data) {
                            if(isset($data->capacity)){
                                return $data->capacity;
                            }
                            return '';
                        },
                    'headerHtmlOptions' => array(
                        'width' => '10%',
                    ),

                ),
                array(
                    'header' => 'Occupied',
                    'type' => 'raw',
                    'value' => function ($data) {
                            if(isset($data->occupied)){
                                return $data->occupied;
                            }
                            return '';
                        },
                    'headerHtmlOptions' => array(
                        'width' => '10%',
                    ),

                ),
                array(
                    'header' => 'Order Number',
                    'type' => 'raw',
                    'value' => function ($data) {
                            if(isset($data->order_number)){
                                return $data->order_number;
                            }
                            return '';
                        },
                    'headerHtmlOptions' => array(
                        'width' => '10%',
                    ),

                ),
                array(
                    'header' => 'Status',
                    'type' => 'raw',
                    'value' => function ($data) {
                            if(isset($data->status)){
                                return $data->status;
                            }
                            return '';
                        },
                    'headerHtmlOptions' => array(
                        'width' => '10%',
                    ),

                ),
                array(
                    //'header' => Yii::t('common', 'label.delete'),
                    'type' => 'raw',
                    'value' => function ($data) {
                            return '<a data-toggle="tooltip" data-placement="top" data-original-title="'.Yii::t('common', 'label.update').'" href="'.Yii::app()->createUrl('tableSeats/update', array('id'=>$data->id)).'" class="glyphicon glyphicon-edit"></a>'.
                            '<a style="margin-left:10px" data-toggle="tooltip" data-placement="top" data-original-title="'.Yii::t('common', 'label.delete').'" href="'.Yii::app()->createUrl('tableSeats/delete', array('id'=>$data->id)).'" onclick="return confirm(\''.Yii::t('common', 'msg.confirmDelete').'\');" class="glyphicon glyphicon-trash"></a>';
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