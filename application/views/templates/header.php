<html>
<head>
 	<meta charset="UTF-8">
 	<title>SunNET</title>

      <link rel="stylesheet" type="text/css" href="//cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.5.0/fullcalendar.min.css">
    <link  media="print" rel="stylesheet" type="text/css" href="//cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.5.0/fullcalendar.print.css">
	 <link rel="stylesheet" href="<?=lte_url()?>bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" href="<?=lte_url()?>dist/css/AdminLTE.min.css">
    <link rel="stylesheet" href="<?=lte_url()?>dist/css/skins/_all-skins.min.css">
    <link rel="stylesheet" href="<?=lte_url()?>plugins/iCheck/flat/blue.css">
    <link rel="stylesheet" href="<?=lte_url()?>plugins/morris/morris.css">
    <link rel="stylesheet" href="<?=lte_url()?>plugins/jvectormap/jquery-jvectormap-1.2.2.css">
    <link rel="stylesheet" href="<?=lte_url()?>plugins/datepicker/datepicker3.css">
    <link rel="stylesheet" href="<?=lte_url()?>plugins/daterangepicker/daterangepicker-bs3.css">
    <link rel="stylesheet" href="<?=lte_url()?>plugins/colorpicker/bootstrap-colorpicker.min.css">
    <link rel="stylesheet" href="<?=lte_url()?>plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
    <link rel="stylesheet" href="<?=asset_url()?>css/bootstrap-datetimepicker.min.css">
    <link rel="stylesheet" href="<?=asset_url()?>css/lte.css">
     <link href="<?=lte_url()?>plugins/bootstrap-slider/slider.css" rel="stylesheet" type="text/css" />
    <link href="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/css/select2.min.css" rel="stylesheet" />
      <link href="<?=asset_url()?>css/scheduler.css" rel="stylesheet" />
       <link rel="stylesheet" href="<?=lte_url()?>plugins/timepicker1/bootstrap-datetimepicker.min.css">
       <link href="https://cdnjs.cloudflare.com/ajax/libs/ekko-lightbox/4.0.1/ekko-lightbox.css" rel="stylesheet" type="text/css" />
       

    <link href="https://cdn.datatables.net/1.10.9/css/dataTables.bootstrap.min.css" rel="stylesheet" type="text/css" />
        <script src="<?=asset_url()?>js/pace.min.js"></script>
    <link rel="stylesheet" href="<?=asset_url()?>css/pace.css">
</head>
<body class="hold-transition skin-green sidebar-mini <?=$close?>" id="sidebar" >
<div class="wrapper">
  <header class="main-header">
    <a href="<?=base_url('main')?>" class="logo">
      <span class="logo-mini">SN</span>
      <span class="logo-lg"><b>Sun</b>NET</span>
    </a>
    <nav class="navbar navbar-static-top" role="navigation">
      <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>
    </nav>
  </header>
  <aside class="main-sidebar">
    <section class="sidebar">
      <div class="user-panel">
        <div class="pull-left image">
          <i style="font-size:50px" class="ion-ios-person-outline text-red"></i>
        </div>
        <div class="pull-left info">
          <p><?=$this->session->userdata('user_name')?></p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
