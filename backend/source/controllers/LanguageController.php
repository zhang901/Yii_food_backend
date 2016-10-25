<?php
/**
 * Created by Lorge.
 * User: Only Love
 * Date: 12/27/13 - 9:31 AM
 */

class LanguageController extends Controller{
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
                'actions' => array('index', 'default', 'active', 'inActive'),
                'users' => array('@'),
            ),
            array('deny', // deny all users
                'users' => array('*'),
            ),
        );
    }

    public function actionIndex(){
        $model = new Language();
        $model->unsetAttributes();
        $this->render('index', array(
            'model' => $model,
        ));
    }

    public function actionDefault($id){
        /** @var Language $language */
        $language = Language::model()->findByPk($id);
        if($language != null && !$language->language_is_default){
            $allLanguage = Language::model()->findAllByDefault();

            $transaction = Yii::app()->db->beginTransaction();
            $result = true;
            foreach($allLanguage as $lang){
                $lang->language_is_default = 0;
                $result &= $lang->save();
            }
            $language->language_is_default = 1;
            $language->language_status = Constants::STATUS_ACTIVE;
            $result &= $language->save();

            if($result){
                $transaction->commit();
            }else{
                $transaction->rollBack();
            }
        }
        $this->redirect(Yii::app()->createUrl('language/index'));
    }

    public function actionActive($id){
        /** @var Language $language */
        $language = Language::model()->findByPk($id);
        if($language != null && $language->language_status == Constants::STATUS_INACTIVE){
            $language->language_status = Constants::STATUS_ACTIVE;
            $language->save();
        }
        $this->redirect(Yii::app()->createUrl('language/index'));
    }

    public function actionInActive($id){
        /** @var Language $language */
        $language = Language::model()->findByPk($id);
        if($language != null && $language->language_status == Constants::STATUS_ACTIVE && !$language->language_is_default){
            $language->language_status = Constants::STATUS_INACTIVE;
            $language->save();
        }
        $this->redirect(Yii::app()->createUrl('language/index'));
    }

    public function actionCreate(){
        $model = new LanguageForm();
        if(isset($_POST['LanguageForm'])){
            $model->attributes = $_POST['LanguageForm'];

            $newThumb=CUploadedFile::getInstance($model, 'languageTempThumb');
            if(!empty($newThumb) && is_object($newThumb)){
                $fileName = time().'.'.$newThumb->extensionName;
                $model->languageThumb = $fileName;
            }
            if($model->save()){
                if(!empty($newThumb) && is_object($newThumb)){
                    $uploadDir = $this->uploadFolder.DIRECTORY_SEPARATOR.Constants::TYPE_LANGUAGE.DIRECTORY_SEPARATOR.$model->languageId;
                    if(!file_exists($uploadDir)){
                        mkdir($uploadDir, 0777, true);
                    }
                    $newThumb->saveAs($uploadDir.DIRECTORY_SEPARATOR.$fileName);
                }
                $this->redirect(Yii::app()->createUrl('language/index'));
            }else{
                Yii::app()->user->setFlash('_error_', Yii::t('common', 'msg.errorSaveData'));
            }
        }
        $this->render('create',array(
            'model'=> $model,
        ));
    }

    public function actionUpdate($id){
        $model = new LanguageForm();

        if(isset($_POST['LanguageForm'])){
            $model->attributes = $_POST['LanguageForm'];

            $oThumb = $model->languageThumb;
            $newThumb=CUploadedFile::getInstance($model, 'languageTempThumb');
            if(!empty($newThumb) && is_object($newThumb)){
                $fileName = time().'.'.$newThumb->extensionName;
                $model->languageThumb = $fileName;
            }
            if($model->update($id)){
                if(!empty($newThumb) && is_object($newThumb)){
                    $uploadDir = $this->uploadFolder.DIRECTORY_SEPARATOR.Constants::TYPE_LANGUAGE.DIRECTORY_SEPARATOR.$id;
                    if(!file_exists($uploadDir)){
                        mkdir($uploadDir, 0777, true);
                    }
                    $newThumb->saveAs($uploadDir.DIRECTORY_SEPARATOR.$fileName);

                    $oThumb = $uploadDir.DIRECTORY_SEPARATOR.$oThumb;
                    if(file_exists($oThumb) && is_file($oThumb)){
                        unlink($oThumb);
                    }
                }
                $this->redirect(Yii::app()->createUrl('language/index'));
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
        /** @var Language $model */
        $model = Language::model()->findByPk($id);
        if($model != null){
            $path = $this->uploadFolder.DIRECTORY_SEPARATOR.Constants::TYPE_LANGUAGE.DIRECTORY_SEPARATOR.$id;
            $image = $model->language_thumb;
            $model->delete();
            if(file_exists($path.DIRECTORY_SEPARATOR.$image) && is_file($path.DIRECTORY_SEPARATOR.$image)){
                unlink($path.DIRECTORY_SEPARATOR.$image);
            }
        }
        $this->redirect(Yii::app()->createUrl('language/index'));
    }

    public function actionLabels($id){
        $enLanguagePath = Yii::getPathOfAlias('application.messages.en').DIRECTORY_SEPARATOR.'common.php';
        if(!file_exists($enLanguagePath) || !is_file($enLanguagePath)){
            throw new CHttpException(400, Yii::t('common', 'msg.badRequest'));
        }

        $newLanguage = Language::model()->findByPk($id);
        if($newLanguage != null){
            $newLanguagePath = Yii::getPathOfAlias('application.messages.'.$newLanguage->language_key);
            if(!file_exists($newLanguagePath) || !is_dir($newLanguagePath)){
                mkdir($newLanguagePath, 777, true);
            }

            $newCommonLanguageFile = $newLanguage.DIRECTORY_SEPARATOR.'common.php';
            if(!file_exists($newCommonLanguageFile) || !is_file($newCommonLanguageFile)){
                if (!copy($enLanguagePath, $newCommonLanguageFile)) {
                    throw new CHttpException(400, Yii::t('common', 'msg.notExecute'));
                }
            }
        }
    }
}