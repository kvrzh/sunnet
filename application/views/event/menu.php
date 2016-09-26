
    <div class="wrapper">

      <header class="main-header">
        <!-- Logo -->
        <a href="<?=base_url('event')?>" class="logo">
          <!-- mini logo for sidebar mini 50x50 pixels -->
          <span class="logo-mini">DT</span>
          <!-- logo for regular state and mobile devices -->
          <span class="logo-lg">DATATOOL</span>
        </a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" role="navigation">
          <!-- Sidebar toggle button-->
          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
          </a>
                              <div class="navbar-custom-menu">
                <ul class="nav navbar-nav">
                <li class="messages-menu"><a href="<?=base_url('lang/change/en')?>"><?=lang('en')?></a></li>
                <li class="messages-menu"><a href="<?=base_url('lang/change/nl')?>"><?=lang('nl')?></a></li>
            </div>
        </nav>

      </header>
      <!-- Left side column. contains the logo and sidebar -->
      <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
          <!-- Sidebar user panel -->
          <div class="user-panel">
            <div class="pull-left image">
              <i style="font-size:50px" class="ion-ios-person-outline text-red"></i>
            </div>
            <div class="pull-left info">
              <p><?=$this->session->userdata('user_name')?></p>
              <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
          </div>
          <!-- search form -->

          <!-- /.search form -->
          <!-- sidebar menu: : style can be found in sidebar.less -->
       <ul class="sidebar-menu">
            <li><a href="<?=base_url('event/create')?>"><i class="fa fa-circle-o text-red"></i> <span><?=lang('create_event')?></span></a></li>
            <li><a href="<?=base_url('event/all')?>"><i class="fa fa-circle-o text-yellow"></i> <span><?=lang('my_event')?></span></a></li>
            <li><a href="<?=base_url('user/profile')?>"><i class="fa fa-circle-o text-green"></i> <span><?=lang('my_profile')?></span></a></li>
            <li><a href="<?=base_url('user/logout')?>"><i class="fa fa-circle-o text-aqua"></i> <span><?=lang('logout')?></span></a></li>
          </ul>
        </section>
        <!-- /.sidebar -->
      </aside>

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->