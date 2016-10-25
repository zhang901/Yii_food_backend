<?php

/**
 * This is the model class for table "ref_relish".
 *
 * The followings are the available columns in table 'ref_relish':
 * @property string $rr_id
 * @property string $rr_relish_id
 * @property string $rr_dest_id
 * @property string $rr_dest_type
 * @property string $rr_order
 */
class RefRelish extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'ref_relish';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('rr_id, rr_relish_id, rr_dest_id, rr_dest_type, rr_order', 'required'),
			array('rr_id, rr_relish_id, rr_dest_id', 'length', 'max'=>60),
			array('rr_dest_type', 'length', 'max'=>30),
			array('rr_order', 'length', 'max'=>10),
			array('rr_id, rr_relish_id, rr_dest_id, rr_dest_type, rr_order', 'safe', 'on'=>'search'),
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
			'rr_id' => 'Rr',
			'rr_relish_id' => 'Rr Relish',
			'rr_dest_id' => 'Rr Dest',
			'rr_dest_type' => 'Rr Dest Type',
			'rr_order' => 'Rr Order',
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
		$criteria->compare('rr_id',$this->rr_id,true);
		$criteria->compare('rr_relish_id',$this->rr_relish_id,true);
		$criteria->compare('rr_dest_id',$this->rr_dest_id,true);
		$criteria->compare('rr_dest_type',$this->rr_dest_type,true);
		$criteria->compare('rr_order',$this->rr_order,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return RefRelish the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

    public function deleteAllByDestId($destId, $relishes, $destType){
        $criteria=new CDbCriteria;
        $criteria->compare('rr_dest_id', $destId);
        $criteria->compare('rr_dest_type', $destType);
        if(count($relishes) > 0){
            $criteria->addNotInCondition('rr_relish_id', $relishes);
        }
        $this->deleteAll($criteria);
    }

    public function checkByDestIdAndRelishId($apartId, $relishId, $destType){
        $criteria=new CDbCriteria;
        $criteria->compare('rr_dest_id', $apartId);
        $criteria->compare('rr_dest_type', $destType);
        $criteria->compare('rr_relish_id', $relishId);
        return $this->count($criteria) > 0;
    }
}
