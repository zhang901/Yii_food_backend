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
        'id'=>'menu-form',
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
        <?php echo $form->label($model, Yii::t('common', 'label.menuName'), array('class'=>'control-label')); ?>
        <?php echo $form->textField($model,'menuName', array(
            'type'=>'text',
            'class'=>'form-control',
        )); ?>
        <?php echo $form->error($model,'menuName'); ?>
        <div class="space"></div>
    </div>
    <div class="form-group">
        <label class="control-label"><?php echo Yii::t('common', 'label.menuThumb'); ?></label>
        <div class="controls">
            <span class="btn btn-success fileinput-button">
                <i class="glyphicon glyphicon-plus"></i>
                <span><?php echo Yii::t('common', 'label.selectFile'); ?></span>
                <?php echo $form->hiddenField($model, 'menuThumb'); ?>
                <?php echo $form->fileField($model,'menuTempThumb'); ?>
            </span>
            <span class="fileinput-label"></span>
            <span class="error-label"><?php echo Yii::t('common', 'label.dataRequired'); ?></span>
        </div>
        <?php if(!empty($model->menuThumb)){ ?>
       <img class="image-small-thumb" src="<?php echo Yii::app()->request->baseUrl.'/uploads/menu/'.$model->menuId.'/'.$model->menuThumb;?>"/>
<!--       <img class="image-small-thumb" src="--><?php // echo Yii::app()->request->baseUrl.'/uploads/menu/'.$model->menuId.'/'.$model->menuThumb ?><!--/>-->
        <?php } ?>
    </div>
    <div class="form-group">
        <?php echo $form->label($model, Yii::t('common', 'label.menuDesc'), array('class'=>'control-label')); ?>
        <?php echo $form->textArea($model, 'menuDesc', array(
            'rows'=>6,
            'class'=>'form-control',
        )); ?>
        <?php echo $form->error($model,'menuDesc'); ?>
    </div>

    <div class="form-group">
        <?php echo $form->label($model, Yii::t('common', 'label.orderNumber'), array('class'=>'control-label')); ?>
        <?php echo $form->textField($model, 'menuOrderNumber', array(
            'type'=>'text',
            'class'=>'form-control',
        )); ?>
        <?php echo $form->error($model,'menuOrderNumber'); ?>
    </div>

    <div class="form-group" style="display: none">
        <?php echo $form->checkbox($model, 'menuIsPanini', array(
            'class'=>'inline',
        )); ?>
        <?php echo $form->label($model, 'menuIsPanini', array('class'=>'control-label')); ?>
        <?php echo $form->error($model,'menuIsPanini'); ?>
    </div>
    <div class="form-group">
        <?php echo $form->label($model, Yii::t('common', 'label.menuRelishes'), array('class'=>'form-label')); ?>
        <?php
        echo Select2::activeMultiSelect($model, "menuRelishes", Relishes::model()->findIn($model->menuRelishes), array(
            'placeholder' => Yii::t('common', 'label.menuRelishes'),
            'select2Options' => array(
                'multiple' => true,
                'allowClear' => true,
                'width' => '100%',
                'minimumInputLength' => 0,
                'ajax' => array(
                    'url' => Yii::app()->createUrl('relish/list'),
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

    <div class="form-group" style="display: none">
        <?php echo $form->label($model, Yii::t('common', 'label.menuCookingMethods'), array('class'=>'form-label')); ?>
        <?php
        echo Select2::activeMultiSelect($model, "menuCookingMethods", CookingMethod::model()->findIn($model->menuCookingMethods, Constants::TYPE_MENU), array(
            'placeholder' => Yii::t('common', 'label.menuCookingMethods'),
            'select2Options' => array(
                'multiple' => true,
                'allowClear' => true,
                'width' => '100%',
                'minimumInputLength' => 0,
                'ajax' => array(
                    'url' => Yii::app()->createUrl('menuOption/list'),
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

    <?php
        foreach($this->activeLanguages as $lang){
            if(!$lang->language_is_default) $this->renderPartial('_languageForm', array('lang'=>$lang, 'languages'=>$languages));
        }
    ?>

    <div class="form-group">
        <?php echo CHtml::button(Yii::t('common', 'btn.update'), array(
            'type' => 'button',
            'onclick'=>'createCategory();',
            'class '=> 'btn btn-primary'
        )); ?>
    </div>
    <div class="space"></div>
    <?php $this->endWidget(); ?>
</div>