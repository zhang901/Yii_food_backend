<?php

/**
 * This is the form model class for table "cooking_method".
 *
 * The followings are the available columns in table 'cooking_method':
 */
class CookingMethodForm extends FormModel{
    public $cmId;
    public $cmName;
    public $cmDesc;
    public $cmParentId;
    public $cmType;
    public $created;
    public $updated;
    public $cmOrderNumber;

    /**
    * @return array validation rules for model attributes.
    */
    public function rules(){
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('cmId, cmName, cmParentId, cmType, created', 'required'),
            array('cmId', 'length', 'max' => 60),
            array('cmOrderNumber', 'numerical', 'integerOnly'=>true),
            array('cmName', 'length', 'max' => 200),
            array('cmDesc, updated', 'safe'),
        );
    }

    /**
    * @return array customized attribute labels (name=>label)
    */
    public function attributeLabels(){
        return array(
            'cmId' => Yii::t('common', 'label.cmId'),
            'cmName' => Yii::t('common', 'label.cmName'),
            'cmDesc' => Yii::t('common', 'label.cmDesc'),
            'cmParentId' => Yii::t('common', 'label.cmParentId'),
            'cmType' => Yii::t('common', 'label.cmType'),
            'created' => Yii::t('common', 'label.created'),
            'updated' => Yii::t('common', 'label.updated'),
            'cmOrderNumber' => Yii::t('common', 'label.orderNumber'),
        );
    }

    /**
    * Create instance form $id of model
    */
    public function loadModel($id){
        /** @var CookingMethod $model */
        $model = CookingMethod::model()->findByPk($id);
        if($model == null) throw new CException(404, Yii::t('common', 'msg.canNotFoundResource'));

        $this->cmId = $model->cm_id;
        $this->cmName = $model->cm_name;
        $this->cmDesc = $model->cm_desc;
        $this->cmParentId = $model->cm_parent_id;
        $this->cmType = $model->cm_type;
        $this->created = $model->created;
        $this->updated = $model->updated;
        $this->cmOrderNumber = $model->order_number;
    }

    /**
    * Save to database
    */
    public function save(){
        $model = new CookingMethod;
        $this->cmId = $model->cm_id = DateTimeUtils::nowStr();
        $model->cm_name = $this->cmName;
        $model->cm_desc = $this->cmDesc;
        $model->cm_parent_id = $this->cmParentId;
        $model->cm_group = (isset($this->cmParentId) && $this->cmParentId) ? $this->cmParentId : $this->cmId;
        $model->cm_type = $this->cmType;
        $model->order_number = $this->cmOrderNumber;
        $model->created = $model->updated = DateTimeUtils::now();
        $result = $model->save();
        if (!$result){
            echo '<pre>'; var_dump($model->getErrors());die;
            return self::ERROR_DB;
        }
        return self::ERROR_NONE;
    }

    /**
    * Save to database
    */
    public function update($id){
        /** @var CookingMethod $model */
        $model = CookingMethod::model()->findByPk($id);
        if ($model == null) throw new CException(404, Yii::t('common', 'msg.canNotFoundResource'));

        $model->cm_name = $this->cmName;
        $model->cm_desc = $this->cmDesc;
        $model->cm_parent_id = $this->cmParentId;
        $model->cm_type = $this->cmType;
        $model->order_number = $this->cmOrderNumber;
        $model->cm_group = (isset($this->cmParentId) && $this->cmParentId) ? $this->cmParentId : $id;
        $model->updated = DateTimeUtils::now();
        $result = $model->save();
        if (!$result){
            echo '<pre>'; var_dump($model->getErrors());die;
            return self::ERROR_DB;
        }
        return self::ERROR_NONE;
    }
}