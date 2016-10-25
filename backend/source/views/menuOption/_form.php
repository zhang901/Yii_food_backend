<?php
/**
 * Created by Lorge 
 *
 * User: Only Love.
 * Date: 12/27/13 - 9:44 AM
 */
?>
<div class="form">
    <?php $form = $this->beginWidget('CActiveForm', array(
        'id'=>'createMenuOption-form',
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
        <?php echo $form->label($model, Yii::t('common', 'label.menuOptionName'), array('class'=>'control-label')); ?>
        <?php echo $form->textField($model,'cmName', array(
            'type'=>'text',
            'size'=>40,
            'class'=>'form-control',
        )); ?>
        <?php echo $form->error($model,'cmName'); ?>
    </div>
    <div class="form-group">
        <?php echo $form->label($model, Yii::t('common', 'label.menuOptionDesc'), array('class'=>'control-label')); ?>
        <?php echo $form->textArea($model, 'cmDesc', array(
            'rows'=>6,
            'class'=>'form-control',
        ));?>
        <?php echo $form->error($model,'cmDesc'); ?>
    </div>
    <div class="form-group">
        <?php echo $form->label($model, Yii::t('common', 'label.menuOptionParentId'), array('class'=>'control-label')); ?>
        <?php echo $form->dropDownList($model, 'cmParentId', $parent, array(
            'class'=>'form-control',
        ));?>
        <?php echo $form->error($model,'cmDesc'); ?>
    </div>
    <div style="float: left">
        <?php echo CHtml::button(Yii::t('common', 'btn.update'), array(
            'type' => 'submit',
            'class '=> 'btn btn-primary'
        )); ?>
    </div>
    <?php $this->endWidget(); ?>
</div>