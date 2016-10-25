<?php
/**
 * Created by Lorge 
 *
 * User: Only Love.
 * Date: 12/15/13 - 10:03 AM
 */

class UserIdentity extends CUserIdentity {
    /**
     * @var integer id of logged user
     */
    private $_id;

    /**
     * Authenticates username and password
     * @return boolean CUserIdentity::ERROR_NONE if successful authentication
     */
    public function authenticate() {
        $this->errorCode=self::ERROR_NONE;
        $criteria = new CDbCriteria();
        $criteria->compare('username', $this->username);
        $criteria->compare('password', md5($this->password));
        if(Account::model()->count($criteria) == 1){
            $admin = Account::model()->find($criteria);
            $this->_id = $admin->id;
            $this->setState('role', $admin->role);
            $this->errorCode=self::ERROR_NONE;
        }else{
            $this->errorCode=self::ERROR_USERNAME_INVALID;
        }
        return !$this->errorCode;
    }

    /**
     *
     * @return integer id of the logged user, null if not set
     */
    public function getId() {
        return $this->_id;
    }
}