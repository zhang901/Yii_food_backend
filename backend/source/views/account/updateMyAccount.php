<div class="row">
    <div class="col-xs-12">
        <div class="row">
            <div class="col-xs-6">
                <h4 class="title"><?php echo Yii::t('common', 'title.updateMyAccount'); ?></h4>
            </div>
            <!--<div class="col-xs-6 text-right">
                <?php /*if(Yii::app()->user->role==1){*/?>
                <a class="btn btn-success inline" href="<?php /*echo Yii::app()->createUrl('place/index'); */?>"><?php /*echo Yii::t('account', 'title.viewPlace'); */?></a>
                <?php /*}else{*/?>

                <?php /*}*/?>
                <a class="btn btn-success inline" href="<?php /*echo Yii::app()->createUrl('account/updateMyPassword',array('id'=>Yii::app()->user->id)); */?>"><?php /*echo Yii::t('common', 'mnu.editPassAccount'); */?></a>
            </div>-->
        </div>
        <hr class="line"/>
    </div>
</div>

<div class="row">
    <div class="col-xs-12">
        <?php $this->renderPartial('_my_account_form', array('model'=>$model)); ?>
    </div>
</div>