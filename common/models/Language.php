<?php

/**
 * This is the model class for table "language".
 *
 * The followings are the available columns in table 'language':
 * @property string $language_id
 * @property string $language_name
 * @property string $language_key
 * @property string $language_thumb
 * @property integer $language_is_default
 * @property string $language_status
 */
class Language extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'language';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('language_id, language_name, language_key, language_thumb, language_is_default, language_status', 'required'),
			array('language_is_default', 'numerical', 'integerOnly'=>true),
			array('language_id, language_key', 'length', 'max'=>10),
			array('language_name', 'length', 'max'=>100),
			array('language_thumb', 'length', 'max'=>255),
			array('language_status', 'length', 'max'=>30),
			array('language_id, language_name, language_key, language_thumb, language_is_default, language_status', 'safe', 'on'=>'search'),
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
			'language_id' => 'Language',
			'language_name' => 'Language Name',
			'language_key' => 'Language Key',
			'language_thumb' => 'Language Thumb',
			'language_is_default' => 'Language Is Default',
			'language_status' => 'Language Status',
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

		$criteria->compare('language_id',$this->language_id,true);
		$criteria->compare('language_name',$this->language_name,true);
		$criteria->compare('language_key',$this->language_key,true);
		$criteria->compare('language_thumb',$this->language_thumb,true);
		$criteria->compare('language_is_default',$this->language_is_default);
		$criteria->compare('language_status',$this->language_status,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Language the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

    public function findAllByDefault(){
        $criteria = new CDbCriteria();
        $criteria->compare('language_is_default', 1);
        return $this->findAll($criteria);
    }

    public function findAllExceptDefault(){
        $criteria = new CDbCriteria();
        $criteria->addCondition('language_is_default <> 1');
        return $this->findAll($criteria);
    }

    public function findAllByStatus($status){
        $criteria = new CDbCriteria();
        $criteria->compare('language_status', $status);
        return $this->findAll($criteria);
    }
}
