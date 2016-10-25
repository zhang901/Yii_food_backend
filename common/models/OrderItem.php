<?php

/**
 * This is the model class for table "order_item".
 *
 * The followings are the available columns in table 'order_item':
 * @property string $oi_id
 * @property string $oi_dish_id
 * @property string $oi_dish_quantity
 * @property double $oi_dish_price
 * @property string $oi_order_id
 * @property string $oi_instruction
 * @property double $oi_topping_price
 * @property string $oi_toppings
 * @property string $oi_cooking_method
 * @property integer $oi_is_panini
 */
class OrderItem extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'order_item';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('oi_id, oi_dish_id, oi_dish_quantity, oi_dish_price, oi_order_id, oi_is_panini', 'required'),
			array('oi_is_panini', 'numerical', 'integerOnly'=>true),
			array('oi_dish_price, oi_topping_price', 'numerical'),
			array('oi_id, oi_order_id', 'length', 'max'=>60),
			array('oi_dish_id, oi_dish_quantity', 'length', 'max'=>10),
			array('oi_instruction, oi_toppings, oi_cooking_method', 'safe'),
			array('oi_id, oi_dish_id, oi_dish_quantity, oi_dish_price, oi_order_id, oi_instruction, oi_topping_price, oi_toppings, oi_cooking_method, oi_is_panini', 'safe', 'on'=>'search'),
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
			'oi_id' => 'Oi',
			'oi_dish_id' => 'Oi Dish',
			'oi_dish_quantity' => 'Oi Dish Quantity',
			'oi_dish_price' => 'Oi Dish Price',
			'oi_order_id' => 'Oi Order',
			'oi_instruction' => 'Oi Instruction',
			'oi_topping_price' => 'Oi Topping Price',
			'oi_toppings' => 'Oi Toppings',
			'oi_cooking_method' => 'Oi Cooking Method',
			'oi_is_panini' => 'Oi Is Panini',
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

		$criteria->compare('oi_id',$this->oi_id,true);
		$criteria->compare('oi_dish_id',$this->oi_dish_id,true);
		$criteria->compare('oi_dish_quantity',$this->oi_dish_quantity,true);
		$criteria->compare('oi_dish_price',$this->oi_dish_price);
		$criteria->compare('oi_order_id',$this->oi_order_id,true);
		$criteria->compare('oi_instruction',$this->oi_instruction,true);
		$criteria->compare('oi_topping_price',$this->oi_topping_price);
		$criteria->compare('oi_toppings',$this->oi_toppings,true);
		$criteria->compare('oi_cooking_method',$this->oi_cooking_method,true);
		$criteria->compare('oi_is_panini',$this->oi_is_panini);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return OrderItem the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
