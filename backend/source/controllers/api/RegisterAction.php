<?php
/**
 * Created by JetBrains PhpStorm.
 * User: HUY
 * Date: 3/7/14
 * Time: 4:19 PM
 * To change this template use File | Settings | File Templates.
 */

class RegisterAction extends CAction
{

    public function run()
    {

        $username = isset($_REQUEST['username']) ? $_REQUEST['username'] : '';
        $password = isset($_REQUEST['password']) ? $_REQUEST['password'] : '';
        $email = isset($_REQUEST['email']) ? $_REQUEST['email'] : '';
        $full_name = isset($_REQUEST['full_name']) ? $_REQUEST['full_name'] : '';
        $phone = isset($_REQUEST['phone']) ? $_REQUEST['phone'] : '';
        $address = isset($_REQUEST['address']) ? $_REQUEST['address'] : '';

        if(strlen($username) == 0 or strlen($password) == 0 or strlen($email) == 0)
        {
            ApiController::sendResponse(200, CJSON::encode(array(
                'status' => Constants::ERROR,
                'data' => '',
                'message' => 'Required fields missing: username / password / email'
            )));
            exit;
        }

        if(strlen($phone) == 0 AND strlen($address) == 0)
        {
            ApiController::sendResponse(200, CJSON::encode(array(
                'status' => Constants::ERROR,
                'data' => '',
                'message' => 'You need to input phone or address for delivery'
            )));
            exit;
        }

        if(Account::model()->checkExistEmail($email)>0)
        {
            ApiController::sendResponse(200, CJSON::encode(array(
                'status' => Constants::ERROR,
                'data' => '',
                'message' => 'Email exist!'
            )));
            exit;
        }
        if(Account::model()->checkExistUserName($username)>0)
        {
            ApiController::sendResponse(200, CJSON::encode(array(
                'status' => Constants::ERROR,
                'data' => '',
                'message' => 'Username exist!'
            )));
            exit;
        }

        $new_user = new Account();
        $new_user->username = $username;
        $new_user->password = md5($password);
        $new_user->email = $email;
        $new_user->full_name = $full_name;
        $new_user->phone = $phone;
        $new_user->address = $address;
        $new_user->role = Constants::ROLE_CUSTOMER;
        $new_user->status = Constants::USER_STATUS_ACTIVE;

        if($new_user->save())
        {
            $data = array(
                'id'=>$new_user->id,
                'user_name'=>$new_user->username,
                'full_name'=> $new_user->full_name,
                'email'=>$new_user->email,
                'phone'=>$new_user->phone,
                'address'=>$new_user->address,
                'role'=>$new_user->role
            );
            ApiController::sendResponse(200, CJSON::encode(array(
                'status' => Constants::SUCCESS,
                'data' => $data,
                'message' => 'OK'
            )));
        }
        else
            ApiController::sendResponse(200, CJSON::encode(array(
                'status' => Constants::ERROR,
                'data' => '',
                'message' => 'Cannot register, please try again!'
            )));
    }

}