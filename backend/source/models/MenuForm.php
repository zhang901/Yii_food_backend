<?php

/**
 * This is the form model class for table "menus".
 *
 * The followings are the available columns in table 'menus':
 */
class MenuForm extends FormModel{
    public $menuId;
    public $menuName;
    public $menuThumb;
    public $menuDesc;
    public $menuTempThumb;
    public $menuIsPanini;
    public $menuCookingMethods;
    public $menuRelishes;
    public $menuOrderNumber;
    public $languages = array();

    /**
    * @return array validation rules for model attributes.
    */
    public function rules(){
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('menuId, menuName', 'required'),
            array('menuId', 'length', 'max'=>10),
            array('menuOrderNumber', 'length', 'max'=>20),
            array('menuName, menuThumb', 'length', 'max'=>255),
            array('menuTempThumb, menuDesc, menuCookingMethods, menuRelishes, menuIsPanini, languages', 'safe'),
        );
    }

    /**
    * @return array customized attribute labels (name=>label)
    */
    public function attributeLabels(){
        return array(
            'menuId' => Yii::t('common', 'label.menuId'),
            'menuName' => Yii::t('common', 'label.menuName'),
            'menuThumb' => Yii::t('common', 'label.menuThumb'),
            'menuDesc' => Yii::t('common', 'label.menuDesc'),
            'menuIsPanini' => Yii::t('common', 'label.menuIsPanini'),
            'menuOrderNumber' => Yii::t('common', 'label.orderNumber')
        );
    }

    /**
    * Create instance form $id of model
    */
    public function loadModel($id){
        /** @var Menus $model */
        $model = Menus::model()->findByPk($id);
        if($model == null) throw new CException(404, Yii::t('common', 'msg.canNotFoundResource'));

        $this->menuId = $model->menu_id;
        $this->menuName = $model->menu_name;
        $this->menuThumb = $model->menu_thumb;
        $this->menuDesc = $model->menu_desc;
        $this->menuIsPanini = $model->menu_is_panini;
        $this->menuOrderNumber = $model->order_number;
        $relishes = "";
        /** @var Relishes $relish */
        foreach($model->relishes as $relish){
            $relishes .= ','.$relish->relish_id;
        }
        $this->menuRelishes = strlen($relishes)>0 ? substr($relishes, 1, strlen($relishes)) : "" ;

        $cookingMethods = "";
        /** @var CookingMethod $method */
        foreach($model->methods as $method){
            $cookingMethods .= ','.$method->cm_id;
        }
        $this->menuCookingMethods = strlen($cookingMethods)>0 ? substr($cookingMethods, 1, strlen($cookingMethods)) : "" ;
    }

    /**
    * Save to database
    */
    public function save($defaultLanguageId){
        $model = new Menus;
        $this->menuId = $model->menu_id = DateTimeUtils::nowStr();
        $model->menu_name = $this->menuName;
        $model->menu_thumb = $this->menuThumb;
        $model->menu_desc = $this->menuDesc;
        $model->menu_is_panini = isset($this->menuIsPanini) ? $this->menuIsPanini : false;
        $model->order_number = $this->menuOrderNumber;
        $model->created = $model->updated = DateTimeUtils::now();

        $trans = Yii::app()->db->beginTransaction();
        $result = $model->save();
        if (!$result) {
            $trans->rollBack();
            return self::ERROR_DB;
        }

        $defaultLanguage = new MenuTransfer();
        $defaultLanguage->menu_transfer_id = StringUtils::generateGUID();
        $defaultLanguage->menu_id = $model->menu_id;
        $defaultLanguage->menu_name = $this->menuName;
        $defaultLanguage->menu_desc = $this->menuDesc;
        $defaultLanguage->language_id = $defaultLanguageId;
        $result = $defaultLanguage->save();

        if (!$result) {
            $trans->rollBack();
            return self::ERROR_DB;
        }
        foreach($this->languages as $langId => $lang){
            if(empty($lang["languageName"])) continue;
            $transfer = new MenuTransfer();
            $transfer->menu_transfer_id = StringUtils::generateGUID();
            $transfer->menu_id = $model->menu_id;
            $transfer->menu_name = $lang["languageName"];
            $transfer->menu_desc = $lang["languageDesc"];
            $transfer->language_id = $langId;
            $result &= $transfer->save();
        }
        if (!$result) {
            $trans->rollBack();
            return self::ERROR_DB;
        }

        $relishes = explode(",", $this->menuRelishes);
        foreach($relishes as $i=>$relishId){
            $relishId = trim($relishId);
            if(!empty($relishId) && Relishes::model()->checkByPk($relishId)){
                $reRelish = new RefRelish();
                $reRelish->rr_id = StringUtils::generateGUID();
                $reRelish->rr_relish_id = $relishId;
                $reRelish->rr_dest_id = $this->menuId;
                $reRelish->rr_dest_type = Constants::TYPE_MENU;
                $reRelish->rr_order = $i+1;
                $result = $result && $reRelish->save();
            }
        }
        if (!$result) {
            $trans->rollBack();
            return self::ERROR_DB;
        }

        $methods = explode(",", $this->menuCookingMethods);
        foreach($methods as $i=>$methodId){
            $methodId = trim($methodId);
            if(!empty($methodId) && CookingMethod::model()->checkByPk($methodId)){
                $reCooking = new RefCooking();
                $reCooking->rc_id = StringUtils::generateGUID();
                $reCooking->rc_cooking_id = $methodId;
                $reCooking->rc_dest_id = $this->menuId;
                $reCooking->rc_dest_type = Constants::TYPE_MENU;
                $reCooking->rc_order = $i+1;
                $result = $result && $reCooking->save();
            }
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
    public function update($id, $defaultLanguageId){
        /** @var Menus $model */
        $model = Menus::model()->findByPk($id);
        if($model == null) throw new CException(404, Yii::t('common', 'msg.canNotFoundResource'));
        $this->menuId = $id;

        $model->menu_name = $this->menuName;
        $model->menu_thumb = $this->menuThumb;
        $model->menu_desc = $this->menuDesc;
        $model->menu_is_panini = isset($this->menuIsPanini) ? $this->menuIsPanini : false;
        $model->order_number = $this->menuOrderNumber;
        $model->updated = DateTimeUtils::now();

        $trans = Yii::app()->db->beginTransaction();
        $result = $model->save();
        if (!$result) {
            $trans->rollBack();
            return self::ERROR_DB;
        }

        $criteria = new CDbCriteria;
        $criteria->compare('menu_id', $id);
        $criteria->compare('language_id', $defaultLanguageId);
        $defaultLanguage = MenuTransfer::model()->find($criteria);
        if($defaultLanguage == null){
            $defaultLanguage = new MenuTransfer();
            $defaultLanguage->menu_transfer_id = StringUtils::generateGUID();
            $defaultLanguage->language_id = $defaultLanguageId;
            $defaultLanguage->menu_id = $model->menu_id;
        }
        $defaultLanguage->menu_name = $this->menuName;
        $defaultLanguage->menu_desc = $this->menuDesc;

        $result = $defaultLanguage->save();
        if (!$result) {
            $trans->rollBack();
            return self::ERROR_DB;
        }
        foreach($this->languages as $langId => $lang){
            if(empty($lang["languageName"])) continue;
            $criteria = new CDbCriteria;
            $criteria->compare('menu_id', $id);
            $criteria->compare('language_id', $langId);
            $transfer = MenuTransfer::model()->find($criteria);
            if($transfer == null){
                $transfer = new MenuTransfer();
                $transfer->menu_transfer_id = StringUtils::generateGUID();
                $transfer->language_id = $langId;
                $transfer->menu_id = $model->menu_id;
            }
            $transfer->menu_name = $lang["languageName"];
            $transfer->menu_desc = $lang["languageDesc"];
            $result &= $transfer->save();
        }
        if (!$result) {
            $trans->rollBack();
            return self::ERROR_DB;
        }

        $menuRelishes = explode(",", $this->menuRelishes);
        RefRelish::model()->deleteAllByDestId($this->menuId, $menuRelishes, Constants::TYPE_MENU);
        foreach($menuRelishes as $i=>$relishId){
            $relishId = trim($relishId);
            if(!empty($relishId) && Relishes::model()->checkByPk($relishId)){
                if(!RefRelish::model()->checkByDestIdAndRelishId($this->menuId, $relishId, Constants::TYPE_MENU)){
                    $reService = new RefRelish;
                    $reService->rr_id = StringUtils::generateGUID();
                    $reService->rr_relish_id = $relishId;
                    $reService->rr_dest_id = $this->menuId;
                    $reService->rr_dest_type = Constants::TYPE_MENU;
                    $reService->rr_order = $i+1;
                    $result = $result && $reService->save();
                }
            }
        }
        if (!$result) {
            $trans->rollBack();
            return self::ERROR_DB;
        }

        $menuCookingMethods = explode(",", $this->menuCookingMethods);
        RefCooking::model()->deleteAllByDestId($this->menuId, $menuCookingMethods, Constants::TYPE_MENU);
        foreach($menuCookingMethods as $i=>$methodId){
            $methodId = trim($methodId);
            if(!empty($methodId) && CookingMethod::model()->checkByPk($methodId)){
                if(!RefCooking::model()->checkByDestIdAndCookingId($this->menuId, $methodId, Constants::TYPE_MENU)){
                    $reCooking = new RefCooking;
                    $reCooking->rc_id = StringUtils::generateGUID();
                    $reCooking->rc_cooking_id = $methodId;
                    $reCooking->rc_dest_id = $this->menuId;
                    $reCooking->rc_dest_type = Constants::TYPE_MENU;
                    $reCooking->rc_order = $i+1;
                    $result = $result && $reCooking->save();
                }
            }
        }
        if (!$result) {
            $trans->rollBack();
            return self::ERROR_DB;
        }

        $trans->commit();
        return self::ERROR_NONE;
    }
}