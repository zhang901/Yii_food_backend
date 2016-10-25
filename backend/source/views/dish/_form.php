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
        'id'=>'dish-form',
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
        <?php echo $form->label($model, Yii::t('common', 'label.dishName'), array('class'=>'control-label')); ?>
        <?php echo $form->textField($model,'dishName', array(
            'type'=>'text',
            'size'=>40,
            'class'=>'form-control',
        )); ?>
        <?php echo $form->error($model,'dishName'); ?>
        <div class="space"></div>
    </div>
    <div class="form-group">
        <?php echo $form->label($model, Yii::t('common', 'label.dishDesc'), array('class'=>'control-label')); ?>
        <?php echo $form->textArea($model,'dishDesc', array(
            'rows'=>'8',
            'class'=>'form-control',
        )); ?>
        <?php echo $form->error($model,'dishDesc'); ?>
    </div>
    <div class="form-group">
        <?php echo $form->label($model, Yii::t('common', 'label.dishPrice'), array('class'=>'control-label')); ?>
        <?php echo $form->textField($model,'dishPrice', array(
            'type'=>'text',
            'size'=>40,
            'class'=>'form-control',
        )); ?>
        <?php echo $form->error($model,'dishPrice'); ?>
        <div class="space"></div>
    </div>

    <div class="form-group">
        <?php echo $form->label($model, Yii::t('common', 'label.orderNumber'), array('class'=>'control-label')); ?>
        <?php echo $form->textField($model,'order_number', array(
            'type'=>'text',
            'size'=>20,
            'class'=>'form-control',
        )); ?>
        <?php echo $form->error($model,'order_number'); ?>
        <div class="space"></div>
    </div>

    <div class="form-group">
        <?php echo $form->label($model, Yii::t('common', 'label.dishMenu'), array('class'=>'control-label')); ?>
        <?php echo $form->dropDownList($model,'dishMenu', $menus, array(
            'class'=>'form-control',
        )); ?>
        <?php echo $form->error($model,'dishMenu'); ?>
        <div class="space"></div>
    </div>
    <div class="form-group">
        <label class="control-label"><?php echo Yii::t('common', 'label.dishThumb'); ?></label>
        <div class="controls">
            <span class="btn btn-success fileinput-button">
                <i class="glyphicon glyphicon-plus"></i>
                <span><?php echo Yii::t('common', 'label.selectFile'); ?></span>
                <?php echo $form->hiddenField($model, 'dishThumb'); ?>
                <?php echo $form->fileField($model,'dishTempThumb'); ?>
            </span>
            <span class="fileinput-label"></span>
            <span class="error-label"><?php echo Yii::t('common', 'label.dataRequired'); ?></span>
        </div>
        <?php if(!empty($model->dishThumb)){ ?>
            <!--<img class="image-small-thumb" src="<?php /*echo Yii::app()->createUrl('site/image', array('id' => $model->dishId, 'f'=>$model->dishThumb, 't'=>Constants::TYPE_PRODUCT));*/?>"/>-->
            <img class="image-small-thumb" src="<?php echo Yii::app()->request->baseUrl.'/uploads/products/'.$model->dishId.'/'.$model->dishThumb ?>"/>
        <?php } ?>
    </div>

    <?php
    foreach($this->activeLanguages as $lang){
        if(!$lang->language_is_default) $this->renderPartial('_languageForm', array('lang'=>$lang, 'languages'=>$languages));
    }
    ?>

    <div style="float: left">
        <?php echo CHtml::button(Yii::t('common', 'btn.update'), array(
            'type' => 'button',
            'onclick'=>'createDish();',
            'class '=> 'btn btn-primary'
        )); ?>
    </div>
    <div class="space"></div>
    <?php $this->endWidget(); ?>
</div>