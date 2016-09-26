<section class="content-header">
    <h1>Добавить <?=$head?><small></small></h1>
</section>
<section class="content">
<div class="row">
	<div class="col-md-11">
	    <?if($this->session->flashdata('danger')):?>
      <div class="alert alert-danger alert-dismissible">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <?=$this->session->flashdata('danger')?>
      </div>
    <?endif;?>

		<div class="box box-success">
            <div class="box-body">
             <form role="form" method="post" class="form-horizontal" action="<?php echo base_url('operator/repair_create_action');?>">
	        		<input type="hidden" id="type" name="type" value="<?=$type?>">
	        		<?if($type==1 || $type==2):?>
	        		<div class="form-group">
			  			<label  class="control-label col-md-2">Полное имя*</label>
					  	<div class="col-md-6">
					  		<input type="text"  name="name" class="form-control" required>
					  	</div>	
	          			 <div class="col-md-2">
	                  		<div class="checkbox"><label><input name="urgency" value="1" type="checkbox">Срочность</label></div>	
	                    </div>
	          			 <div class="col-md-2">
	                  		<div class="checkbox"><label><input name="sms" value="1" <?=$type==4?"checked":""?> type="checkbox">Отправить SMS</label></div>	
	                    </div>
					</div>
	        		<div class="form-group">
			  			<label  class="control-label col-md-2">Cтационарный телефон</label>
					  	<div class="col-md-2">
					  		<input type="text"   pattern=".{10,10}" class="phone form-control" value="" name="phone1"  >
					  	</div>	 
			  			<label  class="control-label col-md-2">Мобильный телефон*</label>
					  	<div class="col-md-2">
					  		<input type="text"  pattern=".{10,10}"  class="phone form-control" value="" name="phone2"  >
					  	</div>	
		          			 <div class="col-md-2">
	                  		<div class="checkbox"><label><input id="without_date" value="1" type="checkbox">Без даты</label></div>	
	                    </div>
	          			 <div class="col-md-2">

	                  		<div class="checkbox"><label><input id="without_time" value="1" type="checkbox">Не учитывать время</label></div>	
	                    </div>
					</div>
					<?endif;?>
	        		<div class="form-group">
			  			<label  class="control-label col-md-2">Дата</label>
					  	<div class="col-md-2">
					  			<input name="date_repair" id="date_repair" type='text'  class="form-control date"  required/>
					  	</div>
  		        		<?if($type==1 || $type==2):?>
			  			<label  class="control-label col-md-1">Группа</label>
					  	<div class="col-md-3">
					  		<select class="form-control" id="group_id" name="group_id" >
					  		<option></option>
					  			<?if($groups):?>
					  				<?foreach($groups as $key=>$value):?>
					  					<option value="<?=$value->id?>"><?=$value->title?></option>
					  				<?endforeach;?>
					  			<?endif;?>
					  		</select>
					  			
					  	</div>	
			  			<label  class="control-label col-md-2">Диапазон времени</label>
					  	<div class="col-md-2">
					  		<select class="form-control" id='repair_range' name="repair_range" disabled="disabled">
					  		<option></option>
					  			<?if($repair_range):?>
					  				<?foreach($repair_range as $key=>$value):?>
					  					<option value="<?=$value->id?>"><?=$value->start?> - <?=$value->end?></option>
					  				<?endforeach;?>
					  			<?endif;?>
					  		</select>
					  			
					  	</div>


					  	<?endif;?>	
					  	<?if($type==3):?>	
				  			<label  class="control-label col-md-1">Группа</label>
							  	<div class="col-md-3">
							  		<select class="form-control"  name="group_id">
							  		<option></option>
							  			<?if($groups):?>
							  				<?foreach($groups as $key=>$value):?>
							  					<option value="<?=$value->id?>"><?=$value->title?></option>
							  				<?endforeach;?>
							  			<?endif;?>
							  		</select>		
							  	</div>
  		          			 <div class="col-md-2">
	                  		<div class="checkbox"><label><input id="without_date" value="1" type="checkbox">Без даты</label></div>	
	                    </div>
		          			 <div class="col-md-2">
		                  		<div class="checkbox"><label><input name="urgency" value="1" type="checkbox">Срочность</label></div>	
		                    </div>
					  	<?endif;?>
					</div>
						<?if($type==3):?>
							<div class="form-group">
			          			 <div class="col-md-2">
		                  			<div class="checkbox"><label><input id="check_date" value="1" type="checkbox">Заявка со сроком</label></div>	
		                    	</div>
								<div  id="show_date" style="display:none">
								  	<label class="control-label col-md-2">Сумма штрафа</label>
								  	<div class="col-md-1">
								  		<input min="0" max="5000" type="number" name="fine_sum" class="form-control"  value="0"  >
								  	</div>
								  	<label class="control-label col-md-1">Дней</label>
								  	<div class="col-md-1">
								  		<input min="0" max="99" type="number" name="fine_d" class="form-control" value="0"  >
								  	</div>
								  	<label class="control-label col-md-1">Часов</label>
								  	<div class="col-md-1">
								  		<input min="0" max="24" type="number" name="fine_h" class="form-control" value="0"  >
								  	</div>
								  	<label class="control-label col-md-1">Mинут</label>
								  	<div class="col-md-1">
								  		<input min="0" max="60" type="number" name="fine_m" class="form-control" value="0" >
								  	</div>
							  	</div>



								
							</div>

						<?endif;?>

	        		<div class="form-group">
	        		<?if($type==1):?>
					</div>
	        		<div class="form-group">
			  			<label  class="control-label col-md-2">Акция</label>
					  	<div class="col-md-6">
					  		<select class="form-control" name="rate_id">
					  			<option value="">Без акции</option>
					  			<?if($rates):?>
					  				<?foreach($rates as $key=>$value):?>
					  					<option value="<?=$value->id?>"><?=$value->title?></option>
					  				<?endforeach;?>
					  			<?endif;?>
					  		</select>
					  	</div>	
					</div>
	        		<div class="form-group">
			  			<label  class="control-label col-md-2">Тариф 1</label>
					  	<div class="col-md-6">
					  		<select class="form-control" name="action1_id">
					  		<option value="">Без тарифа</option>
					  			<?if($actions1):?>
					  				<?foreach($actions1 as $key=>$value):?>
					  					<option value="<?=$value->id?>"><?=$value->title?></option>
					  				<?endforeach;?>
					  			<?endif;?>
					  		</select>
					  	</div>	
					</div>
	        		<div class="form-group">
			  			<label  class="control-label col-md-2">Тариф IpTV</label>
					  	<div class="col-md-6">
					  		<select class="form-control" name="action2_id">
					  		<option value="">Без тарифа IpTv</option>
					  			<?if($actions2):?>
					  				<?foreach($actions2 as $key=>$value):?>
					  					<option value="<?=$value->id?>"><?=$value->title?></option>
					  				<?endforeach;?>
					  			<?endif;?>
					  		</select>
					  	</div>	
					</div>
					<?endif;?>
					<?if($type==2):?>
	        		<div class="form-group">
			  			<label  class="control-label col-md-2">Поломка</label>
					  	<div class="col-md-6">
					  		<select class="form-control" name="damage_id">
					  			<?if($damages):?>
					  				<?foreach($damages as $key=>$value):?>
					  					<option value="<?=$value->id?>"><?=$value->title?></option>
					  				<?endforeach;?>
					  			<?endif;?>
					  		</select>
					  	</div>	
					</div>
					<?endif;?>
	
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
			  			<label  class="control-label col-md-1">Подъезд</label>
					  	<div class="col-md-1">
					  		<input type="number" min='0'  name="address_porch" class="form-control">
					  	</div>	
  		        		<?if($type==1 || $type==2):?>
			  			<label  class="control-label col-md-1">Этаж</label>
					  	<div class="col-md-1">
					  		<input type="number" min='0'   name="address_floor" class="form-control">
					  	</div>	
			  			<label  class="control-label col-md-1">Квартира</label>
					  	<div class="col-md-1">
					  		<input type="number" min='0'  name="address_room" class="form-control">
					  	</div>	
					  	<?endif;?>
					</div>
					<div class="form-group">
						<div class="col-md-offset-2 col-md-10 help-block" id="note_problem">
							
						</div>
						
					</div>
	        		<div class="form-group">
			  			<label  class="control-label col-md-2">Оборудование</label>
					  	<div class="col-md-6">
					  		<select class="form-control" id="equipment" name="equipment[]" multiple="">
					  			<?if($equipment):?>
					  				<?foreach($equipment as $key=>$value):?>
					  					<option value="<?=$value->id?>"><?=$value->title?></option>
					  				<?endforeach;?>
					  			<?endif;?>
					  		</select>
					  	</div>	
					</div>
	        		<div class="form-group">
			  			<label  class="control-label col-md-2">Комментарий</label>
				  		<div class=" col-md-10">
				  			<textarea rows="4" maxlength="250" class="form-control" name="comment"></textarea>
			  			</div>
					</div>
					<?if($type==2):?>
						<input type="hidden" name="paid" value="0">
			            <div class="form-group">
                			<div class="checkbox col-md-offset-1 col-md-2"><label><input id="paid_show" value="1" type="checkbox">Платный ремонт</label></div>  
	  						<div id="paid_block" style="display:none">
	  						<label  class="control-label col-md-3">Ориентировочная стоимость ремонта</label>
				  			<div class="col-md-1">
				  				<input type="number" min='0'  max="9999" value="0" name="paid" class="form-control">
				  			</div>	
				  			</div>
               			</div>
           			<?endif;?>
	                <div class="form-group">
                        <div class="col-md-offset-4 col-md-4"  style="margin-top: 0px;">
                            <button type="submit" class="btn bg-black btn-block">Добавить</button>
                        </div>
                	</div>

		       			 
		        </div>
		    </form>
            </div>
        </div>
	</div>
	
		
</section>
<script type="text/javascript">
function get_group () {
		var group_id=$('#group_id option:selected').val();
		var date=$('#date_repair').val();
		var type=$('#type').val();
		var without_time=$('#without_time').prop( "checked");
		if(group_id && date ){
			$('#repair_range').val('');
		  $('#repair_range').prop('disabled', false);
		  $('#repair_range option').prop('disabled', false);
		  var data={
    			'group':group_id,
    			'date':date,
				"type":type,
    		};
    		console.log(data);

    		$.ajax({
    		method:"POST",  
    		dataType: "json",
    		data: data,
    		url:"<?=base_url('operator/get_range')?>/",
    		success:function(obj){
    			console.log(obj);
    			if(without_time==false){
	    			$.each(obj,function(key,value){
	    				$('#repair_range option[value='+value+']').prop('disabled', 'disabled');

	    			});
    			}
    		}
    	});	
    	}
    	else{
		  	$('#repair_range').prop('disabled', 'disabled');
    	}
}
	$(document).ready(function(){

	$('#group_id').on('change',function(){
		get_group();
	});



    $(".phone").inputmask(
    	//"mask", {"mask": "(999)999 99 99"},
    	"Regex", {regex: "[0-9]{10}"});
    $('.date').datepicker({language: 'ru',startDate: new Date() }).on('changeDate', function(ev) {
    	get_group();
});

    $('#house').select2({placeholder:"Дом"});

    $('#street').select2({placeholder:"Выберите улицу"});
    $('#equipment').select2({placeholder:"Выберите доп опборудование для монтажника"});
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
    })
});
	$('#house').on('change',function(){
		var house=$('#house option:selected').val();
		$.ajax({
			method:"GET",  
			dataType: "json",
			url:"<?=base_url('operator/select_house')?>/"+house,
			success:function(obj){
				console.log(obj.note_problem);
				if(obj.note_problem){
					$('#note_problem').html("Проблемный дом: "+obj.note_problem);
				}
				else{
					$('#note_problem').html('');
				}
			}

		})
	});
$('#without_date').on('click',function(){
	var status=$( "#without_date" ).prop( "checked");
	$('#date_repair').prop('required',!status);

})
$('#without_time').on('click',function(){
	get_group();
})
$('#without_date').on('click',function(){
	var status=$( "#without_date" ).prop( "checked");
	$('#date_repair').prop('required',!status);

})

$('#paid_show').on('click',function(){
    var status=$("#paid_show").prop( "checked");
    var display_status=status?'':'none';
    console.log(display_status);
     $('#paid_block').css('display',display_status);


});
$('#check_date').on('click',function(){
    var status=$("#check_date").prop( "checked");
    var display_status=status?'':'none';
    console.log(display_status);
     $('#show_date').css('display',display_status);


});

</script>