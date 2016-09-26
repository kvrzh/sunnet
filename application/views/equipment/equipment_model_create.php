<section class="content-header">
    <h1>Добавить Тип оборудования<small></small></h1>
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
             <form enctype="multipart/form-data" role="form" method="post" class="form-horizontal" action="<?php echo base_url('equipment/equipment_model_create');?>" >
	        		<div class="form-group">
				  			<label  class="control-label col-md-2">Модель*</label>
				  	<div class="col-md-6">
				  		<input type="text"  name="title" class="form-control" required>
				  	</div>	
					</div>
					<div class="form-group">
					  	<label class="control-label col-md-2">Тип*</label>
					  	<div class="col-md-4">
								<select name="type_id" class="form-control">
									<?if($equipment_type):?>
										<?foreach($equipment_type as $key=>$value):?>
											<option value="<?=$value->id?>"><?=$value->title?></option>
										<?endforeach;?>
									<?endif;?>
		
		
								</select>
					  	</div>
					  	<label class="control-label col-md-2">Вендор*</label>
					  	<div class="col-md-4">
								<select name="vendor_id" class="form-control">
									<?if($equipment_vendor):?>
										<?foreach($equipment_vendor as $key=>$value):?>
											<option value="<?=$value->id?>"><?=$value->title?></option>
										<?endforeach;?>
									<?endif;?>
								</select>
					  	</div>
						 		
					</div>
					<div class="form-group">
						<label class="control-label col-md-2">Минимум</label>
					  	<div class="col-md-2">
				  			<input type="number"  min="0" name="min" class="form-control">
			  			</div>
				
						<label class="control-label col-md-2">Цена закупки*</label>
					  	<div class="col-md-2">
				  			<input type="number"  min="0" name="price_in" step="0.01" class="form-control" required>
			  			</div>
						<label class="control-label col-md-2">Цена продажи*</label>
					  	<div class="col-md-2">
				  			<input type="number"  min="0" name="price_out" step="0.1" class="form-control" required>
			  			</div>
						
					</div>
					<div class="form-group">
						<label class="control-label col-md-2">Описание</label>
						<div class="col-md-10">
							<textarea class="form-control" name="description"></textarea>	
					</div> 		
					</div>
					<div class="form-group">                    
					<label class="control-label col-md-2">Прикрепить</label>                  
					<div class="col-md-2">
                   
                             <input type="file" name="file">
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

</script>