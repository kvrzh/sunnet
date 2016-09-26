<section class="content-header">
    <h1>Удаленные проводки<small></small></h1>
</section>
<section class="content">
<div class="row">
	<div class="col-md-2">
		<select class="form-control select2" id="user_in">
			<?if($users):?>
					<option value="">Все получатели</option>
				<?foreach($users as $key=>$value):?>
					<option value="<?=$value->id?>"><?=$value->name?></option>
				<?endforeach;?>
			<?endif;?>
		</select>
	</div>
	<div class="col-md-2">
		<select class="form-control select2" id="type_id">
			<?if($types):?>
				<option value="">Все статьи</option>
					<?$type=0;?>
					<?foreach($types as $key=>$value):?>			
					<?if($type!=$value->type):?>
					<optgroup label="<?=$value->type_title?>"></optgroup>
					<?endif;?>
					<option value="<?=$value->id?>"><?=$value->title?></option>
					<?$type=$value->type;?>
				<?endforeach;?>
			<?endif;?>
		</select>
	</div>
	<div class="col-md-2">
		<select class="form-control select2" id="user_out">
			<?if($users):?>
				<option value="">Все источники</option>
				<?foreach($users as $key=>$value):?>
					<option value="<?=$value->id?>"><?=$value->name?></option>
				<?endforeach;?>
			<?endif;?>
		</select>
	</div>
	<div class="col-md-2">
		<div class="input-group">                               
			<input id="start" type='text' class="form-control date"  />
			<span class="input-group-addon"><i class="ion-calendar"></i></span>
		</div>
	</div>
	<div class="col-md-2">
		<div class="input-group">                               
			<input id="end" type='text'  class="form-control date"  />
			<span class="input-group-addon"><i class="ion-calendar"></i></span>
		</div>
	</div>
</div>

<div class="row" style="margin-top:10px">
	<div class="col-md-12">
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

		<div class="box box-success">
        	<div class="box-body" id="get_table">
        	</div>
        </div>
    </div>
</div>
</section>
<script type="text/javascript">
function get_table(){
	var data={
		user_in:$('#user_in option:selected').val(),
		user_out:$('#user_out option:selected').val(),
	 	type_id:$('#type_id option:selected').val(),
 		start:$('#start').val(),
		end:$('#end').val(),
	};
	$.ajax({
		type:"POST",
		url:"<?=base_url('report/budget_table')?>",
		data:data,
		success:function(result){
			//console.log(result);

			$("#get_table").html(result);
			$('#data').DataTable({
     							 "aoColumnDefs": [ { 'bSortable': false, 'aTargets': [ 7 ] }],
     							 "language": {"url": "//cdn.datatables.net/plug-ins/1.10.10/i18n/Russian.json"}
		});

		}
	})

}
$(document).ready(function(){
	$('.date').datepicker({language: 'ru'}).on('changeDate',function(){
		get_table();
	});

var today=new Date();
var day=today.getDate();

$('#start').datepicker('update', new Date(today.getFullYear(), today.getMonth(), 1));
$('#end').datepicker('update', new Date(today.getFullYear(), today.getMonth(), day+1));
get_table();


	$('select').on('change',function(){
		get_table();
	});

});

</script>



