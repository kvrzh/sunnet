<section class="content-header">
    <h1>Добавить кабель на улице <?=$street->title?>, дом <?=$house->title?><small></small></h1>
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
             <form role="form" method="post" class="form-horizontal" action="<?php echo base_url('option/house_cable_edit_action');?>">
	        		<input type="hidden" name="house_id" value="<?=$house->id?>">
	        		<input type="hidden" name="house_cable[id]" value="<?=$house_cable->id?>">
	        		<div class="form-group">
			  			<label  class="control-label col-md-1">Кв</label>
					  	<div class="col-md-2">
					  		<input required type="number" min="0" name="house_cable[number]" value="<?=$house_cable->number?>" value="<?=$house_cable->number?>" class="form-control" >
					  	</div>	
			  			<label  class="control-label col-md-1">Подъезд</label>
					  	<div class="col-md-2">
					  		<input type="number" min="0" name="house_cable[porch] "value="<?=$house_cable->porch?>"  class="form-control" >
					  	</div>	
			  			<label  class="control-label col-md-1">Этаж</label>
					  	<div class="col-md-2">
					  		<input type="number" min="0" name="house_cable[floor]"  value="<?=$house_cable->floor?>" class="form-control" >
					  	</div>	
          			 	<div class="col-md-2">
      			 			<input name="house_cable[free]" type="hidden" value="0">
		                  		<div class="checkbox"><label><input name="house_cable[free]" value="1" type="checkbox"  <?=$house_cable->free==1?"checked":""?> >Свободный</label></div>	
		                    </div>
					</div>
		        		<div class="form-group">
			  			<label  class="control-label col-md-2">Абонентский порт</label>
					  	<div class="col-md-2">
					  		<input type="text" min="0" name="house_cable[login]" value="<?=$house_cable->login?>" class="form-control" >
					  	</div>	
			  			<label  class="control-label col-md-1">Комутатор</label>
					  	<div class="col-md-3">
					  		<input type="text" min="0" name="house_cable[com_id]" value="<?=$house_cable->com_id?>" class="form-control" >
					  	</div>
			  			<label  class="control-label col-md-1">Логин</label>
					  	<div class="col-md-3">
					  		<input type="text" min="0" name="house_cable[log]" value="<?=$house_cable->log?>" class="form-control" >
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
        <a href="<?=base_url('option/house_cable_delete_action/'.$house_cable->id)?>" class="btn btn-block btn-danger btn-flat">Удалить</a> 

    </div>
	</div>
	

		
</section>
<script type="text/javascript">

</script>