<ul class="nav nav-tabs">
    <li class="dropdown">
        <a class="dropdown-toggle" data-toggle="dropdown" href="#">
            <i class="icon-edit icon-3x"></i><br/>ใบกำกับภาษี
            <b class="caret"></b></a>
        <ul class="dropdown-menu">
            <li><a href="<?php echo $this->createUrl('tax/create')?>">สร้าง</a></li>
            <li><a href="<?php echo $this->createUrl('tax/admin')?>">จัดการ</a></li>
        </ul>
    </li>
    <li class="dropdown">
        <a class="dropdown-toggle" data-toggle="dropdown" href="#">
            <i class="icon-money icon-3x"></i><br/>ใบเสร็จ
            <b class="caret"></b></a>
        <ul class="dropdown-menu">
            <li><a href="<?php echo $this->createUrl('invoice/create')?>">สร้าง</a></li>
            <li><a href="<?php echo $this->createUrl('invoice/admin')?>">จัดการ</a></li>
        </ul>
    </li>
    <li class="dropdown">
        <a class="dropdown-toggle" data-toggle="dropdown" href="#">
            <i class="icon-credit-card icon-3x"></i><br/>ใบวางบิล
            <b class="caret"></b></a>
        <ul class="dropdown-menu">
            <li><a href="<?php echo $this->createUrl('bill/create')?>">สร้าง</a></li>
            <li><a href="<?php echo $this->createUrl('bill/admin')?>">จัดการ</a></li>
        </ul>
    </li>
    <li class="dropdown">
        <a class="dropdown-toggle" data-toggle="dropdown" href="#">
            <i class="icon-building icon-3x"></i><br/>บริษัทลูกค้า
            <b class="caret"></b></a>
        <ul class="dropdown-menu">
            <li><a href="<?php echo $this->createUrl('customer/create')?>">สร้าง</a></li>
            <li><a href="<?php echo $this->createUrl('customer/admin')?>">จัดการ</a></li>
        </ul>
    </li>
    <li class="dropdown">
        <a class="dropdown-toggle" data-toggle="dropdown" href="#">
            <i class="icon-suitcase icon-3x"></i><br/>สินค้า
            <b class="caret"></b></a>
        <ul class="dropdown-menu">
            <li><a href="<?php echo $this->createUrl('product/create')?>">สร้าง</a></li>
            <li><a href="<?php echo $this->createUrl('product/admin')?>">จัดการ</a></li>
        </ul>
    </li>
    <li>
        <a href="<?php echo $this->createUrl('setting/admin') ?>">
            <i class="icon-wrench icon-3x"></i><br/>แก้ไขค่าเริ่มต้นของเลขที่
        </a>
    </li>
</ul>