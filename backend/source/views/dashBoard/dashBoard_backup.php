<?php
/*if(isset($myOrder))
    $dataProvider = $model->myOrders($searchModel);
else
    $dataProvider = $model->search($searchModel);*/
?>
 <?php 
			$startDate = isset($_REQUEST['startTime']) ? $_REQUEST['startTime'] : date('m/d/Y', (strtotime ( '-30 day' , time () ) ));
			$endDate = isset($_REQUEST['endTime']) ? $_REQUEST['endTime'] : date('m/d/Y');
			$type = isset($_REQUEST['type']) ? $_REQUEST['type'] : '0';
?>
<div class="row">
    <div class="col-xs-12">
        <div class="row">
            <div class="col-xs-6">
                <h4 class="title"><?php echo 'DashBoard'; ?></h4>
            </div>
            <div class="col-xs-6 text-right">
                Start time: <?php $this->widget('zii.widgets.jui.CJuiDatePicker', array(
								'name'=>'startTime',
								'model'=>$model,
								'options'=>array(
									'showAnim'=>'fold',
								),
								'value'=>$startDate,
								'htmlOptions'=>array(
								'style'=>' width:100px;',
                                //'class'=> 'form-control'
								),));?>
				End time: <?php $this->widget('zii.widgets.jui.CJuiDatePicker', array(
								'name'=>'endTime',
								'model'=>$model,
								'value'=>$endDate,
								'options'=>array(
									'showAnim'=>'fold',
								),
								'htmlOptions'=>array(
								'style'=>' width:100px;',
                                    //'class'=> 'form-control'
								),));?>
				Type: <select id="type" name="type" style="height:20px">
							<option value="" <?php if ($type == 0) echo 'selected'?>>Daily</option>
							<option value="" <?php if ($type == 1) echo 'selected'?>>Weekly</option>
							<option value="" <?php if ($type == 2) echo 'selected'?>>Monthly</option>
							<option value="" <?php if ($type == 3) echo 'selected'?>>Yearly</option>
					  </select>
				<button type="button" onclick='onReportClicked();'>Report</button>
            </div>
        </div>
        <?php /*echo $this->renderPartial("_searchForm", array('searchModel'=>$searchModel)); */?>

        <hr class="line"/>
    </div>
</div>

<div class="row">
    <div class="col-xs-12">
		<table class='table table-bordered table-striped table-hover data-table'>
			<thead>
				<td width="250px" style="color:white; background:gray; height:30px">Time</td>
				<td width="150px" style="color:white; background:gray; height:30px">New </td>
				<td width="150px" style="color:white; background:gray; height:30px">On the way</td>
				<td width="150px" style="color:white; background:gray; height:30px">Fail</td>
				<td width="150px" style="color:white; background:gray; height:30px">Delivery</td>
			</thead>
        <?php 
			
			if ($type == 0) // daily
			{
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
						echo '<tr><td>'.$ha.'</td><td>'.$new_number.'</td><td>'.$pending_number.'</td><td>'.$void_number.'</td><td>'.$deliver_number.'</td></tr>';
						
					}                
				}
				else
					echo '<tr><td colspan="5">orders not found'.$type.'</td></tr>';
			}
			else if ($type == 1) // weekly
			{
				$data= array();
				
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
					echo '<tr><td>'.$week.'-'.($year).'</td><td>'.$new_number.'</td><td>'.$pending_number.'</td><td>'.$void_number.'</td><td>'.$deliver_number.'</td></tr>';
				}
			}
			else if ($type == 2) // monthly
			{
				$data= array();
				
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
					echo '<tr><td>'.$month.'-'.($year).'</td><td>'.$new_number.'</td><td>'.$pending_number.'</td><td>'.$void_number.'</td><td>'.$deliver_number.'</td></tr>';
				}
			}
			else if ($type == 3) // year
			{
				$data= array();
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
					echo '<tr><td>'.$year.'</td><td>'.$new_number.'</td><td>'.$pending_number.'</td><td>'.$void_number.'</td><td>'.$deliver_number.'</td></tr>';
				}
			}
		?>
		</table>
    </div>
</div>

<script>
	function onReportClicked(){
		var startTime = document.getElementById("startTime").value;
		var endTime = document.getElementById("endTime").value;
		var type = document.getElementById("type").selectedIndex;
		window.location = '?startTime=' + startTime + '&endTime=' + endTime + '&type=' + type;		
	}
	
	
</script>
