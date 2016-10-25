<?php
/**
 * User: Only Love
 * Date: 4/19/14
 * Time: 7:12 AM
 */

class MailForm extends FormModel{
    public $host;
    public $account;
    public $password;
    public $port;
    public $encryption;

    /**
     * @return array validation rules for model attributes.
     */
    public function rules(){
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('host, account, password, port, encryption', 'required'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels(){
        return array(
            'host' => Yii::t('common', 'label.host'),
            'account' => Yii::t('common', 'label.account'),
            'password' => Yii::t('common', 'label.password'),
            'port' => Yii::t('common', 'label.port'),
            'encryption' => Yii::t('common', 'label.encryption'),
        );
    }
}