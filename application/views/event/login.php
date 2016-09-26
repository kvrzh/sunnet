<!--<section class="bg-roman">
<div class="form-box" id="login-box">
    <div class="header">Sign In</div>
      
           

    <form role="form" method="post" action='<?php echo base_url('user/login');?>'>
        <div class="body bg-gray">
 
            <div class="form-group">
                <input type="text" name="email" class="form-control" placeholder="<?php echo lang('username'); ?>"/>
            </div>
            <div class="form-group">
                <input type="password" name="password" class="form-control" placeholder="<?php echo lang('password'); ?>"/>
            </div>
            <div class="form-group">
                <input type="checkbox" name="remember_me"/> Remember me
            </div>
        </div>
        <div class="footer">
            <button type="submit" class="btn bg-olive btn-block">Login</button>


            <p><a href="<?php echo base_url('user/registration');?>">Registration</a></p>
        </div>
    </form>
</div>
</section>-->
<!--
    you can substitue the span of reauth email for a input with the email and
    include the remember me checkbox
    -->

    <link rel="stylesheet" href="<?=lte_url()?>bootstrap/css/bootstrap.min.css">
            <link rel="stylesheet" href="<?=lte_url()?>dist/css/AdminLTE.min.css">
    <link rel="stylesheet" type="text/css" href="<?=asset_url().'css/login.css'?>">

    <title>Login</title>
    <div class="container">
        <div class="card card-container">
            <div id="header">Login</div>
            <div id="content">
            <?if($this->session->flashdata('success')):?>
                <div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <?=$this->session->flashdata('success')?>
                </div>
            <?endif;?>

            <?if($this->session->flashdata('danger')):?>
                <div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <?=$this->session->flashdata('danger')?>
                </div>
            <?endif;?>
            <!-- <img class="profile-img-card" src="//lh3.googleusercontent.com/-6V8xOA6M7BA/AAAAAAAAAAI/AAAAAAAAAAA/rzlHcD0KYwo/photo.jpg?sz=120" alt="" /> -->
            <p id="profile-name" class="profile-name-card"></p>
            <form class="form-signin"  method="post"  action='<?=base_url('user/login');?>'  autocomplete="off">
                <span id="reauth-email" class="reauth-email"></span>
                <input type="email" name="email"  id="inputEmail" class="form-control" placeholder="Email address" required autofocus>
                <input type="password" name="password"  id="inputPassword" class="form-control" placeholder="Password" required>

                <button class="btn btn-lg btn-primary btn-block btn-signin" type="submit">Login</button>
            </form><!-- /form -->

               
        
            </div>
             <p><a id="link" href="<?php echo base_url('user/registration');?>"><?=lang('registration')?></a></p>
        </div><!-- /card-container -->
    </div><!-- /container -->
    <script src="<?=lte_url()?>plugins/jQuery/jQuery-2.1.4.min.js"></script>
<script src="<?=lte_url()?>bootstrap/js/bootstrap.min.js"></script>

<script type="text/javascript">

</script>