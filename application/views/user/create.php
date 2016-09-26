<section class="content-header">
    <h1>Создать пользователя/ помещение</h1>
</section>
<section class="content">
<div class="row">
	<div class="col-md-10">

	        <?if($this->session->flashdata('danger')):?>
        <div class="alert alert-danger alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <?=$this->session->flashdata('danger')?>
        </div>
        <?endif;?>
	    <div class="box box-success">
	        <div class="box-body">
   				<form method="post"    class="form-horizontal" action="<?php echo base_url('user/create_action');?>"  enctype="multipart/form-data" >

	        		<div class="form-group">
				  			<label  class="control-label col-md-2">ФИО/название помещения*</label>
				  	<div class="col-md-6">
				  		<input type="text" name="name" class="form-control" required>
				  	</div>	
				  	</div>	

	        		<div class="form-group">
				  			<label  class="control-label col-md-2">Логин</label>
				  	<div class="col-md-6">
				  		<input type="text" name="login" class="form-control">
				  	</div>	
				  	</div>	
	        		<div class="form-group">
				  			<label  class="control-label col-md-2">Пароль</label>
				  	<div class="col-md-6">
				  		<input type="text" name="password" class="form-control">
				  	</div>
				  	<div class="col-md-2">
				  		<button id="generate" class="btn bg-blue btn-block">Сгенерировать</button>
				  	 </div>	
				  	</div>	
	        		<div class="form-group">
			  			<label  class="control-label col-md-2">Роль*</label>
					  	<div class="col-md-6">
					  	<select class="form-control" name="role">
					  		<?if($roles):?>
					  		<?foreach($roles as $key=>$value):?>
					  			<option value="<?=$value->id?>"><?=$value->title?></option>
					  		<?endforeach;?>
				  			<?endif;?>
			  			</select>
					  	</div>	
			  		</div>

	        		<div class="form-group">
				  			<label  class="control-label col-md-2">Телефон</label>
				  	<div class="col-md-6">
				  		<input type="text" name="phone" class="form-control">
				  	</div>	
				  	</div>
				  	<div class="form-group">
					<label class="col-md-2 control-label">Электронные замки</label>
						<div class="col-md-8">
							<select class="form-control select2" name="lock[]" multiple="multiple" placeholder="Замки">
							<option></option>
							<?if($lock):?>
									<?foreach($lock as $key=>$value):?>			
										<option value="<?=$value->id?>"><?=$value->title?></option>
								<?endforeach;?>
							<?endif;?>
							</select>
						</div>
				  		
				  	</div>
	                <div class="form-group">
                    <label class="col-md-2 control-label">Фото профиля</label>
                    <div class="col-md-2">
                        <div class="btn btn-default btn-file">
                            <i class="fa fa-paperclip"></i> Прикрепить
                             <input type="file"   name="photo" multiple="true"  />
                            </div>
                        <p class="help-block">Максимум. 1МБ.</p>
                    </div>
                    <label class="col-md-2 control-label">Фото Паспорта </label>
                    <div class="col-md-2">
                        <div class="btn btn-default btn-file">Прикрепить
                            <i class="fa fa-paperclip"></i> 
                             <input type="file" name="passport" multiple="true"  />
                            </div>
                        <p class="help-block">Максимум. 1МБ.</p>
                    </div>
                </div>
	                <div class="form-group">
                        <div class="col-md-offset-4 col-md-4"  style="margin-top: 0px;">
                            <button type="submit" class="btn bg-black btn-block">Сохранить</button>
                        </div>
                	</div>	

		    </form>
        	</div>

		</div>
		
	</div>
	
</div>

</section>
<script type="text/javascript">
$(document).ready(function(){
	$('#generate').on('click',function(){
		var password="<?=gen_password()?>";
		$('input[name=password]').val(password);
		return false;


	})
})
$('.select2').select2({
	placeholder:"Замок"
})

</script>
