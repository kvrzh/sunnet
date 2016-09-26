<section class="content-header">
    <h1>Диапазоны времени<small></small></h1>
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
</div>
</div>
<div class="row">
<div class="col-md-6">
	<div class="box box-success">
		<div class="box-header with-borer"><h3 class="box-title">Подключения</h3></div>
		<div class="box-body">
			<form  action="<?=base_url('option/repair_range_action')?>" method="POST" class="form-horizontal" >
			<input type="hidden" name="type_id" value="1">
			<a class="btn btn-flat btn-default margin" onclick="addField('type_1')" style="margin-top:-10px"><i class="glyphicon glyphicon-plus"></i> Добавить диапазон</a>
			<div id="type_1">

			<?if($repair_range1):?>
		    	<?foreach($repair_range1 as $value):?>
		            <div class="block form-group">
		            
		            	<label class="col-md-2 control-label type_1">Диап. <span>1</span>:</label>
		            <div class="col-md-4">
		            <div class="input-group  input-append time ">
		           	 	<input placeholder="Начало"  value="<?=$value->start?>" class="form-control " required data-format="hh:mm" type="text"  name="date[start][]"></input>
		           	 	<span class="input-group-addon add-on">
		           	 	<i  class="glyphicon glyphicon-time"></i></span>
		            </div></div>
		            <div class="col-md-4">
		            <div class="input-group  input-append time ">
		           	 	<input  placeholder="Конец" value="<?=$value->end?>" class="form-control " required data-format="hh:mm" type="text"  name="date[end][]"></input>
		           	 	<span class="input-group-addon add-on">
		           	 	<i  class="glyphicon glyphicon-time"></i></span>
		            </div></div>
		                <div class="col-md-2">
		                    <a class="btn btn-flat btn-default remove"><i class="glyphicon glyphicon-minus" ></i></a>
		                </div>
		            </div>
			    <?endforeach;?>
				<?else:?>
		            <div class="block form-group">
		            
		            	<label class="col-md-2 control-label type_1">Диап. <span>1</span>:</label>
		            <div class="col-md-4">
		            <div class="input-group  input-append time ">
		           	 	<input placeholder="Начало"   class="form-control " required data-format="hh:mm" type="text"  name="date[start][]"></input>
		           	 	<span class="input-group-addon add-on">
		           	 	<i  class="glyphicon glyphicon-time"></i></span>
		            </div></div>
		            <div class="col-md-4">
		            <div class="input-group  input-append time ">
		           	 	<input  placeholder="Конец" class="form-control " required data-format="hh:mm" type="text"  name="date[end][]"></input>
		           	 	<span class="input-group-addon add-on">
		           	 	<i  class="glyphicon glyphicon-time"></i></span>
		            </div></div>
		                <div class="col-md-2">
		                    <a class="btn btn-flat btn-default remove"><i class="glyphicon glyphicon-minus" ></i></a>
		                </div>
		            </div>
				<?endif;?>
			</div>
	        <div class="form-group">
        		<div class="col-md-offset-2 col-md-8">
            		<button type="submit" class="btn btn-block bg-black">Сохранить</button>
            	</div>
            </div>
			</form>
		</div>
		</div>

		</div>



<div class="col-md-6">
	<div class="box box-success">
		<div class="box-header with-borer"><h3 class="box-title">Ремонты</h3></div>
		<div class="box-body">
			<form  action="<?=base_url('option/repair_range_action')?>" method="POST" class="form-horizontal" >
			<input type="hidden" name="type_id" value="2">
			<a class="btn btn-flat btn-default margin" onclick="addField('type_2')" style="margin-top:-10px"><i class="glyphicon glyphicon-plus"></i> Добавить диапазон</a>
			<div id="type_2">

			<?if($repair_range2):?>
		    	<?foreach($repair_range2 as $value):?>

		            <div class="block form-group">
		            
		            	<label class="col-md-2 control-label type_2">Диап. <span>1</span>:</label>
		            <div class="col-md-4">
		            <div class="input-group  input-append time ">
		           	 	<input placeholder="Начало"  value="<?=$value->start?>" class="form-control " required data-format="hh:mm" type="text"  name="date[start][]"></input>
		           	 	<span class="input-group-addon add-on">
		           	 	<i  class="glyphicon glyphicon-time"></i></span>
		            </div></div>
		            <div class="col-md-4">
		            <div class="input-group  input-append time ">
		           	 	<input  placeholder="Конец" value="<?=$value->end?>" class="form-control " required data-format="hh:mm" type="text"  name="date[end][]"></input>
		           	 	<span class="input-group-addon add-on">
		           	 	<i  class="glyphicon glyphicon-time"></i></span>
		            </div></div>
		                <div class="col-md-2">
		                    <a class="btn btn-flat btn-default remove"><i class="glyphicon glyphicon-minus" ></i></a>
		                </div>
		            </div>
			    <?endforeach;?>
				<?else:?>
		            <div class="block form-group">
		            
		            	<label class="col-md-2 control-label type_2">Диап. <span>1</span>:</label>
		            <div class="col-md-4">
		            <div class="input-group  input-append time ">
		           	 	<input placeholder="Начало"   class="form-control " required data-format="hh:mm" type="text"  name="date[start][]"></input>
		           	 	<span class="input-group-addon add-on">
		           	 	<i  class="glyphicon glyphicon-time"></i></span>
		            </div></div>
		            <div class="col-md-4">
		            <div class="input-group  input-append time ">
		           	 	<input  placeholder="Конец" class="form-control " required data-format="hh:mm" type="text"  name="date[end][]"></input>
		           	 	<span class="input-group-addon add-on">
		           	 	<i  class="glyphicon glyphicon-time"></i></span>
		            </div></div>
		                <div class="col-md-2">
		                    <a class="btn btn-flat btn-default remove"><i class="glyphicon glyphicon-minus" ></i></a>
		                </div>
		            </div>
				<?endif;?>
			</div>
	        <div class="form-group">
        		<div class="col-md-offset-2 col-md-8">
            		<button type="submit" class="btn btn-block bg-black">Сохранить</button>
            	</div>
            </div>
			</form>
		</div>
		</div>

		</div>

	</div>
		</div>

	

		
</section>
<script type="text/javascript">
var change_day =function(){
	var dayCl=['.type_1','.type_2'];
	$.each(dayCl,function(key,value){
		$.each($(value),function(key,value){
			$(this).children('span').html(key+1);
		});
	});

}
var addField=function(name){
    var clone_elem= $('#'+name);
    var  block=clone_elem.children('.block').last();
    var new_elem= block.clone();
    clone_elem.append(new_elem);
    $('#'+name).children('.block').last().find('input').val('');
	$('.time').datetimepicker({pickDate: false,pickSeconds: false,});
	$('.date1').datetimepicker({pickTime: false,});
    change_day();     
}
$(document).ready(function(){
	$('.date').datetimepicker({format: 'yyyy-MM-dd hh:ii'});     
	change_day();
	$(document).on('click','.remove',function(){
		console.log('click');
		var elem=$(this).parent('div').parent('.block');
		var count=elem.parent('div').children('.block').length;
		if(count>1){
			elem.remove();
		}
		   change_day();    
	}) 
	$('.time').datetimepicker({
      pickDate: false,
      pickSeconds: false,
    });

});

</script>