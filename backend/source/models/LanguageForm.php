<?php

/**
 * This is the form model class for table "language".
 *
 * The followings are the available columns in table 'language':
 */
class LanguageForm extends FormModel{
    public $languageId;
    public $languageName;
    public $languageThumb;
    public $languageIsDefault;
    public $languageTempThumb;

    /**
    * @return array validation rules for model attributes.
    */
    public function rules(){
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
                    array('languageId, languageName, languageThumb', 'required'),
                    array('languageIsDefault', 'numerical', 'integerOnly'=>true),
                    array('languageId', 'length', 'max'=>10),
                    array('languageName', 'length', 'max'=>100),
                    array('languageThumb', 'length', 'max'=>255),
                    array('languageTempThumb', 'safe'),
                );
    }

    /**
    * @return array customized attribute labels (name=>label)
    */
    public function attributeLabels(){
    return array(
            'languageId' => Yii::t('language', 'label.languageId'),
            'languageName' => Yii::t('language', 'label.languageName'),
            'languageThumb' => Yii::t('language', 'label.languageThumb'),
            'languageIsDefault' => Yii::t('language', 'label.languageIsDefault'),
        );
    }

    /**
    * Create instance form $id of model
    */
    public function loadModel($id){
        /** @var Language $model */
        $model = Language::model()->findByPk($id);
        if($model == null) throw new CException(404, Yii::t('common', 'msg.canNotFoundResource'));

            $this->languageId = $model->language_id;
            $this->languageName = $model->language_name;
            $this->languageThumb = $model->language_thumb;
            $this->languageIsDefault = $model->language_is_default;
        }

    /**
    * Save to database
    */
    public function save(){
        $model = new Language;
                    $this->languageId = $model->language_id = DateTimeUtils::nowStr();
                        $model->language_name = $this->languageName;
                        $model->language_thumb = $this->languageThumb;
                        $model->language_is_default = $this->languageIsDefault;
                    $result = $model->save();
        if (!$result) {
            return false;
        }
        return true;
    }

    /**
    * Save to database
    */
    public function update($id){
        /** @var Language $model */
        $model = Language::model()->findByPk($id);
        if($model == null) throw new CException(404, Yii::t('common', 'msg.canNotFoundResource'));

                                    $model->language_name = $this->languageName;
                            $model->language_thumb = $this->languageThumb;
                            $model->language_is_default = $this->languageIsDefault;
                    $result = $model->save();
        if (!$result) {
            return false;
        }
        return true;
    }
}