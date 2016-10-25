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
        <h4 class="title"><?php echo Yii::t('common', 'title.listOrder'); ?></h4>
    </div>
    <div class="col-xs-10 text-right">
        <?php $form = $this->beginWidget('CActiveForm', array(
            'id'=>'order_form',
            'method' => 'POST',
            'enableClientValidation'=>true,
            'enableAjaxValidation'=>false,
            'clientOptions'=>array(
                'validateOnSubmit'=>true,
            ),
            'htmlOptions' => array(
                'role' => 'form',
                'class' => 'form-inline',
            ),
        )); ?>

        <div class="form-group">
            <?php echo $form->textField($searchModel, 'Name', array(
                'class' => 'form-control',
                'placeholder' => 'Order Name',
            )); ?>
        </div>

        <div class="form-group">
        <?php
        $this->widget('zii.widgets.jui.CJuiDatePicker', array(
            'name'=>"OrderSearchForm[From]", // the name of the field
            //'attribute' => 'From',
            'value'=>$searchModel->From,  // pre-fill the value
            // additional javascript options for the date picker plugin
            'options'=>array(
                'showAnim'=>'fold',
                'showOtherMonths' => true,      // show dates in other months
                'selectOtherMonths' => true,    // can seelect dates in other months
                'changeYear' => true,           // can change year
                'changeMonth' => true,          // can change month
                'dateFormat'=>'yy-mm-dd',  // optional Date formatting
                'debug'=>true,
            ),
            'htmlOptions'=>array(
                //'style'=>'height:20px;',
                'class'=>'form-control',
                'placeholder' => 'Form Date',
            ),
        ));
        ?>
        </div>

        <div class="form-group">
            <?php
            $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                'name'=>"OrderSearchForm[To]", // the name of the field
                //'attribute' => 'To',
                'value'=>$searchModel->To,  // pre-fill the value
                // additional javascript options for the date picker plugin
                'options'=>array(
                    'showAnim'=>'fold',
                    'showOtherMonths' => true,      // show dates in other months
                    'selectOtherMonths' => true,    // can seelect dates in other months
                    'changeYear' => true,           // can change year
                    'changeMonth' => true,          // can change month
                    'dateFormat'=>'yy-mm-dd',  // optional Date formatting
                    'debug'=>true,
                ),
                'htmlOptions'=>array(
                    //'style'=>'height:20px;',
                    'class'=>'form-control',
                    'placeholder' => 'To Date',
                ),
            ));
            ?>
        </div>

        <!--<div class="form-group">
            <?php
/*            $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                'model' => $searchModel,
                'attribute' => 'From',
                //'name'=>'OrderSearchForm["Day"]',
                'htmlOptions' => array(
                    'size' => '10',         // textField size
                    'maxlength' => '10',    // textField maxlength
                    'class'=>'form-control',
                    'placeholder' => 'From date',
                ),
                'options' => array(
                    'showOn' => 'both',             // also opens with a button
                    'dateFormat' => 'yy-mm-dd',     // format of "2012-12-25"
                    'showOtherMonths' => true,      // show dates in other months
                    'selectOtherMonths' => true,    // can seelect dates in other months
                    'changeYear' => true,           // can change year
                    'changeMonth' => true,          // can change month
                    'yearRange' => '2014:2050',     // range of year
                    'minDate' => '2014-01-01',      // minimum date
                    'maxDate' => '2050-12-31',      // maximum date
                    'showButtonPanel' => true,      // show button panel

                ),
            ));

            */?>
        </div>
        <div class="form-group">
            <?php
/*            $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                'model' => $searchModel,
                'attribute' => 'To',
                //'name'=>'OrderSearchForm["Day"]',
                'htmlOptions' => array(
                    'size' => '10',         // textField size
                    'maxlength' => '10',    // textField maxlength
                    'class'=>'form-control',
                    'placeholder' => 'To date',

                ),
                'options' => array(
                    'showOn' => 'both',             // also opens with a button
                    'dateFormat' => 'yy-mm-dd',     // format of "2012-12-25"
                    'showOtherMonths' => true,      // show dates in other months
                    'selectOtherMonths' => true,    // can seelect dates in other months
                    'changeYear' => true,           // can change year
                    'changeMonth' => true,          // can change month
                    'yearRange' => '2014:2050',     // range of year
                    'minDate' => '2014-01-01',      // minimum date
                    'maxDate' => '2050-12-31',      // maximum date
                    'showButtonPanel' => true,      // show button panel



                ),
            ));

            */?>
        </div>-->

        <div class="form-group">
            <?php echo $form->dropDownList($searchModel, 'Status',array(0=>'New',1=>'Reject',2=>'In Process',3=>'Ready',4=>'Delivered',5=>'Fail',6=>'On the way') ,array(
                'class' => 'form-control',
                'prompt' => 'Select Status',
            )); ?>
        </div>

        <button type="submit" class="btn btn-warning">Search</button>
<!--        <a class="btn btn-primary inline" href="--><?php //echo Yii::app()->createUrl('category/create'); ?><!--">-->
<!--            --><?php //echo Yii::t('common', 'btn.create'); ?>
<!--        </a>-->
        <?php $this->endWidget(); ?>
    </div>
</div>
<?php
    Yii::app()->clientScript->registerScript('menu_search', "
        $('#order_form').submit(function(){
            $('#order-grid').yiiGridView('update', {
                data: $(this).serialize(),
            });
            return false;
        });
    ");

?>

