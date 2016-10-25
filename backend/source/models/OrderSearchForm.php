<?php
/**
 * Created by Lorge 
 *
 * User: Only Love.
 * Date: 3/21/14 - 3:36 PM
 */

class OrderSearchForm extends FormModel{
    public $Name;
    public $Status;
    public $From;
    public $To;

    public function rules(){
        return array(
            array('Name, Status, From, To', 'safe'),
        );
    }

    /*public function __construct(){
        $criteria = new CDbCriteria();
        $criteria->compare('language_status', Constants::STATUS_ACTIVE);
        $criteria->compare('language_is_default', true);
        $defaultLanguage = Language::model()->find($criteria);
        if($defaultLanguage != null){
            $this->menuLang = $defaultLanguage->language_id;
        }
    }*/
}