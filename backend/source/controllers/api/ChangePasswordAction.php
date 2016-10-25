<?php
//http://localhost/matching/index.php/api/register?name=tony&email=tony@gmail.com&dob=1992-12-11&gender=2&password=123456
class ChangePasswordAction extends CAction
{
    public function run()
    {
        $userId = isset($_REQUEST['userId']) ? $_REQUEST['userId'] : '';
        $currentPassword = isset($_REQUEST['current_pass']) ? $_REQUEST['current_pass'] : '';
        $newPassword = isset($_REQUEST['new_pass']) ? $_REQUEST['new_pass'] : '';


        $old_user = Account::model()->findByPk($userId);
        //var_dump($old_user);exit;
        if (isset($old_user))
        {

            if($old_user->password == md5($currentPassword))
            {

                $old_user->password = md5($newPassword);
                if($old_user->save(false))
                    ApiController::sendResponse(200, CJSON::encode(array(
                        'status' => 'SUCCESS',
                        'data' => '',
                        'message' => 'OK',)));
            }
            else
                ApiController::sendResponse(200, CJSON::encode(array(
                    'status' => 'ERROR',
                    'data' => '',
                    'message' => 'Please check again Current Password!',)));

        }
        else
        {
            ApiController::sendResponse(200, CJSON::encode(array(
                'status' => 'ERROR',
                'data' => '',
                'message' => 'User does not exist!',)));
            //  exit;
        }


    }
}