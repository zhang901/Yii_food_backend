<?php
/**
 * User: Only Love
 * Date: 5/16/14
 * Time: 4:35 PM
 */
?>

<div class="row">
    <div class="col-xs-12">
        <div class="row">
            <div class="col-xs-6">
                <h4 class="title"><?php echo Yii::t('common', 'title.update'); ?></h4>
            </div>
        </div>
        <hr class="line"/>
    </div>
</div>

<div class="row">
    <div class="col-xs-12">
        <div class="form">
            <?php $form = $this->beginWidget('CActiveForm', array(
                'id'=>'admin-form',
                'method' => 'POST',
                'enableClientValidation'=>true,
                'clientOptions'=>array(
                    'validateOnSubmit'=>true,
                ),
                'htmlOptions' => array(
                    'role' => 'form',
                ),
            )); ?>
            <?php if (Yii::app()->user->hasFlash('_success_')): ?>
                <div class="form-group">
                    <div class="alert alert-success">
                        <button data-dismiss="alert" class="close"></button>
                        <?php echo Yii::app()->user->getFlash('_success_'); ?>
                    </div>
                </div>
            <?php endif; ?>
            <?php if (Yii::app()->user->hasFlash('_error_')): ?>
                <div class="form-group">
                    <div class="alert alert-danger">
                        <button data-dismiss="alert" class="close"></button>
                        <?php echo Yii::app()->user->getFlash('_error_'); ?>
                    </div>
                </div>
            <?php endif; ?>
            <div class="form-group">
                <?php echo $form->label($model, Yii::t('common', 'label.adminPassword'), array('class'=>'control-label')); ?>
                <?php echo $form->passwordField($model,'adminPassword', array(
                    'type'=>'text',
                    'class'=>'form-control',
                )); ?>
                <?php echo $form->error($model,'adminPassword'); ?>
            </div>
            <div class="form-group">
                <?php echo $form->label($model, Yii::t('common', 'label.adminRetypePassword'), array('class'=>'control-label')); ?>
                <?php echo $form->passwordField($model,'adminRetypePassword', array(
                    'type'=>'text',
                    'class'=>'form-control',
                )); ?>
                <?php echo $form->error($model,'adminRetypePassword'); ?>
            </div>

            <div style="float: left">
                <?php echo CHtml::button(Yii::t('common', 'btn.update'), array(
                    'type' => 'submit',
                    'class '=> 'btn btn-primary'
                )); ?>
            </div>
            <div class="space"></div>
            <?php $this->endWidget(); ?>
        </div>
    </div>
</div>