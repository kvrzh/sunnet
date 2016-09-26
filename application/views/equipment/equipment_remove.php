<section class="content-header">
    <h1>Списать с пользователя <?=$equipment->user_name?><h1>
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
    <?

    ?>
	        <div class="box box-success">
	            <div class="box-body">
	            	  <form  role="form" method="post" class="form-horizontal"  >
	        		<input type="hidden" name="id" value="<?=$equipment->id?>">
	        		<input type="hidden" name="fine_id" value="<?=$equipment->fine_id?>">
	
	        		<div class="form-group">
				  			<label  class="control-label col-md-2">Тип</label>
				  			<div class="col-md-4">
				  				<input type="text"  value="<?=$equipment->type?>" disabled="" class="form-control">
				  			</div>
	            	</div>
	        		<div class="form-group">
				  			<label  class="control-label col-md-2">Вендор/модель</label>
				  			<div class="col-md-4">
				  				<input type="text"  value="<?=$equipment->vendor?> <?=$equipment->model?>" disabled="" class="form-control">
				  			</div>
	            	</div>
            		<div class="form-group">
            				<label  class="control-label col-md-2">Серийный номер</label>
				  			<div class="col-md-4">
				  				<input type="text"  value="<?=$equipment->serial?>" disabled="" class="form-control">
				  			</div>
	            		</div>

	            	<div class="form-group">
        				<label  class="control-label col-md-2">Куда</label>
				  			<div class="col-md-4">
				  				<select class="form-control select2" name="location_to"  required>
				  					<option></option>
				  					<?if($all_location):?>
				  						<?foreach($all_location as $key=>$value):?>
				  							<option value="<?=$value->id?>"><?=$value->title?></option>
				  						<?endforeach?>
				  					<?endif?>
				  				</select>
				  			</div>
	          
	            	</div>

	                <div class="form-group">
                        <div class="col-md-offset-4 col-md-4"  style="margin-top: 0px;">
                            <button type="submit" class="btn bg-black btn-block">Отправить</button>
                        </div>
                	</div> 
            	</form>
        	</div>


	        </div>
			
		</div>
	    <div class="col-md-2" >
        <a href="<?=base_url('equipment/equipment_delete/'.$equipment->id)?>" class="btn btn-block btn-danger btn-flat">Удалить</a> 
        <?if($equipment->photo_thumb):?>
        	<img class="img img-responsive img_edit" src="<?=base_url($equipment->photo_thumb)?>" data-toggle="lightbox"  href="<?=base_url($equipment->photo)?>">
        <?endif;?>
    </div>
	</div>
</section>
<script type="text/javascript">
$('#img').ekkoLightbox();
$(document).delegate('*[data-toggle="lightbox"]', 'click', function(event) {
	event.preventDefault();
	$(this).ekkoLightbox();

});

$(document).ready(function(){
	$('.select2').select2({placeholder:" Выберите из списка"});
});



</script>
