<?php

class MyPasswordForm extends CFormModel {
    const
        ERROR_NONE = 0,
        ERROR_EXISTS = 1,
        ERROR_DB = 2;
    public $id;
    public $username;
    public $email;
    public $role;
    //public $placeId;
    public $newPass;
    public $comfirmPass;
    public $status;

    /**
     * Declares the validation rules.
     * The rules state that username and password are required,
     * and password needs to be authenticated.
     */
    public function rules()
    {
        return array(
            // languageName are required
            //array('username,email,newPass', 'required'),
            // length of categoryName is 100 characters, categoryDesc 300 characters
            //array('username', 'length', 'max'=>30),
           // array('username', 'match', 'pattern'=>'/^[a-zA-Z0-9]+$/'),
            array('comfirmPass', 'compare', 'compareAttribute'=>'newPass'),
            array('role,status,id','safe'),
        );
    }

    public function attributeLabels(){
        return array(
            'username' => Yii::t('account', 'label.username'),
            'email' => Yii::t('account', 'label.email'),
            'role' => Yii::t('account', 'label.role'),
         //   'placeId' => Yii::t('account', 'label.place'),
            'status' => Yii::t('account', 'label.status'),
            'newPass' => Yii::t('account', 'label.newPass'),
            'confPass' => Yii::t('account', 'label.confNewPass'),
        );
    }

    public function loadModel($id){
        /* @var AccountForm $model */
        $account = Account::model()->findByPk($id);
        if($account == null) throw new CHttpException(400, Yii::t('common', 'msg.badRequest'));

        $this->id = $account->id;
        $this->username = $account->username;
        $this->email = $account->email;
      //  $this->placeId=$account->placeId;
        $this->role=$account->role;
        $this->status=$account->status;

    }

    public function update($id){
        /* @var Account $model */
        $model = Account::model()->findByPk($id);
        if($model == null) throw new CHttpException(400, Yii::t('common', 'msg.badRequest'));
        //echo $_POST['MyPasswordForm']['newPass'];exit;
        $model->password= md5($_POST['MyPasswordForm']['newPass']);
//        $model->updated = DateTimeUtils::createInstance()->now();
        if($model->save()){
            return true;
        }else{
            return false;
        }
    }
}