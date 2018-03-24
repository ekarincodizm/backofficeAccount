<?php
$this->breadcrumbs=array(
	'Taxes'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Tax','url'=>array('index')),
	array('label'=>'Manage Tax','url'=>array('admin')),
);
?>

<h1>สร้างใบกำกับภาษี</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>