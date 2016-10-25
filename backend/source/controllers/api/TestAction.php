<?php
/**
 * Created by JetBrains PhpStorm.
 * User: HUY
 * Date: 3/7/14
 * Time: 4:19 PM
 * To change this template use File | Settings | File Templates.
 */

class TestAction extends CAction
{

    public function run()
    {
        Order::model()->notifyStatus(199);
		//var_dump(Device::model()-> findDevicesByOrderId(199,2));
		
    }

}