<?php

/**
 * This is the form model class for table "contact".
 *
 * The followings are the available columns in table 'contact':
 */
class ContactForm extends FormModel{
    public $contactId;
    public $contactName;
    public $contactEmail;
    public $contactContent;
    public $created;

    /**
    * @return array validation rules for model attributes.
    */
    public function rules(){
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
                    array('contactId, contactName, contactEmail, contactContent, created', 'required'),
                    array('contactId', 'length', 'max'=>10),
                    array('contactName, contactEmail', 'length', 'max'=>100),
                );
    }

    /**
    * @return array customized attribute labels (name=>label)
    */
    public function attributeLabels(){
    return array(
            'contactId' => Yii::t('contact', 'label.contactId'),
            'contactName' => Yii::t('contact', 'label.contactName'),
            'contactEmail' => Yii::t('contact', 'label.contactEmail'),
            'contactContent' => Yii::t('contact', 'label.contactContent'),
            'created' => Yii::t('contact', 'label.created'),
        );
    }

    /**
    * Create instance form $id of model
    */
    public function loadModel($id){
        /** @var Contact $model */
        $model = Contact::model()->findByPk($id);
        if($model == null) throw new CException(404, Yii::t('common', 'msg.canNotFoundResource'));

            $this->contactId = $model->contact_id;
            $this->contactName = $model->contact_name;
            $this->contactEmail = $model->contact_email;
            $this->contactContent = $model->contact_content;
            $this->created = $model->created;
        }

    /**
    * Save to database
    */
    public function save(){
        $model = new Contact;
                    $this->contactId = $model->contact_id = DateTimeUtils::nowStr();
                        $model->contact_name = $this->contactName;
                        $model->contact_email = $this->contactEmail;
                        $model->contact_content = $this->contactContent;
                        $model->created = $this->created;
                    $result = $model->save();
        if (!$result) {
            return false;
        }
        return true;
    }

    /**
    * Save to database
    */
    public function update($id){
        /** @var Contact $model */
        $model = Contact::model()->findByPk($id);
        if($model == null) throw new CException(404, Yii::t('common', 'msg.canNotFoundResource'));

                                    $model->contact_name = $this->contactName;
                            $model->contact_email = $this->contactEmail;
                            $model->contact_content = $this->contactContent;
                            $model->created = $this->created;
                    $result = $model->save();
        if (!$result) {
            return false;
        }
        return true;
    }
}