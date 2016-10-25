<?php
/**
 * Created by Lorge.
 * User: Only Love
 * Date: 12/27/13 - 9:31 AM
 */

class CategoryController extends Controller{
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
                'actions' => array('index', 'create', 'update', 'delete'),
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

    public function actionIndex($rs = false){
        $model = new Menus();
        $model->unsetAttributes();

        if($rs) unset(Yii::app()->session['MenuSearchForm']);

        $searchModel = new MenuSearchForm();
        if(isset($_REQUEST['MenuSearchForm'])){
            $searchModel->attributes = $_REQUEST['MenuSearchForm'];
            Yii::app()->session['MenuSearchForm'] = $_REQUEST['MenuSearchForm'];
        }elseif(isset(Yii::app()->session['MenuSearchForm'])){
            $searchModel->attributes = Yii::app()->session['MenuSearchForm'];
        }

        $this->render('index', array(
            'model' => $model,
            'searchModel' => $searchModel,
        ));
    }

    public function actionCreate(){
        $model = new MenuForm();
        if(isset($_POST['MenuForm'])){
            $model->attributes = $_POST['MenuForm'];

            $defaultLanguageId = $this->defaultLanguage->language_id;
            if(array_key_exists($defaultLanguageId, $model->languages)){
                Yii::app()->user->setFlash('_error_', Yii::t('common', 'msg.changeDefaultLanguage'));
            }else{
                $menuThumb=CUploadedFile::getInstance($model, 'menuTempThumb');
                if(!empty($menuThumb) && is_object($menuThumb)){
                    if(in_array($menuThumb->extensionName, Constants::$imageExtension)){
                        $fileName = time().'.'.$menuThumb->extensionName;
                        $model->menuThumb = $fileName;
                        if($model->save($defaultLanguageId) == MenuForm::ERROR_NONE){
                            $uploadDir = $this->uploadFolder.DIRECTORY_SEPARATOR.Constants::TYPE_MENU.DIRECTORY_SEPARATOR.$model->menuId;
                            if(!file_exists($uploadDir)){
                                mkdir($uploadDir, 0777, true);
                            }
                            $menuThumb->saveAs($uploadDir.DIRECTORY_SEPARATOR.$fileName);
                            $this->redirect(Yii::app()->createUrl('category/index'));
                        }else{
                            Yii::app()->user->setFlash('_error_', Yii::t('common', 'msg.errorSaveData'));
                        }
                    }else{
                        Yii::app()->user->setFlash('_error_', Yii::t('common', 'msg.errorFileExtension'));
                    }
                }else{
                    Yii::app()->user->setFlash('_error_', Yii::t('common', 'msg.errorFileRequired'));
                }
            }
        }
        $this->render('create',array(
            'model'=> $model,
            'languages' => array(),
        ));
    }

    public function actionUpdate($id){
        $model = new MenuForm();

        if(isset($_POST['MenuForm'])){
            $model->attributes = $_POST['MenuForm'];

            $defaultLanguageId = $this->defaultLanguage->language_id;
            if(array_key_exists($defaultLanguageId, $model->languages)){
                Yii::app()->user->setFlash('_error_', Yii::t('common', 'msg.changeDefaultLanguage'));
            }else{
                $oThumb = $model->menuThumb;
                $newThumb=CUploadedFile::getInstance($model, 'menuTempThumb');
                if(!empty($newThumb) && is_object($newThumb)){
                    if(in_array($newThumb->extensionName, Constants::$imageExtension)){
                        $fileName = time().'.'.$newThumb->extensionName;
                        $model->menuThumb = $fileName;
                        if($model->update($id, $defaultLanguageId) == MenuForm::ERROR_NONE){
                            if(!empty($newThumb) && is_object($newThumb)){
                                $uploadDir = $this->uploadFolder.DIRECTORY_SEPARATOR.Constants::TYPE_MENU.DIRECTORY_SEPARATOR.$id;
                                if(!file_exists($uploadDir)){
                                    mkdir($uploadDir, 0777, true);
                                }
                                $newThumb->saveAs($uploadDir.DIRECTORY_SEPARATOR.$fileName);

                                $oThumb = $uploadDir.DIRECTORY_SEPARATOR.$oThumb;
                                if(file_exists($oThumb) && is_file($oThumb)){
                                    unlink($oThumb);
                                }
                            }
                            $this->redirect(Yii::app()->createUrl('category/index'));
                        }else{
                            Yii::app()->user->setFlash('_error_', Yii::t('common', 'msg.errorSaveData'));
                        }
                    }else{
                        Yii::app()->user->setFlash('_error_', Yii::t('common', 'msg.errorFileExtension'));
                    }
                }else{
                    if($model->update($id, $defaultLanguageId) == MenuForm::ERROR_NONE){
                        $this->redirect(Yii::app()->createUrl('category/index'));
                    }else{
                        Yii::app()->user->setFlash('_error_', Yii::t('common', 'msg.errorSaveData'));
                    }
                }
            }
        }else{
            $model->loadModel($id);
        }

        $mlanguages = MenuTransfer::model()->findAllByMenuId($id);
        $languages = array();
        foreach($mlanguages as $lang){
            $languages[$lang->language_id] = $lang;
        }
        $this->render('update', array(
            'model' => $model,
            'languages' => $languages,
        ));
    }

    public function actionDelete($id){
        /** @var Menus $model */
        $model = Menus::model()->findByPk($id);
        if($model != null && count($model->dish) == 0){
            $path = $this->uploadFolder.DIRECTORY_SEPARATOR.Constants::TYPE_ARTICLE.DIRECTORY_SEPARATOR.$id;
            $image = $model->menu_thumb;
            $model->delete();
            if(file_exists($path.DIRECTORY_SEPARATOR.$image) && is_file($path.DIRECTORY_SEPARATOR.$image)){
                unlink($path.DIRECTORY_SEPARATOR.$image);
            }
        }
        $this->redirect(Yii::app()->createUrl('category/index'));
    }
}