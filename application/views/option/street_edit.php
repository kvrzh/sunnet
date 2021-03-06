<section class="content-header">
    <h1>Редактировать улицу<small></small></h1>
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
             <form role="form" method="post" class="form-horizontal" action="<?php echo base_url('option/street_edit_action');?>">
             		<input type="hidden" name="id" value="<?=$street->id?>">
	        		<div class="form-group">
				  			<label  class="control-label col-md-2">Улица*</label>
				  	<div class="col-md-6">
				  		<input type="text" value="<?=$street->title?>" name="title" class="form-control" required>
				  	</div>	
				  	</div>
	
					<div class="form-group">
					  	<label class="control-label col-md-2">Район*</label>
					  	<div class="col-md-4">
								<select name="area_id" class="form-control">
									<?if($areas):?>
										<?foreach($areas as $key=>$value):?>
											<option <?=$value->id==$street->area_id?"selected='selected'":""?> value="<?=$value->id?>"><?=$value->title?></option>
										<?endforeach;?>
									<?endif;?>
		
								</select>
					  	</div>
						 		
					</div>
	        		<div class="form-group">
			  			<label  class="control-label col-md-2">Сокращение</label>
					  	<div class="col-md-4">
					  		<input type="text" value="<?=$street->short?>" name="short" class="form-control" >
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
    <div class="col-md-2">
        <a href="<?=base_url('option/street_delete_action/'.$street->id)?>" class="btn btn-block btn-danger btn-flat">Удалить</a> 
    </div>

	</div>
	

		
</section>
<script type="text/javascript">

</script>