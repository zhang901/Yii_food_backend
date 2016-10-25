<?php
/**
 * User: Only Love.
 */

$currentUrl = $this->uniqueId;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php $this->renderPartial("/layouts/public/header"); ?>
</head>
<body>
<div id="navigation">
    <nav class="navbar navbar-default no-border-radius" role="navigation">
        <div class="container">
            <div class="row">
                <!-- header -->
                <div id="header" class="col-xs-3">
                    <div id="logo"><?php echo CHtml::encode(Yii::app()->name); ?></div>
                </div><!-- header -->

                <!-- mainmenu -->
                <div class="col-xs-9 collapse navbar-collapse">
                    <ul class="nav navbar-nav">

                        <?php if (Yii::app()->user->role == 3) { ?>

                        <li <?php if($currentUrl === 'dish') echo "class='active'"; ?>>
                            <a href="<?php echo Yii::app()->createUrl('dish/index', array('rs'=>true)); ?>">
                                <i class="glyphicon glyphicon-list"></i>
                                <?php echo Yii::t('common', 'mnu.dish'); ?>
                            </a>
                        </li>

                        <li class="dropdown">
                            <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="false">
                                <i class="glyphicon glyphicon-book"></i>
                                <?php echo Yii::t('common', 'mnu.category'); ?> <b class="caret"></b>
                            </a>
                            <ul class="dropdown-menu multi-level">
                                <li>
                                    <a href="<?php echo Yii::app()->createUrl('category/index', array('rs'=>true)); ?>">
                                        <?php echo Yii::t('common', 'mnu.category'); ?>
                                    </a>
                                </li>
                                <li class="dropdown-submenu">
                                    <a href="javascript:;">
                                        <?php echo Yii::t('common', 'mnu.definition'); ?>
                                    </a>
                                    <ul class="dropdown-menu">
<!--                                        <li>-->
<!--                                            <a href="--><?php //echo Yii::app()->createUrl('menuOption/index'); ?><!--">-->
<!--                                                --><?php //echo Yii::t('common', 'mnu.menuOptions'); ?>
<!--                                            </a>-->
<!--                                        </li>-->
                                        <li>
                                            <a href="<?php echo Yii::app()->createUrl('relish/index'); ?>">
                                                <?php echo Yii::t('common', 'mnu.topping'); ?>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="<?php echo Yii::app()->createUrl('toppingOption/index'); ?>">
                                                <?php echo Yii::t('common', 'mnu.toppingOptions'); ?>
                                            </a>
                                        </li>
                                        
                                    </ul>
                                </li>
                            </ul>
                        </li>

                        <li <?php if($currentUrl === 'order') echo "class='active'"; ?>>
                            <a href="<?php echo Yii::app()->createUrl('order/index'); ?>">
                                <i class="glyphicon glyphicon-shopping-cart"></i>
                                <?php echo Yii::t('common', 'mnu.order'); ?>
                                <label id="order-number"></label>
                            </a>
                        </li>

                        <li <?php if($currentUrl === 'contact') echo "class='active'"; ?>>
                            <a href="<?php echo Yii::app()->createUrl('contact/index'); ?>">
                                <i class="glyphicon glyphicon-envelope"></i>
                                <?php echo Yii::t('common', 'mnu.contact'); ?>
                            </a>
                        </li>

                        <li <?php if($currentUrl === 'promotion') echo "class='active'"; ?>>
                            <a href="<?php echo Yii::app()->createUrl('promotion/index'); ?>">
                                <i class="glyphicon glyphicon-gift"></i>
                                <?php echo Yii::t('common', 'mnu.promotion'); ?>
                            </a>
                        </li>

                        <li <?php if($currentUrl === 'tableSeats') echo "class='active'"; ?>>
                            <a href="<?php echo Yii::app()->createUrl('tableSeats/index'); ?>">
                                <i class="glyphicon glyphicon-gift"></i>
                                <?php echo Yii::t('common', 'mnu.tableSeats'); ?>
                            </a>
                        </li>

                        <li <?php if($currentUrl === 'account') echo "class='active'"; ?>>
                            <a href="<?php echo Yii::app()->createUrl('account/index'); ?>">
                                <i class="glyphicon glyphicon-user"></i>
                                <?php echo Yii::t('common', 'mnu.account'); ?>
                            </a>
                        </li>

                        <li <?php if($currentUrl === 'dashBoard') echo "class='active'"; ?>>
                            <a href="<?php echo Yii::app()->createUrl('dashBoard/dashBoard'); ?>">
                                <i class="glyphicon glyphicon-list-alt"></i>
                                <?php echo 'DashBoard'; ?>

                            </a>
                        </li>

                        <li class="dropdown">
                            <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="false">
                                <i class="glyphicon glyphicon-cog"></i>
                                <?php echo Yii::t('common', 'mnu.setting'); ?> <b class="caret"></b>
                            </a>
                            <ul class="dropdown-menu">
                                <li>
                                    <a href="<?php echo Yii::app()->createUrl('setting/general'); ?>">
                                        <?php echo Yii::t('common', 'label.generalSettings'); ?>
                                    </a>
                                </li>
                                <li>
                                    <a href="<?php echo Yii::app()->createUrl('setting/mail'); ?>">
                                        <?php echo Yii::t('common', 'mnu.systemMail'); ?>
                                    </a>
                                </li>
                                <li>
                                    <a href="<?php echo Yii::app()->createUrl('setting/adminMail'); ?>">
                                        <?php echo Yii::t('common', 'mnu.adminMail'); ?>
                                    </a>
                                </li>
                                <li>
                                    <a href="<?php echo Yii::app()->createUrl('setting/bankInfo'); ?>">
                                        <?php echo Yii::t('common', 'mnu.bank'); ?>
                                    </a>
                                </li>
                                <li>
                                    <a href="<?php echo Yii::app()->createUrl('setting/adminAccount'); ?>">
                                        <?php echo Yii::t('common', 'mnu.adminAccount'); ?>
                                    </a>
                                </li>
                                <li>
                                    <a href="<?php echo Yii::app()->createUrl('setting/adminPassword'); ?>">
                                        <?php echo Yii::t('common', 'mnu.adminPassword'); ?>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <?php }else{ ?>


                        <?php if (Yii::app()->user->role != 0) { ?>
                            <li class="dropdown">
                                <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="false">
                                    <i class="glyphicon glyphicon-shopping-cart"></i>
                                    <?php echo Yii::t('common', 'mnu.order') ?> <b class="caret"></b>
                                    <label id="order-number"></label>

                                </a>
                                <ul class="dropdown-menu">

                                    <li <?php if($currentUrl === 'order/index') echo "class='active'"; ?>>
                                        <a href="<?php echo Yii::app()->createUrl('order/index'); ?>">
                                            <?php echo 'Assign Orders'; ?>
                                        </a>
                                    </li>

                                    <li <?php if($currentUrl === 'order/myOrders') echo "class='active'"; ?>>
                                        <a href="<?php echo Yii::app()->createUrl('order/myOrders'); ?>">
                                            <?php echo 'My Orders'; ?>
                                        </a>
                                    </li>
                                </ul>
                            </li>


                            <li class="dropdown">
                                <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="false">
                                    <i class="glyphicon glyphicon-cog"></i>
                                    <?php echo 'My Profile'; ?> <b class="caret"></b>
                                </a>
                                <ul class="dropdown-menu">

                                    <li>
                                        <a href="<?php echo Yii::app()->createUrl('account/updateMyAccount',array('id' => Yii::app()->user->id)); ?>">
                                            <?php echo 'Update My Account'; ?>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="<?php echo Yii::app()->createUrl('account/updateMyPassword',array('id' => Yii::app()->user->id)); ?>">
                                            <?php echo 'Update My Password'; ?>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        <?php }else{ ?>
                                <li class="dropdown">
                                    <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="false">
                                        <i class="glyphicon glyphicon-cog"></i>
                                        <?php echo 'My Profile'; ?> <b class="caret"></b>
                                    </a>
                                    <ul class="dropdown-menu">

                                        <li>
                                            <a href="<?php echo Yii::app()->createUrl('account/updateMyAccount',array('id' => Yii::app()->user->id)); ?>">
                                                <?php echo 'Update My Account'; ?>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="<?php echo Yii::app()->createUrl('account/updateMyPassword',array('id' => Yii::app()->user->id)); ?>">
                                                <?php echo 'Update My Password'; ?>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                        <?php } ?>
                        <?php } ?>

                        <li>
                            <a href="<?php echo Yii::app()->createUrl('site/logout'); ?>">
                                <i class="glyphicon glyphicon-log-out"></i>
                                <?php echo Yii::t('common', 'mnu.logout'); ?> (<?php $id = Yii::app()->user->id; if(isset($id))echo $name= Account::model()->findByPk($id)->full_name ?>)
                            </a>
                        </li>
                    </ul>
                </div><!-- mainmenu -->
            </div>
        </div>
    </nav>
</div>
<div class="container">
    <div class="row">
        <div class="col-xs-12">
            <?php echo $content; ?>
        </div>
    </div>

    <div id="footer" class="row">
        <div class="col-xs-12">
            <!--<hr class="line"/>
            &copy;  ProjecTemplate - All rights reserved<br/>
            Powered by <a href="http://projectemplate.com">ProjecTemplate</a> (Web & App Development).-->
        </div>
    </div>
</div>
<?php $this->renderPartial("/layouts/public/footer"); ?>
<?php
Yii::app()->clientScript->registerScript('script', "
    function notification(url){
        $.ajax({
            url: '".Yii::app()->createUrl('order/count')."',
            type: 'POST',
            success: function(json){
                if(json.status == 'SUCCESS'){
                    count = parseInt(json.data);
                   // alert(count);
                    if(count > 0){
                        $('#order-number').addClass('label label-danger').html(json.data);
                    }else{
                        $('#order-number').removeClass('label').removeClass('label-danger').html('');
                    }
                }
            },
            complete: function(data){}
        });
    }
", CClientScript::POS_END);
if(!Yii::app()->user->isGuest){
    Yii::app()->clientScript->registerScript('notify', "
        notification();
        var t = setInterval(function(){
        notification();
        }, 3000);
    ", CClientScript::POS_END);
}
?>
</body>
</html>