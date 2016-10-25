<?php
/**
 * User: Only Love
 * Date: 4/19/14
 * Time: 7:12 AM
 */

class AdminMailForm extends FormModel{
    public $account;

    /**
     * @return array validation rules for model attributes.
     */
    public function rules(){
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('account', 'required'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels(){
        return array(
            'account' => Yii::t('common', 'label.account'),
        );
    }
}