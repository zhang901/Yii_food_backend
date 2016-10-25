<?php

/**
 * This is the model class for table "cooking_method".
 *
 * The followings are the available columns in table 'cooking_method':
 * @property string $cm_id
 * @property string $cm_name
 * @property string $cm_desc
 * @property string $cm_parent_id
 * @property string $cm_group
 * @property string $cm_type
 * @property string $created
 * @property string $updated
 * @property integer $order_number
 */
class CookingMethod extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'cooking_method';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('cm_id, cm_name, created, cm_group', 'required'),
			array('cm_id, cm_parent_id', 'length', 'max'=>60),
            array('cm_type', 'length', 'max'=>30),
            array('order_number', 'numerical', 'integerOnly'=>true),
			array('cm_name', 'length', 'max'=>200),
			array('cm_desc, updated', 'safe'),
			array('cm_id, cm_name, cm_desc, order_number, created, updated', 'safe', 'on'=>'search'),
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
            'parent' => array(self::HAS_ONE, 'CookingMethod', array('cm_id'=>'cm_parent_id')),
            'ref_cooking'=>array(self::HAS_MANY, 'RefCooking', array('rc_cooking_id'=>'cm_id')),
            'toppings'=>array(self::HAS_MANY, 'RefCooking', array('rc_cooking_id'=>'cm_id'), 'on'=>'toppings.rc_dest_type = \''.Constants::TYPE_TOPPING.'\''),
            'menus'=>array(self::HAS_MANY, 'RefCooking', array('rc_cooking_id'=>'cm_id'), 'on'=>'menus.rc_dest_type = \''.Constants::TYPE_MENU.'\''),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'cm_id' => 'Cm',
			'cm_name' => 'Cm Name',
			'cm_desc' => 'Cm Desc',
            'cm_parent_id' => 'Cm Parent Id',
            'cm_group' => 'Cm Group',
            'cm_type' => 'Cm Type',
			'created' => 'Created',
			'updated' => 'Updated',
            'order_number' => 'Order Number'
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
		$criteria->compare('t.cm_id',$this->cm_id,true);
		$criteria->compare('t.cm_name',$this->cm_name,true);
        $criteria->compare('t.cm_desc',$this->cm_desc,true);
        $criteria->compare('t.cm_parent_id',$this->cm_parent_id,true);
        $criteria->compare('t.cm_type',$this->cm_type,true);
        $criteria->compare('t.cm_group',$this->cm_group,true);
		$criteria->compare('t.created',$this->created,true);
		$criteria->compare('t.updated',$this->updated,true);
        $criteria->compare('t.order_number',$this->order_number,true);

        //$criteria->order = 't.cm_group, t.cm_parent_id ASC, t.updated DESC';

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
            'sort'=> array(
                'defaultOrder'=> 't.order_number DESC,t.cm_name ASC'
            )
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return CookingMethod the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

    public function findAllByLevel($level, $type){
        $criteria=new CDbCriteria;
        if($level == 1){
            $criteria->addCondition("cm_parent_id = '0'");
        }
        if($level == 2){
            $criteria->addCondition("cm_parent_id <> '0'");
        }
        $criteria->compare('t.cm_type', $type);
        return $this->findAll($criteria);
    }

    public function checkByPk($cookingId){
        $criteria=new CDbCriteria;
        $criteria->compare('cm_id', $cookingId);
        return $this->count($criteria) > 0;
    }

    public function findIn($val, $type){
        $criteria=new CDbCriteria;
        $criteria->addInCondition('cm_id', explode(',', $val));
        $criteria->compare('cm_type', $type);
        $arr = $this->findAll($criteria);
        $result = array();
        foreach($arr as $item){
            /** @var CookingMethod $item */
            $result[] = array(
                'id' => $item->cm_id,
                'name' => $item->cm_name,
            );
        }
        return $result;
    }

    public function findAllByParentId($parentId, $type){
        $criteria=new CDbCriteria;
        $criteria->compare('cm_parent_id', $parentId);
        $criteria->compare('cm_type', $type);
        return $this->findAll($criteria);
    }

    public function findAllByToppingId($toppingId){
        $criteria=new CDbCriteria;
        $criteria->with = array(
            'ref_cooking' => array(
                'joinType'=>'INNER JOIN',
                'on'=>'ref_cooking.rc_dest_id = \''.$toppingId.'\' AND ref_cooking.rc_dest_type = \''.Constants::TYPE_TOPPING.'\'',
            ),
        );
        $criteria->together = true;
        $criteria->compare('cm_parent_id', 0);
        $criteria->compare('cm_type', Constants::TYPE_TOPPING);
        return $this->findAll($criteria);
    }
}
