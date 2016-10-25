<?php
/**
 * User: Only Love
 * Date: 4/11/14
 * Time: 5:31 PM
 */

class ToppingOptionController extends Controller{
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
        $model = new CookingMethod;
        $model->unsetAttributes();
        $model->cm_type = Constants::TYPE_TOPPING;
        $this->render('index', array(
            'model' => $model,
        ));
    }

    public function actionCreate(){
        $model = new CookingMethodForm;
        $model->cmType = Constants::TYPE_TOPPING;
        $model->cmParentId = 0;
        if(isset($_POST['CookingMethodForm'])){
            $model->attributes = $_POST['CookingMethodForm'];

            if($model->save() == FormModel::ERROR_NONE){
                $this->redirect(Yii::app()->createUrl('toppingOption/index'));
            }else{
                Yii::app()->user->setFlash('_error_', Yii::t('common', 'msg.errorSaveData'));
            }
        }
        $this->render('create',array(
            'model'=> $model,
        ));
    }

    public function actionUpdate($id){
        $model = new CookingMethodForm;
        $model->cmType = Constants::TYPE_TOPPING;
        $model->cmParentId = 0;

        if(isset($_POST['CookingMethodForm'])){
            $model->attributes = $_POST['CookingMethodForm'];

            if($model->update($id) == FormModel::ERROR_NONE){
                $this->redirect(Yii::app()->createUrl('toppingOption/index'));
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
        /** @var CookingMethod $model */
        $model = CookingMethod::model()->with('toppings')->findByPk($id);
        if($model != null && $model->cm_type == Constants::TYPE_TOPPING && count($model->toppings) == 0){
            $model->delete();
        }
        $this->redirect(Yii::app()->createUrl('toppingOption/index'));
    }

    public function actionList(){
        $q = $_GET['q'];
        $criteria = new CDbCriteria;
        $criteria->compare('cm_name', $q, true);
        $criteria->addCondition("cm_parent_id = '0'");
        $criteria->compare('cm_type', Constants::TYPE_TOPPING);
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