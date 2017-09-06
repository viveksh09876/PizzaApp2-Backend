<header class="main-header">
  <a href="<?=ADMIN_WEBROOT?>home" class="logo">
    <!-- mini logo for sidebar mini 50x50 pixels -->
    <span class="logo-mini">NKD</span>
    <!-- logo for regular state and mobile devices -->
	<img src="<?=IMG_ADMIN?>logo.svg" alt="NKD Pizza" height="34" style="margin:10px 0 0 0;"></img>
   <!-- <span class="logo-lg"><b>NKD</b>PIZZA</span>-->
  </a>

  <!-- Header Navbar: style can be found in header.less -->
  <nav class="navbar navbar-static-top" role="navigation">
    <!-- Sidebar toggle button-->
    <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
      <span class="sr-only">Toggle navigation</span>
    </a>
    <!-- Navbar Right Menu -->
    <div class="navbar-custom-menu">
      <ul class="nav navbar-nav">
        <!-- User Account: style can be found in dropdown.less -->
        <li class="dropdown user user-menu">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            <span class="hidden-xs"><?php echo (!empty($loggedUser))?$loggedUser['first_name'].' '.$loggedUser['last_name']:''; ?></span>&nbsp; 
            | &nbsp; <a href="<?=COMPANY_WEBROOT?>home/choose_language"><i class="fa fa-language"></i><span><?php $language = $this->Session->read('language');  echo $language['name']; ?></span></a>
          </a>
          <ul class="dropdown-menu">
            <!-- User image -->
            <li class="user-header">
              <p>
                <?php echo (!empty($loggedUser))?$loggedUser['first_name'].' '.$loggedUser['last_name']:''; ?>
                <small>Member since <?php echo (!empty($loggedUser))?date('M, Y',strtotime($loggedUser['user_added_date'])):''; ?></small>
              </p>
              <div class="text-center">
                <a href="<?=COMPANY_WEBROOT?>logins/logout" class="btn btn-default btn-flat">Sign out</a>
              </div>
            </li>                  
            <!-- Menu Footer-->
          </ul>
        </li>
      </ul>
    </div>
  </nav>
</header>

