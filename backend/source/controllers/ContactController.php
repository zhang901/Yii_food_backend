<?php
/**
 * Created by Lorge.
 * User: Only Love
 * Date: 12/27/13 - 9:31 AM
 */

class ContactController extends Controller{
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
                'actions' => array('index', 'view', 'delete'),
                'users' => array('@'),
            ),*/
            array('allow',  // allow all users to perform 'index' and 'view' actions
                'actions'=>array('index','view','create','update','delete'),
                'users'=>array('@'),
                'expression'=>'Yii::app()->user->isAdmin()'
            ),
            array('deny', // deny all users
                'users' => array('*'),
            ),
        );
    }

    public function actionIndex(){
        $model = new Contact();
        $model->unsetAttributes();
        $this->render('index', array(
            'model' => $model,
        ));
    }

    public function actionView($id){
        /** @var Contact $model */
        $model = Contact::model()->findByPk($id);
        if($model == null) throw new CHttpException(404, Yii::t('common', 'msg.badRequest'));

        $this->render('view', array(
            'model' => $model,
        ));
    }

    public function actionDelete($id){
        /** @var Contact $model */
        $model = Contact::model()->findByPk($id);
        if($model != null){
            $model->delete();
        }
        $this->redirect(Yii::app()->createUrl('contact/index'));
    }
}