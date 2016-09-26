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
             <form role="form" method="post" class="form-horizontal" action="<?php echo base_url('equipment/equipment_type_create');?>">
	        		<div class="form-group">
				  			<label  class="control-label col-md-2">Тип*</label>
				  	<div class="col-md-6">
				  		<input type="text"  name="title" class="form-control" required>
				  	</div>	
					</div>
					<div class="form-group">
					  	<label class="control-label col-md-2">Назначение*</label>
					  	<div class="col-md-4">
								<select name="use_id" class="form-control">
									<?if($equipment_use):?>
										<?foreach($equipment_use as $key=>$value):?>
											<option value="<?=$key?>"><?=$value?></option>
										<?endforeach;?>
									<?endif;?>
		
		
								</select>
					  	</div>
						 		
					</div>
					<div class="form-group">
					  	<label class="control-label col-md-2">Единицы*</label>
					  	<div class="col-md-4">
								<select name="unit" class="form-control">
									<?if($equipment_unit):?>
										<?foreach($equipment_unit as $key=>$value):?>
											<option value="<?=$key?>"><?=$value?></option>
										<?endforeach;?>
									<?endif;?>
		
		
								</select>
					  	</div>
						 		
					</div>
					<div class="form-group">
						<div class="col-md-4">
								<input type="hidden" name="has_number" value="0">
								<span class="checkbox"><label><input name="has_number" value="1" type="checkbox"   >Мак адрес (добавления на склад)</label></span>	
						</div>	
						<div class="col-md-2">
								<input type="hidden" name="type_1" value="0">
								<span class="checkbox"><label><input name="type_1" value="1" type="checkbox"   >Подключения</label></span>	
						</div>	
						<div class="col-md-2">
								<input type="hidden" name="type_2" value="0">
								<span class="checkbox"><label><input name="type_2"  value="1" type="checkbox"  >Ремонт</label></span>	
						</div>	
						<div class="col-md-2">
								<input type="hidden" name="type_3" value="0">
								<span class="checkbox"><label><input name="type_3"  value="1" type="checkbox"  >Строительство</label></span>	
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

</script>