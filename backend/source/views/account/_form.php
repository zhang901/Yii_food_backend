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
        'id'=>'account-form',
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
        <?php echo $form->label($model, Yii::t('common', 'label.username'), array('class'=>'control-label')); ?>
        <?php echo $form->textField($model,'username', array(
            'type'=>'text',
            'class'=>'form-control',
        )); ?>
        <?php echo $form->error($model,'username'); ?>
        <div class="space"></div>
    </div>

    <div class="form-group">
        <?php echo $form->label($model, Yii::t('common', 'label.email'), array('class'=>'control-label')); ?>
        <?php echo $form->textField($model, 'email', array(
            'type'=>'text',
            'class'=>'form-control',
        )); ?>
        <?php echo $form->error($model,'email'); ?>
    </div>

    <div class="form-group">
        <?php echo $form->label($model, Yii::t('common', 'label.full_name'), array('class'=>'control-label')); ?>
        <?php echo $form->textField($model, 'full_name', array(
            'type'=>'text',
            'class'=>'form-control',
        )); ?>
        <?php echo $form->error($model,'full_name'); ?>
    </div>

    <div class="form-group">
        <?php echo $form->label($model, Yii::t('common', 'label.phone'), array('class'=>'control-label')); ?>
        <?php echo $form->textField($model, 'phone', array(
            'type'=>'text',
            'class'=>'form-control',
        )); ?>
        <?php echo $form->error($model,'phone'); ?>
    </div>

    <div class="form-group">
        <?php echo $form->label($model, Yii::t('common', 'label.address'), array('class'=>'control-label')); ?>
        <?php echo $form->textField($model, 'address', array(
            'type'=>'text',
            'class'=>'form-control',
        )); ?>
        <?php echo $form->error($model,'address'); ?>
    </div>

    <div class="form-group">
        <?php echo $form->label($model, Yii::t('common', 'label.role'), array('class'=>'control-label')); ?>
        <?php echo $form->dropDownlist($model, 'role',array(2=>'Chef',1=>'Delivery Man',0=>'User',4=>'Waiter')
            , array(
            'prompt'=>'Select Role',
            'class'=>'form-control',
        )); ?>
        <?php echo $form->error($model,'role'); ?>
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