<?php

/**
 * This is the model class for table "dish_transfer".
 *
 * The followings are the available columns in table 'dish_transfer':
 * @property string $dish_transfer_id
 * @property string $dish_id
 * @property string $language_id
 * @property string $dish_name
 * @property string $dish_desc
 */
class DishTransfer extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'dish_transfer';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('dish_transfer_id, dish_id, language_id, dish_name', 'required'),
            array('dish_transfer_id', 'length', 'max'=>60),
            array('dish_id, language_id', 'length', 'max'=>10),
			array('dish_name', 'length', 'max'=>255),
			array('dish_desc', 'safe'),
			array('dish_transfer_id, dish_id, language_id, dish_name, dish_desc', 'safe', 'on'=>'search'),
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
            'dish' => array(self::BELONGS_TO, 'Dish', array('dish_id'=>'dish_id')),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'dish_transfer_id' => 'Dish Transfer',
			'dish_id' => 'Dish',
			'language_id' => 'Language',
			'dish_name' => 'Dish Name',
			'dish_desc' => 'Dish Desc',
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
		$criteria=new CDbCriteria;
		$criteria->compare('dish_transfer_id',$this->dish_transfer_id,true);
		$criteria->compare('dish_id',$this->dish_id,true);
		$criteria->compare('language_id',$this->language_id,true);
		$criteria->compare('dish_name',$this->dish_name,true);
		$criteria->compare('dish_desc',$this->dish_desc,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return DishTransfer the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

    public function findAllByDishId($dishId){
        $criteria=new CDbCriteria;
        $criteria->with = array('dish');
        $criteria->together = true;
        $criteria->compare('dish.dish_id', $dishId);
        return $this->findAll($criteria);
    }
}
