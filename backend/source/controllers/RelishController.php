<?php
/**
 * User: Only Love
 * Date: 4/11/14
 * Time: 5:31 PM
 */

class RelishController extends Controller{
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
                'actions' => array('index', 'create', 'update', 'delete', 'list'),
                'users' => array('@'),
            ),*/
            array('allow',  // allow all users to perform 'index' and 'view' actions
                'actions'=>array('index','view','create','update','delete','list'),
                //'users'=>array('*'),
                'expression'=>'Yii::app()->user->isAdmin()'
            ),
            array('deny', // deny all users
                'users' => array('*'),
            ),
        );
    }

    public function actionIndex(){
        $model = new Relishes;
        $model->unsetAttributes();
        $this->render('index', array(
            'model' => $model,
        ));
    }

    public function actionCreate(){
        $model = new RelishForm;
        if(isset($_POST['RelishForm'])){
            $model->attributes = $_POST['RelishForm'];

            if($model->save() == FormModel::ERROR_NONE){
                $this->redirect(Yii::app()->createUrl('relish/index'));
            }else{
                Yii::app()->user->setFlash('_error_', Yii::t('common', 'msg.errorSaveData'));
            }
        }
        $this->render('create',array(
            'model'=> $model,
        ));
    }

    public function actionUpdate($id){
        $model = new RelishForm;

        if(isset($_POST['RelishForm'])){
            $model->attributes = $_POST['RelishForm'];

            if($model->update($id) == FormModel::ERROR_NONE){
                $this->redirect(Yii::app()->createUrl('relish/index'));
            }else{
                Yii::app()->user->setFlash('_error_', Yii::t('common', 'msg.errorSaveData'));
            }
        }
        $model->loadModel($id);
        $this->render('update', array(
            'model' => $model,
        ));
    }

    public function actionDelete($id){
        /** @var Relishes $model */
        $model = Relishes::model()->findByPk($id);
        if($model != null){
            $model->delete();
            $criteria = new CDbCriteria;
            $criteria->compare('rc_dest_id', $id);
            $criteria->compare('rc_dest_type', Constants::TYPE_TOPPING);
            RefCooking::model()->deleteAll($criteria);
        }
        $this->redirect(Yii::app()->createUrl('relish/index'));
    }

    public function actionList(){
        $q = $_GET['q'];
        $criteria = new CDbCriteria;
        $criteria->compare('relish_name', $q, true);
        $criteria->limit = 10;
        $criteria->offset = 0;
        $rows = Relishes::model()->findAll($criteria);
        $result = array();
        /** @var Relishes $row */
        foreach($rows as $row){
            $item = array();
            $item['id'] = $row->relish_id;
            $item['name'] = $row->relish_name;
            $result[] = $item;
        }

        echo $_GET['callback'] . "(";
        echo CJSON::encode($result);
        echo ")";
    }
}