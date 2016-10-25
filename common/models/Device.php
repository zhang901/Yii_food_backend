<?php

/**
 * This is the model class for table "device".
 *
 * The followings are the available columns in table 'device':
 * @property integer $id
 * @property string $gcm_id
 * @property string $ime
 * @property integer $type
 * @property integer $status
 * @property integer $user_id
 */
class Device extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'device';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('type, status,user_id', 'numerical', 'integerOnly'=>true),
			array('gcm_id, ime', 'length', 'max'=>255),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, gcm_id, ime, type, status,user_id', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'gcm_id' => 'Gcm',
			'ime' => 'Ime',
			'type' => 'Type',
			'status' => 'Status',
            'user_id'=>'User'
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
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('gcm_id',$this->gcm_id,true);
		$criteria->compare('ime',$this->ime,true);
		$criteria->compare('type',$this->type);
		$criteria->compare('status',$this->status);
        $criteria->compare('user_id',$this->user_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Device the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

    public function findDevicesByRole($roleId, $typeId){
        $userByRoleArray = Account::model()->findAll('role ='.$roleId);
        $deviceGCMsByRoleArray = array();
        if(count($userByRoleArray)>0)
        {
            foreach($userByRoleArray as $user)
            {
                $userId = $user->id;
                $deviceByUserArray = Device::model()->findAll('user_id ='.$userId.' and status = 1 and type = '.$typeId);
                foreach($deviceByUserArray as $device)
                {
                    array_push( $deviceGCMsByRoleArray, $device->gcm_id);
                }
            }
        }
        return $deviceGCMsByRoleArray;
    }

    public function findDevicesByUserId($userId, $typeId){
        $deviceArray = Device::model()->findAll('user_id ='.$userId.' and status = 1 and type = '.$typeId);
		$GCM = array();
        if(count($deviceArray)>0)
        {			
			foreach($deviceArray as $device)
			{
				if (strlen($device->gcm_id) > 0)
				{
					$GCM[] = $device->gcm_id;
				}
			}            
        }
        return $GCM;
    }
	
	public function findDevicesByOrderId($orderId, $typeId){
		$order = Order::model()->findByPk($orderId);
		
		if (isset($order->user_id))
		{			
			$deviceArray = Device::model()->findAll('user_id ='.$order->user_id.' and status = 1 and type = '.$typeId);
		}
		else
		{		
			$deviceArray = Device::model()->findAll('ime ="'.$order->deviceId.'" and status = 1 and type = '.$typeId);
		}
		$GCM = array();
        if(count($deviceArray)>0)
        {			
			foreach($deviceArray as $device)
			{
				if (strlen($device->gcm_id) > 0)
				{
					$GCM[] = $device->gcm_id;
				}
			}            
        }
        return $GCM;
    }
}
