<!--<section class="bg-roman">
<div class="form-box register" id="login-box">
    <div class="header">Registraion Form</div>
    <form role="form" method="post"   class="form-horizontal formself" data-toggle="validator" action="<?php echo base_url('user/register');?>">
        <div class="body bg-gray">
       		<div class="row">

	        		<div class="form-group">
			  			<label for="inputEmail" class="control-label col-md-2">Name *</label>
			  	<div class="col-md-6">
			  		<input name="name" class="form-control" data-error="Name can not be empty" required>
				<div class="help-block with-errors"></div>
			  	</div>	
			</div>
			<div class="form-group">
			  	<label for="inputEmail" class="control-label col-md-2">Email *</label>
			  	<div class="col-md-6">
			  		<input name="email" type="email" class="form-control" data-error="Not valid Email" required>
				<div class="help-block with-errors"></div>
			  	</div>
				 		
			</div>
			<div class="form-group">
				<label class="control-label col-md-2">Password *</label>
				<div class="col-md-4">
					 	<input name="password" type="password" data-minlength="6" data-error="Minimum of 6 characters" class="form-control" id="inputPassword" placeholder="Password" required>
						<div class="help-block with-errors"></div>
				</div>
				<div class=" col-md-4">
						<input type="password" class="form-control"  data-match="#inputPassword" data-error="Whoops, these don't match" placeholder="Confirm" required>
						<div class="help-block with-errors"></div>
				</div>
			</div>
  			<div class="form-group">
			  	<label class="control-label col-md-2">Website </label>
			  	<div class="col-md-6">
			  		<input name="website"  class="form-control" >
				<div class="help-block with-errors"></div>
			  	</div> 		
			</div>
			<div class="form-group">
				<label class="control-label col-md-2">Phone number</label>
				<div class="col-md-6">
					 	<input name="phone" type="number" data-minlength="6" data-error="Not correct phone number" class="form-control" >
						<div class="help-block with-errors"></div>
				</div>

			</div>

       			
   		</div>     
        </div>
        <div class="footer">
            <button type="submit" class="btn bg-olive btn-block">Registration</button>

            <p><a href="<?php echo base_url('user/registration');?>">Login</a></p>
        </div>
    </form>
</div>
</section>-->

    <link rel="stylesheet" href="<?=lte_url()?>bootstrap/css/bootstrap.min.css">
            <link rel="stylesheet" href="<?=lte_url()?>dist/css/AdminLTE.min.css">
    <link rel="stylesheet" type="text/css" href="<?=asset_url().'css/login.css'?>">

<title><?=lang('registration')?></title>
    <div class="container">
        <div class="card reg-container">
            <div id="header"><?=lang('registration')?></div>
            <div id="content">

            <!-- <img class="profile-img-card" src="//lh3.googleusercontent.com/-6V8xOA6M7BA/AAAAAAAAAAI/AAAAAAAAAAA/rzlHcD0KYwo/photo.jpg?sz=120" alt="" /> -->
            <p id="profile-name" class="profile-name-card"></p>
              <form role="form" method="post"   class="form-signin form-horizontal formself" data-toggle="validator" action="<?php echo base_url('user/register');?>"
                       		<div class="row">

	        		<div class="form-group">
			  			<label for="inputEmail" class="control-label col-md-3"><?=lang('name')?> *</label>
			  	<div class="col-md-6">
			  		<input name="name" class="form-control" data-error="<?=lang('empty msg')?>" required>
				<div class="help-block with-errors"></div>
			  	</div>	
			</div>
			<div class="form-group">
			  	<label for="inputEmail" class="control-label col-md-3"><?=lang('email')?> *</label>
			  	<div class="col-md-6">
			  		<input name="email" type="email" class="form-control" data-error="<?=lang('er_value')?>" required>
				<div class="help-block with-errors"></div>
			  	</div>
				 		
			</div>
			<div class="form-group">
				<label class="control-label col-md-3"><?=lang('pass')?> *</label>
				<div class="col-md-4">
					 	<input name="password" type="password" data-minlength="6" data-error="<?=lang('er_value')?>" class="form-control" id="inputPassword" placeholder="Password" required>
						<div class="help-block with-errors"></div>
				</div>
				<div class=" col-md-4">
						<input type="password" class="form-control"  data-match="#inputPassword" data-error="<?=lang('er_value')?>" placeholder="Confirm" required>
						<div class="help-block with-errors"></div>
				</div>
			</div>
  			<div class="form-group">
			  	<label class="control-label col-md-3"><?=lang('website')?> </label>
			  	<div class="col-md-6">
			  		<input name="website"  class="form-control" >
				<div class="help-block with-errors"></div>
			  	</div> 		
			</div>
			<div class="form-group">
				<label class="control-label col-md-3"><?=lang('phone')?></label>
				<div class="col-md-6">
					 	<input name="phone" type="number" data-minlength="6" data-error="<?=lang('er_value')?>" class="form-control" >
						<div class="help-block with-errors"></div>
				</div>
				 <button type="submit" class="btn btn-lg btn-primary btn-block btn-signin"><?=lang('registration')?></button>
			</div>

               
            </form><!-- /form -->

               
        
            </div>
                   <p><a id="link" href="<?php echo base_url('user/login');?>">Login</a></p>
        </div><!-- /card-container -->
  
    </div><!-- /container -->
    <script src="<?=lte_url()?>plugins/jQuery/jQuery-2.1.4.min.js"></script>
<script src="<?=lte_url()?>bootstrap/js/bootstrap.min.js"></script>
   <script src="<?=asset_url()?>js/validator.js"></script>

<script type="text/javascript">

</script>