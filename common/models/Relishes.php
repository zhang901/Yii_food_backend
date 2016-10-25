<?php

/**
 * This is the model class for table "relishes".
 *
 * The followings are the available columns in table 'relishes':
 * @property string $relish_id
 * @property string $relish_name
 * @property string $relish_desc
 * @property double $relish_price
 * @property integer $order_number
 */
class Relishes extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'relishes';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('relish_id, relish_name', 'required'),
			array('relish_price', 'numerical'),
			array('relish_id', 'length', 'max'=>10),
            array('order_number', 'length', 'max'=>20),
			array('relish_name', 'length', 'max'=>200),
			array('relish_desc', 'safe'),
			array('relish_id, order_number, relish_name, relish_desc, relish_price', 'safe', 'on'=>'search'),
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
            'ref_method'=>array(self::HAS_MANY,'RefCooking',array('rc_dest_id'=>'relish_id'),'on'=>'ref_method.rc_dest_type = \''.Constants::TYPE_TOPPING.'\'', 'order'=>'ref_method.rc_order ASC'),
            'methods'=>array(
                self::HAS_MANY,'CookingMethod',array('rc_cooking_id'=>'cm_id'),'through'=>'ref_method'
            ),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'relish_id' => 'Relish',
			'relish_name' => Yii::t('common', 'label.name'),
			'relish_desc' => Yii::t('common', 'label.desc'),
			'relish_price' => Yii::t('common', 'label.price'),
            'order_number' => Yii::t('common', 'label.orderNumber'),
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

		$criteria->compare('relish_id',$this->relish_id,true);
		$criteria->compare('relish_name',$this->relish_name,true);
		$criteria->compare('relish_desc',$this->relish_desc,true);
		$criteria->compare('relish_price',$this->relish_price);
        $criteria->compare('order_number',$this->order_number);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
            'sort'=> array(
                'defaultOrder'=> 'order_number DESC,relish_name ASC'
            )
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Relishes the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

    public function checkByPk($relishId){
        $criteria=new CDbCriteria;
        $criteria->compare('relish_id', $relishId);
        return $this->count($criteria) > 0;
    }

    public function findIn($val){
        $criteria=new CDbCriteria;
        $criteria->addInCondition('relish_id', explode(',', $val));
        $arr = $this->findAll($criteria);
        $result = array();
        foreach($arr as $item){
            /** @var Relishes $item */
            $result[] = array(
                'id' => $item->relish_id,
                'name' => $item->relish_name,
            );
        }
        return $result;
    }
}
