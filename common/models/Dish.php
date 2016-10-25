<?php

/**
 * This is the model class for table "dish".
 *
 * The followings are the available columns in table 'dish':
 * @property string $dish_id
 * @property string $dish_name
 * @property double $dish_price
 * @property double $dish_promotion
 * @property string $dish_urls_image
 * @property string $dish_urls_video
 * @property string $dish_thumb
 * @property string $dish_small_thumb
 * @property string $dish_menu
 * @property string $dish_desc
 * @property string $created
 * @property string $updated
 * @property integer $order_number
 */
class Dish extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'dish';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('dish_id, dish_price, dish_thumb, dish_menu, created', 'required'),
			array('dish_price, dish_promotion', 'numerical'),
			array('dish_id, dish_menu', 'length', 'max'=>10),
			array('dish_name, dish_thumb, dish_small_thumb', 'length', 'max'=>255),
			array('dish_urls_image, dish_name, dish_urls_video, dish_desc, updated', 'safe'),
            array('order_number', 'numerical', 'integerOnly'=>true),
			array('dish_id, dish_name, dish_price, order_number, dish_promotion, dish_urls_image, dish_urls_video, dish_thumb, updated, dish_small_thumb, dish_menu, dish_desc', 'safe', 'on'=>'search'),
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
            'dish_language' => array(self::BELONGS_TO, 'DishTransfer', array('dish_id'=>'dish_id')),
            'menu' => array(self::BELONGS_TO, 'Menu', array('dish_menu'=>'menu_id'))
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'dish_id' => 'Dish',
			'dish_name' => 'Dish Name',
			'dish_price' => 'Dish Price',
			'dish_promotion' => 'Dish Promotion',
			'dish_urls_image' => 'Dish Urls Image',
			'dish_urls_video' => 'Dish Urls Video',
			'dish_thumb' => 'Dish Thumb',
			'dish_small_thumb' => 'Dish Small Thumb',
			'dish_menu' => 'Dish Menu',
			'dish_desc' => 'Dish Desc',
            'order_number'=> 'Order Number'
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
	public function searchs()
	{
		$criteria=new CDbCriteria;
		$criteria->compare('dish_id',$this->dish_id,true);
		$criteria->compare('dish_name',$this->dish_name,true);
		$criteria->compare('dish_price',$this->dish_price);
		$criteria->compare('dish_promotion',$this->dish_promotion);
		$criteria->compare('dish_urls_image',$this->dish_urls_image,true);
		$criteria->compare('dish_urls_video',$this->dish_urls_video,true);
		$criteria->compare('dish_thumb',$this->dish_thumb,true);
		$criteria->compare('dish_small_thumb',$this->dish_small_thumb,true);
		$criteria->compare('dish_menu',$this->dish_menu,true);
		$criteria->compare('dish_desc',$this->dish_desc,true);
        $criteria->compare('order_number',$this->order_number,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
            'pagination' => array(
                // 'pageSize' => 20,
            ),
            'sort'=>array(
                'defaultOrder'=>'order_number DESC,dish_name ASC',
            )
		));
	}

    /** @var DishSearchForm $searchModel */
    public function search($searchModel)
    {
        $criteria=new CDbCriteria;
        $criteria->with = array(
            'dish_language' => array(
                'joinType'=>'LEFT JOIN',
                'on'=>'dish_language.language_id = \''.$searchModel->dishLang.'\'',
            ),
        );
        $criteria->together = true;
        $criteria->compare('t.dish_name', $searchModel->dishName, true);
        if(!empty($searchModel->dishMenu) && $searchModel->dishMenu){
            $criteria->compare('dish_menu', $searchModel->dishMenu);
        }
        //$criteria->order = 'updated DESC';
        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
            'sort'=>array(
                'defaultOrder'=>'order_number DESC,dish_language.dish_name ASC',
            )
        ));
    }

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Dish the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
