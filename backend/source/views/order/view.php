<?php
/**
 * Created by Lorge
 *
 * User: Only Love.
 * Date: 12/27/13 - 9:44 AM
 *
 * @var Order $model
 */
?>

<div class="row">
    <div class="col-xs-12">
        <div class="row">
            <div class="col-xs-6">
                <h4 class="title"><?php echo Yii::t('common', 'title.view').'&nbsp;'.'#'.'&nbsp;'.$id;; ?></h4>
            </div>
            <div class="col-xs-6 text-right">

                <a class="btn btn-danger inline" href="<?php echo Yii::app()->createUrl('order/index'); ?>"><?php echo Yii::t('common', 'btn.back'); ?></a>

            </div>
        </div>
        <hr class="line"/>
    </div>
</div>

<div class="row">
    <div class="col-xs-5">
        <table class="table table-bordered table-striped">
            <tr>
                <th><?php echo Yii::t('common', 'label.orderId');?></th>
                <td><?php echo $model->order_id; ?></td>
            </tr>
            <tr>
                <th><?php echo Yii::t('common', 'label.orderName');?></th>
                <td><?php echo $model->order_name; ?></td>
            </tr>
            <tr>
                <th><?php echo Yii::t('common', 'label.orderTel');?></th>
                <td><?php echo $model->order_tel; ?></td>
            </tr>
            <tr>
                <th><?php echo Yii::t('common', 'label.orderPrice');?></th>
                <td><?php echo $model->order_price; ?></td>
            </tr>
            <tr>
                <th><?php echo Yii::t('common', 'label.orderTime');?></th>
                <td><?php echo gmdate('Y-m-d H:i:s',(float) $model->order_time); ?></td>
            </tr>
            <tr>
                <th><?php echo Yii::t('common', 'label.delivery');?></th>
                <td><?php
                    if(strlen($model->delivery_id)>0)
                    {
                        $delivery = Account::model()->findByPk($model->delivery_id);
                        if(count($delivery)>0)
                            echo $delivery->full_name;
                        else
                            echo 'N/A';
                    }

                    ?>
                </td>
            </tr>
            <tr>
                <th><?php echo Yii::t('common', 'label.chef');?></th>
                <td><?php
                    if(strlen($model->chef_id)>0)
                    {
                        $delivery = Account::model()->findByPk($model->chef_id);
                        if(count($delivery)>0)
                            echo $delivery->full_name;
                        else
                            echo 'N/A';
                    }

                    ?>
                </td>
            </tr>
            <tr>
                <th><?php echo Yii::t('common', 'label.orderStatus');?></th>
                <td>
                    <?php
                    if($model->order_status == Constants::STATUS_CREATED){
                        echo "<label class='label label-danger'>Created</label>";
                    }elseif($model->order_status == Constants::STATUS_REJECT){
                        echo "<label class='label label-warning'>Reject</label>";
                    }elseif($model->order_status == Constants::STATUS_IN_PROCESS){
                        echo "<label class='label label-default'>In Process</label>";
                    }
                    elseif($model->order_status == Constants::STATUS_READY){
                        echo "<label class='label label-default'>Ready</label>";
                    }
                    elseif($model->order_status == Constants::STATUS_PENDING){
                        echo "<label class='label label-default'>Pending</label>";
                    }
                    elseif($model->order_status == Constants::STATUS_DELIVERED){
                        echo "<label class='label label-warning'>Delivered</label>";
                    }
                    else
                        echo "<label class='label label-danger'>Fail</label>";
                    ?>
                </td>
            </tr>
        </table>
    </div>
</div>

<div class="row">
    <div class="col-xs-12">
        <table class="table table-bordered table-striped">
            <tr>
                <th style="width:10%;border: none"><?php echo Yii::t('common', 'label.image'); ?></th>
                <th style="width:10%;border: none"><?php echo Yii::t('common', 'label.dishName'); ?></th>
                <th style="width:10%;border: none"><?php echo Yii::t('common', 'label.dishPrice'); ?></th>
                <th style="width:10%;border: none"><?php echo Yii::t('common', 'label.dishOptionPrice'); ?></th>
                <th style="width:10%;border: none"><?php echo Yii::t('common', 'label.dishQuantity'); ?></th>
<!--                <th style="width:10%;border: none">--><?php //echo Yii::t('common', 'label.dishCookingMethod'); ?><!--</th>-->
                <th style="width:10%;border: none"><?php echo Yii::t('common', 'label.dishTopping'); ?></th>
                <th style="width:30%;border: none"><?php echo Yii::t('common', 'label.instruction'); ?></th>
<!--                <th style="width:10%;border: none">--><?php //echo Yii::t('common', 'label.panini'); ?><!--</th>-->
                <th style="width:10%;border: none"><?php echo Yii::t('common', 'label.total'); ?></th>
            </tr>

            <?php foreach($model->order_item as $i=>$item){
                $data = Dish::model()->findByPk($item->oi_dish_id);
                if($data != null){
            ?>
                    <tr>
<!--                        <td style="text-align: center">--><?php //echo '<img class="image-small-thumb" src="'.Yii::app()->createUrl('site/image', array('id' => $data->dish_id, 'f'=>$data->dish_small_thumb, 't'=>Constants::TYPE_PRODUCT)).'"/>'; ?><!--</td>-->
                        <td style="text-align: center"><?php echo '<img class="image-small-thumb" src="'.Yii::app()->request->baseUrl.'/uploads/products/'.$data->dish_id.'/'.$data->dish_small_thumb.'"/>'; ?></td>
                        <td><?php echo $data->dish_name; ?></td>
                        <td><?php echo $item->oi_dish_price; ?></td>
                        <td><?php echo $item->oi_topping_price; ?></td>
                        <td><?php echo $item->oi_dish_quantity; ?></td>
<!--                        <td>--><?php //echo $item->oi_cooking_method; ?><!--</td>-->
                        <td><?php echo $item->oi_toppings!=""?$item->oi_toppings:"none"; ?></td>
                        <td><?php echo $item->oi_instruction!=""?$item->oi_instruction:"none"; ?></td>
<!--                        <td>--><?php //echo $item->oi_is_panini ? '<i class="glyphicon glyphicon-ok"></i>': ''; ?><!--</td>-->
                        <td><?php echo intval($model->order_item[$i]->oi_dish_quantity) * (doubleval($model->order_item[$i]->oi_dish_price) + doubleval($model->order_item[$i]->oi_topping_price)); ?></td>
                    </tr>
                <?php } ?>
            <?php } ?>
        </table>
    </div>
</div>

<?php Yii::app()->clientScript->registerCoreScript('jquery'); ?>