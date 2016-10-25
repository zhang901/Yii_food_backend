<?php
/**
 * Created by Lorge.
 * User: Only Love
 * Date: 12/27/13 - 9:31 AM
 */

class OrderController extends Controller{
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
                'actions' => array('index', 'view', 'solve', 'delete', 'count','update','cancel','myOrders'),
                'users' => array('@'),
            ),
            array('deny', // deny all users
                'users' => array('*'),
            ),
        );
    }

    public function actionIndex(){
        $model = new Order();
        //$model->unsetAttributes();

        $searchModel = new OrderSearchForm();
        if(isset($_REQUEST['OrderSearchForm'])){
            $searchModel->attributes = $_REQUEST['OrderSearchForm'];
            Yii::app()->session['OrderSearchForm'] = $_REQUEST['OrderSearchForm'];
        }elseif(isset(Yii::app()->session['OrderSearchForm'])){
            $searchModel->attributes = Yii::app()->session['OrderSearchForm'];
        }

        $this->render('index', array(
            'model' => $model,
            'searchModel' => $searchModel,
        ));
    }

    public function actionMyOrders(){
        $model = new Order();
        //$model->unsetAttributes();

        $searchModel = new OrderSearchForm();
        /*$dataList = null;
        if(isset($_REQUEST['OrderSearchForm'])){

            $searchModel->attributes = $_REQUEST['OrderSearchForm'];
            $model = $searchModel->searchs();
            //$dataList = $model;
        }*/
        if(isset($_REQUEST['OrderSearchForm'])){
            $searchModel->attributes = $_REQUEST['OrderSearchForm'];
            Yii::app()->session['OrderSearchForm'] = $_REQUEST['OrderSearchForm'];
        }elseif(isset(Yii::app()->session['OrderSearchForm'])){
            $searchModel->attributes = Yii::app()->session['OrderSearchForm'];
        }

        $this->render('index', array(
            'model' => $model,
            'searchModel' => $searchModel,
            'myOrder'=> 'myOrder',
            //'dataList'=> $dataList
        ));
    }

    public function actionView($id){
        /** @var Order $model */
        $model = Order::model()->with('order_item', 'foods')->findByPk($id);
        if($model == null) throw new CHttpException(404, Yii::t('common', 'msg.badRequest'));

        /*if($model->order_status == Constants::STATUS_CREATED){
            $model->order_status = Constants::STATUS_PENDING;
            $model->updated = DateTimeUtils::now();
            $model->save(false);
        }*/

        $this->render('view', array(
            'model' => $model,
            'id'=>$id
        ));
    }

    public function actionUpdate($id)
    {

        //echo $id;exit;
        $model= Order::model()->findByPk($id);

        if (isset($_POST['Order'])) {
            $model->attributes = $_POST['Order'];
            $status = $_POST['Order']['order_status'];
            //if ($this->validateForm($model, false)) {
            /*if(Yii::app()->user->role != 3)
            {
                if(Yii::app()->user->role == 2)
                {
                    $model->chef_id = Yii::app()->user->id;
                }
                else
                    $model->delivery_id = Yii::app()->user->id;
            }*/
            if($model->save(false))
            {

                $table = TableSeats::model()->findByPk($model->table_id);
                if(count($table)>0)
                {
                    if($status == Constants::STATUS_DELIVERED || Constants::STATUS_REJECT || Constants::STATUS_FAIL)
                    {
                        $table->occupied = $table->occupied - $model->seats_number;
                        if(($table->occupied) >0)
                        {
                            $table->save(false);
                        }
                        else
                        {
                            $table->occupied = 0;
                            $table->save(false);
                        }
                    }
                }

                Order::model()->notifyStatus($id);

            }
            $this->redirect(Yii::app()->createUrl('order/index'));

            // }
        }

        $this->render('update', array(
            'model' => $model,
            'id' => $id,
        ));
    }

    public function actionSolve($id){
        /** @var Order $model */
        $model = Order::model()->findByPk($id);
        if($model == null) throw new CHttpException(404, Yii::t('common', 'msg.badRequest'));
        $model->order_status = Constants::STATUS_SOLVED;
        $model->updated = DateTimeUtils::now();
        $model->save();
        $this->redirect(Yii::app()->createUrl('order/index'));
    }

    public function actionDelete($id){
        /** @var Order $model */
        $model = Order::model()->findByPk($id);
        if($model != null){
            $model->delete();
            $criteria = new CDbCriteria();
            $criteria->compare('oi_order_id', $id);
            OrderItem::model()->deleteAll($criteria);
        }
        $this->redirect(Yii::app()->createUrl('order/index'));
    }

    public function actionCount(){
        $cri = new CDbCriteria();
        $cri->compare('order_status', Constants::STATUS_CREATED);
        header('HTTP/1.1 200 OK');
        header('Content-type: application/json');
        echo CJSON::encode(array(
            'status' => Constants::SUCCESS,
            'data' => Order::model()->count($cri),
            'message' => '',
        ));
        Yii::app()->end();
    }

    public function actionCancel($id){
        $model = Order::model()->findByPk($id);
        $model->order_status = Constants::STATUS_REJECT;
        if($model->save(false)){
            $table = TableSeats::model()->findByPk($model->table_id);
            if(count($table)>0)
            {
                $table->occupied = $table->occupied - $model->seats_number;
                if(($table->occupied) > 0 )
                {
                    $table->save(false);
                }
                else
                {
                    $table->occupied = 0;
                    $table->save(false);
                }
            }
        }
        $this->redirect(Yii::app()->createUrl('order/index'));
    }
}