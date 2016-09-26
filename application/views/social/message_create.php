<section class="content-header">
<h1>Отправка Сообщения</h1>
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

	<div class="box box-primary">
		<div class="box-header with-border">
			<h4>Сообщение</h4>
			</div>
			<div class="box-body">
				<form id="user" action="<?=base_url("social/message_create_action");?>" method="POST" class="form-horizontal" enctype="multipart/form-data">
					<input type="hidden" name="sender_id" value="<?=$this->session->userdata('user_id')?>">
					<div class="form-group">
					<input type="hidden" value="<?=$dialog?>" name='dialog'>
					<input type="hidden" value="<?=$message_id?>" name='message_id'>
						<label class="col-md-2 control-label">Получатель</label>
						<div class="col-md-8">
							<select class="form-control select2" name="recipient_id[]" multiple="multiple" placeholder="Кому">
							<option></option>
							<?if($users):?>
									<?$type=0;?>
									<?foreach($users as $key=>$value):?>			
										<?if($type!=$value->role):?>
											<optgroup label="<?=$value->role_title?>"></optgroup>
										<?endif;?>
										<option <?=($value->id==$recipient_id)?'selected':''?> value="<?=$value->id?>"><?=$value->name?></option>
										<?$type=$value->role;?>
								<?endforeach;?>
							<?endif;?>
							</select>

						</div>
					</div>
					<div class="form-group">
						<label class="col-md-2 control-label">Группы</label>
						<div class="col-md-8">
									<select class="form-control select2" name="roles[]" multiple="multiple" placeholder="Кому">
											<option></option>
								<?if($roles):?>
									<?foreach($roles as $key=>$value):?>
										<option value="<?=$value->id?>"><?=$value->title?></option>
									<?endforeach;?>
								<?endif;?>
								
							</select>
						</div>
					</div>
					
					<div class="form-group">
						<div class="col-md-12">
						<input class="form-control" value="<?=$subject?>" name="subject" placeholder="Тема сообщений" required>
					</div>

					</div>
					<div class="form-group">
					<div class="col-md-12">

						
						<?if($recipient):?>
						 <div class="direct-chat-text">
							<span class="bg-grey-active"><?=$recipient?>: "<?=strip_tags($text)?>"</span>
							</div>
						<?endif;?>
					</div>
					</div>
					<div class="col-md-12">
						<div class="form-group">
						<textarea  class="textarea"  style="width: 100%;" name="text" rows="10" placeholder="Сообщение">
						</textarea>
						</div>   
					</div>
					<div class="form-group">                    
				
                             <input type="file" name="file">

                    </div>
                    <div class="col-md-2">
                  		<div class="checkbox"><label><input name="general" type="checkbox">Общий файл</label></div>	
                    </div>
						<div class="col-md-offset-4 col-md-4">
						<button type="submit" class="btn bg-black btn-block"><i class="fa fa-paper-plane"></i>Отправить</button>
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
	$(".textarea").wysihtml5();
	$('.select2').select2({
		placeholder:"Кому"
	});
});
</script>



