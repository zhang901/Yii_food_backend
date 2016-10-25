<?php

//http://localhost/matching/index.php/api/register?name=tony&email=tony@gmail.com&dob=1992-12-11&gender=2&password=123456
class UpdateProfileAction extends CAction
{
    public function run()
    {
        $userId = isset($_REQUEST['userId']) ? $_REQUEST['userId'] : '';
        //$username = isset($_REQUEST['username']) ? $_REQUEST['username'] : '';
        //$email = isset($_REQUEST['email']) ? $_REQUEST['email'] : '';
        $fullName = isset($_REQUEST['full_name']) ? $_REQUEST['full_name'] : '';
        $phone = isset($_REQUEST['phone']) ? $_REQUEST['phone'] : '';
        $address = isset($_REQUEST['address']) ? $_REQUEST['address'] : '';
        $password = isset($_REQUEST['password']) ? $_REQUEST['password'] : '';
		
		$old_user = Account::model()->findByPk($userId);

        if (isset($old_user)) {
            
			$old_user->full_name = $fullName;
			$old_user->address = $address;
			$old_user->phone = $phone;
			if ($old_user->save(false)) {
				$new_user = Account::model()->findByPk($userId);

				ApiController::sendResponse(200, CJSON::encode(array(
					'status' => 'SUCCESS',
					'data' => array(
						'id' => $new_user->id,
						'username' => $new_user->username,
						'email' => $new_user->email,
						'full_name' => $new_user->full_name . "",
						//'image' => $new_user->image . "",
						'address' => $new_user->address . "",
						'phone' => $new_user->phone . "",
						//'description' => $new_user->description . "",
						'token' => $new_user->token . "",
					),
					'message' => 'OK',)));

			}   

        } else {
            ApiController::sendResponse(200, CJSON::encode(array(
                'status' => 'ERROR',
                'data' => '',
                'message' => 'User does not exist!',)));
            exit;
        }


    }
}