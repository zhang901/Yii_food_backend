<?php
/**
 * User: Only Love
 * Date: 4/19/14
 * Time: 8:33 AM
 */
?>

<div class="row">
    <div class="col-xs-12">
        <div class="row">
            <div class="col-xs-6">
                <h4 class="title"><?php echo Yii::t('common', 'label.bank'); ?></h4>
            </div>
        </div>
        <hr class="line"/>
    </div>
</div>

<div class="row">
    <div class="col-xs-12">
        <div class="form">
            <?php $form = $this->beginWidget('CActiveForm', array(
                'id'=>'bankInfo-form',
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
                <?php echo $form->label($model, Yii::t('common', 'label.bank'), array('class'=>'control-label')); ?>
                <?php $this->widget('common.extensions.editMe.widgets.ExtEditMe', array(
                    'model' => $model,
                    'attribute' => 'info',
                    'htmlOptions' => array(
                        'rows' => 3,
                        'class' => 'form-control',
                    ),
                )); ?>
                <?php echo $form->error($model,'info'); ?>
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