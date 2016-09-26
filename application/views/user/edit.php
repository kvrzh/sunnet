<section class="content-header">
    <h1>Редактировать пользлвателя/ помещение</h1>
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

   				<form method="post"    class="form-horizontal" action="<?php echo base_url('user/edit_action');?>"  enctype="multipart/form-data" >
   				<input type="hidden" name="id" value="<?=$user->id?>">
   				<input type="hidden" name="photo" value="<?=$user->photo?>">
   				<input type="hidden" name="passport" value="<?=$user->passport?>">
	        		<div class="form-group">
				  			<label  class="control-label col-md-2">ФИО/название помещения*</label>
				  	<div class="col-md-6">
				  		<input type="text" id="name" name="name" value="<?=$user->name?>"  class="form-control" required>
				  	</div>	
				  	</div>	

	        		<div class="form-group">
				  			<label  class="control-label col-md-2">Логин</label>
				  	<div class="col-md-6">
				  		<input type="text" value="<?=$user->login?>" name="login" class="form-control">
				  	</div>	
				  	</div>	
	        		<div class="form-group">
				  			<label  class="control-label col-md-2">Пароль</label>
				  	<div class="col-md-6">
				  		<input type="text" value="<?=decode_pass($user->password)?>" name="password" class="form-control">
				  	</div>
				  	<div class="col-md-2">
				  		<button id="generate" class="btn bg-blue btn-block">Сгенерировать</button>
				  	 </div>	
				  	</div>	
	        		<div class="form-group">
			  			<label  class="control-label col-md-2">Роль*</label>
					  	<div class="col-md-6">
					  	<select id="role" class="form-control" name="role">
					  		<?if($roles):?>
					  		<?foreach($roles as $key=>$value):?>
					  			<option <?=$value->id==$user->role?"selected='selected'":""?> value="<?=$value->id?>"><?=$value->title?></option>
					  		<?endforeach;?>
				  			<?endif;?>
			  			</select>
					  	</div>	
			  		</div>

	        		<div class="form-group">
				  			<label   class="control-label col-md-2">Телефон</label>
				  	<div class="col-md-6">
				  		<input value="<?=$user->phone?>" type="text" name="phone" class="form-control">
				  	</div>	
				  	</div>
				  	<div class="form-group">
				  		<div class="col-md-4">
				  			<?if($user->photo):?>
				  				<img class="img-responsive" src="<?=base_url('uploads/users/'.$user->photo)?>">
				  			<?endif;?>
				  		</div>
				  		<div class="col-md-4">
				  			<?if($user->passport):?>
				  			<img class="img-responsive" src="<?=base_url('uploads/users/'.$user->passport)?>">
				  			<?endif;?>
				  		</div>
				  		
				  	</div>
		  			<div class="form-group">
					<label class="col-md-2 control-label">Электронные замки</label>
						<div class="col-md-8">
							<select class="form-control select2" name="lock[]" multiple="multiple" placeholder="Замки">
							<option></option>
							<?if($lock):?>
									<?foreach($lock as $key=>$value):?>	
										<?if(isset($user_lock)):?>
										<option <?=array_key_exists($value->id, $user_lock)?'selected':''?> value="<?=$value->id?>"><?=$value->title?></option>
										<?else:?>		
										<option value="<?=$value->id?>"><?=$value->title?></option>
										<?endif;?>
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
	<div class="col-md-2">
		<?if($user->active==1):?>
			<a href="<?=base_url('user/active_action/'.$user->id)?>" class="btn btn-block btn-danger btn-flat">Деактивировать</a>
		<?else:?>
			<a href="<?=base_url('user/active_action/'.$user->id)?>" class="btn btn-block btn-success btn-flat">Активировать</a>
		<?endif;?>
		<a href="<?=base_url('option/permission/'.$user->id)?>" class="btn btn-block btn-success btn-flat">Права доступа</a>
		<button onclick=copy("<?=base_url('user/copy_user/'.$user->id)?>") id="copy" class="btn btn-block btn-success btn-warning">Копия</button>
	</div>
	
</div>

</section>
<script type="text/javascript">
$(document).ready(function(){
	$('.select2').select2({
	placeholder:"Замок"
})
	$('#generate').on('click',function(){
		var password="<?=gen_password()?>";
		$('input[name=password]').val(password);
		return false;


	})
})
	function copy(link){
		console.log(link);
        
        bootbox.confirm({
        buttons: {
            confirm: {label: 'Создать копию',},
            cancel: {label: 'Не создавать'}
        },
    message: "Вы собираетесь создать копию учетной записи "+ $('#name').val()+" ("+$('#role option:selected').html()+')',
    callback: function(result) {
     if(result){
         window.location=link; 
        }
    },
    title: "Создание копии",
    });
};
</script>
