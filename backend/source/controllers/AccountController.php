<?php

class AccountController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout= Constants::LAYOUT_MAIN;

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			//'postOnly + delete', // we only allow deletion via POST request
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			/*array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view'),
				'users'=>array('*'),
			),*/
            array('allow',  // allow all users to perform 'index' and 'view' actions
                'actions'=>array('index','view','create','update','delete','list'),
                'users'=>array('@'),
                'expression'=>'Yii::app()->user->isAdmin()'
            ),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array(/*'create','update',*/'updateMyAccount','updateMyPassword'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete'),
				'users'=>array('admin'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Account;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Account']))
		{
			$model->attributes=$_POST['Account'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);
        //var_dump($model);exit;
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Account']))
		{
			$model->attributes=$_POST['Account'];
			if($model->save())
				$this->redirect(array('index'));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
        $this->redirect(array('index'));
	}

	/**
	 * Lists all models.
	 */
    public function actionIndex($rs = false){
        $model = new Account();
        $model->unsetAttributes();

        if($rs) unset(Yii::app()->session['AccountSearchForm']);

        $searchModel = new AccountSearchForm();
        if(isset($_REQUEST['AccountSearchForm'])){
            $searchModel->attributes = $_REQUEST['AccountSearchForm'];
            Yii::app()->session['AccountSearchForm'] = $_REQUEST['AccountSearchForm'];
        }elseif(isset(Yii::app()->session['AccountSearchForm'])){
            $searchModel->attributes = Yii::app()->session['AccountSearchForm'];
        }

        $this->render('index', array(
            'model' => $model,
            'searchModel' => $searchModel,
        ));
    }
	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Account('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Account']))
			$model->attributes=$_GET['Account'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Account the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Account::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Account $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='account-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}

    public function actionUpdateMyAccount($id)
    {
        $model = new MyAccountForm();
        $model->loadModel($id);

        if (isset($_POST['MyAccountForm'])) {
            $model->attributes = $_POST['MyAccountForm'];
            if ($model->update($id)) {
//                $this->redirect(Yii::app()->createUrl('account/index'));
            } else {
                Yii::app()->user->setFlash('_error_', Yii::t('common', 'msg.errorSaveData'));
            }
        }

        $this->render('updateMyAccount', array(
            'model' => $model,
            'id'=>$id
        ));
    }

    public function actionUpdateMyPassword($id)
    {
        $model = new MyPasswordForm();
        $model->loadModel($id);

        if (isset($_POST['MyPasswordForm'])) {
            $model->attributes = $_POST['MyPasswordForm'];
            if ($model->update($id)) {
                $this->redirect(Yii::app()->createUrl('account/updateMyAccount',array('id'=>$id)));
            } else {
                Yii::app()->user->setFlash('_error_', Yii::t('common', 'msg.errorSaveData'));
            }
        }

        $this->render('updateMyPassword', array(
            'model' => $model,
        ));
    }


}
