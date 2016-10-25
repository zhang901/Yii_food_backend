<?php
/**
 * Created by Lorge
 *
 * User: Only Love.
 * Date: 12/27/13 - 9:44 AM
 */
?>

<div class="row">
    <div class="col-xs-12">
        <div class="row">
            <div class="col-xs-6">
                <h4 class="title"><?php echo Yii::t('common', 'title.view'); ?></h4>
            </div>
            <div class="col-xs-6 text-right">
                <a class="btn btn-danger inline" href="<?php echo Yii::app()->createUrl('contact/index'); ?>"><?php echo Yii::t('common', 'btn.back'); ?></a>
            </div>
        </div>
        <hr class="line"/>
    </div>
</div>

<div class="row">
    <div class="col-xs-12">
        <table class="table table-bordered table-striped">
            <tr>
                <th><?php echo Yii::t('common', 'label.contactEmail');?></th>
                <td><?php echo $model->contact_email; ?></td>
            </tr>
            <tr>
                <th><?php echo Yii::t('common', 'label.time');?></th>
                <td><?php echo $model->created; ?></td>
            </tr>
            <tr>
                <th><?php echo Yii::t('common', 'label.contactContent');?></th>
                <td><?php echo $model->contact_content; ?></td>
            </tr>
        </table>
    </div>
</div>
<?php Yii::app()->clientScript->registerCoreScript('jquery'); ?>