<?php

/**
 * This is the form model class for table "order".
 *
 * The followings are the available columns in table 'order':
 */
class OrderForm extends FormModel{
    public $orderId;
    public $orderName;
    public $orderTel;
    public $orderEmail;
    public $orderPlaces;
    public $orderRequirement;
    public $orderTime;
    public $orderStatus;
    public $created;

    /**
    * @return array validation rules for model attributes.
    */
    public function rules(){
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
                    array('orderId, orderName, orderTel, orderEmail, orderPlaces, orderRequirement, orderTime, orderStatus, created', 'required'),
                    array('orderId, orderPlaces', 'length', 'max'=>10),
                    array('orderName', 'length', 'max'=>200),
                    array('orderTel, orderEmail, orderTime', 'length', 'max'=>100),
                    array('orderStatus', 'length', 'max'=>30),
                );
    }

    /**
    * @return array customized attribute labels (name=>label)
    */
    public function attributeLabels(){
    return array(
            'orderId' => Yii::t('order', 'label.orderId'),
            'orderName' => Yii::t('order', 'label.orderName'),
            'orderTel' => Yii::t('order', 'label.orderTel'),
            'orderEmail' => Yii::t('order', 'label.orderEmail'),
            'orderPlaces' => Yii::t('order', 'label.orderPlaces'),
            'orderRequirement' => Yii::t('order', 'label.orderRequirement'),
            'orderTime' => Yii::t('order', 'label.orderTime'),
            'orderStatus' => Yii::t('order', 'label.orderStatus'),
            'created' => Yii::t('order', 'label.created'),
        );
    }

    /**
    * Create instance form $id of model
    */
    public function loadModel($id){
        /** @var Order $model */
        $model = Order::model()->findByPk($id);
        if($model == null) throw new CException(404, Yii::t('common', 'msg.canNotFoundResource'));

            $this->orderId = $model->order_id;
            $this->orderName = $model->order_name;
            $this->orderTel = $model->order_tel;
            $this->orderEmail = $model->order_email;
            $this->orderPlaces = $model->order_places;
            $this->orderRequirement = $model->order_requirement;
            $this->orderTime = $model->order_time;
            $this->orderStatus = $model->order_status;
            $this->created = $model->created;
        }

    /**
    * Save to database
    */
    public function save(){
        $model = new Order;
                    $this->orderId = $model->order_id = DateTimeUtils::nowStr();
                        $model->order_name = $this->orderName;
                        $model->order_tel = $this->orderTel;
                        $model->order_email = $this->orderEmail;
                        $model->order_places = $this->orderPlaces;
                        $model->order_requirement = $this->orderRequirement;
                        $model->order_time = $this->orderTime;
                        $model->order_status = $this->orderStatus;
                        $model->created = $this->created;
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
        /** @var Order $model */
        $model = Order::model()->findByPk($id);
        if($model == null) throw new CException(404, Yii::t('common', 'msg.canNotFoundResource'));

                                    $model->order_name = $this->orderName;
                            $model->order_tel = $this->orderTel;
                            $model->order_email = $this->orderEmail;
                            $model->order_places = $this->orderPlaces;
                            $model->order_requirement = $this->orderRequirement;
                            $model->order_time = $this->orderTime;
                            $model->order_status = $this->orderStatus;
                            $model->created = $this->created;
                    $result = $model->save();
        if (!$result) {
            return false;
        }
        return true;
    }
}