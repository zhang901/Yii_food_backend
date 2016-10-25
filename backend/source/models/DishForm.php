<?php

/**
 * This is the form model class for table "dish".
 *
 * The followings are the available columns in table 'dish':
 */
class DishForm extends FormModel
{
    public $dishId;
    public $dishName;
    public $dishPrice;
    public $dishPromotion;
    public $dishUrlsImage;
    public $dishUrlsVideo;
    public $dishThumb;
    public $dishSmallThumb;
    public $dishMenu;
    public $dishDesc;
    public $dishTempThumb;
    public $dishSmallTempThumb;
    public $order_number;
    public $languages = array();


    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('dishId, dishName, dishPrice, dishThumb, dishMenu', 'required'),
            array('dishPrice, dishPromotion', 'numerical'),
            array('dishId', 'length', 'max' => 10),
            array('order_number', 'length', 'max' => 20),
            array('dishPrice','numerical','min'=>0),
            array('dishName, dishThumb, dishSmallThumb', 'length', 'max' => 255),
            array('dishMenu', 'length', 'max' => 120),
            array('dishUrlsImage, dishUrlsVideo, dishDesc', 'safe'),
            array('dishTempThumb, dishSmallTempThumb, languages', 'safe'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'dishId' => Yii::t('common', 'label.dishId'),
            'dishName' => Yii::t('common', 'label.dishName'),
            'dishPrice' => Yii::t('common', 'label.dishPrice'),
            'dishPromotion' => Yii::t('common', 'label.dishPromotion'),
            'dishUrlsImage' => Yii::t('common', 'label.dishUrlsImage'),
            'dishUrlsVideo' => Yii::t('common', 'label.dishUrlsVideo'),
            'dishThumb' => Yii::t('common', 'label.dishThumb'),
            'dishSmallThumb' => Yii::t('common', 'label.dishSmallThumb'),
            'dishMenu' => Yii::t('common', 'label.dishMenu'),
            'dishDesc' => Yii::t('common', 'label.dishDesc'),
            'order_number'=> Yii::t('common', 'label.orderNumber')
        );
    }

    /**
     * Create instance form $id of model
     */
    public function loadModel($id)
    {
        /** @var Dish $model */
        $model = Dish::model()->findByPk($id);
        if ($model == null) throw new CException(404, Yii::t('common', 'msg.canNotFoundResource'));

        $this->dishId = $model->dish_id;
        $this->dishName = $model->dish_name;
        $this->dishPrice = $model->dish_price;
        $this->dishPromotion = $model->dish_promotion;
        $this->dishUrlsImage = $model->dish_urls_image;
        $this->dishUrlsVideo = $model->dish_urls_video;
        $this->dishThumb = $model->dish_thumb;
        $this->dishSmallThumb = $model->dish_small_thumb;
        $this->dishMenu = $model->dish_menu;
        $this->dishDesc = $model->dish_desc;
        $this->order_number = $model->order_number;
    }

    /**
     * Save to database
     */
    public function save($defaultLanguageId)
    {
        $model = new Dish;
        $this->dishId = $model->dish_id = DateTimeUtils::nowStr();
        $model->dish_name = $this->dishName;
        $model->dish_price = $this->dishPrice;
        $model->dish_promotion = $this->dishPromotion;
        $model->dish_urls_image = $this->dishUrlsImage;
        $model->dish_urls_video = $this->dishUrlsVideo;
        $model->dish_thumb = $this->dishThumb;
        $model->dish_small_thumb = 'S'.$this->dishThumb;
        $model->dish_menu = $this->dishMenu;
        $model->dish_desc = $this->dishDesc;
        $model->order_number = $this->order_number;
        $model->created = $model->updated = DateTimeUtils::now();

        $trans = Yii::app()->db->beginTransaction();
        $result = $model->save();
        if (!$result) {
            echo '<pre>'; var_dump($model->getErrors()); die;
            $trans->rollBack();
            return self::ERROR_DB;
        }

        $defaultLanguage = new DishTransfer();
        $defaultLanguage->dish_transfer_id = StringUtils::generateGUID();
        $defaultLanguage->dish_id = $model->dish_id;
        $defaultLanguage->dish_name = $this->dishName;
        $defaultLanguage->dish_desc = $this->dishDesc;
        $defaultLanguage->language_id = $defaultLanguageId;
        $result = $defaultLanguage->save();

        if (!$result) {
            echo '<pre>'; var_dump($defaultLanguage->getErrors()); die;
            $trans->rollBack();
            return self::ERROR_DB;
        }

        foreach($this->languages as $langId => $lang){
            if(empty($lang["languageName"])) continue;
            $transfer = new DishTransfer();
            $transfer->dish_transfer_id = StringUtils::generateGUID();
            $transfer->dish_id = $model->dish_id;
            $transfer->dish_name = $lang["languageName"];
            $transfer->dish_desc = $lang["languageDesc"];
            $transfer->language_id = $langId;
            $result &= $transfer->save();
        }
        if (!$result) {
            $trans->rollBack();
            return self::ERROR_DB;
        }

        $trans->commit();
        return self::ERROR_NONE;
    }

    /**
     * Save to database
     */
    public function update($id, $defaultLanguageId)
    {
        /** @var Dish $model */
        $model = Dish::model()->findByPk($id);
        if ($model == null) throw new CException(404, Yii::t('common', 'msg.canNotFoundResource'));

        $model->dish_name = $this->dishName;
        $model->dish_price = $this->dishPrice;
        $model->dish_promotion = $this->dishPromotion;
        $model->dish_urls_image = $this->dishUrlsImage;
        $model->dish_urls_video = $this->dishUrlsVideo;
        $model->dish_thumb = $this->dishThumb;
        $model->dish_small_thumb = 'S'.$this->dishThumb;
        $model->dish_menu = $this->dishMenu;
        $model->dish_desc = $this->dishDesc;
        $model->order_number = $this->order_number;
        $model->updated = DateTimeUtils::now();

        $trans = Yii::app()->db->beginTransaction();
        $result = $model->save();
        if (!$result) {
            return self::ERROR_DB;
        }

        $criteria = new CDbCriteria;
        $criteria->compare('dish_id', $id);
        $criteria->compare('language_id', $defaultLanguageId);
        $defaultLanguage = DishTransfer::model()->find($criteria);
        if($defaultLanguage == null){
            $defaultLanguage = new DishTransfer();
            $defaultLanguage->dish_transfer_id = StringUtils::generateGUID();
            $defaultLanguage->language_id = $defaultLanguageId;
            $defaultLanguage->dish_id = $model->dish_id;
        }
        $defaultLanguage->dish_name = $this->dishName;
        $defaultLanguage->dish_desc = $this->dishDesc;

        $result = $defaultLanguage->save();
        if (!$result) {
            return self::ERROR_DB;
        }
        foreach($this->languages as $langId => $lang){
            if(empty($lang["languageName"])) continue;
            $criteria = new CDbCriteria;
            $criteria->compare('dish_id', $id);
            $criteria->compare('language_id', $langId);
            $transfer = DishTransfer::model()->find($criteria);
            if($transfer == null){
                $transfer = new DishTransfer();
                $transfer->dish_transfer_id = StringUtils::generateGUID();
                $transfer->language_id = $langId;
                $transfer->dish_id = $model->dish_id;
            }
            $transfer->dish_name = $lang["languageName"];
            $transfer->dish_desc = $lang["languageDesc"];
            $result &= $transfer->save();
        }
        if (!$result) {
            $trans->rollBack();
            return self::ERROR_DB;
        }

        $trans->commit();
        return self::ERROR_NONE;
    }
}