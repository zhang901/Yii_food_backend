<?php

class PromotionController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout=Constants::LAYOUT_MAIN;

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
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view','create','update','delete'),
				'users'=>array('@'),
                'expression'=>'Yii::app()->user->isAdmin()'
			),
			/*array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update'),
				'users'=>array('@'),
			),*/
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
		$model=new Promotion;
        $model->dateCreated = date('Y-m-d H:i:s',strtotime('Now'));

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Promotion']))
		{
			$model->attributes=$_POST['Promotion'];
            $promotion_name=$_POST['Promotion']['title'];
            $uploadedFile=CUploadedFile::getInstance($model,'image');
            if (is_object($uploadedFile) && get_class($uploadedFile) === 'CUploadedFile') {
                $name = str_replace(' ','',$uploadedFile->name);
                $name_length = strlen($name);
                $length= strrpos($name,'.');
                $name_file =  strtotime('now').rand(0,99).substr($name,$length,$name_length);
                $model->image = $name_file;
            }

            if($model->save(false))
            {
                if(isset($uploadedFile) && $uploadedFile->size>0){
                    $uploadDir = $this->uploadFolder.DIRECTORY_SEPARATOR.Constants::TYPE_PROMOTION.DIRECTORY_SEPARATOR.$model->id;
                    if (!file_exists($uploadDir)) {
                        mkdir($uploadDir, 0777, true);
                    }
                    $uploadedFile->saveAs($uploadDir.DIRECTORY_SEPARATOR.$model->image);  // image
                }
                $devices= Device::model()->findAll('status = 1');
                $iDevices = array();
                $aDevices = array();
                foreach($devices as $device)
                {
                    if($device->type ==1)
                        $aDevices[] = $device->gcm_id;
                    if($device->type ==2)
                        $iDevices[] = $device->gcm_id;
                }
                Constants::pushAndroid($aDevices, $promotion_name);
                Constants::pushIos($iDevices, $promotion_name);
            }

            $this->redirect(Yii::app()->createUrl('promotion/index'));

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
        $oldImage = $model->image;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Promotion']))
		{
            $model->attributes=$_POST['Promotion'];
            $uploadedFile=CUploadedFile::getInstance($model,'image');
            if (is_object($uploadedFile) && get_class($uploadedFile) === 'CUploadedFile') {
                $name = str_replace(' ','',$uploadedFile->name);
                $name_length = strlen($name);
                $length= strrpos($name,'.');
                $name_file =  strtotime('now').rand(0,99).substr($name,$length,$name_length);
                $model->image = $name_file;
            }
            $uploadDir = $this->uploadFolder.DIRECTORY_SEPARATOR.Constants::TYPE_PROMOTION.DIRECTORY_SEPARATOR.$id.DIRECTORY_SEPARATOR;
            if($model->save(false))
            {
                if(isset($uploadedFile) && $uploadedFile->size>0){
                    if(isset($uploadedFile) && $uploadedFile->size>0){
                        if(($model->image) != $oldImage && strlen($oldImage)>0){
                            unlink($uploadDir. $oldImage);
                            $uploadedFile->saveAs($uploadDir.$model->image);  // image
                        }
                        $uploadedFile->saveAs($uploadDir.$model->image);   // image
                    }
                    $this->redirect(Yii::app()->createUrl('promotion/index'));
                }
            }
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
        $model = Promotion::model()->findByPk($id);
        $oldImage = $model->image;
        if(strlen($oldImage)>0)
        {
            $uploadDir = $this->uploadFolder.DIRECTORY_SEPARATOR.Constants::TYPE_PROMOTION.DIRECTORY_SEPARATOR.$id.DIRECTORY_SEPARATOR;
            unlink($uploadDir. $oldImage);
        }
		$model->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
        $this->redirect(array('index'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex($rs = false)
	{
        $model = new Promotion();
        $model->unsetAttributes();

        if($rs) unset(Yii::app()->session['PromotionSearchForm']);

        $searchModel = new PromotionSearchForm();
        if(isset($_REQUEST['PromotionSearchForm'])){
            $searchModel->attributes = $_REQUEST['PromotionSearchForm'];
            Yii::app()->session['PromotionSearchForm'] = $_REQUEST['PromotionSearchForm'];
        }elseif(isset(Yii::app()->session['PromotionSearchForm'])){
            $searchModel->attributes = Yii::app()->session['PromotionSearchForm'];
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
		$model=new Promotion('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Promotion']))
			$model->attributes=$_GET['Promotion'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Promotion the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Promotion::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Promotion $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='promotion-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
