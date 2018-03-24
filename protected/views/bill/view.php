<?php
$this->breadcrumbs = array(
    'Bills' => array('index'),
    $model->billId,
);

$this->menu = array(
    array('label' => 'List Bill', 'url' => array('index')),
    array('label' => 'Create Bill', 'url' => array('create')),
    array('label' => 'Update Bill', 'url' => array('update', 'id' => $model->billId)),
    array('label' => 'Delete Bill', 'url' => '#', 'linkOptions' => array('submit' => array('delete', 'id' => $model->billId), 'confirm' => 'Are you sure you want to delete this item?')),
    array('label' => 'Manage Bill', 'url' => array('admin')),
);
?>

<h1>View Bill #<?php echo $model->billId; ?></h1>

<?php
$this->widget('bootstrap.widgets.TbDetailView', array(
    'data' => $model,
    'attributes' => array(
        'billId',
        'billNumber',
        'companyName',
        'dateCreate',
    ),
));
?>
