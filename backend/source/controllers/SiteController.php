<?php
/**
 * Created by Lorge 
 *
 * User: Only Love.
 * Date: 12/15/13 - 9:13 AM
 */

class SiteController extends Controller{

    public $layout = Constants::LAYOUT_LOGIN;
    public $dashboardAction = "dish/index";

    /**
     * @return array action filters
     */
    public function filters() {
        return array(
            // perform access control for CRUD operations
            'accessControl',
        );
    }

    /**
     * Specifies the access control rules.
     * This method is used by the 'accessControl' filter.
     * @return array access control rules
     */
    public function accessRules(){
        return array(
            array('allow',
                'actions' => array('login', 'error', 'image', 'sql'),
                'users' => array('*'),
            ),
            array('allow',
                'actions' => array('logout'),
                'users' => array('@'),
            ),
            array('deny',
                'users' => array('*'),
            ),

        );
    }

    /**
     * This is the action to handle external exceptions.
     */
    public function actionError(){
        $this->layout = Constants::LAYOUT_ERROR;
        if($error=Yii::app()->errorHandler->error){
            if(Yii::app()->request->isAjaxRequest)
                echo $error['message'];
            else
                $this->render('error', $error);
        }
    }

    /**
     * Displays the login page
     */
    public function actionLogin(){
        $model=new LoginForm;
        if(!Yii::app()->user->isGuest){
            if(property_exists(Yii::app()->user, 'returnUrl') && isset(Yii::app()->user->returnUrl) && Yii::app()->user->returnUrl != '/' && Yii::app()->returnUrl != 'site/login')
                $this->redirect(Yii::app()->user->returnUrl);
            else
                $this->redirect(Yii::app()->createUrl($this->dashboardAction));
        }
        if(isset($_POST['ajax']) && $_POST['ajax']==='login-form'){
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
        if(isset($_POST['LoginForm'])){
            $model->attributes=$_POST['LoginForm'];
            if($model->validate() && $model->login()){
                if(property_exists(Yii::app()->user, 'returnUrl') && isset(Yii::app()->user->returnUrl) && Yii::app()->user->returnUrl != '/' && Yii::app()->returnUrl != 'site/login')
                    $this->redirect(Yii::app()->user->returnUrl);
                else
                    if (Yii::app()->user->role == 3)
                        $this->redirect(Yii::app()->createUrl($this->dashboardAction));
                    else if (Yii::app()->user->role == 0) {
                        $this->redirect(Yii::app()->createUrl('account/updateMyAccount',array('id' => Yii::app()->user->id)));
                    }else
                        $this->redirect(Yii::app()->createUrl('order/index'));
            }
        }
        $this->render('login',array('model'=>$model));
    }

    /**
     * Logs out the current user and redirect to homepage.
     */
    public function actionLogout(){
        Yii::app()->user->logout(false);
        $this->redirect('login');
    }

    public function actionImage($id, $f, $t){
        $imgFile = $this->uploadFolder.DIRECTORY_SEPARATOR.$t.DIRECTORY_SEPARATOR.$id.DIRECTORY_SEPARATOR.$f;
        if (file_exists($imgFile)) {
            $info = getimagesize($imgFile);
            header("Content-type: {$info['mime']}");
            readfile($imgFile);
        }else{
            $info = getimagesize($this->uploadFolder.DIRECTORY_SEPARATOR.Constants::NO_IMAGE);
            header("Content-type: {$info['mime']}");
            readfile($this->uploadFolder.DIRECTORY_SEPARATOR.Constants::NO_IMAGE);
        }
    }

    public function actionSql(){
        //Yii::app()->db->createCommand("INSERT INTO `admins` VALUES (1, 'trung', '71889ba37e2b0572a4280df00d5c90500308a9d8', 'super');")->query();
        //ALTER TABLE `foods`.`location` MODIFY COLUMN `location_tel` VARCHAR(15) DEFAULT NULL;
        //Yii::app()->db->createCommand("ALTER TABLE `location` MODIFY COLUMN `location_tel` VARCHAR(30) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL;")->query();
    }
}