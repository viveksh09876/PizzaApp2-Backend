<aside class="main-sidebar">
  <section class="sidebar">
    <ul class="sidebar-menu">
      <li class="header"><i class="fa fa-angle-double-right"></i> ADMIN PANEL</li>
      <li class="<?php echo (strtolower($this->params->controller)=='home')?'active':'';?> treeview">
        <a href="<?=ADMIN_WEBROOT?>home">
          <i class="fa fa-dashboard"></i> <span>Dashboard</span>
        </a>
      </li>
      <!-- <li class="treeview <?php // echo (strtolower($this->params->controller)=='languages')?'active':'';?>">
        <a href="#">
          <i class="fa fa-language"></i>
          <span>Manage Languages</span>
          <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu">
          <li><a href="<?=ADMIN_WEBROOT?>languages"><i class="fa fa-angle-double-right"></i> List Languages</a></li>
          <li><a href="<?=ADMIN_WEBROOT?>languages/add"><i class="fa fa-angle-double-right"></i> Add Language</a></li>
        </ul>
      </li> -->
      <li class="treeview <?php echo (strtolower($this->params->controller)=='category')?'active':'';?>">
        <a href="#">
          <i class="fa fa-gg"></i>
          <span>Manage Categories</span>
          <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu">
          <li><a href="<?=ADMIN_WEBROOT?>category"><i class="fa fa-angle-double-right"></i> List Categories</a></li>
          <li><a href="<?=ADMIN_WEBROOT?>category/add"><i class="fa fa-angle-double-right"></i> Add Category</a></li>
        </ul>
      </li>
      <li class="treeview <?php echo (strtolower($this->params->controller)=='subcategory')?'active':'';?>">
        <a href="#">
          <i class="fa fa-gg"></i>
          <span>Manage Sub Categories</span>
          <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu">
          <li><a href="<?=ADMIN_WEBROOT?>sub_category"><i class="fa fa-angle-double-right"></i> List Sub Categories</a></li>
          <li><a href="<?=ADMIN_WEBROOT?>sub_category/add"><i class="fa fa-angle-double-right"></i> Add Sub Category</a></li>
        </ul>
      </li>
      <li class="treeview <?php echo (strtolower($this->params->controller)=='product')?'active':'';?>">
        <a href="#">
          <i class="fa fa-book"></i>
          <span>Manage Items</span>
          <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu">
          <li><a href="<?=ADMIN_WEBROOT?>product"><i class="fa fa-angle-double-right"></i> List Items</a></li>
          <li><a href="<?=ADMIN_WEBROOT?>product/add"><i class="fa fa-angle-double-right"></i> Add Item</a></li>
        </ul>
      </li>
      <li class="treeview <?php echo (strtolower($this->params->controller)=='modifier')?'active':'';?>">
        <a href="#">
          <i class="fa fa-book"></i>
          <span>Manage Modifiers</span>
          <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu">
          <li><a href="<?=ADMIN_WEBROOT?>modifier/sub_options"><i class="fa fa-angle-double-right"></i> List Modifier Choices</a></li>
          <li><a href="<?=ADMIN_WEBROOT?>modifier/add_sub_option"><i class="fa fa-angle-double-right"></i> Add Modifier Choice</a></li>
          <li><a href="<?=ADMIN_WEBROOT?>modifier/options"><i class="fa fa-angle-double-right"></i> List Modifiers</a></li>
          <li><a href="<?=ADMIN_WEBROOT?>modifier/add_option"><i class="fa fa-angle-double-right"></i> Add Modifier</a></li>
          <li><a href="<?=ADMIN_WEBROOT?>modifier"><i class="fa fa-angle-double-right"></i> List Modfier Groups</a></li>
          <li><a href="<?=ADMIN_WEBROOT?>modifier/add"><i class="fa fa-angle-double-right"></i> Add Modifier Group</a></li>
        </ul>
      </li>
      <li class="treeview <?php echo (strtolower($this->params->controller)=='slides')?'active':'';?>">
        <a href="#">
          <i class="fa fa-fw fa-gear"></i>
          <span>Manage Sliders</span>
          <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu">
          <li><a href="<?=ADMIN_WEBROOT?>slides"><i class="fa fa-angle-double-right"></i> List Slides</a></li>
          <li><a href="<?=ADMIN_WEBROOT?>slides/add"><i class="fa fa-angle-double-right"></i> Add Slide</a></li>
        </ul>
      </li>
      <li class="treeview <?php echo (strtolower($this->params->controller)=='coupons')?'active':'';?>">
        <a href="#">
          <i class="fa fa-keyboard-o"></i>
          <span>Manage Coupons</span>
          <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu">
          <li><a href="<?=ADMIN_WEBROOT?>coupons"><i class="fa fa-angle-double-right"></i> List Coupons</a></li>
          <li><a href="<?=ADMIN_WEBROOT?>coupons/add"><i class="fa fa-angle-double-right"></i> Add Coupon</a></li>
        </ul>
      </li>
       <li class="treeview <?php echo (strtolower($this->params->controller)=='coupons')?'active':'';?>">
        <a href="#">
          <i class="fa fa-hand-o-right"></i>
          <span>Manage Deals</span>
          <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu">
          <li><a href="<?=ADMIN_WEBROOT?>deals"><i class="fa fa-angle-double-right"></i> List Deals</a></li>
          <li><a href="<?=ADMIN_WEBROOT?>deals/add"><i class="fa fa-angle-double-right"></i> Add Deal</a></li>
        </ul>
      </li>
    </ul>
  </section>
</aside>