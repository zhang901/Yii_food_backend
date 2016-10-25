<?php
/**
 * User: Only Love
 * Date: 4/19/14
 * Time: 6:57 AM
 */

class SettingController extends Controller{
    public $layout = Constants::LAYOUT_MAIN;

    /**
     * @return array action filters
     */
    public function filters(){
        return array(
            'accessControl', // perform access control for CRUD operations
        );
    }

    /**
     * Specifies the access control rules.
     * This method is used by the 'accessControl' filter.
     * @return array access control rules
     */
    public function accessRules(){
        return array(
            /*array('allow', // allow authentication user to perform 'index', ...
                'actions' => array('mail', 'adminMail', 'adminAccount', 'adminPassword','bankInfo', 'general'),
                'users' => array('@'),
            ),*/
            array('allow',  // allow all users to perform 'index' and 'view' actions
                'actions'=>array('index','view','create','update','delete','mail', 'adminMail', 'adminAccount', 'adminPassword','bankInfo', 'general'),
                'users'=>array('@'),
                'expression'=>'Yii::app()->user->isAdmin()'
            ),
            array('deny', // deny all users
                'users' => array('*'),
            ),
        );
    }

    public function actionMail(){
        /** @var Settings $setting */
        $setting = Settings::model()->findByKey(Constants::SETTING_MAIL);
        if(isset($_POST["MailForm"])){
            $setting->setting_value = CJSON::encode($_POST["MailForm"]);
            if($setting->save()){
                Yii::app()->user->setFlash('_success_', Yii::t('common', 'msg.successSaveData'));
            }else{
                Yii::app()->user->setFlash('_error_', Yii::t('common', 'msg.errorSaveData'));
            }
        }

        $model = new MailForm;
        $model->attributes = CJSON::decode($setting->setting_value);
        $this->render("mail", array(
            'model'=>$model,
        ));
    }

    public function actionGeneral(){
        /** @var Settings $setting */
        $setting = Settings::model()->findByKey(Constants::SETTING_GENERAL);
        if(isset($_POST["GeneralForm"])){
            $setting->setting_value = CJSON::encode($_POST["GeneralForm"]);
            if($setting->save()){
                Yii::app()->user->setFlash('_success_', Yii::t('common', 'msg.successSaveData'));
            }else{
                Yii::app()->user->setFlash('_error_', Yii::t('common', 'msg.errorSaveData'));
            }
        }

        $model = new GeneralForm();
        $model->attributes = CJSON::decode($setting->setting_value);
        $this->render("general", array(
            'model'=>$model,
        ));
    }

    public function actionAdminMail(){
        /** @var Settings $setting */
        $setting = Settings::model()->findByKey(Constants::SETTING_ADMIN_MAIL);
        if(isset($_POST["AdminMailForm"])){
            $setting->setting_value = $_POST["AdminMailForm"]["account"];
            if($setting->save()){
                Yii::app()->user->setFlash('_success_', Yii::t('common', 'msg.successSaveData'));
            }else{
                Yii::app()->user->setFlash('_error_', Yii::t('common', 'msg.errorSaveData'));
            }
        }

        $model = new AdminMailForm;
        $model->account = $setting->setting_value;
        $this->render("adminMail", array(
            'model'=>$model,
        ));
    }

    public function actionBankInfo(){
        /** @var Settings $setting */
        $setting = Settings::model()->findByKey(Constants::SETTING_BANK_INFO);
        if(isset($_POST["BankInfoForm"])){
            $setting->setting_value = $_POST["BankInfoForm"]["info"];
            if($setting->save()){
                Yii::app()->user->setFlash('_success_', Yii::t('common', 'msg.successSaveData'));
            }else{
                Yii::app()->user->setFlash('_error_', Yii::t('common', 'msg.errorSaveData'));
            }
        }

        $model = new BankInfoForm;
        $model->info = $setting->setting_value;
        $this->render("bankInfo", array(
            'model'=>$model,
        ));
    }



    public function actionAdminAccount(){
        $model = new AdminForm;
        if(isset($_POST['AdminForm'])){
            $model->attributes = $_POST['AdminForm'];
            if($model->updateAccount()){
                Yii::app()->user->setFlash('_success_', Yii::t('common', 'msg.successSaveData'));
            }else{
                Yii::app()->user->setFlash('_error_', Yii::t('common', 'msg.errorSaveData'));
            }
        }
        $model->loadModel();
        $this->render('adminAccount', array(
            'model'=>$model,
        ));
    }

    public function actionAdminPassword(){
        $model = new AdminForm;
        if(isset($_POST['AdminForm'])){
            $model->attributes = $_POST['AdminForm'];
            if($model->updatePassword()){
                Yii::app()->user->setFlash('_success_', Yii::t('common', 'msg.successSaveData'));
            }else{
                Yii::app()->user->setFlash('_error_', Yii::t('common', 'msg.errorSaveData'));
            }
        }
        $model->loadModel();
        $this->render('adminPassword', array(
            'model'=>$model,
        ));
    }
}