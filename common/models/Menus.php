<?php

/**
 * This is the model class for table "menus".
 *
 * The followings are the available columns in table 'menus':
 * @property string $menu_id
 * @property string $menu_name
 * @property string $menu_thumb
 * @property string $menu_desc
 * @property string $menu_is_panini
 * @property string $created
 * @property string $updated
 * @property integer $order_number
 */
class Menus extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'menus';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('menu_id, menu_name, menu_is_panini', 'required'),
			array('menu_id', 'length', 'max'=>10),
            array('order_number', 'length', 'max'=>20),
			array('menu_name, menu_thumb', 'length', 'max'=>255),
			array('menu_id, menu_name, menu_desc, order_number, menu_thumb, menu_desc, created, updated, menu_is_panini', 'safe', 'on'=>'search'),
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
            'menu_language' => array(self::BELONGS_TO, 'MenuTransfer', array('menu_id'=>'menu_id')),
            'languages' => array(self::HAS_MANY, 'MenuTransfer', array('menu_id'=>'menu_id')),
            
            'ref_relish'=>array(self::HAS_MANY,'RefRelish',array('rr_dest_id'=>'menu_id'),'on'=>'ref_relish.rr_dest_type = \''.Constants::TYPE_MENU.'\'', 'order'=>'ref_relish.rr_order ASC'),
            'relishes'=>array(
                self::HAS_MANY,'Relishes',array('rr_relish_id'=>'relish_id'),'through'=>'ref_relish'
            ),

            'ref_method'=>array(self::HAS_MANY,'RefCooking',array('rc_dest_id'=>'menu_id'),'on'=>'ref_method.rc_dest_type = \''.Constants::TYPE_MENU.'\'', 'order'=>'ref_method.rc_order ASC'),
            'methods'=>array(
                self::HAS_MANY,'CookingMethod',array('rc_cooking_id'=>'cm_id'),'through'=>'ref_method'
            ),
            'dish'=>array(
                self::HAS_MANY,'Dish',array('dish_menu'=>'menu_id')
            ),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'menu_id' => 'Menu',
			'menu_name' => 'Menu Name',
			'menu_thumb' => 'Menu Thumb',
			'menu_desc' => 'Menu Desc',
            'menu_is_panini' => Yii::t('common', 'label.menuIsPanini'),
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
     * @var MenuSearchForm $searchModel
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search($searchModel)
	{
		$criteria=new CDbCriteria;
        $criteria->with = array(
            'menu_language' => array(
                'joinType'=>'LEFT JOIN',
                'on'=>'menu_language.language_id = \''.$searchModel->menuLang.'\'',
            ),
        );
        $criteria->together = true;
        $criteria->compare('menu_language.menu_name', $searchModel->menuName, true);
        //$criteria->order = 't.updated DESC';
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
            'sort'=>array(
                'defaultOrder'=> 'order_number DESC,menu_language.menu_name ASC'
            )
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Menus the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
