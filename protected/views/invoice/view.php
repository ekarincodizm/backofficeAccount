<?php
$this->breadcrumbs = array(
    'Invoices' => array('index'),
    $model->invoiceId,
);

$this->menu = array(
    array('label' => 'List Invoice', 'url' => array('index')),
    array('label' => 'Create Invoice', 'url' => array('create')),
    array('label' => 'Update Invoice', 'url' => array('update', 'id' => $model->invoiceId)),
    array('label' => 'Delete Invoice', 'url' => '#', 'linkOptions' => array('submit' => array('delete', 'id' => $model->invoiceId), 'confirm' => 'Are you sure you want to delete this item?')),
    array('label' => 'Manage Invoice', 'url' => array('admin')),
);
?>

<h1>View Invoice #<?php echo $model->invoiceId; ?></h1>

<?php
$this->widget('bootstrap.widgets.TbDetailView', array(
    'data' => $model,
    'attributes' => array(
        'invoiceId',
        'customerId',
        'dateCreate',
        'invoiceNumber',
    ),
));
?>
