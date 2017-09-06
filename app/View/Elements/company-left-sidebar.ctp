<aside class="main-sidebar">
  <section class="sidebar">
    <ul class="sidebar-menu">
      <li class="header"><i class="fa fa-angle-double-right"></i> COMPANY ADMIN PANEL</li>
      <li class="<?php echo (strtolower($this->params->controller)=='home')?'active':'';?> treeview">
        <a href="<?=COMPANY_WEBROOT?>home">
          <i class="fa fa-dashboard"></i> <span>Dashboard</span>
        </a>
      </li>
      <li class="treeview <?php echo (strtolower($this->params->controller)=='store')?'active':'';?>">
        <a href="#">
          <i class="fa fa-fw fa-gear"></i>
          <span>Manage Stores</span>
          <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu">
          <li><a href="<?=COMPANY_WEBROOT?>store"><i class="fa fa-angle-double-right"></i> List Stores</a></li>
          <li><a href="<?=COMPANY_WEBROOT?>store/add"><i class="fa fa-angle-double-right"></i> Add Store</a></li>
        </ul>
      </li>
       <li class="treeview <?php echo (strtolower($this->params->controller)=='category')?'active':'';?>">
        <a href="#">
          <i class="fa fa-gg"></i>
          <span>Manage Categories</span>
          <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu">
          <li><a href="<?=COMPANY_WEBROOT?>category"><i class="fa fa-angle-double-right"></i> List Categories</a></li>
          <li><a href="<?=COMPANY_WEBROOT?>category/add"><i class="fa fa-angle-double-right"></i> Add Category</a></li>
        </ul>
      </li>
      <li class="treeview <?php echo (strtolower($this->params->controller)=='sub_category')?'active':'';?>">
        <a href="#">
          <i class="fa fa-gg"></i>
          <span>Manage Sub Categories</span>
          <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu">
          <li><a href="<?=COMPANY_WEBROOT?>sub_category"><i class="fa fa-angle-double-right"></i> List Sub Categories</a></li>
          <li><a href="<?=COMPANY_WEBROOT?>sub_category/add"><i class="fa fa-angle-double-right"></i> Add Sub Category</a></li>
        </ul>
      </li>
       <li class="treeview <?php echo (strtolower($this->params->controller)=='product')?'active':'';?>">
        <a href="#">
          <i class="fa fa-book"></i>
          <span>Manage Items</span>
          <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu">
          <li><a href="<?=COMPANY_WEBROOT?>product"><i class="fa fa-angle-double-right"></i> List Items</a></li>
          <li><a href="<?=COMPANY_WEBROOT?>product/add"><i class="fa fa-angle-double-right"></i> Add Item</a></li>
        </ul>
      </li>
      <li class="treeview <?php echo (strtolower($this->params->controller)=='modifier')?'active':'';?>">
        <a href="#">
          <i class="fa fa-book"></i>
          <span>Manage Modifiers</span>
          <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu">
          <li><a href="<?=COMPANY_WEBROOT?>modifier/sub_options"><i class="fa fa-angle-double-right"></i> List Modifier Choices</a></li>
          <li><a href="<?=COMPANY_WEBROOT?>modifier/add_sub_option"><i class="fa fa-angle-double-right"></i> Add Modifier Choice</a></li>
          <li><a href="<?=COMPANY_WEBROOT?>modifier/options"><i class="fa fa-angle-double-right"></i> List Modifiers</a></li>
          <li><a href="<?=COMPANY_WEBROOT?>modifier/add_option"><i class="fa fa-angle-double-right"></i> Add Modifier</a></li>
          <li><a href="<?=COMPANY_WEBROOT?>modifier"><i class="fa fa-angle-double-right"></i> List Modfier Groups</a></li>
          <li><a href="<?=COMPANY_WEBROOT?>modifier/add"><i class="fa fa-angle-double-right"></i> Add Modifier Group</a></li>
        </ul>
      </li>
      <li class="treeview <?php echo (strtolower($this->params->controller)=='question')?'active':'';?>">
        <a href="#">
          <i class="fa fa-question-circle"></i>
          <span>Manage Prefrances</span>
          <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu">
          <li><a href="<?=COMPANY_WEBROOT?>question"><i class="fa fa-angle-double-right"></i> List Questions</a></li>
          <li><a href="<?=COMPANY_WEBROOT?>question/add"><i class="fa fa-angle-double-right"></i> Add Question</a></li>
        </ul>
      </li>
       <li class="treeview <?php echo (strtolower($this->params->controller)=='email_templates')?'active':'';?>">
        <a href="#">
          <i class="fa fa-envelope-o"></i>
          <span>Manage Email Templates</span>
          <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu">
          <li><a href="<?=COMPANY_WEBROOT?>email_templates"><i class="fa fa-angle-double-right"></i> List Email Templates</a></li>
          <li><a href="<?=COMPANY_WEBROOT?>email_templates/add"><i class="fa fa-angle-double-right"></i> Add Email Template</a></li>
        </ul>
      </li>
      <li class="treeview <?php echo (strtolower($this->params->controller)=='contents')?'active':'';?>">
        <a href="#">
          <i class="fa fa-pencil-square-o"></i>
          <span>Manage Content</span>
          <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu">
          <li><a href="<?=COMPANY_WEBROOT?>contents"><i class="fa fa-angle-double-right"></i> List Pages</a></li>
          <li><a href="<?=COMPANY_WEBROOT?>contents/add"><i class="fa fa-angle-double-right"></i> Add New Page</a></li>
        </ul>
      </li>
      <li class="treeview <?php echo (strtolower($this->params->controller)=='coupons')?'active':'';?>">
        <a href="#">
          <i class="fa fa-keyboard-o"></i>
          <span>Manage Coupons</span>
          <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu">
          <li><a href="<?=COMPANY_WEBROOT?>coupons"><i class="fa fa-angle-double-right"></i> List Coupons</a></li>
          <li><a href="<?=COMPANY_WEBROOT?>coupons/add"><i class="fa fa-angle-double-right"></i> Add Coupon</a></li>
        </ul>
      </li>
    </ul>
  </section>
</aside>