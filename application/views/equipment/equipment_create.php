<section class="content-header">
    <h1>Добавить на склад<small></small></h1>
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
             <form role="form" method="post" class="form-horizontal" action="<?php echo base_url('equipment/equipment_create');?>">
             		<div class="form-group">
			  			<label  class="control-label col-md-2 " value="">Поставшик</label>
					  	<div class="col-md-4">
					  		<select id="provisioner"  name="provisioner_id" class="form-control select2" required>
					  		<option></option>
					  			<?if($equipment_provisioner):?>
					  				<?foreach($equipment_provisioner as $key=>$value):?>
					  					<option value="<?=$value->id?>"><?=$value->title?></option>
					  				<?endforeach;?>
					  			<?endif;?>
					  		</select>
					  	</div>
					  	<div class="col-md-4"> <a class="btn btn-flat btn-default " onclick="addField('equipment')" ><i class="glyphicon glyphicon-plus"></i>Добавить в заявку</a></div>
             			
             		</div>
             		  
         			<div id="equipment"><div class="block">
		        		<div class="form-group" >
				  			<label  class="control-label col-md-1" value="">Тип</label>
						  	<div class="col-md-3">
						  		<select  class="form-control select2 type" required>
						  		<option></option>
						  			<?if($equipment_type):?>
						  				<?foreach($equipment_type as $key=>$value):?>
						  					<option value="<?=$value->id?>"><?=$value->title?></option>
						  				<?endforeach;?>
						  			<?endif;?>
						  		</select>
						  	</div>
				  			<label  class="control-label col-md-1">Модель</label>
						  	<div class="col-md-4">
						  		<select id="model" name="model_id[]" class="form-control select2 model" required>
						  		<option></option>
						  		</select>
						  	</div>
						  	<label  class="control-label col-md-1">Колич.</label>	
					  		<div class="col-md-1">
					  			<input class="form-control count" type="number" min="1"  max="100" value="1" name="count[]" required>
					  		</div>	
				  		   <div class="col-md-1">
                        		<a class="btn btn-flat btn-default remove"  ><i class="glyphicon glyphicon-minus" ></i></a>
                            </div>
						</div>
						<input type="hidden" name="has_number[]" class="has-number" value="0">
						<div class="form-group serial"  pos="0" hasnumber="0">

							
						</div>
					</div></div>
					
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
var change_day =function(){
		$.each($('.serial'),function(key,value){
			new_key=key+1
			$(this).attr('pos',new_key-1);
	});
}
var addField=function(name){
    var clone_elem= $('#'+name);
    var  block=clone_elem.children('.block').last();
    var new_elem= block.clone();
    clone_elem.append(new_elem);

    $('#'+name).children('.block').last().find('input').val(1);
    $('#'+name).children('.block').last().find('select').val('');  
     $('#'+name).children('.block').last().find('.div_s').remove();
    change_day();

}
$(document).on('click','.remove',function(){
		var elem=$(this).parent('div').parent('.form-group').parent('.block');
		var count=elem.parent('div').children('.block').length;
		if(count>1){
			elem.remove();
		}  
		 change_day();


}); 

$(document).ready(function(){
	$(document).on('change','.count',function(){
		var count=$(this).val();

		var serial=$(this).parent('div').parent('.form-group').parent('div').children('.serial');
		serial.find('.div_s').remove();
		var pos=serial.attr('pos');
		console.log(pos);
		var has_number=serial.attr('hasnumber');
		if(has_number==1 && count>0 && count<101){
    				for(var i=0;i<count;i++){
					serial.append('<div class="col-md-3 div_s"><input class="form-control" name="serail['+pos+'][]" required></div>');
			}
		}
	})
    //$('#provisioner').select2({placeholder:"Выберите поставщика"});
    //$('.type').select2({placeholder:"Выберите Тип"});
   // $('.model').select2({placeholder:"Выберите Модель"});

	$(document).on('change','.type',function(){
		var serial=$(this).parent('div').parent('.form-group').parent('div').children('.serial');
		serial.find('.div_s').remove();
		var count=$(this).parent('div').parent('.form-group').parent('div').find('.count').val();
		var input_number=$(this).parent('div').parent('.form-group').parent('div').find('.has-number');
		var pos=serial.attr('pos');
    	var type=$('option:selected',this).val();
		var typeSelect=$(this).parent('div').parent('.form-group').find('.model');
    	$.ajax({
    		method:"GET",  
    		dataType: "json",
    		url:"<?=base_url('equipment/get_model')?>/"+type,
    		success:function(obj){
    			//$('#street').children('option:not(:first)').remove();
		
    			var has_number=0;
    			typeSelect.find('option').remove().end().append('<option value=""</option>').val('');
    			//typeSelect.html('').select2({data: {id:null, text: null},placeholder:"Выберите Модель"});
    			$.each(obj,function(key,model){
    				has_number=model.type_has_number;
    				typeSelect
				 	.append($("<option></option>")
    				.attr('value',model.id)
    				.text(model.vendor+' '+ model.title));
    			});
    			typeSelect.val([]);
    			serial.attr('hasnumber',has_number);
    			input_number.val(has_number);
    			 change_day();
    			if(has_number==1 && count>0 && count<101){
    				for(var i=0;i<count;i++){
					serial.append('<div class="col-md-3 div_s"><input type="text" pattern=^[a-zA-Z0-9-]+$ class="form-control serial" name="serail['+pos+'][]" required></div>')


    				}
    			}

    
    		}
    	})
    });
});

$(document).on('keypress','.serial',function(e) {
	console.log(e.keyCode);
    if (e.keyCode > 1071 && e.keyCode < 1104) {
        return false;
    }
});
</script>