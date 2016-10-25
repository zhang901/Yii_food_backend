<?php
/**
 * User: Only Love.
 * Date: 12/27/13 - 9:44 AM
 */

?>
<div class="form">
    <?php $form = $this->beginWidget('CActiveForm', array(
        'id'=>'order-form',
        'method' => 'POST',
        'enableClientValidation'=>true,
        'clientOptions'=>array(
            'validateOnSubmit'=>true,
        ),
        'htmlOptions' => array(
            'class' => 'panel-body',
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

    <div class="col-md-12">
        <div class="row">
            <div class="col-md-4">
            <?php echo '<p style="font-size:17px" >'.'Order From:'.'&nbsp;'.$model->order_name.'</p>'?>
            </div>
        </div>
        <div class="space"></div>
    </div>

    <div class="col-md-12">
        <div class="row">
        <?php if(Yii::app()->user->role == Constants::ROLE_ADMIN){ ?>
        <div class="col-md-4">
            <?php /*if($model->order_status == 3){*/?>
            <?php echo $form->labelEx($model,'delivery_id'); ?>
            <?php
            echo $form->dropDownlist($model, 'delivery_id',CHtml::listData(Account::model()->findAll('role = 1'),'id','full_name') ,array('class'=>'form-control','prompt'=>'Select DeliveryMan'));
            echo $form->error($model,'delivery_id'); ?>
        </div>

        <div class="col-md-4">
            <?php echo $form->labelEx($model,'chef_id'); ?>
            <?php
            echo $form->dropDownlist($model, 'chef_id',CHtml::listData(Account::model()->findAll('role = 2'),'id','full_name') ,array('class'=>'form-control','prompt'=>'Select Chef'));
            echo $form->error($model,'chef_id'); ?>
        </div>

        <div class="col-md-4">
            <?php echo $form->labelEx($model,'order_status'); ?>
            <?php
            echo $form->dropDownlist($model, 'order_status',array(6=>'Pending',5=>'Fail',4=>'Delivered',3=>'Ready',2=>'In Process',1=>'Reject',0=>'Created'),array('class'=>'form-control','prompt'=>'Select Status'));
            echo $form->error($model,'order_status'); ?>
        </div>
        <?php }elseif(Yii::app()->user->role == Constants::ROLE_CHEF){ ?>
            <div class="col-md-4">
                <?php echo $form->labelEx($model,'chef_id'); ?>
                <?php
                echo $form->dropDownlist($model, 'chef_id',CHtml::listData(Account::model()->findAll('role = 2'),'id','full_name') ,array('class'=>'form-control',"disabled"=>"disabled",
                    'options' => array(Yii::app()->user->id =>array('selected'=>true)),    ));
                echo $form->error($model,'chef_id'); ?>
            </div>
            <div class="col-md-4">
                <?php echo $form->labelEx($model,'order_status'); ?>
                <?php
                echo $form->dropDownlist($model, 'order_status',array(3=>'Ready',2=>'In Process',1=>'Reject'),array('class'=>'form-control','prompt'=>'Select Status'));
                echo $form->error($model,'order_status'); ?>
            </div>
        <?php }else{?>
            <div class="col-md-4">
                <?php echo $form->labelEx($model,'delivery_id'); ?>
                <?php
                echo $form->dropDownlist($model, 'delivery_id',CHtml::listData(Account::model()->findAll('role = 1'),'id','full_name') ,array('class'=>'form-control',"disabled"=>"disabled",
                    'options' => array(Yii::app()->user->id =>array('selected'=>true)),    ));
                echo $form->error($model,'delivery_id'); ?>
            </div>
            <div class="col-md-4">
                <?php echo $form->labelEx($model,'order_status'); ?>
                <?php
                echo $form->dropDownlist($model, 'order_status',array(6=>'Pending',5=>'Fail',4=>'Delivered'),array('class'=>'form-control','prompt'=>'Select Status'));
                echo $form->error($model,'order_status'); ?>
            </div>
        <?php } ?>
        </div>
        <div class="space"></div>
    </div>


    <div class="space"></div>
    <div class="col-md-12">
        <div class="row">
            <div class="col-md-12">
                <?php echo CHtml::button(Yii::t('common', 'btn.update'), array(
                    'type' => 'submit',
                    'class '=> 'btn btn-primary'
                )); ?>
            </div>
        </div>
    </div>

    <?php $this->endWidget(); ?>
</div>