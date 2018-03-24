<?php $this->beginContent('//layouts/main'); ?>
<div class="content">
    <div class="content-header">
        <div class="container-fluid">
            <h4><span class="color-orange">รุ่งปิติพร การทอ</span></h4>
        </div>
    </div>
    <div class="row-fluid">
        <div class="content-navbar">
            <?php
            $this->renderPartial('/layouts/menu');
            ?>
        </div>
        <div class="container-fluid">
            <?php echo $content; ?>
        </div>
    </div>
</div>
<?php $this->endContent(); ?>