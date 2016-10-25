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
        'id'=>'tableSeats-form',
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
        <?php echo $form->label($model, 'title', array('class'=>'control-label')); ?>
        <?php echo $form->textField($model,'title', array(
            'type'=>'text',
            'class'=>'form-control',
        )); ?>
        <?php echo $form->error($model,'title'); ?>
        <div class="space"></div>
    </div>

    <div class="form-group">
        <?php echo $form->label($model, 'capacity', array('class'=>'control-label')); ?>
        <?php echo $form->textField($model, 'capacity', array(
            'type'=>'text',
            'class'=>'form-control',
        )); ?>
        <?php echo $form->error($model,'capacity'); ?>
    </div>

    <div class="form-group">
        <?php echo $form->label($model,'occupied', array('class'=>'control-label')); ?>
        <?php echo $form->textField($model, 'occupied', array(
            'type'=>'text',
            'class'=>'form-control',
        )); ?>
        <?php echo $form->error($model,'occupied'); ?>
    </div>

    <div class="form-group">
        <?php echo $form->label($model,'order_number', array('class'=>'control-label')); ?>
        <?php echo $form->textField($model, 'order_number', array(
            'type'=>'text',
            'class'=>'form-control',
        )); ?>
        <?php echo $form->error($model,'order_number'); ?>
    </div>

    <div class="form-group">
        <?php echo $form->label($model, 'status', array('class'=>'control-label')); ?>
        <?php echo $form->dropDownlist($model,'status',array(1=>'Active',0=>'Inactive'),array('prompt'=>'Select Status','class'=>'form-control'));
        ?>
        <?php echo $form->error($model,'address'); ?>
    </div>




    <?php
    /*    foreach($this->activeLanguages as $lang){
            if(!$lang->language_is_default) $this->renderPartial('_languageForm', array('lang'=>$lang, 'languages'=>$languages));
        }
        */?>

    <div class="form-group">
        <?php /*echo CHtml::button(Yii::t('common', 'btn.update'), array(
            'type' => 'button',
            'onclick'=>'createCategory();',
            'class '=> 'btn btn-primary'
        )); */?>
        <?php echo CHtml::button(Yii::t('common', $model->id != null ? 'Save' : 'Create'), array(
            'type' => 'submit',
            'class ' => 'btn btn-success',
        )); ?>
    </div>
    <div class="space"></div>
    <?php $this->endWidget(); ?>
</div>