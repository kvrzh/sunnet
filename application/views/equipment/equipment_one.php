<section class="content-header">
    <h1>Списать со склада<h1>
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
	            	  <form  role="form" method="post" class="form-horizontal"  >
	        		<input type="hidden" name="model_id" value="<?=$equipment_model->id?>">
	        		<input type="hidden" name="has_number" value="<?=$equipment_model->type_has_number?>">
	        		<div class="form-group">
				  			<label  class="control-label col-md-2">Откуда</label>
				  			<div class="col-md-4">
				  				<?if($location):?>
				  					<select class="form-control select2" id="location_from" name="location_from" required>
				  						<option></option>
				  					<?foreach($location as $key=>$value):?>
				  						<option value="<?=$key?>"><?=$value?></option>

				  					<?endforeach;?>
				  					</select>
				  				<?else:?>
				  					Нет на местах перемещения
				  				<?endif?>
				  			</div>
	            	</div>
	            	<?if($equipment_model->type_has_number==1):?>
	            		<div class="form-group">
            				<label  class="control-label col-md-2">Серийный номер</label>
				  			<div class="col-md-4">
				  				<select class="form-control select2" id="serial" name="serial" required>
				  					<option></option>
				  				</select>
				  			</div>
	            		</div>
	            	<?endif?>
	        		<div class="form-group">
				  			<label  class="control-label col-md-2">Тип</label>
				  			<div class="col-md-4">
				  				<input type="text"  value="<?=$equipment_model->type?>" disabled="" class="form-control">
				  			</div>
	            	</div>
	        		<div class="form-group">
				  			<label  class="control-label col-md-2">Вендор/модель</label>
				  			<div class="col-md-4">
				  				<input type="text"  value="<?=$equipment_model->vendor?> <?=$equipment_model->title?>" disabled="" class="form-control">
				  			</div>
	            	</div>
	        		<div class="form-group">
				  			<label  class="control-label col-md-2">Количество</label>
				  			<div class="col-md-4">
				  				<input type="number" id="count" min="1" max="1" value="1" name="count" <?=$equipment_model->type_has_number==1?'disabled':''?> class="form-control" required>
				  			</div>
	            	</div>
	            	<div class="form-group">
        				<label  class="control-label col-md-2">Куда</label>
				  			<div class="col-md-4">
				  				<select class="form-control select2" name="location_to" id="location_to" required>
				  					<option></option>
				  					<?if($all_location):?>
				  						<?foreach($all_location as $key=>$value):?>
				  							<option value="<?=$value->id?>"><?=$value->title?></option>
				  						<?endforeach?>
				  					<?endif?>
				  				</select>
				  			</div>
	          
	            	</div>
	            	<div class="form-group" id="user_id">
        				<label  class="control-label col-md-2">На руки "Кому"</label>
				  			<div class="col-md-4">
				  				<select class="form-control select2" name="user_to" id="user_to">
				  					<option></option>
				  					<?if($users):?>
				  						<?foreach($users as $key=>$value):?>
				  							<option value="<?=$value->id?>"><?=$value->name?></option>
				  						<?endforeach?>
				  					<?endif?>
				  				</select>
				  			</div>
	          
	            	</div>
	            	<div id="topology" style="display:none">
		        		<div class="form-group">
			  			<label  class="control-label col-md-2">Улица</label>
					  	<div class="col-md-6">
					  		<select id="street" class="form-control" name="street_id" required >
					  			<option></option>
					  			<?if($streets):?>
					  				<?foreach($streets as $key=>$value):?>
					  					<option value="<?=$value->id?>"><?=$value->title?></option>
					  				<?endforeach;?>
					  			<?endif;?>
					  		</select>
					  	</div>	
						</div>
		        		<div class="form-group">
				  			<label  class="control-label col-md-2">Дом</label>
						  	<div class="col-md-2">
		  				  		<select class="form-control"  id="house" name="house_id" required >
						  			<option></option>
						  		</select>
						  	</div>
  				  			<label  class="control-label col-md-2">Подъезд</label>
					  		<div class="col-md-1">
					  		<input type="number" min='0'  name="porch" class="form-control">
					  	</div>
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
        <a href="<?=base_url('equipment/equipment_model_delete/'.$equipment_model->id)?>" class="btn btn-block btn-danger btn-flat">Удалить</a> 
        <?if($equipment_model->photo_thumb):?>
        	<img class="img img-responsive img_edit" src="<?=base_url($equipment_model->photo_thumb)?>" data-toggle="lightbox"  href="<?=base_url($equipment_model->photo)?>">
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

		$('#location_to').on('change',function(){
			var location_to=$('#location_to option:selected').val();
			var flag=location_to==2?true:false;
			$('#user_to').attr('required',flag);
		    
		    var display_status=location_to==9?'':'none';
		     $('#topology').css('display',display_status);
		         $('#house').select2({placeholder:"Дом"});
    $('#street').select2({placeholder:"Выберите улицу"});
		});



	    $('#location_from').on('change',function(){
    	var data={
    		'location_id':$('#location_from option:selected').val(),
    		'model_id':$('input[name=model_id]').val(),
    	}
    	var max=0;
    	$.ajax({
    		method:"POST",  
    		data:data,
    		dataType: "json",
    		url:"<?=base_url('equipment/get_serial')?>/",
    		success:function(obj){
    			//$('#street').children('option:not(:first)').remove();
    			console.log(obj);
    			$('#serial').html('').select2({data: {id:null, text: null},placeholder:"Выберите из списка"});
    			$.each(obj,function(key,serial){
    				$('#serial')
				 	.append($("<option></option>")
    				.attr('value',serial.id)
    				.text(serial.serial));
    				max++;

    			});
    			$('#serial').val([]);
    			$('#count').attr('max',max);

    		}
    	})
    });


    $('#house').select2({placeholder:"Дом"});
    $('#street').select2({placeholder:"Выберите улицу"});
    $('select[name=street_id]').on('change',function(){
    	var street=$('select[name=street_id] option:selected').val();
    	$.ajax({
    		method:"GET",  
    		dataType: "json",
    		url:"<?=base_url('operator/get_house')?>/"+street,
    		success:function(obj){
    			//$('#street').children('option:not(:first)').remove();
    			console.log(obj);
    			$('#house').html('').select2({data: {id:null, text: null},placeholder:"Дом"});
    			$.each(obj,function(key,house){
    				$('#house')
				 	.append($("<option></option>")
    				.attr('value',house.id)
    				.text(house.title));

    			});
    			$('#house').val([]);
    		}
    	})
    });
});

</script>
