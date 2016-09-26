<section class="content-header">
    <h1>Добавление доходов и расходов<small></small></h1>
</section>
<section class="content">
<div class="row">
	<div class="col-md-10">
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
		<div class="box box-success">
            <div class="box-body">
             <form role="form" method="post" class="form-horizontal" action="<?php echo base_url('budget/create_action');?>">
	        		<input type="hidden" name="user_id" value="<?=$this->session->userdata('user_id')?>">
	        		<?if($get):?>
					<div class="form-group">
					  	<label class="control-label col-md-2">Статья*</label>
					  	<div class="col-md-4">
							<select name="type_id" class="form-control select" required>
								<?if($types):?>
									<?$type=0;?>
									<?foreach($types as $key=>$value):?>			
										<?if($type!=$value->type):?>
											<optgroup label="<?=$value->type_title?>"></optgroup>
										<?endif;?>
										<option <?=($value->id==5)?"selected":""?> value="<?=$value->id?>"><?=$value->title?></option>
										<?$type=$value->type;?>
									<?endforeach;?>
								<?endif;?>
	
							</select>
				  		</div> 		
					</div>
					<div class="form-group">
					  	<label class="control-label col-md-2">Зарплата *</label>
					  	<div class="col-md-4">
							<select name="user_in" class="form-control select2">
								<?if($users):?>
									<option></option>
									<?foreach($users as $key=>$value):?>
										<?if($value->role==5):?>
											<option <?=$value->id==$get['user_id']?'selected':''?> value="<?=$value->id?>"><?=$value->name?></option>
										<?else:?>
											<option  <?=$value->id==$get['user_id']?'selected':''?> class="not_point"  value="<?=$value->id?>"><?=$value->name?></option>
										<?endif?>
									<?endforeach;?>
								<?endif;?>
	
							</select>
			  			</div>
						 		
					</div>
	        		<div class="form-group">
		  				<label  class="control-label col-md-2">Сумма*</label>
					  	<div class="col-md-6">
					  		<input type="number" step="0.01" min="0" name="sum" class="form-control" value="<?=$get['sum_out']?>"  required>
					  	</div>	
					</div>
					<?else:?>
					<div class="form-group">
					  	<label class="control-label col-md-2">Статья*</label>
					  	<div class="col-md-4">
							<select name="type_id" class="form-control select" required>
								<?if($types):?>
									<?$type=0;?>
									<?foreach($types as $key=>$value):?>			
										<?if($type!=$value->type):?>
											<optgroup label="<?=$value->type_title?>"></optgroup>
										<?endif;?>
										<option value="<?=$value->id?>"><?=$value->title?></option>
										<?$type=$value->type;?>
									<?endforeach;?>
								<?endif;?>
	
							</select>
				  		</div>
						 		
					</div>
					<div class="form-group">
					  	<label class="control-label col-md-2">Зарплата *</label>
					  	<div class="col-md-4">
							<select name="user_in" class="form-control select2">
								<?if($users):?>
									<option></option>
									<?foreach($users as $key=>$value):?>
										<?if($value->role==5):?>
											<option value="<?=$value->id?>"><?=$value->name?></option>
										<?else:?>
											<option class="not_point"  value="<?=$value->id?>"><?=$value->name?></option>
										<?endif?>
									<?endforeach;?>
								<?endif;?>
	
							</select>
			  			</div>
						 		
					</div>
	        		<div class="form-group">
		  				<label  class="control-label col-md-2">Сумма*</label>
					  	<div class="col-md-6">
					  		<input type="number" step="0.01" min="0" name="sum" class="form-control" required>
					  	</div>	
					</div>

					<?endif;?>
	        		<div class="form-group">
		  				<label  class="control-label col-md-2">Коментарий</label>
					  	<div class="col-md-6">
					  		<textarea class="form-control" name="comment"></textarea>
					  	</div>	
					</div>
					<div class="form-group">
					  	<label class="control-label col-md-2">Место (источник)</label>
					  	<div class="col-md-4">
							<select name="user_out" class="form-control select2">
								<?if($users):?>
								<option></option>
									<?foreach($users as $key=>$value):?>
										<?if($value->role==5):?>
										<option value="<?=$value->id?>"><?=$value->name?></option>
										<?endif;?>
									<?endforeach;?>
								<?endif;?>
							</select>
			  			</div>		
					</div>
					
	                <div class="form-group">
                        <div class="col-md-offset-4 col-md-4"  style="margin-top: 0px;">
                            <button type="submit" class="btn bg-black btn-block">Сохранить</button>
                        </div>
                	</div>

		       			 
		        </div>
		    </form>
            </div>
        </div>
	</div>
	

		
</section>
<script type="text/javascript">
    /*$('.select2').select2({
            placeholder: "Выберите человек/ точку из списка",
        });
        $('.select').select2({
            placeholder: "Выберите статью",
        });*/
$(document).ready(function(){
	$('select[name=type_id]').on('change',function(){
		var type=$('select[name=type_id] option:selected').val()
		if(type==8){
			$(".not_point").each(function(){
				$(this).css('display','none');
			});
		}
		else{
			$(".not_point").each(function(){
				$(this).show();
			});
		}
	});
});
</script>