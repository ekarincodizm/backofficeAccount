<?php
$cs = Yii::app()->clientScript;
/*
  $cs->scriptMap = array(
  'jquery' => '//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js',
  );
  $cs->registerScriptFile('jquery', CClientScript::POS_HEAD);
 *
 */
$cs->packages = array(
    'jquery' => array(
        'baseUrl' => Yii::app()->baseUrl,
        'js' => array('js/jquery-1.9.1.min.js'))
);
$cs->registerCoreScript('jquery');
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title><?php echo CHtml::encode($this->pageTitle); ?></title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">
        <!-- google font -->
        <link
            href="<?php echo Yii::app()->theme->baseUrl; ?>/assets/css/css.css"
            rel="stylesheet" type="text/css">

        <!-- bootstrap -->
        <link
            href="<?php echo Yii::app()->theme->baseUrl; ?>/assets/css/bootstrap.css"
            rel="stylesheet">
        <link
            href="<?php echo Yii::app()->theme->baseUrl; ?>/assets/css/bootstrap-responsive.css"
            rel="stylesheet">
        <!-- yii -->
        <link
            href="<?php echo Yii::app()->theme->baseUrl; ?>/assets/css/yii.css"
            rel="stylesheet">

        <!-- custom style -->
        <link
            href="<?php echo Yii::app()->theme->baseUrl; ?>/assets/css/custom.css"
            rel="stylesheet">
        <link
            href="<?php echo Yii::app()->theme->baseUrl; ?>/assets/css/custom-ui.css"
            rel="stylesheet">
        <link
            href="<?php echo Yii::app()->theme->baseUrl; ?>/assets/css/custom-form.css"
            rel="stylesheet">

        <!-- icons -->
        <link
            href="<?php echo Yii::app()->theme->baseUrl; ?>/assets/css/font-awesome.css"
            rel="stylesheet">
    </head>
    <body id="top">
        <header class="header">
        </header>
        <section class="section">
            <?php echo $content; ?>
        </section>

        <!-- javascript -->
        <!--script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script-->
        <script
        src="<?php echo Yii::app()->theme->baseUrl; ?>/assets/js/bootstrap.js"></script>
        <!--/javascript -->

    </body>
</html>
