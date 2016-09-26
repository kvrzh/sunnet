<section class="content-header">
    <h1>Редактировать  Место<small></small></h1>
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
             <form role="form" method="post" class="form-horizontal" action="<?php echo base_url('equipment/equipment_location_edit');?>">
             		<input type="hidden" name="id" value="<?=$equipment_location->id?>">
	        		<div class="form-group">
				  			<label  class="control-label col-md-2">Место*</label>
				  	<div class="col-md-6">
				  		<input type="text"  value="<?=$equipment_location->title?>" name="title" class="form-control" required>
				  	</div>	
					</div>
          <div class="form-group">
              <div class="col-md-3">
                <input type="hidden" name="move" value="0">
                <span class="checkbox"><label><input name="move" value="1" type="checkbox"  <?=$equipment_location->move==1?"checked":""?> >Место для перемещения</label></span> 
            </div>
              <div class="col-md-3">
                <input type="hidden" name="remove" value="0">
                <span class="checkbox"><label><input name="remove" value="1" type="checkbox"  <?=$equipment_location->remove==1?"checked":""?> >Место для списания</label></span> 
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
        <a href="<?=base_url('equipment/equipment_location_delete/'.$equipment_location->id)?>" class="btn btn-block btn-danger btn-flat">Удалить</a> 
    </div>

	</div>
	

		
</section>
<script type="text/javascript">

</script>