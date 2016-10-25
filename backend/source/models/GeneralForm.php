<?php
/**
 * User: Only Love
 * Date: 4/19/14
 * Time: 7:12 AM
 */

class GeneralForm extends FormModel{
    public $google_api_key;
   // public $attribute;


    /**
     * @return array validation rules for model attributes.
     */
    public function rules(){
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('google_api_key', 'required'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels(){
        return array(
            'google_api_key' =>Yii::t('common', 'label.googleKey'),
        );
    }
}