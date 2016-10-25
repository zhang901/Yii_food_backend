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
        <h4 class="title"><?php echo 'Tables'; ?></h4>
    </div>
    <div class="col-xs-10 text-right">
        <?php $form = $this->beginWidget('CActiveForm', array(
            'id'=>'tableSeats_search_form',
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

       <!-- <div class="form-group">
            <?php /*echo $form->textField($searchModel, 'Name', array(
                'class' => 'form-control',
                'placeholder' => Yii::t('common', 'label.username'),
            )); */?>
        </div>
         <div class="form-group">
            <?php /*echo $form->dropDownList($searchModel, 'Role',array(2=>'Chef',1=>'Delivery Man',0=>'User'), array(
                'class' => 'form-control','prompt'=>'Select Role'
            )); */?>
        </div>-->
       <!-- <button type="submit" class="btn btn-warning">Search</button>-->
        <a class="btn btn-primary inline" href="<?php echo Yii::app()->createUrl('tableSeats/create'); ?>">
            <?php echo Yii::t('common', 'btn.create'); ?>
        </a>
        <?php $this->endWidget(); ?>
    </div>
</div>
<?php
    Yii::app()->clientScript->registerScript('menu_search', "
        $('#tableSeats_search_form').submit(function(){
            $('#tableSeats-grid').yiiGridView('update', {
                data: $(this).serialize(),
            });
            return false;
        });
    ");
?>