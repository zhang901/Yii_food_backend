<?php
/**
 * User: Only Love
 * Date: 5/16/14
 * Time: 4:26 PM
 */

class AdminForm extends FormModel{
    public $adminFullname;
    public $adminPassword;
    public $adminRetypePassword;
    public $adminRole;

    /**
     * @return array validation rules for model attributes.
     */
    public function rules(){
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('adminFullname, adminPassword, adminRetypePassword, adminRole', 'required'),
            array('adminFullname', 'length', 'max' => 100),
            array('adminPassword', 'length', 'max' => 300),
            array('adminRole', 'length', 'max' => 30),
            array('adminRetypePassword', 'compare', 'compareAttribute'=>'adminPassword'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels(){
        return array(
            'adminFullname' => Yii::t('common', 'label.adminFullname'),
            'adminPassword' => Yii::t('common', 'label.adminPassword'),
            'adminRole' => Yii::t('common', 'label.adminRole'),
        );
    }

    /**
     * Create instance form $id of model
     */
    public function loadModel(){
        /** @var Admins $model */
        $model = Account::model()->find('role ='.Constants::ROLE_ADMIN);
        if ($model == null) throw new CHttpException(404, Yii::t('common', 'msg.canNotFoundResource'));

        $this->adminFullname = $model->full_name;
       // $this->adminRole = $model->admin_role;
    }

    /**
     * Save to database
     */
    public function updateAccount(){
        /** @var Admins $model */
        $model = Account::model()->find('role ='.Constants::ROLE_ADMIN);
        if($model == null) throw new CHttpException(404, Yii::t('common', 'msg.canNotFoundResource'));

        $model->full_name = $this->adminFullname;
        $result = $model->save();
        if (!$result) {
            return false;
        }
        return true;
    }

    /**
     * Save to database
     */
    public function updatePassword(){
        /** @var Admins $model */
        $model = Account::model()->find('role ='.Constants::ROLE_ADMIN);
        if($model == null) throw new CException(404, Yii::t('common', 'msg.canNotFoundResource'));

        $model->password = md5($_POST['AdminForm']['adminPassword']);
        $result = $model->save();
        if (!$result) {
            return false;
        }
        return true;
    }
}