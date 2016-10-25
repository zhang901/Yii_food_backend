<?php

/**
 * This is the model class for table "account".
 *
 * The followings are the available columns in table 'admin':
 * @property integer $id
 * @property string $username
 * @property string $password
 * @property string $email
 * @property integer $role
 * @property string $full_name
 * @property string $address
 * @property string $phone
 * @property string $token
 * @property integer $status
 */
class Account extends ActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'account';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
            array('role, status, id', 'numerical', 'integerOnly'=>true),
			//array('username, password, email', 'required'),
			array('username', 'length', 'max'=>30),
			array('password', 'length', 'max'=>60),
            array('email', 'length', 'max'=>100),
            array('phone', 'length', 'max'=>30),
            array('full_name', 'length', 'max'=>150),
            array('address', 'length', 'max'=>300),
            array('token', 'length', 'max'=>50),

            // The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, username, password, email, role, status, full_name, address, phone', 'safe', 'on'=>'search'),
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
			'username' => 'Username',
			'password' => 'Password',
            'email' => 'Email',
            'role'=>'Role',
            'status'=>'Status',
            'full_name' => 'Full Name',
            'address' => 'Address',
            'phone' => 'Phone',
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
	public function search($searchModel)
	{
		// @todo Please modify the following code to remove attributes that should not be searched.


		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id,true);
		$criteria->compare('username',$this->username,true);
        $criteria->compare('username',$searchModel->Name,true);
        $criteria->compare('role',$searchModel->Role,true);
		$criteria->compare('password',$this->password,true);
        $criteria->compare('email',$this->email,true);
        $criteria->compare('role',$this->role);
        $criteria->compare('full_name',$this->full_name,true);
        $criteria->compare('address',$this->address,true);
        $criteria->compare('phone',$this->phone,true);
        $criteria->compare('status',$this->status);
        $criteria->compare('token',$this->token);

        /*if($inactiveRole != null)
            $criteria->addCondition('role != '.$inactiveRole);*/

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

    public function checkExistEmail($email)
    {
        $criteria=new CDbCriteria;
        $criteria->compare('email',$email);
        return $this->count($criteria)>0;
    }

    public function checkExistUserName($userName)
    {
        $criteria=new CDbCriteria;
        $criteria->compare('username',$userName);
        return $this->count($criteria)>0;
    }

    public function getAccount($userName,$pass)
    {
        $criteria=new CDbCriteria;
        $criteria->compare('username',$userName);
        $criteria->compare('password',$pass);
       // $criteria->compare('role',0);
       // $criteria->compare('status',1);
        return $this->find($criteria);
    }


    public function getListAccountRoleDeliveryMan()
    {
        $criteria=new CDbCriteria;
        $criteria->addCondition('role=1');
        $criteria->compare('status',1);

        return $this->findAll($criteria);
    }

    public function getListAccountRoleCustomer()
    {
        $criteria=new CDbCriteria;
        $criteria->addCondition('role=0');
        $criteria->compare('status',1);

        return $this->findAll($criteria);
    }


	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Account the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
