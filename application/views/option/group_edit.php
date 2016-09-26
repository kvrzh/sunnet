<section class="content-header">
    <h1>Редактировать группу<small></small></h1>
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
             <form role="form" method="post" class="form-horizontal" action="<?php echo base_url('option/group_edit_action');?>">
             		<input type="hidden" name="id" value="<?=$group->id?>">
	        		<div class="form-group">
				  			<label  class="control-label col-md-2">Группа*</label>
				  	<div class="col-md-6">
				  		<input type="text" value="<?=$group->title?>" name="title" class="form-control" required>
				  	</div>	
				  	</div>
	
					<div class="form-group">
					  	<label class="control-label col-md-2">Тип*</label>
					  	<div class="col-md-4">
								<select name="type_id" class="form-control">
									<?if($types):?>
										<?foreach($types as $key=>$value):?>
											<option <?=$value->id==$group->type_id?"selected='selected'":""?> value="<?=$value->id?>"><?=$value->title?></option>
										<?endforeach;?>
									<?endif;?>
		
								</select>
					  	</div>
						 		
					</div>
					<div class="form-group">
						<label class="control-label col-md-2">Цвет</label>
						<div class="col-md-4 input-group" id="color">
							<input type="text" value="<?=$group->color?>" name="color" class="form-control" required >
							 <span class="input-group-addon"><i></i></span>
						</div>	
						 		
					</div
					
	                <div class="form-group">
                        <div class="col-md-offset-4 col-md-4"  style="margin-top: 0px;">
                            <button type="submit" class="btn bg-black btn-block">Сохранить</button>
                        </div>
                	</div>

		       			 
		        </div>
		    </form>
            </div>
        </div>
    <div class="col-md-2">
        <a href="<?=base_url('option/group_delete_action/'.$group->id)?>" class="btn btn-block btn-danger btn-flat">Удалить</a> 
    </div>

	</div>
	

		
</section>
<script type="text/javascript">
	  $('#color').colorpicker();
</script>