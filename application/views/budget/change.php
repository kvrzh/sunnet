<section class="content-header">
    <h1>Редактирование доходов и расходов<small></small></h1>
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
             <form role="form" method="post" class="form-horizontal" action="<?php echo base_url('budget/change_action');?>">
	        		<input type="hidden" name="user_id" value="<?=$this->session->userdata('user_id')?>">
	        		<input type="hidden" name="budget_id" value="<?=$budget->id?>">
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
										<option <?=($value->id==$budget->type_id)?"selected":""?> value="<?=$value->id?>"><?=$value->title?></option>
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
											<option  <?=($value->id==$budget->user_in)?"selected":""?> value="<?=$value->id?>"><?=$value->name?></option>
										<?else:?>
											<option <?=($value->id==$budget->user_in)?"selected":""?> class="not_point"  value="<?=$value->id?>"><?=$value->name?></option>
										<?endif?>
									<?endforeach;?>
								<?endif;?>
	
							</select>
			  			</div>
						 		
					</div>
	        		<div class="form-group">
		  				<label  class="control-label col-md-2">Сумма*</label>
					  	<div class="col-md-6">
					  		<input type="number" value="<?=$budget->sum_in?$budget->sum_in:$budget->sum_out?>" step="0.01" min="0" name="sum" class="form-control" required>
					  	</div>	
					</div>
	        		<div class="form-group">
		  				<label  class="control-label col-md-2">Коментарий</label>
					  	<div class="col-md-6">
					  		<textarea class="form-control"  name="comment"><?=$budget->comment?></textarea>
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
										<option <?=($value->id==$budget->user_out)?"selected":""?> value="<?=$value->id?>"><?=$value->name?></option>
										<?endif;?>
									<?endforeach;?>
								<?endif;?>
							</select>
			  			</div>		
					</div>
					
	                <div class="form-group">
                        <div class="col-md-offset-4 col-md-4"  style="margin-top: 0px;">
                            <button type="submit" class="btn bg-black btn-block">Редактировать</button>
                        </div>
                	</div>
		       			 
		        </div>
		    </form>
            </div>
        </div>
        <div class="col-md-2">
        <a href="<?=base_url('budget/budget_delete_action/'.$budget->id)?>" class="btn btn-block btn-danger btn-flat">Удалить</a> 
    </div>
	</div>
<div class="row">
	<div class="col-md-10">
	<?if($budget_change):?>
	<h3>Список изминений<h3>
		<table id="data" class="table table-striped table-bordered" cellspacing="0" width="100%">
		    <thead>
		        <tr>   
		        <th >Дата</th>
		        <th >Получатель</th>
		        <th >Тип</th>
		        <th >Доход</th>
		        <th >Расход</th>
		        <th >Коментарий</th>
		        <th >Источник</th>
		        <th >Создал</th>
		        </tr>
		    </thead> <tbody>
		        <?foreach($budget_change as $key=>$value):?>
		            <tr>
		            <td><?=default_dt($value->date)?></td>
		            <td><?=$value->in?></a></td>
		            <td><?=$value->type?></td>
		            <td><?=$value->sum_in?></td>
		            <td><?=$value->sum_out?></td>
		            <td><?=$value->comment?></td>
		            <td><?=$value->out?></td>
		            <td><?=$value->user?></td>
		           

		            </tr>
		        <?endforeach;?>  

		</tbody></table>
		<?endif;?>
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