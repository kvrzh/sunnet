 <section class="content-header">
    <h1><?=lang('my_profile')?><small></small></h1>
</section>
<section class="content">
<div class="row">
	<div class="col-md-9">
    <?if($this->session->flashdata('success')):?>
      <div class="alert alert-success alert-dismissible">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <?=$this->session->flashdata('success')?>
      </div>
    <?endif;?>
		<div class="box box-success">
            <div class="box-body">
             <form role="form" method="post"   class="form-horizontal " data-toggle="validator" action="<?php echo base_url('user/change');?>"> 
		       			<input type="hidden" name="id" value="<?=$user->id?>">
			        		<div class="form-group">
					  			<label for="inputEmail" class="control-label col-md-2"><?=lang('name')?> *</label>
					  	<div class="col-md-6">
					  		<input name="name" class="form-control" data-error="Name can not be empty" value="<?=$user->name?>" required>
						<div class="help-block with-errors"></div>
					  	</div>	
					</div>
					<div class="form-group">
					  	<label for="inputEmail" class="control-label col-md-2"><?=lang('email')?> *</label>
					  	<div class="col-md-6">
					  		<input name="email" type="email" class="form-control" data-error="Not valid Email" value="<?=$user->email?>" required>
						<div class="help-block with-errors"></div>
					  	</div>
						 		
					</div>
					<div class="form-group">
						<label class="control-label col-md-2"><?=lang('pass')?> *</label>
						<div class="col-md-4">
							 	<input name="password" type="password" data-minlength="6" data-error="Minimum of 6 characters" value="<?=decode_pass($user->password)?>" class="form-control" id="inputPassword" placeholder="Password" required>
								<div class="help-block with-errors"></div>
						</div>
						<div class=" col-md-4">
								<input type="password" class="form-control"  data-match="#inputPassword" data-error="Whoops, these don't match" value="<?=decode_pass($user->password)?>" placeholder="Confirm" required>
								<div class="help-block with-errors"></div>
						</div>
					</div>
		  			<div class="form-group">
					  	<label class="control-label col-md-2"><?=lang('website')?> </label>
					  	<div class="col-md-6">
					  		<input name="website"  value="<?=$user->website?>" class="form-control" >
						<div class="help-block with-errors"></div>
					  	</div> 		
					</div>
					<div class="form-group">
						<label class="control-label col-md-2"><?=lang('phone')?></label>
						<div class="col-md-6">
							 	<input name="phone" type="number" value="<?=$user->phone?>" data-minlength="6" data-error="Not correct phone number" class="form-control" >
								<div class="help-block with-errors"></div>
						</div>

					</div>
	                <div class="form-group">
                        <div class="col-md-offset-4 col-md-4"  style="margin-top: 0px;">
                            <button type="submit" class="btn bg-black btn-block"><?=lang('save')?></button>
                        </div>
                	</div>

		       			     
		        </div>
		    </form>
            </div>
        </div>

	</div>
	

		
</section>
