<section class="content-header">
    <h1>Заявка</h1>
</section>
<section class="content">
<div class="row">
    <div class="col-md-7">

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
            <div class="table-responsive">
            	<table class="table"><tbody>
            		<tr><td>Имя</td><td><?=$repair->name?></td></tr>
            		<tr><td>Номера</td><td><?=$repair->phone1?> <?=$repair->phone2?></td></tr>
            		<tr><td>Район/Улица</td><td><?=$repair->area?>/<?=$repair->street?></td></tr>
            		<tr><td>Адрес</td><td><?="Дом: $repair->address_house, подъезд: $repair->address_porch, этаж: $repair->address_floor, квартира: $repair->address_room"?></td></tr>
            		<?if($repair->type_id==1):?>
            		<tr><td>Акция</td><td><?=$repair->rate?></td></tr>
            		<tr><td>Тарифы</td><td><?=$repair->action1?>/<?=$repair->action2?></td></tr>
            		<tr><td>Кабель</td><td><?=$repair->cable?></td></tr>
					<?endif;?>
					<?if($repair->type_id==2):?>
	            		<tr><td>Поломка</td><td><?=$repair->damage?></td></tr>
					</div>
					<?endif;?>
					<tr><td>Время созвона</td><td><?=$repair->date_phone?></td></tr>
					<tr><td>Время ремонта</td><td><?=default_dt($repair->start)?>/<?=default_time($repair->end)?></td></tr>
					<tr><td>Статус</td>  <td><span class="badge" style="background-color:<?=$repair->color?>"><?=$repair->status?></span></td></tr>
            		<tr><td>Дополнительно</td><td>
		            	<?if($repair->urgency==1):?>
		            	<span class="badge bg-red">Срочная</span>
		            	<?endif;?>
		            	<?if($repair->sms==1):?>
		            	<span class="badge bg-yellow">sms</span>
		            	<?endif;?>
		            </td></tr>
		            <tr><td>Коментарий</td><td><?=$repair->comment?></td></tr>
            	</tbody></table>
                </div>
            </div><!-- /.box-body -->
            </div>

        </div>
        <div class="col-md-5">

        <form role="form" method="post" class="form-horizontal" action="<?php echo base_url('mounter/change_status');?>">
        	<input type="hidden" value="<?=$repair->id?>" name="id">
            <input type="hidden" name="type_id" id="type_id" value="<?=$repair->type_id?>">
        	<div class="form-group">
            <div class="col-md-12">
            <input type="hidden" value="<?=$repair->status_id?>" name="status">
        	<select name="status" id='status' class="form-control">
        	<?if($status):?>
        		<?foreach($status as $key=>$value):?>
        			<option value="<?=$value->id?>"
                    <?=($value->id==11 && $repair->type_id==3 && $repair->fine_time>0)?'disabled':''?>
                     <?=($value->mont==0)?'disabled':''?> <?=($repair->status_id==$value->id)?'selected':''?>><?=$value->title?></option>
 
                <?endforeach;?>
        	<?endif?>
        	</select>
            </div>
        	</div>
            <div class="form-group" id="status_time" style="display:<?=$repair->status_id==7?'':'none'?>;">
                <label class="control-label col-md-4">
                    Опаздываю
                </label>
                <div class="col-md-8">
                    <select name="status_time" class="form-control">
                        <option <?=$repair->status_time==15?'selected':''?> value="15">15 мин</option>
                        <option <?=$repair->status_time==30?'selected':''?>  value="30">30 мин</option>
                        <option <?=$repair->status_time==40?'selected':''?> value="40">40 мин</option>
                        <option <?=$repair->status_time==60?'selected':''?> value="60">больше 40 мин</option>
                    </select>                    
                </div>
            </div>
        	<div class="form-group">
                 <div class="col-md-12">
        		<textarea rows="6" name="comment_master"  maxlength="250" class="form-control" placeholder="Коментарий"><?=$repair->comment_master?></textarea>
        	   </div>
            </div>
            <div class="form-group">
                <label class="control-label col-md-4">
                    Заметка по дому
                </label>
                <div class="checkbox col-md-5"><label><input id="edit_note" value="1" type="checkbox">Редактировать</label></div>  
                 <div class="col-md-12">

                 <input type="hidden" name="def_house_note" value="<?=$repair->house_note?>">
             
                 <input type="hidden" name="house_id" value="<?=$repair->house_id?>">
                 <input type="hidden" name="house_note" value="<?=$repair->house_note?>">

                <textarea id="house_note" disabled="disabled" rows="6" name="house_note"  maxlength="250" class="form-control" placeholder="Заметка"><?=$repair->house_note?></textarea>
               </div>
            </div>
            <?if($house_cable && $repair->cable_use==0):?>
            <div id="house_cable" style="display:<?=$repair->status_id==5?'':'none'?>;">
            <div class="form-group" >
                <label  class="control-label col-md-7" >Использовал свободный кабель</label>
                <div class="col-md-5">
                    <select name="house_cable" id="cable" class="select2 form-control" required>
                        <option></option>
                         <option value="-1">Нет</option>
                        <?foreach($house_cable as $key=>$value):?>
                            <option value="<?=$value->id?>"><?=$value->number?></option>

                        <?endforeach;?>
                    </select>
                </div>
            </div>
            </div>
            <?endif?>
            <?if($equipment):?>
                <?foreach($equipment as $eq):?>
                <div class="form-group">
                    <label  class="control-label col-md-4" ><?=$eq['type']?></label>
                    <div class="col-md-8">
                        <?if($eq['list']):?>
                        <select name="equipment[]" class="equipment form-control" <?=$repair->status_id==5?'disabled':''?>>
                            <option></option>
                            <?foreach($eq['list'] as $key=>$value):?>
                                <option value="<?=$value->id?>"><?=$value->vendor?> <?=$value->model?>
                                 (<?=$value->serial?>)</option>

                            <?endforeach;?>
                        </select>
                        <?else:?>
                        <input class="form-control" value="Нет на складе" disabled="">
                        <?endif?>
                    </div>
                    
                </div>
                <?endforeach;?>
            <?endif;?>
            <?if($repair->type_id==2):?>
            <div class="form-group">
                <?if($repair->paid>0):?>
                <label class="control-label col-md-7">Ориентировочная сумма  <?=$repair->paid?> грн</label>
                <?endif;?>
                <label class="control-label col-md-3">К оплате</label>
                    <div class="col-md-2"><input type="number" class="form-control" name="mount_paid" value="<?=$repair->paid?>" required></div>
                </div>
            <?endif;?>
            <?if($repair->type_id==1 || $repair->type_id==2):?>
                    <div class="form-group" id="move" style="display:none">
                        <input name="date_repair_old" value="<?=dot_day($repair->date_repair)?>" type="hidden">
                        <label  class="control-label col-md-6">Дата</label>
                        <div class="col-md-6">
                            <input name="date_repair" value="<?=dot_day($repair->date_repair)?>" type='text'  id="date_repair" class="form-control date"  />
                        </div>
                        <label  class="control-label col-md-6">Группа</label>
                        <div class="col-md-6">
                            <select class="form-control" id="group_id" name="group_id"  >
                            <option></option>
                                <?if($groups):?>
                                    <?foreach($groups as $key=>$value):?>
                                        <option value="<?=$value->id?>"><?=$value->title?></option>
                                    <?endforeach;?>
                                <?endif;?>
                            </select>
                                
                        </div>
                        <label  class="control-label col-md-6">Диапазон времени</label>
                        <div class="col-md-6">
                            <select class="form-control" id='repair_range' name="repair_range" disabled="disabled" >
                            <option></option>
                                <?if($repair_range):?>
                                    <?foreach($repair_range as $key=>$value):?>
                                        <option value="<?=$value->id?>"><?=$value->start?> - <?=$value->end?></option>
                                    <?endforeach;?>
                                <?endif;?>
                            </select>
                                
                        </div> 
                    </div> 
            <?endif;?>
            <?if($repair->type_id==3):?>
                    <div class="form-group" id="move" style="display:none">
                        <input name="date_repair_old" value="<?=dot_day($repair->date_repair)?>" type="hidden">
                        <label  class="control-label col-md-6">Дата</label>
                        <div class="col-md-6">
                            <input name="date_repair" value="<?=dot_day($repair->date_repair)?>" type='text'  id="date_repair" class="form-control date"  />
                        </div>
                        <label  class="control-label col-md-6">Группа</label>
                        <div class="col-md-6">
                            <select class="form-control" id="group_id" name="group_id"  >
                            <option></option>
                                <?if($groups):?>
                                    <?foreach($groups as $key=>$value):?>
                                        <option value="<?=$value->id?>"><?=$value->title?></option>
                                    <?endforeach;?>
                                <?endif;?>
                            </select>
                                
                        </div>
                    </div> 
            <?endif;?>
            <div class="form-group">
            <div class="col-md-offset-4 col-md-8"  style="margin-top: 0px;">
                            <?if($this->session->userdata('user_role')!=1 && $repair->status_id==5):?>
                                <button type="submit" disabled="true" class="btn bg-black btn-block">Изменить статус</button>
                            <?else:?>
                                <button type="submit"   class="btn bg-black btn-block">Изменить статус</button>
                                <?endif;?>
            </div>
            </div>
        </form>

    </div>
    </div>
<script type="text/javascript">
    $('#cable').select2({placeholder:"Кабель"});
    $('.equipment').select2({placeholder:"Выберите оборудование"});
    $('#status').on('change',function(){
        var status=$('#status option:selected').val();
        if(status==7){
            $('#status_time').css('display','');
        }
        else{
             $('#status_time').css('display','none');
        }
        if(status==5){
            $('#house_cable').css('display','');
            $('#cable').prop('required',true);
             $('#cable').select2({placeholder:"Кабель"});
        }
        else{
             $('#house_cable').css('display','none');
             $('#cable').removeAttr('required');;

        }
    });

    $('#edit_note').on('click',function(){
    var status=$( "#edit_note" ).prop( "checked");
    $('#house_note').prop('disabled',!status);

});
$(document).ready(function(){
    $('.date').datepicker({language: 'ru',startDate: new Date() }).on('changeDate', function(ev) {
        get_group();
    });
    $(document).on('change','#group_id',function(){
        get_group();
    });
    $('#status').on('change',function(){
    var status=$('#status option:selected').val();
        if(status==11){
    $('#move').css('display','');
    }
    else{
         $('#move').css('display','none');

    }
    });

});
function get_group () {
        var group_id=$('#group_id option:selected').val();
        var date=$('#date_repair').val();
        var type=$('#type_id').val();
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
</script>

