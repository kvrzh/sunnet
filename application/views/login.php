    <link rel="stylesheet" href="<?=lte_url()?>bootstrap/css/bootstrap.min.css">
            <link rel="stylesheet" href="<?=lte_url()?>dist/css/AdminLTE.min.css">
    <link rel="stylesheet" type="text/css" href="<?=asset_url().'css/login.css'?>">

    <title>Вход</title>
    <div class="container">
        <div class="card card-container">
            <div id="header">SunNet</div>
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
            <form class="form-signin"  method="post"  action='<?=base_url('user/login');?>'>
                <span id="reauth-email" class="reauth-email"></span>
                <input type="text" name="login"  id="inputEmail" class="form-control" placeholder="Логин" required autofocus>
                <input type="password" name="password"  id="inputPassword" class="form-control" placeholder="Пароль" required>

                <button class="btn btn-lg btn-primary btn-block btn-signin" type="submit">Войти</button>
            </form><!-- /form -->

               
        
            </div>
    
        </div><!-- /card-container -->
    </div><!-- /container -->
    <script src="<?=lte_url()?>plugins/jQuery/jQuery-2.1.4.min.js"></script>
<script src="<?=lte_url()?>bootstrap/js/bootstrap.min.js"></script>

<script type="text/javascript">

</script>