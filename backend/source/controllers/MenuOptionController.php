<?php
/**
 * User: Only Love
 * Date: 4/11/14
 * Time: 5:31 PM
 */

class MenuOptionController extends Controller{
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
            array('allow', // allow authentication user to perform 'index', ...
                'actions' => array('index', 'create', 'update', 'delete', 'list'),
                'users' => array('@'),
            ),
            array('deny', // deny all users
                'users' => array('*'),
            ),
        );
    }

    public function actionIndex(){
        $model = new CookingMethod;
        $model->unsetAttributes();
        $model->cm_type = Constants::TYPE_DISH;
        $this->render('index', array(
            'model' => $model,
        ));
    }

    public function actionCreate(){
        $model = new CookingMethodForm;
        $model->cmType = Constants::TYPE_MENU;
        if(isset($_POST['CookingMethodForm'])){
            $model->attributes = $_POST['CookingMethodForm'];

            if($model->save() == FormModel::ERROR_NONE){
                $this->redirect(Yii::app()->createUrl('menuOption/index'));
            }else{
                Yii::app()->user->setFlash('_error_', Yii::t('common', 'msg.errorSaveData'));
            }
        }
        $arr = CookingMethod::model()->findAllByLevel(1, Constants::TYPE_DISH);
        $parent = array(Yii::t('common', 'label.root'));
        foreach($arr as $item){
            $parent[$item->cm_id] = $item->cm_name;
        }
        $this->render('create',array(
            'model'=> $model,
            'parent'=>$parent,
        ));
    }

    public function actionUpdate($id){
        $model = new CookingMethodForm;
        $model->cmType = Constants::TYPE_MENU;

        if(isset($_POST['CookingMethodForm'])){
            $model->attributes = $_POST['CookingMethodForm'];

            if($model->update($id) == FormModel::ERROR_NONE){
                $this->redirect(Yii::app()->createUrl('menuOption/index'));
            }else{
                Yii::app()->user->setFlash('_error_', Yii::t('common', 'msg.errorSaveData'));
            }
        }
        $model->loadModel($id);
        $arr = CookingMethod::model()->findAllByLevel(1, Constants::TYPE_DISH);
        $parent = array(Yii::t('common', 'label.root'));
        foreach($arr as $item){
            $parent[$item->cm_id] = $item->cm_name;
        }
        $this->render('update', array(
            'model' => $model,
            'parent'=>$parent,
        ));
    }

    public function actionDelete($id){
        /** @var CookingMethod $model */
        $model = CookingMethod::model()->with('menus')->findByPk($id);
        if($model != null && $model->cm_type == Constants::TYPE_MENU && count($model->menus) == 0){
            $model->delete();
            $criteria = new CDbCriteria;
            $criteria->compare('cm_parent_id', $id);
            CookingMethod::model()->deleteAll($criteria);
        }
        $this->redirect(Yii::app()->createUrl('menuOption/index'));
    }

    public function actionList(){
        $q = $_GET['q'];
        $criteria = new CDbCriteria;
        $criteria->compare('cm_name', $q, true);
        $criteria->addCondition("cm_parent_id = '0'");
        $criteria->compare('cm_type', Constants::TYPE_MENU);
        $criteria->limit = 10;
        $criteria->offset = 0;
        $rows = CookingMethod::model()->findAll($criteria);
        $result = array();
        /** @var CookingMethod $row */
        foreach($rows as $row){
            $item = array();
            $item['id'] = $row->cm_id;
            $item['name'] = $row->cm_name;
            $result[] = $item;
        }

        echo $_GET['callback'] . "(";
        echo CJSON::encode($result);
        echo ")";
    }
}