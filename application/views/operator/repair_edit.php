<section class="content-header">
    <h1>Изменить <?=$head?><small></small></h1>
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
             <form role="form" method="post" class="form-horizontal" action="<?php echo base_url('operator/repair_change_action');?>">
	        		<input type="hidden" name="type" id="type" value="<?=$type?>">
	        		<input type="hidden" name="id" value="<?=$repair->id?>">
	        		<input type="hidden" name="date_repair_old" value="<?=dot_day($repair->date_repair)?>">
	        		<input type="hidden" name="client_id" value="<?=$client->id?>">
	        		<?if($type==1 || $type==2):?>


	        		<div class="form-group">
			  			<label   class="control-label col-md-2">Полное имя*</label>
					  	<div class="col-md-6">
					  		<input value="<?=$client->name?>" type="text"  name="name" class="form-control" required>
					  	</div>	
	          			 <div class="col-md-2">
	                  		<div class="checkbox"><label><input name="urgency" value="1" type="checkbox"  <?=$repair->urgency==1?"checked":""?> >Срочность</label></div>	
	                    </div>
	          			 <div class="col-md-2">
	                  		<div class="checkbox"><label><input name="sms" value="1" <?=$repair->sms==1?"checked":""?> type="checkbox">Отправить SMS</label></div>	
	                    </div>
					</div>
	        		<div class="form-group">
			  			<label  class="control-label col-md-2">Cтационарный телефон</label>
					  	<div class="col-md-2">
					  		<input type="text" pattern=".{10,10}"  value="<?=$client->phone1?>"  value="" name="phone1" class=" phone form-control" >
					  	</div>	 
			  			<label  class="control-label col-md-2">Мобильный телефон*</label>
					  	<div class="col-md-2">
					  		<input type="text" pattern=".{10,10}" value="<?=$client->phone2?>"  value="" name="phone2" class="phone form-control" >
					  	</div>
				  	  	<input type="hidden" value="<?$repair->status_id?>" name="status_id">
	    		  			<label  class="control-label col-md-1">Статус</label>
						  	<div class="col-md-3">
						  	            <input type="hidden" value="<?$repair->status_id?>" name="status_id">
						  		<select class="form-control" id="status_id" name="status_id">
						  			<?if($status):?>
						  				<?foreach($status as $key=>$value):?>
						  					<option <?=$value->oper==0?'disabled':''?>  <?=$value->id==$repair->status_id?'selected':''?> value="<?=$value->id?>"><?=$value->title?></option>
						  				<?endforeach;?>
						  			<?endif;?>
						  		</select>
						  	</div>
					</div>


					<?endif;?>
					<input name="date_repair" value="<?=dot_day($repair->date_repair)?>" type="hidden">
					<div class="form-group" id="move" style="display:none">
						<label  class="control-label col-md-2">Дата</label>
					  	<div class="col-md-2">
				  			<input name="date_repair" value="<?=dot_day($repair->date_repair)?>" type='text'  id="date_repair" class="form-control date"  />
					  	</div>
					  	<?if($type==1 || $type==2):?>
			  			<label  class="control-label col-md-1">Группа</label>
					  	<div class="col-md-3">
					  		<select class="form-control" id="group_id" name="group_id">
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
					  		<select class="form-control" id='repair_range' name="repair_range"  disabled="disabled">
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
					  	<?endif;?>


					</div>




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
					  					<option  <?=$value->id==$repair->rate_id?'selected':''?> value="<?=$value->id?>"><?=$value->title?></option>
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
					  					<option <?=$value->id==$repair->action1_id?'selected':''?> value="<?=$value->id?>"><?=$value->title?></option>
					  				<?endforeach;?>
					  			<?endif;?>
					  		</select>
					  	</div>	
					</div>
	        		<div class="form-group">
			  			<label  class="control-label col-md-2">Тариф IpTv</label>
					  	<div class="col-md-6">
					  		<select class="form-control" name="action2_id">
					  		<option value="">Без тарифа IpTv</option>
					  			<?if($actions2):?>
					  				<?foreach($actions2 as $key=>$value):?>
					  					<option <?=$value->id==$repair->action2_id?'selected':''?> value="<?=$value->id?>"><?=$value->title?></option>
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
					  					<option <?=$value->id==$repair->damage_id?'selected':''?> <?=$value->id==$repair->rate_id?'selected':''?>value="<?=$value->id?>"><?=$value->title?></option>
					  				<?endforeach;?>
					  			<?endif;?>
					  		</select>
					  	</div>	
					</div>
					<?endif;?>	
					<?if($type==3):?>
						<div class="form-group">
						  		<input min="0" max="5000" type="hidden" name="fine_sum" class="form-control"  value="<?=$work->fine_sum?>"  >
						  		<input min="0" max="99" type="hidden" name="fine_d" class="form-control" value="<?=$work->fine_d?>"  >
						  		<input min="0" max="24" type="hidden" name="fine_h" class="form-control" value="<?=$work->fine_h?>"  >
						  		<input min="0" max="60" type="hidden" name="fine_m" class="form-control" value="<?=$work->fine_m?>" >
						</div>
					<?endif;?>
	        		<div class="form-group">
			  			<label  class="control-label col-md-2">Улица</label>
					  	<div class="col-md-4">
					  		<select id="street" class="form-control" name="street_id" required>
					  			<option></option>
					  			<?if($streets):?>
					  				<?foreach($streets as $key=>$value):?>
					  					<option <?=$value->id==$client->street_id?'selected':''?> value="<?=$value->id?>"><?=$value->title?></option>
					  				<?endforeach;?>
					  			<?endif;?>
					  		</select>
					  	</div>
  		        		<?if($type==3):?>
  		        		  <input type="hidden" value="<?$repair->status_id?>" name="status_id">
    					<?if($this->session->userdata('user_role')==1 ):?>
      			 			<div class="col-md-2">
			                  		<div class="checkbox"><label><input name="urgency" value="1" type="checkbox"  <?=$repair->urgency==1?"checked":""?> >Срочность</label></div>	
		                    </div>
	    		  			<label  class="control-label col-md-1">Статус</label>
						  	<div class="col-md-3">
						  	          
						  		<select class="form-control" id="status_id"  name="status_id">
						  			<?if($status):?>
						  				<?foreach($status as $key=>$value):?>
						  					<option <?=$value->oper==0?'disabled':''?>  <?=$value->id==$repair->status_id?'selected':''?> value="<?=$value->id?>"><?=$value->title?></option>
						  				<?endforeach;?>
						  			<?endif;?>
						  		</select>
						  	</div>	
					  	<?endif;?>	
					  	<?endif;?>	
					</div>
	        		<div class="form-group">
			  			<label  class="control-label col-md-2">Дом</label>
					  	<div class="col-md-2">
	  				  		<select class="form-control"  id="house" name="house_id" required >
					  			<option></option>
					  			<?if($house):?>
					  				<?foreach($house as $key=>$value):?>
					  					<option <?=$value->id==$client->house_id?'selected':''?> value="<?=$value->id?>"><?=$value->title?></option>
					  				<?endforeach;?>
					  			<?endif;?>
					  		</select>
					  	</div>	
			  			<label  class="control-label col-md-1">Подъезд</label>
					  	<div class="col-md-1">
					  		<input type="number" min='0'  value="<?=$client->address_porch?>" name="address_porch" class="form-control">
					  	</div>	
					  	<?if($type==1 || $type==2):?>
			  			<label  class="control-label col-md-1">Этаж</label>
					  	<div class="col-md-1">
					  		<input type="number" min='0' value="<?=$client->address_floor?>" name="address_floor" class="form-control">
					  	</div>	
			  			<label  class="control-label col-md-1">Квартира</label>
					  	<div class="col-md-1">
					  		<input type="number" min='0'  value="<?=$client->address_room?>" name="address_room" class="form-control">
					  	</div>	
					  	<?endif;?>
					</div>
					<div class="form-group">
						<div class="col-md-offset-2 col-md-10 help-block" id="note_problem">
							<?if($house):?>
							<?=$house[$client->house_id]->note_problem?>
							<?endif;?>
						</div>
						
					</div>
					<?if($this->session->userdata('user_role')==1 ):?>
	        		<!--<div class="form-group">
			  			<label  class="control-label col-md-2">Оборудование</label>
					  	<div class="col-md-6">
					  		<select class="form-control" id="equipment" name="equipment[]" multiple="" disabled="true">
					  			<?if($equipment):?>
					  				<?foreach($equipment as $key=>$value):?>
					  					<?if($repair_equipment):?>
					  					<option <?=in_array($value->id, $repair_equipment)?"selected":""?> value="<?=$value->id?>"><?=$value->title?></option>
					  					<?else:?>
					  					<option  value="<?=$value->id?>"><?=$value->title?></option>
					  					<?endif;?>
					  				<?endforeach;?>
					  			<?endif;?>
					  		</select>
					  	</div>	
					</div>-->
					<?endif?>

	        		<div class="form-group">
			  			<label  class="control-label col-md-2">Комментарий</label>
				  		<div class=" col-md-10">
				  			<textarea rows="4" class="form-control" maxlength="250" name="comment"><?=$repair->comment?></textarea>
			  			</div>

					</div>
					<?if($type==2):?>
						<input type="hidden" name="paid" value="<?=$repair->paid?>">
			            <div class="form-group">
                			<div class="checkbox col-md-offset-1 col-md-2"><label><input id="paid_show" value="1" type="checkbox">Платный ремонт</label></div>  
	  						<div id="paid_block" style="display:none">
	  						<label  class="control-label col-md-3">Ориентировочная стоимость ремонта</label>
				  			<div class="col-md-1">
				  				<input type="number" min='0'  max="9999" value="<?=$repair->paid?>" name="paid" class="form-control">
				  			</div>	
				  			</div>
               			</div>
           			<?endif;?>
	                <div class="form-group">
                        <div class="col-md-offset-4 col-md-4"  style="margin-top: 0px;">
                    		<?if($this->session->userdata('user_role')!=1 && $repair->status_id==5):?>
                          		<button type="submit" disabled="true" class="btn bg-black btn-block">Сохранить</button>
                        	<?else:?>
                            	<button type="submit"   class="btn bg-black btn-block">Сохранить</button>
                            	<?endif;?>
                        </div>
                        <div class="col-md-4"  style="margin-top: 0px;">
                        	<?if($this->session->userdata('user_role')==1):?>
                           <a class="btn btn-block bg-red" href="<?=base_url('operator/delete_repair/'.$repair->id)?>">Удалить заявку</a>
                        	<?endif;?>
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
		if(group_id && date){
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
    			$.each(obj,function(key,value){
    				$('#repair_range option[value='+value+']').prop('disabled', 'disabled');

    			});
    		}
    	});	
    	}
    	else{
		  	$('#repair_range').prop('disabled', 'disabled');
    	}
}
$(document).on('change','#group_id',function(){
	get_group();
});
$(document).ready(function(){


	$('#status_id').on('change',function(){
		var status=$('#status_id option:selected').val();
		        if(status==11){
            $('#move').css('display','');
	        }
	        else{
	             $('#move').css('display','none');

	        }
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
$('#paid_show').on('click',function(){
    var status=$("#paid_show").prop( "checked");
    var display_status=status?'':'none';
    console.log(display_status);
     $('#paid_block').css('display',display_status);


});
</script>