<?php

/**
 * This is the model class for table "order".
 *
 * The followings are the available columns in table 'order':
 * @property string $order_id
 * @property string $order_name
 * @property string $order_tel
 * @property string $order_email
 * @property string $order_foods
 * @property string $order_requirement
 * @property string $order_time
 * @property string $order_price
 * @property string $order_topping_price
 * @property integer $order_status
 * @property string $created
 * @property string $updated
 * @property integer $delivery_id
 * @property string $order_address
 * @property integer $user_id
 * @property string $payment_type
 * @property string $deviceId
 * @property integer $chef_id
 * @property integer $table_id
 * @property integer $seats_number
 *
 *
 */
class DashBoard extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
    public $full_name;
    public $From;
    public $To;
	public function tableName()
	{
		return 'order';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('order_id, order_name, order_tel, order_topping_price, order_email, order_foods, order_time, order_status, created', 'required'),
            array('delivery_id, chef_id, table_id, seats_number, order_status, user_id', 'numerical', 'integerOnly'=>true),
            array('order_id', 'length', 'max'=>60),
            array('order_foods', 'length', 'max'=>10000),
			array('order_name', 'length', 'max'=>200),
            array('order_address, payment_type, deviceId', 'length', 'max'=>255),
			array('order_tel, order_email, order_time', 'length', 'max'=>100),
			//array('', 'length', 'max'=>30),
			array('order_id, user_id, order_name, order_tel, order_email, order_foods, order_requirement,delivery_id, order_time, order_status, created, updated', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
            'order_item' => array(self::HAS_MANY, 'OrderItem', array("oi_order_id"=>"order_id")),
            'foods'=>array(
                self::HAS_MANY,'Dish',array('oi_dish_id'=>'dish_id'), 'through'=>'order_item'
            ),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'order_id' => 'Order',
			'order_name' => 'Order Name',
			'order_tel' => 'Order Tel',
			'order_email' => 'Order Email',
			'order_foods' => 'Order Places',
			'order_requirement' => 'Order Requirement',
			'order_time' => 'Order Time',
			'order_status' => 'Order Status',
            'created' => 'Created',
            'updated' => 'Updated',
            'delivery_id'=>'Delivery Man',
            'order_address'=> 'Order Address',
            'user_id'=>'User',
            'payment_type'=> 'Payment Type',
            'deviceId'=>'Device',
            'chef_id'=>'Chef',
            'table_id'=>'Table',
            'seats_number'=> 'Seats Number'
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search($searchModel)//$searchModel
	{
        $criteria=new CDbCriteria;
		$criteria->compare('order_id',$this->order_id,true);
		$criteria->compare('order_name',$this->order_name,true);
		$criteria->compare('order_tel',$this->order_tel,true);
		$criteria->compare('order_email',$this->order_email,true);
		$criteria->compare('order_foods',$this->order_foods,true);
		$criteria->compare('order_requirement',$this->order_requirement,true);
		$criteria->compare('order_time',$this->order_time,true);
		$criteria->compare('order_status',$this->order_status,true);
        $criteria->compare('created',$this->created,true);
        $criteria->compare('updated',$this->updated,true);
        //$criteria->compare('delivery_id',$this->delivery_id,true);
        $criteria->compare('order_address',$this->order_address,true);
        $criteria->compare('user_id',$this->user_id,true);
        //$criteria->compare('chef_id',$this->chef_id,true);
        $criteria->compare('table_id',$this->table_id,true);
        $criteria->compare('seats_number',$this->seats_number,true);

        if(strlen($searchModel->Name)>0)
        {
            $criteria->compare('order_name',$searchModel->Name,true);
        }
        if(strlen($searchModel->Status)>0)
        {
            $criteria->compare('order_status',$searchModel->Status,true);
        }
        if(strlen($searchModel->From) || strlen($searchModel->To)>0)
        {
            $fromDate = date('Y-m-d',strtotime($searchModel->From));
            $toDate = date('Y-m-d',strtotime($searchModel->To));
            $criteria->addCondition("DATE_FORMAT(created, '%Y-%m-%d') >= '$fromDate'");
            $criteria->addCondition("DATE_FORMAT(created, '%Y-%m-%d') <= '$toDate'");
        }


        //$criteria->order = "order_status, updated DESC, order_time DESC";
        $criteria->order = "created DESC";

        if(Yii::app()->user->role == Constants::ROLE_DELIVERY)
        {
            $criteria->addCondition( " order_status = '".Constants::STATUS_READY."'  AND
            delivery_id !='".Yii::app()->user->id."' AND delivery_id = 0 ");
        }

        if(Yii::app()->user->role == Constants::ROLE_CHEF)
        {
            $criteria->addCondition( " order_status = '".Constants::STATUS_CREATED."'  AND
            chef_id !='".Yii::app()->user->id."' AND chef_id = 0 ");
        }


		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'pagination'=>array(
                        'pageSize'=>30,
                ),
		));
	}

    public function dashBoard()//$searchModel
    {
        $criteria=new CDbCriteria;
        $criteria->compare('order_id',$this->order_id,true);
        $criteria->compare('order_name',$this->order_name,true);
        $criteria->compare('order_tel',$this->order_tel,true);
        $criteria->compare('order_email',$this->order_email,true);
        $criteria->compare('order_foods',$this->order_foods,true);
        $criteria->compare('order_requirement',$this->order_requirement,true);
        $criteria->compare('order_time',$this->order_time,true);
        $criteria->compare('order_status',$this->order_status,true);
        $criteria->compare('created',$this->created,true);
        $criteria->compare('updated',$this->updated,true);
        //$criteria->compare('delivery_id',$this->delivery_id,true);
        $criteria->compare('order_address',$this->order_address,true);
        $criteria->compare('user_id',$this->user_id,true);
        //$criteria->compare('chef_id',$this->chef_id,true);
        $criteria->compare('table_id',$this->table_id,true);
        $criteria->compare('seats_number',$this->seats_number,true);


        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
            'pagination'=>array(
                'pageSize'=>30,
            ),
        ));
    }

    public function myOrders($searchModel)
    {
        $criteria=new CDbCriteria;

        $criteria->compare('order_id',$this->order_id,true);
        $criteria->compare('order_name',$this->order_name,true);
        $criteria->compare('order_tel',$this->order_tel,true);
        $criteria->compare('order_email',$this->order_email,true);
        $criteria->compare('order_foods',$this->order_foods,true);
        $criteria->compare('order_requirement',$this->order_requirement,true);
        $criteria->compare('order_time',$this->order_time,true);
        $criteria->compare('order_status',$this->order_status,true);
        $criteria->compare('created',$this->created,true);
        $criteria->compare('updated',$this->updated,true);
        //$criteria->compare('delivery_id',$this->delivery_id,true);
        $criteria->compare('order_address',$this->order_address,true);
        $criteria->compare('user_id',$this->user_id,true);
        //$criteria->compare('chef_id',$this->chef_id,true);
        $criteria->compare('table_id',$this->table_id,true);
        $criteria->compare('seats_number',$this->seats_number,true);

        $criteria->order = "created DESC";

        if(strlen($searchModel->Name)>0)
        {
            $criteria->compare('order_name',$searchModel->Name,true);
        }
        if(strlen($searchModel->Status)>0)
        {
            $criteria->compare('order_status',$searchModel->Status,true);
        }
        if(strlen($searchModel->From)>0 || strlen($searchModel->To)>0)
        {
            $fromDate = date('Y-m-d',strtotime($this->From));
            $toDate = date('Y-m-d',strtotime($this->To));
            $criteria->addCondition("DATE_FORMAT(created, '%Y-%m-%d') >= '$fromDate'");
            $criteria->addCondition("DATE_FORMAT(created, '%Y-%m-%d') <= '$toDate'");
        }

        $id = Yii::app()->user->id;
        if(Yii::app()->user->role == Constants::ROLE_DELIVERY)
        {
            /*$criteria->condition = " order_status = '".Constants::STATUS_READY."' OR
            order_status = '".Constants::STATUS_PENDING."' OR
            order_status = '".Constants::STATUS_DELIVERED."' OR
            order_status = '".Constants::STATUS_FAIL."' AND
            delivery_id = '".Yii::app()->user->id."' ";*/
            $criteria->addCondition( " order_status = '".Constants::STATUS_READY."' OR
            order_status = '".Constants::STATUS_PENDING."' OR
            order_status = '".Constants::STATUS_DELIVERED."' OR
            order_status = '".Constants::STATUS_FAIL."' ");
            $criteria->addCondition( " delivery_id = '".Yii::app()->user->id."' ");

        }
        if(Yii::app()->user->role == Constants::ROLE_CHEF)
        {
            /* $criteria->condition = " ( order_status = '".Constants::STATUS_CREATED."' OR
            order_status = '".Constants::STATUS_IN_PROCESS."') AND ( chef_id = $id)
            ";*/
            $criteria->addCondition( " order_status = '".Constants::STATUS_CREATED."'  OR
            order_status ='".Constants::STATUS_IN_PROCESS."' ");
            $criteria->addCondition( " chef_id = '".Yii::app()->user->id."' ");
        }


        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
            'pagination'=>array(
                'pageSize'=> 30
            )
        ));
    }
	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Order the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}


}
