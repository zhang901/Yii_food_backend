<?php
/**
 * Created by Lorge 
 *
 * User: Only Love.
 * Date: 12/15/13 - 9:00 AM
 */

class WebUser extends CWebUser {
    private $_model;

    public function init(){
        parent::init();
    }

    // Load user model.
    protected function loadUser($id = null){
        if ($this->_model === null) {
            if ($id !== null)
                $this->_model = $id;
        }
        return $this->_model;
    }

    public function getCurrentRoleUser()
    {
        $user = $this->loadUser(Yii::app()->user->role);
        return $user;
    }

    function isAdmin()
    {
        $user = $this->getCurrentRoleUser();
        //echo $user;exit;
        if ($user != null) {
            return intval($user) == Constants::ROLE_ADMIN;
        } else {
            return false;
        }
    }




}