<?php
/**
 * User: Only Love.
 * Date: 12/27/13 - 9:44 AM
 */
?>
<div class="form">
    <?php $form = $this->beginWidget('CActiveForm', array(
        'id'=>'createRelish-form',
        'method' => 'POST',
        'enableClientValidation'=>true,
        'clientOptions'=>array(
            'validateOnSubmit'=>true,
        ),
        'htmlOptions' => array(
            'class' => 'panel-body',
            'enctype' => 'multipart/form-data',
            'role' => 'form',
        ),
    )); ?>
    <?php if (Yii::app()->user->hasFlash('_error_')): ?>
        <div class="form-group">
            <div class="alert alert-danger">
                <button data-dismiss="alert" class="close"></button>
                <?php echo Yii::app()->user->getFlash('_error_'); ?>
            </div>
        </div>
    <?php endif; ?>
    <div class="form-group">
        <?php echo $form->label($model, Yii::t('common', 'label.relishName'), array('class'=>'control-label')); ?>
        <?php echo $form->textField($model,'relishName', array(
            'type'=>'text',
            'size'=>40,
            'class'=>'form-control',
        )); ?>
        <?php echo $form->error($model,'relishName'); ?>
    </div>
    <div class="form-group">
        <?php echo $form->label($model, Yii::t('common', 'label.relishDesc'), array('class'=>'control-label')); ?>
        <?php echo $form->textArea($model, 'relishDesc', array(
            'rows'=>6,
            'class'=>'form-control',
        ));?>
        <?php echo $form->error($model,'relishDesc'); ?><br/>
    </div>
    <div class="form-group">
        <?php echo $form->label($model, Yii::t('common', 'label.relishPrice'), array('class'=>'control-label')); ?>
        <?php echo $form->textField($model,'relishPrice', array(
            'type'=>'text',
            'size'=>40,
            'class'=>'form-control',
        )); ?>
        <?php echo $form->error($model,'relishPrice'); ?>
    </div>

    <div class="form-group">
        <?php echo $form->label($model, Yii::t('common', 'label.orderNumber'), array('class'=>'control-label')); ?>
        <?php echo $form->textField($model,'relishOrderNumber', array(
            'type'=>'text',
            'size'=>20,
            'class'=>'form-control',
        )); ?>
        <?php echo $form->error($model,'relishOrderNumber'); ?>
    </div>

    <div class="form-group">
        <?php echo $form->label($model, Yii::t('common', 'label.options'), array('class'=>'form-label')); ?>
        <?php
        echo Select2::activeMultiSelect($model, "options", CookingMethod::model()->findIn($model->options, Constants::TYPE_TOPPING), array(
            'placeholder' => Yii::t('common', 'label.options'),
            'select2Options' => array(
                'multiple' => true,
                'allowClear' => true,
                'width' => '100%',
                'minimumInputLength' => 0,
                'ajax' => array(
                    'url' => Yii::app()->createUrl('toppingOption/list'),
                    'dataType' => 'jsonp',
                    'data' => 'js: function(term,page) {
                        return {
                            q: term,
                            page_limit: 10
                        };
                    }',
                    'results' => 'js: function(data,page){
                        return {results: data};
                    }',
                ),
                'formatResult' => 'js:function(data){
                    return data.name;
                }',
                'formatSelection' => 'js: function(data) {
                    return data.name;
                }',
            ),
        )); ?>
    </div>
    <div style="float: left">
        <?php echo CHtml::button(Yii::t('common', 'btn.update'), array(
            'type' => 'submit',
            'class '=> 'btn btn-primary'
        )); ?>
    </div>
    <?php $this->endWidget(); ?>
</div>