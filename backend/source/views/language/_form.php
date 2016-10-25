<?php
/**
 * Created by Lorge
 *
 * User: Only Love.
 * Date: 12/18/13 - 11:50 PM
 */
?>
<div class="form">
    <?php $form = $this->beginWidget('CActiveForm', array(
        'id'=>'createBanner-form',
        'method' => 'POST',
        'enableClientValidation'=>true,
        'clientOptions'=>array(
            'validateOnSubmit'=>true,
        ),
        'htmlOptions' => array(
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
        <?php echo $form->label($model, Yii::t('common', 'label.languageName'), array('class'=>'control-label')); ?>
        <?php echo $form->textField($model,'languageName', array(
            'type'=>'text',
            'size'=>40,
            'class'=>'form-control',
        )); ?>
        <?php echo $form->error($model,'languageName'); ?>
        <div class="space"></div>
    </div>
    <div class="form-group">
        <?php echo $form->label($model, Yii::t('common', 'label.languageIsDefault'), array('class'=>'control-label')); ?>
        <?php echo $form->checkBox($model,'languageIsDefault', array(
            'class'=>'',
        )); ?>
        <?php echo $form->error($model,'languageIsDefault'); ?>
        <div class="space"></div>
    </div>
    <div class="form-group">
        <label class="control-label"><?php echo Yii::t('common', 'label.languageThumb'); ?></label>
        <div class="controls">
            <span class="btn btn-success fileinput-button">
                <i class="glyphicon glyphicon-plus"></i>
                <span><?php echo Yii::t('common', 'label.selectFile'); ?></span>
                <?php echo $form->hiddenField($model, 'languageThumb'); ?>
                <?php echo $form->fileField($model,'languageTempThumb'); ?>
            </span>
            <span class="fileinput-label"></span>
        </div>
    </div>
    <div class="col-xs-12" style="float: left">
        <?php echo CHtml::button(Yii::t('common', 'btn.update'), array(
            'type' => 'submit',
            'class '=> 'btn btn-primary'
        )); ?>
    </div>
    <div class="space"></div>
    <?php $this->endWidget(); ?>
</div>