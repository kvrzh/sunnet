<section class="content-header">
    <h1><?=lang('create_event')?><small></small></h1>
</section>
<?
/*echo "<pre>";
print_r($cities);
echo "</pre>";*/
?>
<section class="content">
	<div class="row">
		<div class="col-md-9">
        <div class="box box-success">
        <div class="box-header with-borer">
        </div>
        <div class="box-body">
            <?if($this->session->flashdata('danger')):?>
            <div class="alert alert-danger alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <?=$this->session->flashdata('danger')?>
            </div>
            <?endif;?>
			<form  data-toggle="validator" id="event" action="<?=base_url("event/action/create");?>" method="POST" class="form-horizontal" enctype="multipart/form-data" >
                <input type="hidden" name="user_id" value="<?=$this->session->userdata('user_id')?>">
                <div class="form-group">
                    <label class="col-md-1 control-label"><?=lang('name')?></label>
                    <div class="col-md-7">
                        <input class="form-control" name="title" data-error="<?=lang('empty_msg')?>" required/>
                        <div class="help-block with-errors"></div>
                    </div>

                </div>
                <div class="form-group">
                   <label class="col-md-1 control-label"><?=lang('type')?></label>
                    <div class=" col-md-5">
                        <select class="form-control" name="type_id" id="type">
                            <?if($event_types):?>
                                <?foreach($event_types as $value):?>
                                    <option value="<?=$value->id?>"><?=$value->title?></option>
                                <?endforeach;?>
                            <?endif;?>
                        </select>
                    </div>
                    
                </div>
                <div class="form-group" style="margin-top:25px;">
                    <label class="col-md-1 control-label"><?=lang('city')?></label>
                    <div class=" col-md-5">
                        <select class="form-control  select2" name="location_id" required >
                            <?if($cities):?>
                                <option></option>
                                <?foreach($cities as $value):?>
                                    <option value="<?=$value->id?>"><?=$value->city?>, <small style="font-size:7px"><?=$value->sub?></small></option>
                                <?endforeach;?>
                            <?endif;?>
                        </select>
                    </div>
                    <label class="col-md-1 control-label"><?=lang('address')?></label>
                    <div class="col-md-5">
                        <input name="adress" class="form-control" data-error="<?=lang('empty_msg')?>" required>
                         <div class="help-block with-errors"></div>
                    </div>
                    <!--<label class="col-md-1 control-label">Postcode</label>
                    <div class="col-md-3">
                        <input name="postcode" class="form-control"  data-error='Post code can not be empty' required>
                         <div class="help-block with-errors"></div>
                    </div>-->
                </div>
                <div style="font-size: 16px;margin-top:-10px;">
                    <a class="btn btn-flat btn-default margin" onclick="addField('event_dates')"><i class="glyphicon glyphicon-plus"></i></a>
                    <?=lang('event_date')?>:
                      <a class="btn btn-flat btn-default margin" onclick="removeField('event_dates')"><i class="glyphicon glyphicon-minus"></i></a>
                </div>
                <div class="form-group" id="event_dates">
                    <div class="block">
                        <label class="col-md-1 control-label"><?=lang('begin')?> </label>
                        <div class="col-md-5">
                            <div class="input-group">                               
                                <input id="start" type='text' name="date_start[]" class="form-control date"  data-error="<?=lang('empty_msg')?>"  placeholder="From" readonly  />
                                <span class="input-group-addon"><i class="ion-calendar"></i></span>
                            </div>
                             <div class="help-block with-errors"></div>

                        </div>
                          <label class="col-md-1 control-label"> <?=lang('end')?> </label>
                        <div class="col-md-5" style="margin-bottom: 10px;">
                             <div class="input-group">
                                <input id="end" type='text' name="date_end[]" class="form-control date" data-error="<?=lang('empty_msg')?>"  placeholder="To" readonly="" />
                                <span class="input-group-addon"><i class="ion-calendar"></i></span>
                            </div>
                             <div class="help-block with-errors"></div>
                        </div>

                    </div>
                    <hr>
                </div>

  

                <div class="form-group">
                    <label class="col-md-1 control-label"><?=lang('photo')?></label>
                    <div class="col-md-3">
                        <div class="btn btn-default btn-file">
                            <i class="fa fa-paperclip"></i> <?=lang('atach')?>
                             <input type="file" name="userfile" size="20" required />
                            </div>
                        <p class="help-block">Max. 800kb</p>
                    </div>
                </div>
                <div class="form-group">
						<label class=" control-label col-md-1"><?=lang('desc')?></label>
						<div class=" col-md-offset-1 col-md-11">
							<textarea class="form-control" rows="3" name="description" data-error="<?=lang('empty_msg')?>" required></textarea>
                             <div class="help-block with-errors"></div>

						</div>			 	
				</div>
  
                
                <div class="form-group">
                        <div class="col-md-offset-4 col-md-4"  style="margin-top: 0px;">
                            <button type="submit" class="btn bg-black btn-block"><?=lang('save')?></button>
                        </div>
                </div>
            </form>
		</div>
	</div>
    </div>	
	</div>
</section>
 <script>
 var addField=function(name){
    var clone_elem= $('#'+name);
    var  block=clone_elem.children('.block').last();
    var new_elem= block.clone();
    clone_elem.append(new_elem);
    $('#'+name).children('.block').last().find('input').val('');
    $('.date').datetimepicker();
         
}
var removeField=function(name){
    var el=$('#'+name).children('.block');
     if(el.length>1){
    el.last().remove();
    }

}





$(document).ready(function(){

    $('.select2').select2({
                            placeholder: "<?=lang('select_city')?>",
                            });
        $('#type').select2();
    $('.date').datetimepicker();


    $('#event').on('submit',function(){
        var dates=$('.date');
        var error=false;

        $.each(dates,function(index,value){
            var val=$(this).val();
            if(val=='')
            {
                $(this).parent('div').parent('div').addClass('has-error');
                $(this).parent('div').next('div').addClass('has-error');
                error=true;

            }
            else{
                $(this).parent('div').parent('div').removeClass('has-error');
                $(this).parent('div').next('div').removeClass('has-error');
            }
        });
        if(error==true){
            return false;
        }
       
    });

  
});
</script>