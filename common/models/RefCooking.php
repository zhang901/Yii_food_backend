<?php

/**
 * This is the model class for table "ref_cooking".
 *
 * The followings are the available columns in table 'ref_cooking':
 * @property string $rc_id
 * @property string $rc_cooking_id
 * @property string $rc_dest_id
 * @property string $rc_dest_type
 * @property string $rc_order
 */
class RefCooking extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'ref_cooking';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('rc_id, rc_cooking_id, rc_dest_id, rc_dest_type, rc_order', 'required'),
			array('rc_id, rc_cooking_id, rc_dest_id', 'length', 'max'=>60),
			array('rc_dest_type', 'length', 'max'=>30),
			array('rc_order', 'length', 'max'=>10),
			array('rc_id, rc_cooking_id, rc_dest_id, rc_dest_type, rc_order', 'safe', 'on'=>'search'),
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
			'rc_id' => 'Rc',
			'rc_cooking_id' => 'Rc Cooking',
			'rc_dest_id' => 'Rc Dest',
			'rc_dest_type' => 'Rc Dest Type',
			'rc_order' => 'Rc Order',
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
		$criteria->compare('rc_id',$this->rc_id,true);
		$criteria->compare('rc_cooking_id',$this->rc_cooking_id,true);
		$criteria->compare('rc_dest_id',$this->rc_dest_id,true);
		$criteria->compare('rc_dest_type',$this->rc_dest_type,true);
		$criteria->compare('rc_order',$this->rc_order,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return RefCooking the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

    public function deleteAllByDestId($destId, $methods, $destType){
        $criteria=new CDbCriteria;
        $criteria->compare('rc_dest_id', $destId);
        $criteria->compare('rc_dest_type', $destType);
        if(count($methods) > 0){
            $criteria->addNotInCondition('rc_cooking_id', $methods);
        }
        $this->deleteAll($criteria);
    }

    public function checkByDestIdAndCookingId($apartId, $methodId, $destType){
        $criteria=new CDbCriteria;
        $criteria->compare('rc_dest_id', $apartId);
        $criteria->compare('rc_dest_type', $destType);
        $criteria->compare('rc_cooking_id', $methodId);
        return $this->count($criteria) > 0;
    }
}
