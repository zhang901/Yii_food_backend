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
        'id'=>'promotion-form',
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
        <?php echo $form->label($model, Yii::t('common', 'label.categoryId'), array('class'=>'control-label')); ?>
        <?php echo $form->dropDownlist($model,'categoryId',CHtml::listData(Menus::model()->findAll(),'menu_id','menu_name') ,array(
            'prompt'=>'Select Category',
            'class'=>'form-control',
        )); ?>
        <?php echo $form->error($model,'username'); ?>
        <div class="space"></div>
    </div>

    <div class="form-group">
        <?php echo $form->label($model, Yii::t('common', 'label.title'), array('class'=>'control-label')); ?>
        <?php echo $form->textField($model, 'title', array(
            'type'=>'text',
            'class'=>'form-control',
        )); ?>
        <?php echo $form->error($model,'title'); ?>
    </div>
    <?php if($model->isNewRecord!='1'){ ?>

        <?php if(!empty($model->image)){ ?>
            <!--<img class="image-small-thumb" src="<?php /*echo Yii::app()->createUrl('site/image', array('id' => $model->id, 'f'=>$model->image, 't'=>Constants::TYPE_PROMOTION));*/?>"/>-->
            <img class="image-small-thumb" src="<?php echo Yii::app()->request->baseUrl.'/uploads/promotion/'. $model->id. '/'.$model->image;?>"/>
        <?php } ?>

    <?php } ?>


    <div class="form-group">
        <?php echo $form->label($model, Yii::t('common', 'label.image'), array('class'=>'control-label')); ?>
        <?php echo CHtml::activeFileField($model,'image'); ?>
    </div>

    <div class="form-group">
        <?php echo $form->label($model, Yii::t('common', 'label.description'), array('class'=>'control-label')); ?>
        <?php echo $form->textArea($model, 'description', array(
            'rows'=>'6',
            'class'=>'form-control',
        )); ?>
        <?php echo $form->error($model,'description'); ?>
    </div>

    <div class="form-group">
        <?php echo $form->label($model, Yii::t('common', 'label.startDate'), array('class'=>'control-label')); ?>
            <?php
            $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                'model' => $model,
                'attribute' => 'startDate',
                'htmlOptions' => array(
                    'size' => '10',         // textField size
                    'maxlength' => '10',    // textField maxlength
                    'class'=>'form-control'
                ),
                'options' => array(
                    'showOn' => 'both',             // also opens with a button
                    'dateFormat' => 'yy-mm-dd',     // format of "2012-12-25"
                    'showOtherMonths' => true,      // show dates in other months
                    'selectOtherMonths' => true,    // can seelect dates in other months
                    'changeYear' => true,           // can change year
                    'changeMonth' => true,          // can change month
                    'yearRange' => '2015:2020',     // range of year
                    'minDate' => '2015-01-01',      // minimum date
                    'maxDate' => '2020-12-31',      // maximum date
                    'showButtonPanel' => true,      // show button panel
                ),
            ));
            ?>
        <?php echo $form->error($model,'startDate'); ?>
    </div>

    <div class="form-group">
        <?php echo $form->label($model, Yii::t('common', 'label.endDate'), array('class'=>'control-label')); ?>
        <?php
        $this->widget('zii.widgets.jui.CJuiDatePicker', array(
            'model' => $model,
            'attribute' => 'endDate',
            'htmlOptions' => array(
                'size' => '10',         // textField size
                'maxlength' => '10',    // textField maxlength
                'class'=>'form-control'
            ),
            'options' => array(
                'showOn' => 'both',             // also opens with a button
                'dateFormat' => 'yy-mm-dd',     // format of "2012-12-25"
                'showOtherMonths' => true,      // show dates in other months
                'selectOtherMonths' => true,    // can seelect dates in other months
                'changeYear' => true,           // can change year
                'changeMonth' => true,          // can change month
                'yearRange' => '2015:2020',     // range of year
                'minDate' => '2015-01-01',      // minimum date
                'maxDate' => '2020-12-31',      // maximum date
                'showButtonPanel' => true,      // show button panel
            ),
        ));
        ?>
        <?php echo $form->error($model,'endDate'); ?>
    </div>

    <div class="form-group">
        <?php echo $form->label($model, Yii::t('common', 'label.orderNumber'), array('class'=>'control-label')); ?>
        <?php echo $form->textField($model, 'order_number', array(
            'type'=>'text',
            'class'=>'form-control',
        )); ?>
        <?php echo $form->error($model,'order_number'); ?>
    </div>

    <div class="form-group">
        <?php echo $form->label($model, Yii::t('common', 'label.status'), array('class'=>'control-label')); ?>
        <?php echo $form->dropDownlist($model, 'status',array(1=>'Active',0=>'Inactive') ,array(
            'prompt'=>'Select Status',
            'class'=>'form-control',
        )); ?>
        <?php echo $form->error($model,'status'); ?>
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