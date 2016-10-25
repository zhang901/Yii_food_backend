<?php
/**
 * User: Only Love
 * Date: 4/19/14
 * Time: 3:09 PM
 *
 * @var Dish $data
 */
$n = 6
?>
<?php if ($index % $n == 0) { ?>
    <div class="row">
<?php } ?>

<div class="col-xs-2">
    <div class="item">
        <div class="item-image">
            <img class="img-responsive" src="<?php echo Yii::app()->createUrl('site/image', array('id' => $data->dish_id, 'f'=>$data->dish_small_thumb, 't'=>Constants::TYPE_PRODUCT)); ?>"/>
        </div>
        <div class="item-name line-bottom">
            <?php echo isset($data->dish_language) ? $data->dish_language->dish_name : ''; ?>
        </div>
        <div class="item-price line-bottom">
            <?php echo Yii::t('common', 'label.price'); ?>:
            <?php
                if(isset($data->dish_promotion)){
                    echo '<label class="strike">'.$data->dish_price.' $</label> <label class="red">'.$data->dish_promotion.' $</label>';
                }else{
                    echo $data->dish_price.' $';
                }
            ?>
        </div>
    </div>
</div>

<?php if ($index % $n == ($n - 1) || $index == ($count - 1)) { ?>
    <div class="clearfix"></div>
    </div>
<?php } ?>