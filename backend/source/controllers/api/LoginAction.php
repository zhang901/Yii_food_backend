<?php
/**
 * Created by JetBrains PhpStorm.
 * User: HUY
 * Date: 3/7/14
 * Time: 4:19 PM
 * To change this template use File | Settings | File Templates.
 */

class LoginAction extends CAction
{

    public function run()
    {
        if (isset($_REQUEST['username']) && isset($_REQUEST['password']) && isset($_REQUEST['ime'])) {

            $user = $_REQUEST['username'];
            $pass = $_REQUEST['password'];
            $ime = $_REQUEST['ime'];
            /** @var Account $account */
            $account = Account::model()->getAccount($user, md5($pass));
            if (count($account)>0) {
                $crit = new CDbCriteria();
                $crit->compare('username',$user);
                //$crit->compare('password',md5($pass));

                $users = Account::model()->find($crit);
                $id = $users->id;

                $crit = new CDbCriteria();
                $crit->compare('username',$user);
                //$crit->compare('password',md5($pass));

                $users = Account::model()->find($crit);
                $id = $users->id;

                $crit = new CDbCriteria();
                $crit->compare('ime',$ime);
                $device = Device::model()->find($crit);
                if(count($device)>0)
                {
                    $device->user_id = $id;
                    $device->save(false);
                }

                ApiController::sendResponse(200, CJSON::encode(array(
                    'status' => Constants::SUCCESS,
                    'data' => array(
                        'id'=>$account->id,
                        'user_name'=>$account->username,
                        'email'=>$account->email,
                        'full_name'=>$account->full_name,
                        'phone'=>$account->phone,
                        'address'=>$account->address,
                        'role'=>$account->role,

                    ),
                    'message' => 'OK',
                )));
            } else {
                ApiController::sendResponse(200, CJSON::encode(array(
                    'status' => Constants::ERROR,
                    'data' => '',
                    'message' => 'Username or password not found!',
                )));
            }
        } else {
            ApiController::sendResponse(400, CJSON::encode(array(
                'status' => Constants::ERROR,
                'data' => '',
                'message' => Yii::t('common', 'msg.badRequest'),
            )));
        }
    }

}