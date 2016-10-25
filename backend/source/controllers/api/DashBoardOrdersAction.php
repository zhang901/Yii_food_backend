<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Giang
 * Date: 3/5/14
 * Time: 2:18 PM
 * To change this template use File | Settings | File Templates.
 */

class DashBoardOrdersAction extends CAction{
    public function run()
    {
        $option = isset($_REQUEST['option']) ? $_REQUEST['option'] : '';
        //$status = isset($_REQUEST['status']) ? $_REQUEST['status'] : '';
        $startDate = isset($_REQUEST['startDate']) ? $_REQUEST['startDate'] : '';
        $endDate = isset($_REQUEST['endDate']) ? $_REQUEST['endDate'] : '';
        $page = isset($_REQUEST['page']) ? $_REQUEST['page'] : '1';


        $new = array();
        $void = array();
        $deliver = array();
        $pending = array();
        $path= Yii::app()->getBaseUrl(true);
		$rows_page = 30;

        // ORDER DAILY
        if($option == 0) // daily no filter
        {
            
            $has= Order::model()->previousDay($page,$rows_page);
			if ($startDate != '' && $endDate != '')
			{
				$has = array();
				$startTime = strtotime($startDate);
				$endTime = strtotime($endDate);
				for ( $timeIndex = $endTime; $timeIndex >= $startTime; $timeIndex = $timeIndex - 86400) 
				{
					$thisDate = date( 'Y-m-d', $timeIndex ); // 2010-05-01, 2010-05-02, etc
					$has[]= $thisDate;
				}
			}
            if(count($has)>0)
            {
                foreach($has as $ha)
                {
                    $new = array();
                    $void = array();
                    $deliver = array();
                    $pending = array();
                    $crit = new CDbCriteria();
                    $crit->addCondition("DATE_FORMAT(created, '%Y-%m-%d') = '$ha'");
                    $orders = Order::model()->findAll($crit);
                    foreach($orders as $match)
                    {
                        $status = $match->order_status;
                        if($status == Constants::STATUS_CREATED)
                        {
                            $new[]= $match->order_id;
                        }
                        if($status == Constants::STATUS_FAIL)
                        {
                            $void[] = $match->order_id;
                        }
                        if($status == Constants::STATUS_DELIVERED)
                        {
                            $deliver[] = $match->order_id;

                        }
                        if($status == Constants::STATUS_PENDING)
                        {
                            $pending[] =  $match->order_id;
                            //var_dump($pending);exit;
                        }

                    }
                    $new_number = count($new);
                    $void_number = count($void);
                    $deliver_number = count($deliver);
                    $pending_number = count($pending);
                    $data[]= array(
                        'day'=>$ha,
                        'numberNewOrder'=>$new_number,
                        'numberVoidOrder'=>$void_number,
                        'numberDeliveredOrder'=>$deliver_number,
                        'numberPendingOrder'=>$pending_number,
                    );
                }
                ApiController::sendResponse(200, CJSON::encode(array(
                    'status' => Constants::SUCCESS,
                    'data'=>$data,
                    'message' => 'OK',
                )));
            }
            else
                ApiController::sendResponse(200, CJSON::encode(array(
                    'status' => Constants::ERROR,
                    'data'=>'',
                    'message' => 'Not found orders in daily!',
                )));
        }
        
        // ORDER WEEKLY
        if($option == Constants::ORDER_WEEKLY) // weekly no filter
        {
			$data= array();
            $ha = Order::model()->previousWeek($page,$rows_page);
			if ($startDate != '' && $endDate != '')
			{
				$ha = array();
				$startTime = strtotime($startDate);
				$endTime = strtotime($endDate);
				for ( $timeIndex = $endTime; $timeIndex >= $startTime; $timeIndex = $timeIndex - 604800) 
				{
					$thisDate = date( 'Y-m-d', $timeIndex ); // 2010-05-01, 2010-05-02, etc
					$ha[]= $thisDate;
				}
			}
			//var_dump($ha);exit;
            foreach($ha as $item)
            {
                //echo $item;
                $new = array();
                $void = array();
                $deliver = array();
                $pending = array();
                //$year = date("o");
				
				$year = date("o",strtotime($item));
                $week = date('W',strtotime($item));
                $Monday= date("Y-m-d", strtotime($year.'W'.$week.'1'));
                $Sunday=date("Y-m-d", strtotime($year.'W'.$week.'7'));
                $crit = new CDbCriteria();
                $crit->addCondition("DATE_FORMAT(created, '%Y-%m-%d') >= '$Monday'");
                $crit->addCondition("DATE_FORMAT(created, '%Y-%m-%d') <= '$Sunday'");
                $crit->order ='created DESC';
                $orders = Order::model()->findAll($crit);
                //var_dump($orders);exit;
                foreach($orders as $match)
                {

                    $status = $match->order_status;
                    if($status == Constants::STATUS_CREATED)
                    {
                        $new[]= $match->order_id;
                    }
                    if($status == Constants::STATUS_FAIL)
                    {
                        $void[] = $match->order_id;
                    }
                    if($status == Constants::STATUS_DELIVERED)
                    {
                        $deliver[] = $match->order_id;
                    }
                    if($status == Constants::STATUS_PENDING)
                    {
                        $pending[] =  $match->order_id;                        
                    }
                }
                $new_number = count($new);
                $void_number = count($void);
                $deliver_number = count($deliver);
                $pending_number = count($pending);
                $data[]= array(
                    'day'=>$week.'-'.($year),
                    'numberNewOrder'=>$new_number,
                    'numberVoidOrder'=>$void_number,
                    'numberDeliveredOrder'=>$deliver_number,
                    'numberPendingOrder'=>$pending_number,
                );
            }
            ApiController::sendResponse(200, CJSON::encode(array(
                'status' => Constants::SUCCESS,
                //  'numpage'=>$allpage,
                'data'=>$data,
                'message' => 'OK',
            )));
        }
        // ORDER MONTHLY
        if($option == Constants::ORDER_MONTHLY) // monthly no filter
        {
            $data= array();
            $months= Order::model()->previousMonth($page,$rows_page);
			if ($startDate != '' && $endDate != '')
			{
				$months = array();
				$startTime = strtotime($startDate);
				$endTime = strtotime($endDate);
				for ( $timeIndex = $endTime; $timeIndex >= $startTime; $timeIndex = $timeIndex - 2592000) 
				{
					$thisDate = date( 'Y-m-d', $timeIndex ); // 2010-05-01, 2010-05-02, etc
					$months[]= $thisDate;
				}
			}
            foreach($months as $item)
            {
                $new = array();
                $void = array();
                $deliver = array();
                $pending = array();
				
				$month = date('m',strtotime($item));
                $year = date('o',strtotime($item));

                $date_start = date("$year-$month-01");
                $date_end = date("$year-$month-t");

                //$date_start = Order::model()->firstOfMonth($month);
                //$date_end  = Order::model()->lastOfMonth($month);

                $crit = new CDbCriteria();
                $crit->addCondition("DATE_FORMAT(created, '%Y-%m-%d') >= '$date_start'");
                $crit->addCondition("DATE_FORMAT(created, '%Y-%m-%d') <= '$date_end'");
                $crit->order ='created DESC';
                $orders = Order::model()->findAll($crit);
                // var_dump($order);exit;
                foreach($orders as $match)
                {

                    $status = $match->order_status;
                    if($status == Constants::STATUS_CREATED)
                    {
                        $new[]= $match->order_id;
                    }
                    if($status == Constants::STATUS_FAIL)
                    {
                        $void[] = $match->order_id;
                    }
                    if($status == Constants::STATUS_DELIVERED)
                    {
                        $deliver[] = $match->order_id;

                    }
                    if($status == Constants::STATUS_PENDING)
                    {
                        $pending[] =  $match->order_id;
                        //var_dump($pending);exit;
                    }

                }
                $new_number = count($new);
                $void_number = count($void);
                $deliver_number = count($deliver);
                $pending_number = count($pending);
                $data[]= array(
                    'day'=>$month.'-'.($year),
                    'numberNewOrder'=>$new_number,
                    'numberVoidOrder'=>$void_number,
                    'numberDeliveredOrder'=>$deliver_number,
                    'numberPendingOrder'=>$pending_number,
                );
            }
            ApiController::sendResponse(200, CJSON::encode(array(
                'status' => Constants::SUCCESS,
                //  'numpage'=>$allpage,
                'data'=>$data,
                'message' => 'OK',
            )));
        }

        //ORDER YEARLY
        if($option == Constants::ORDER_YEARLY) // yearly no filter
        {
            $data= array();
            $years= Order::model()->previousYear($page,$rows_page);
			if ($startDate != '' && $endDate != '')
			{
				$years = array();
				$startTime = strtotime($startDate);
				$endTime = strtotime($endDate);
				for ( $timeIndex = $endTime; $timeIndex >= $startTime; $timeIndex = $timeIndex - 31536000) 
				{
					$thisDate = date( 'Y-m-d', $timeIndex ); // 2010-05-01, 2010-05-02, etc
					$years[]= $thisDate;
				}
			}
            foreach($years as $item)
            {
                $new = array();
                $void = array();
                $deliver = array();
                $pending = array();
				
				$year = date('Y',strtotime($item));

                $crit = new CDbCriteria();
                $crit->addCondition("DATE_FORMAT(created, '%Y') = '$year'");
                $crit->order ='created DESC';
                $orders = Order::model()->findAll($crit);
                //var_dump($order);exit;
                foreach($orders as $match)
                {
                    $status = $match->order_status;
                    if($status == Constants::STATUS_CREATED)
                    {
                        $new[]= $match->order_id;
                    }
                    if($status == Constants::STATUS_FAIL)
                    {
                        $void[] = $match->order_id;
                    }
                    if($status == Constants::STATUS_DELIVERED)
                    {
                        $deliver[] = $match->order_id;

                    }
                    if($status == Constants::STATUS_PENDING)
                    {
                        $pending[] =  $match->order_id;
                        //var_dump($pending);exit;
                    }

                }
                $new_number = count($new);
                $void_number = count($void);
                $deliver_number = count($deliver);
                $pending_number = count($pending);
                $data[]= array(
                    'day'=>$year,
                    'numberNewOrder'=>$new_number,
                    'numberVoidOrder'=>$void_number,
                    'numberDeliveredOrder'=>$deliver_number,
                    'numberPendingOrder'=>$pending_number,
                );
            }
            ApiController::sendResponse(200, CJSON::encode(array(
                'status' => Constants::SUCCESS,
                //  'numpage'=>$allpage,
                'data'=>$data,
                'message' => 'OK',
            )));
        }

    }



}