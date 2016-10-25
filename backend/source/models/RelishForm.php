<?php

/**
 * This is the form model class for table "relishes".
 *
 * The followings are the available columns in table 'relishes':
 */
class RelishForm extends FormModel{
    public $relishId;
    public $relishName;
    public $relishDesc;
    public $relishPrice;
    public $relishOrderNumber;
    public $options;

    /**
    * @return array validation rules for model attributes.
    */
    public function rules(){
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('relishId, relishName', 'required'),
            array('relishPrice', 'numerical'),
            array('relishPrice','numerical','min'=>0),
            array('relishId', 'length', 'max'=>10),
            array('relishOrderNumber', 'length', 'max'=>20),
            array('relishName', 'length', 'max'=>200),
            array('relishDesc, options', 'safe'),
        );
    }

    /**
    * @return array customized attribute labels (name=>label)
    */
    public function attributeLabels(){
        return array(
            'relishId' => Yii::t('relishe', 'label.relishId'),
            'relishName' => Yii::t('relishe', 'label.relishName'),
            'relishDesc' => Yii::t('relishe', 'label.relishDesc'),
            'relishPrice' => Yii::t('relishe', 'label.relishPrice'),
            'relishOrderNumber' => Yii::t('common', 'label.orderNumber'),
        );
    }

    /**
    * Create instance form $id of model
    */
    public function loadModel($id){
        /** @var Relishes $model */
        $model = Relishes::model()->findByPk($id);
        if($model == null) throw new CException(404, Yii::t('common', 'msg.canNotFoundResource'));

        $this->relishId = $model->relish_id;
        $this->relishName = $model->relish_name;
        $this->relishDesc = $model->relish_desc;
        $this->relishPrice = $model->relish_price;
        $this->relishOrderNumber = $model->order_number;

        $methods = "";
        /** @var CookingMethod $method */
        foreach($model->methods as $method){
            $methods .= ','.$method->cm_id;
        }
        $this->options = strlen($methods)>0 ? substr($methods, 1, strlen($methods)) : "" ;
    }

    /**
    * Save to database
    */
    public function save(){
        $model = new Relishes;
        $this->relishId = $model->relish_id = DateTimeUtils::nowStr();
        $model->relish_name = $this->relishName;
        $model->relish_desc = $this->relishDesc;
        $model->relish_price = $this->relishPrice;
        $model->order_number = $this->relishOrderNumber;
        $result = $model->save();

        /** @var CDbTransaction $trans */
        $trans = Yii::app()->db->beginTransaction();
        if (!$result) {
            $trans->rollBack();
            return self::ERROR_DB;
        }

        $methods = explode(",", $this->options);
        foreach($methods as $i=>$methodId){
            $methodId = trim($methodId);
            if(!empty($methodId) && CookingMethod::model()->checkByPk($methodId)){
                $reCooking = new RefCooking();
                $reCooking->rc_id = StringUtils::generateGUID();
                $reCooking->rc_cooking_id = $methodId;
                $reCooking->rc_dest_id = $this->relishId;
                $reCooking->rc_dest_type = Constants::TYPE_TOPPING;
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
    public function update($id){
        /** @var Relishes $model */
        $model = Relishes::model()->findByPk($id);
        if ($model == null) throw new CException(404, Yii::t('common', 'msg.canNotFoundResource'));

        $model->relish_name = $this->relishName;
        $model->relish_desc = $this->relishDesc;
        $model->relish_price = $this->relishPrice;
        $model->order_number = $this->relishOrderNumber;
        $result = $model->save();

        $trans = Yii::app()->db->beginTransaction();
        if (!$result) {
            $trans->rollBack();
            return self::ERROR_DB;
        }

        $methods = explode(",", $this->options);
        RefCooking::model()->deleteAllByDestId($id, $methods, Constants::TYPE_TOPPING);
        foreach($methods as $i=>$methodId){
            $methodId = trim($methodId);
            if(!empty($methodId) && CookingMethod::model()->checkByPk($methodId)){
                if(!RefCooking::model()->checkByDestIdAndCookingId($id, $methodId, Constants::TYPE_TOPPING)){
                    $reCooking = new RefCooking;
                    $reCooking->rc_id = StringUtils::generateGUID();
                    $reCooking->rc_cooking_id = $methodId;
                    $reCooking->rc_dest_id = $id;
                    $reCooking->rc_dest_type = Constants::TYPE_TOPPING;
                    $reCooking->rc_order = $i+1;
                    $result = $result && $reCooking->save();
                }
            }
            if (!$result) {
                echo '<pre>';
                var_dump($reCooking->getErrors());
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