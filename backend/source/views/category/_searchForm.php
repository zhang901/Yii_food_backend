<?php
/**
 * Created by Lorge 
 *
 * User: Only Love.
 * Date: 3/24/14 - 10:05 AM
 */
?>
<div class="row">
    <div class="col-xs-2">
        <h4 class="title"><?php echo Yii::t('common', 'title.listMenu'); ?></h4>
    </div>
    <div class="col-xs-10 text-right">
        <?php $form = $this->beginWidget('CActiveForm', array(
            'id'=>'menu_search_form',
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
            <?php echo $form->textField($searchModel, 'menuName', array(
                'class' => 'form-control',
                'placeholder' => Yii::t('common', 'label.menuName'),
            )); ?>
        </div>
        <!-- <div class="form-group">
            <?php echo $form->dropDownList($searchModel, 'menuLang', $this->languages, array(
                'class' => 'form-control',
            )); ?>
        </div> -->
        <button type="submit" class="btn btn-warning">Search</button>
        <a class="btn btn-primary inline" href="<?php echo Yii::app()->createUrl('category/create'); ?>">
            <?php echo Yii::t('common', 'btn.create'); ?>
        </a>
        <?php $this->endWidget(); ?>
    </div>
</div>
<?php
    Yii::app()->clientScript->registerScript('menu_search', "
        $('#menu_search_form').submit(function(){
            $('#menu-grid').yiiGridView('update', {
                data: $(this).serialize(),
            });
            return false;
        });
    ");
?>