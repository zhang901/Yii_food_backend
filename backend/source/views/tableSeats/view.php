<?php
/* @var $this TableSeatsController */
/* @var $model TableSeats */

$this->breadcrumbs=array(
	'Table Seats'=>array('index'),
	$model->title,
);

$this->menu=array(
	array('label'=>'List TableSeats', 'url'=>array('index')),
	array('label'=>'Create TableSeats', 'url'=>array('create')),
	array('label'=>'Update TableSeats', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete TableSeats', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage TableSeats', 'url'=>array('admin')),
);
?>

<h1>View TableSeats #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'title',
		'capacity',
		'occupied',
		'status',
		'order_number',
	),
)); ?>
