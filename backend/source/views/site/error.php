<?php
/**
 * Created by Lorge 
 *
 * User: Only Love.
 * Date: 12/15/13 - 9:36 AM
 */
?>

<div class="text-center col-md-12">
    <h1 class="text-white"><?php echo $code; ?></h1>
    <h5 class="text-left"><?php echo CHtml::encode($message); ?></h5>
</div>
<div class="list-group col-md-12">
    <a href="<?php echo Yii::app()->createUrl('dish/index'); ?>" class="list-group-item">
        <i class="icon icon-home"></i>
        Back to Homepage
    </a>
</div>