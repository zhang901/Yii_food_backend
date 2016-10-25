<?php
/**
 * Created by Lorge 
 *
 * User: Only Love.
 * Date: 3/24/14 - 10:05 AM
 */
?>
<div class="row">
    <div class="col-xs-1">
        <h4 class="title"><?php echo Yii::t('common', 'title.listDish'); ?></h4>
    </div>
    <div class="col-xs-11 text-right">
        <?php $form = $this->beginWidget('CActiveForm', array(
            'id'=>'dish_search_form',
            'method' => 'POST',
            'enableClientValidation'=>true,
            'clientOptions'=>array(
                'validateOnSubmit'=>true,
            ),
            'htmlOptions' => array(
                'role' => 'form',
                'class' => 'form-inline',
            ),
        )); ?>

        <div class="form-group">
            <?php echo $form->textField($searchModel, 'dishName', array(
                'class' => 'form-control',
                'placeholder' => Yii::t('common', 'label.dishName'),
            )); ?>
        </div>
        <!-- <div class="form-group">
            <?php echo $form->dropDownList($searchModel, 'dishLang', $this->languages, array(
                'class' => 'form-control',
            )); ?>
        </div> -->
        <div class="form-group">
            <?php echo $form->dropDownList($searchModel, 'dishMenu', $menus, array(
                'class' => 'form-control',
            )); ?>
        </div>
        <button type="submit" class="btn btn-warning">Search</button>
        <a class="btn btn-primary inline" href="<?php echo Yii::app()->createUrl('dish/create'); ?>">
            <?php echo Yii::t('common', 'btn.create'); ?>
        </a>
        <?php $this->endWidget(); ?>
    </div>
</div>
<?php
    Yii::app()->clientScript->registerScript('dish_search', "
        $('#dish_search_form').submit(function(){
            $('#dish-grid').yiiGridView('update', {
                data: $(this).serialize(),
            });
            return false;
        });
    ");
?>