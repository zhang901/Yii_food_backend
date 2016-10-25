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
                <h4 class="title"><?php echo Yii::t('common', 'title.listLanguage'); ?></h4>
            </div>
        </div>
        <hr class="line"/>
    </div>
</div>

<div class="row">
    <div class="col-xs-12">
        <?php $this->widget('zii.widgets.grid.CGridView', array(
            'id'=>'news-grid',
            'dataProvider'=>$model->search(),
            'columns'=>array(
                array(
                    'header' => '',
                    'type' => 'raw',
                    'value' => function ($data) {
                        return '<img class="image-tiny-thumb" src="'.Yii::app()->createUrl('site/image', array('id' => $data->language_id, 'f'=>$data->language_thumb, 't'=>Constants::TYPE_LANGUAGE)).'"/>';
                    },
                    'headerHtmlOptions' => array(
                        'width' => '1%',
                    ),

                ),
                array(
                    'header' => Yii::t("common", "label.languageName"),
                    'type' => 'raw',
                    'value' => function ($data) {
                        return $data->language_name;
                    },
                    'headerHtmlOptions' => array(
                    ),

                ),
                array(
                    'header' => Yii::t("common", "label.languageIsDefault"),
                    'type' => 'raw',
                    'value' => function ($data) {
                        if($data->language_is_default){
                            return '<i class="glyphicon glyphicon-ok"></i>';
                        }else{
                            return '';
                        }
                    },
                    'headerHtmlOptions' => array(
                        'width' => '5%',
                    ),

                ),
                array(
                    'header' => '',
                    'type' => 'raw',
                    'value' => function ($data) {
                        if($data->language_is_default){
                            return '';
                        }else{
                            return '<a data-toggle="tooltip" data-placement="top" data-original-title="'.Yii::t("common", "label.setDefault").'" href="'.Yii::app()->createUrl('language/default', array('id'=>$data->language_id)).'" class="glyphicon glyphicon-check"></a>';
                        }
                    },
                    'headerHtmlOptions' => array(
                        'width' => '5%',
                    ),

                ),
                array(
                    'header' => Yii::t('common', 'label.active'),
                    'type' => 'raw',
                    'value' => function ($data) {
                        if($data->language_status == Constants::STATUS_INACTIVE){
                            return '<a data-toggle="tooltip" data-placement="top" data-original-title="'.Yii::t('common', 'label.active').'" href="'.Yii::app()->createUrl('language/active', array('id'=>$data->language_id)).'" class="glyphicon glyphicon-ok-circle"></a>';
                        }
                        return '<i class="glyphicon glyphicon-ok"></i>';
                    },
                    'headerHtmlOptions' => array(
                        'width' => '5%',
                    ),
                ),
                array(
                    'header' => Yii::t('common', 'label.inActive'),
                    'type' => 'raw',
                    'value' => function ($data) {
                        if($data->language_status == Constants::STATUS_ACTIVE){
                            if($data->language_is_default){
                                return '';
                            }
                            return '<a data-toggle="tooltip" data-placement="top" data-original-title="'.Yii::t('common', 'label.inActive').'" href="'.Yii::app()->createUrl('language/inActive', array('id'=>$data->language_id)).'" class="glyphicon glyphicon-ban-circle"></a>';
                        }
                        return '<i class="glyphicon glyphicon-ok"></i>';
                    },
                    'headerHtmlOptions' => array(
                        'width' => '5%',
                    ),
                ),
            ),
            'itemsCssClass' => 'table table-striped table-hover data-table',
        )); ?>
    </div>
</div>