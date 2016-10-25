<?php

/**
 * This is the model class for table "menu_transfer".
 *
 * The followings are the available columns in table 'menu_transfer':
 * @property string $menu_transfer_id
 * @property string $menu_id
 * @property string $language_id
 * @property string $menu_name
 * @property string $menu_desc
 */
class MenuTransfer extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'menu_transfer';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('menu_transfer_id, menu_id, language_id, menu_name', 'required'),
            array('menu_transfer_id', 'length', 'max'=>60),
			array('menu_id, language_id', 'length', 'max'=>10),
			array('menu_name', 'length', 'max'=>255),
			array('menu_transfer_id, menu_id, language_id, menu_name, menu_desc', 'safe', 'on'=>'search'),
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
            'menu' => array(self::BELONGS_TO, 'Menus', array('menu_id'=>'menu_id')),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'menu_transfer_id' => 'Menu Transfer',
			'menu_id' => 'Menu',
			'language_id' => 'Language',
			'menu_name' => 'Menu Name',
			'menu_desc' => 'Menu Desc',
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
		$criteria->compare('menu_transfer_id',$this->menu_transfer_id,true);
		$criteria->compare('menu_id',$this->menu_id,true);
		$criteria->compare('language_id',$this->language_id,true);
		$criteria->compare('menu_name',$this->menu_name,true);
		$criteria->compare('menu_desc',$this->menu_desc,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return MenuTransfer the static model class
	 */
	public static function model($className=__CLASS__){
		return parent::model($className);
	}

    public function findAllByMenuId($menuId){
        $criteria=new CDbCriteria;
        $criteria->with = array('menu');
        $criteria->together = true;
        $criteria->compare('menu.menu_id', $menuId);
        return $this->findAll($criteria);
    }
}
