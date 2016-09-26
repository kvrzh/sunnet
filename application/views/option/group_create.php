<section class="content-header">
    <h1>Добавить группу<small></small></h1>
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
             <form role="form" method="post" class="form-horizontal" action="<?php echo base_url('option/group_create_action');?>">
	        		<div class="form-group">
				  			<label  class="control-label col-md-2">Группа*</label>
				  	<div class="col-md-6">
				  		<input type="text"  name="title" class="form-control" required>
				  	</div>	
					</div>
					<div class="form-group">
					  	<label class="control-label col-md-2">Тип*</label>
					  	<div class="col-md-4">
								<select name="type_id" class="form-control">
									<?if($types):?>
										<?foreach($types as $key=>$value):?>
											<option value="<?=$value->id?>"><?=$value->title?></option>
										<?endforeach;?>
									<?endif;?>
		
		
								</select>
					  	</div>
						 		
					</div>
					<div class="form-group">
						<label class="control-label col-md-2">Цвет</label>
						<div class="col-md-4 input-group" id="color">
							<input type="text" value="" name="color" class="form-control" required >
							 <span class="input-group-addon"><i></i></span>
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
	  $('#color').colorpicker();
</script>