<?php
/**
 * Created by Lorge.
 * User: Only Love
 * Date: 12/27/13 - 9:31 AM
 */

class DishController extends Controller{
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
            array('allow',  // allow all users to perform 'index' and 'view' actions
                'actions'=>array('index','view','create','update','delete'),
                'users'=>array('@'),
                'expression'=>'Yii::app()->user->isAdmin()'
            ),
            /*array('allow', // allow authentication user to perform 'index', ...
                'actions' => array('index', 'create', 'update', 'delete'),
                'users' => array('@'),
            ),*/
            array('deny', // deny all users
                'users' => array('*'),
            ),
        );
    }

    public function actionIndex($rs = false){
        $model = new Dish();
        $model->unsetAttributes();

        if($rs) unset(Yii::app()->session['DishSearchForm']);

        $searchModel = new DishSearchForm();
        if(isset($_REQUEST['DishSearchForm'])){
            $searchModel->attributes = $_REQUEST['DishSearchForm'];
            Yii::app()->session['DishSearchForm'] = $_REQUEST['DishSearchForm'];
        }elseif(isset(Yii::app()->session['DishSearchForm'])){
            $searchModel->attributes = Yii::app()->session['DishSearchForm'];
        }

        $arr = Menus::model()->findAll();
        $menus = array();
        $menus[] = Yii::t('common', 'label.menuSelect');
        foreach($arr as $menu){
            $menus[$menu->menu_id] = $menu->menu_name;
        }
        $this->render('index', array(
            'model' => $model,
            'searchModel' => $searchModel,
            'menus' => $menus,
        ));
    }

    public function actionCreate(){
        $model = new DishForm();
        if(isset($_POST['DishForm'])){
            $model->attributes = $_POST['DishForm'];

            $defaultLanguageId = $this->defaultLanguage->language_id;
            if(array_key_exists($defaultLanguageId, $model->languages)){
                Yii::app()->user->setFlash('_error_', Yii::t('common', 'msg.changeDefaultLanguage'));
            }else{
                $thumb=CUploadedFile::getInstance($model, 'dishTempThumb');
                if(!empty($thumb) && is_object($thumb)){
                    if(in_array($thumb->extensionName, Constants::$imageExtension)){
                        $fileName = time().'.'.$thumb->extensionName;
                        $model->dishThumb = $fileName;
                        if($model->save($defaultLanguageId) == DishForm::ERROR_NONE){
                            $uploadDir = $this->uploadFolder.DIRECTORY_SEPARATOR.Constants::TYPE_PRODUCT.DIRECTORY_SEPARATOR.$model->dishId;
                            if(!file_exists($uploadDir)){
                                mkdir($uploadDir, 0777, true);
                            }
                            $file = $uploadDir.DIRECTORY_SEPARATOR.$model->dishThumb;
                            $thumb->saveAs($file);

                            try{
                                FileUtils::resizeImage($file, 'S', array('width'=>73,'height'=>73));
                            }catch (Exception $e){
                                // Nothing to do
                            }
                            $this->redirect(Yii::app()->createUrl('dish/index'));
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

        $menuModel = Menus::model()->findAll();
        foreach($menuModel as $item){
            $menus[$item->menu_id] = $item->menu_name;
        }

        $this->render('create', array(
            'model' => $model,
            'menus' => $menus,
            'languages' => array(),
        ));
    }

    public function actionUpdate($id){
        $model = new DishForm();

        if(isset($_POST['DishForm'])){
            $model->attributes = $_POST['DishForm'];

            $defaultLanguageId = $this->defaultLanguage->language_id;
            if(array_key_exists($defaultLanguageId, $model->languages)){
                Yii::app()->user->setFlash('_error_', Yii::t('common', 'msg.changeDefaultLanguage'));
            }else{
                $oThumb = $model->dishThumb;
                $oSmallThumb = $model->dishSmallThumb;
                $newThumb=CUploadedFile::getInstance($model, 'dishTempThumb');
                if(!empty($newThumb) && is_object($newThumb)){
                    if(in_array($newThumb->extensionName, Constants::$imageExtension)){
                        $fileName = time().'.'.$newThumb->extensionName;
                        $model->dishThumb = $fileName;
                        if($model->update($id, $defaultLanguageId) == DishForm::ERROR_NONE){
                            $uploadDir = $this->uploadFolder.DIRECTORY_SEPARATOR.Constants::TYPE_PRODUCT.DIRECTORY_SEPARATOR.$id;
                            if(!file_exists($uploadDir)){
                                mkdir($uploadDir, 0777, true);
                            }
                            $file = $uploadDir.DIRECTORY_SEPARATOR.$model->dishThumb;
                            $newThumb->saveAs($uploadDir.DIRECTORY_SEPARATOR.$model->dishThumb);

                            $oThumb = $uploadDir.DIRECTORY_SEPARATOR.$oThumb;
                            if(file_exists($oThumb) && is_file($oThumb)){
                                unlink($oThumb);
                            }

                            $oSmallThumb = $uploadDir.DIRECTORY_SEPARATOR.$oSmallThumb;
                            if(file_exists($oSmallThumb) && is_file($oSmallThumb)){
                                unlink($oSmallThumb);
                            }

                            try{
                                FileUtils::resizeImage($file, 'S', array('width'=>73,'height'=>73));
                            }catch (Exception $e){
                                // Nothing to do
                            }
                            $this->redirect(Yii::app()->createUrl('dish/index'));
                        }else{
                            Yii::app()->user->setFlash('_error_', Yii::t('common', 'msg.errorSaveData'));
                        }
                    }else{
                        Yii::app()->user->setFlash('_error_', Yii::t('common', 'msg.errorFileExtension'));
                    }
                }else{
                    if($model->update($id, $defaultLanguageId) == DishForm::ERROR_NONE){
                        $this->redirect(Yii::app()->createUrl('dish/index'));
                    }else{
                        Yii::app()->user->setFlash('_error_', Yii::t('common', 'msg.errorSaveData'));
                    }
                }
            }
        }else{
            $model->loadModel($id);
        }

        $mlanguages = DishTransfer::model()->findAllByDishId($id);
        $languages = array();
        foreach($mlanguages as $lang){
            $languages[$lang->language_id] = $lang;
        }

        $menuModel = Menus::model()->findAll();
        foreach($menuModel as $item){
            $menus[$item->menu_id] = $item->menu_name;
        }

        $this->render('update', array(
            'model' => $model,
            'menus' => $menus,
            'languages' => $languages,
        ));
    }

    public function actionDelete($id){
        /** @var Dish $model */
        $model = Dish::model()->findByPk($id);
        if($model != null){
            $path = $this->uploadFolder.DIRECTORY_SEPARATOR.Constants::TYPE_PRODUCT.DIRECTORY_SEPARATOR.$id;
            $image = $path.DIRECTORY_SEPARATOR.$model->dish_thumb;
            $smallthumb = $path.DIRECTORY_SEPARATOR.$model->dish_small_thumb;
            $model->delete();
            if(file_exists($image) && is_file($image)){
                unlink($image);
            }
            if(file_exists($smallthumb) && is_file($smallthumb)){
                unlink($smallthumb);
            }
            $criteria = new CDbCriteria;
            $criteria->compare("dish_id", $id);
            Dish::model()->deleteAll($criteria);
        }
        $this->redirect(Yii::app()->createUrl('dish/index'));
    }
}