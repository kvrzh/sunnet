<section class="content-header">
    <h1>Добавить Премию/штраф<small></small></h1>
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
             <form role="form" method="post" class="form-horizontal" action="<?php echo base_url('budget/user_fine_create_action');?>"  enctype="multipart/form-data">
        			<input type="hidden" name="date" value="<?=date('U')?>">
        			<input type="hidden" name="user_adm_id" value="<?=$this->session->userdata('user_id')?>">
             		<div class="form-group">
             			<label class="col-md-2 control-label">Тип</label>
             			<div class="col-md-4">
             				<select class="form-control" name="type">
             					<option value="1">Премия</option>
             					<option value="2">Штраф</option>
             					
             				</select>
             				
             			</div>
             		</div>
	        		<div class="form-group">
				  			<label  class="control-label col-md-2">Сумма*</label>
				  	<div class="col-md-4">
				  		<input type="number" step="0.01" min="0"  name="sum" class="form-control" required>
				  	</div>	
					</div>
					<div class="form-group">
					  	<label class="control-label col-md-2">Пользователь*</label>
					  	<div class="col-md-4">
								<select name="user_id" class="form-control select2">
									<?if($users):?>
										<?foreach($users as $key=>$value):?>
											<option value="<?=$value->id?>"><?=$value->name?></option>
										<?endforeach;?>
									<?endif;?>
								</select>
					  	</div>
					</div>
					<div class="form-group">
						<label class="col-md-2 control-label">Коментарий</label>
						<div class="col-md-6">
							<textarea name="comment" class="form-control"></textarea>
						</div>
						
					</div>
					<div class="form-group">                    
						<div class="col-md-2">
	                        <div class="btn btn-default btn-file">Прикрепить
	                            <i class="fa fa-paperclip"></i> 
	                             <input type="file" name="file">
	                        </div>
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
$(document).ready(function(){
		$('.select2').select2();
})


</script>