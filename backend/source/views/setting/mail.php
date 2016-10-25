<?php
/**
 * User: Only Love
 * Date: 4/19/14
 * Time: 7:06 AM
 *
 * @var CActiveForm $form
 */
?>

<div class="row">
    <div class="col-xs-12">
        <div class="row">
            <div class="col-xs-6">
                <h4 class="title"><?php echo Yii::t('common', 'label.mailSetting'); ?></h4>
            </div>
        </div>
        <hr class="line"/>
    </div>
</div>

<div class="row">
    <div class="col-xs-12">
        <div class="form">
            <?php $form = $this->beginWidget('CActiveForm', array(
                'id'=>'settingMail-form',
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
                <?php echo $form->label($model, Yii::t('common', 'label.host'), array('class'=>'control-label')); ?>
                <?php echo $form->textField($model, 'host', array(
                    'type'=>'text',
                    'class'=>'form-control',
                )); ?>
                <?php echo $form->error($model,'host'); ?>
            </div>
            <div class="form-group">
                <?php echo $form->label($model, Yii::t('common', 'label.account'), array('class'=>'control-label')); ?>
                <?php echo $form->textField($model, 'account', array(
                    'type'=>'text',
                    'class'=>'form-control',
                )); ?>
                <?php echo $form->error($model,'account'); ?>
            </div>
            <div class="form-group">
                <?php echo $form->label($model, Yii::t('common', 'label.password'), array('class'=>'control-label')); ?>
                <?php echo $form->passwordField($model, 'password', array(
                    'type'=>'text',
                    'class'=>'form-control',
                )); ?>
                <?php echo $form->error($model,'password'); ?>
            </div>
            <div class="form-group">
                <?php echo $form->label($model, Yii::t('common', 'label.port'), array('class'=>'control-label')); ?>
                <?php echo $form->textField($model, 'port', array(
                    'type'=>'text',
                    'class'=>'form-control',
                )); ?>
                <?php echo $form->error($model,'port'); ?>
            </div>
            <div class="form-group">
                <?php echo $form->label($model, Yii::t('common', 'label.encryption'), array('class'=>'control-label')); ?>
                <?php echo $form->dropDownList($model, 'encryption', array(
                    'tls'=>'tls',
                    'ftl'=>'ftl',
                ), array(
                    'class'=>'form-control',
                )); ?>
                <?php echo $form->error($model,'encryption'); ?>
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
