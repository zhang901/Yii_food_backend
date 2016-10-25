<?php
/**
 * Created by Lorge 
 *
 * User: Only Love.
 * Date: 12/15/13 - 9:15 AM
 */
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php $this->renderPartial("/layouts/public/header"); ?>
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/backend/static/css/login.css"/>
</head>
<body>
<div class="container login-wrapper">
    <div class="row">
        <div class="col-xs-4 col-xs-offset-4">
            <?php echo $content; ?>
        </div>
    </div>
    <div id="footer" class="row">
        <div class="container">
            &copy;  ProjecTemplate.Com - All rights reserved<br/>
            Powered by <a href="http://ProjecTemplate.Com">ProjecTemplate.Com</a> (Web & App Development).
        </div>
    </div>
</div>
<?php $this->renderPartial("/layouts/public/footer"); ?>
</body>
</html>