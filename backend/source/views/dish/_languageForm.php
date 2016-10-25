<?php
/**
 * Created by Lorge 
 *
 * User: Only Love.
 * Date: 3/22/14 - 11:24 AM
 */
?>
<div class="row">
    <div class="col-xs-12 language">
        <div class="row">
            <div class="col-xs-2">
                <h4 class="title"><?php echo $lang->language_name . ($lang->language_is_default ? ' (default)' : ''); ?></h4>
            </div>
        </div>
        <hr class="line"/>
    </div>
</div>

<div class="row">
    <div class="col-xs-12">
        <div class="form-group">
            <?php echo CHtml::label(Yii::t('common', 'label.dishName'), 'languageName_'.$lang->language_id, array('class'=>'control-label')); ?>
            <?php echo CHtml::textField('DishForm[languages]['.$lang->language_id.'][languageName]', isset($languages[$lang->language_id])?$languages[$lang->language_id]->dish_name:'', array(
                'type'=>'text',
                'class'=>'form-control',
            )); ?>
            <div class="space"></div>
        </div>
        <div class="form-group">
            <?php echo CHtml::label(Yii::t('common', 'label.dishDesc'), 'languageDesc['.$lang->language_id.']', array('class'=>'control-label')); ?>
            <?php $this->widget('common.extensions.editMe.widgets.ExtEditMe', array(
                'name'=>'DishForm[languages]['.$lang->language_id.'][languageDesc]',
                'value'=>isset($languages[$lang->language_id])?$languages[$lang->language_id]->dish_desc:'',
                'htmlOptions'=>array(
                    'rows' => 3,
                    'class'=>'form-control',
                ),
                'filebrowserImageBrowseUrl'=>  Yii::app()->baseUrl.'/static/kcfinder/browse.php?type=images&cms=yii',
                'filebrowserImageBrowseLinkUrl'=>Yii::app()->baseUrl.'/static/kcfinder/browse.php?type=images&cms=yii',
                'filebrowserImageUploadUrl'=>Yii::app()->baseUrl.'/static/kcfinder/upload.php?type=images&cms=yii',
            )); ?>
        </div>
    </div>
</div>