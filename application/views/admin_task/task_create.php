<section class="content-header">
    <h1>Добавить Админ Задачу<small></small></h1>
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
             <form role="form" method="post" class="form-horizontal" action="<?php echo base_url('admin_task/task_create');?>" >
	        		<div class="form-group">
				  			<label  class="control-label col-md-2">Тема*</label>
				  	<div class="col-md-6">
				  		<input type="text"  name="subject" class="form-control" required>
				  	</div>	
					</div>
					<div class="form-group">
						<label class="control-label col-md-2">Коментарий</label>
						<div class="col-md-10">
							<textarea maxlength="250" class="form-control" name="comment"></textarea>	
					</div> 		
					</div>
					<div class="form-group">
					  	<label class="control-label col-md-2">Тип*</label>
					  	<div class="col-md-4">
								<select name="type_id" class="form-control">
									<?if($admin_type):?>
										<?foreach($admin_type as $key=>$value):?>
											<option value="<?=$value->id?>"><?=$value->title?></option>
										<?endforeach;?>
									<?endif;?>
		
		
								</select>
					  	</div>
					  	<input type="hidden" name="status_id">
					  	<!--<label class="control-label col-md-2">Статус*</label>
					  	<div class="col-md-4">

								<select name="status_id" class="form-control">
									<?if($admin_status):?>
										<?foreach($admin_status as $key=>$value):?>
											<option value="<?=$value->id?>"><?=$value->title?></option>
										<?endforeach;?>
									<?endif;?>
								</select>
					  	</div>-->
				  	</div>
				  	<div class="form-group">
			  			<label  class="control-label col-md-2">Дата</label>
					  	<div class="col-md-2">
				  			<input name="date" type='text'  class="form-control date"  required/>
					  	</div>
			  			<label  class="control-label col-md-2">Время</label>
		                    <div class="col-md-2">
					                    <div class="input-group  input-append time ">
			                           	 	<input  class="form-control " required data-format="hh:mm" type="text"  name="start_time"></input>
			                           	 	<span class="input-group-addon add-on">
			                           	 	<i  class="glyphicon glyphicon-time"></i></span>
			                            </div></div>
	          			 <div class="col-md-2">
	          			 	<input type="hidden" value="0" name="urgency">
	                  		<div class="checkbox"><label><input name="urgency" value="1" type="checkbox">Срочность</label></div>	
	                    </div>
	          			 <div class="col-md-2">
	          			 	<input type="hidden" value="0" name="sms">
	                  		<div class="checkbox"><label><input name="sms" value="1" type="checkbox">Отправить SMS</label></div>	
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

$(function() {
    $('.time').datetimepicker({
      pickDate: false,
      pickSeconds: false,
    });
    $('.date').datepicker({language: 'ru'})
  });

</script>