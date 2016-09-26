<section class="content-header">
    <h1> База Заявок<small></small></h1>
</section>
<section class="content">
<div class="row">
	<div class="col-md-2">
		<select class="form-control select2" id="type">
			<?if($types):?>
					<option value="">Все типы</option>
				<?foreach($types as $key=>$value):?>
					<option value="<?=$value->id?>"><?=$value->title?></option>
				<?endforeach;?>
			<?endif;?>
		</select>
	</div>
	<div class="col-md-2">
		<select class="form-control select2" id="status_id">
			<?if($status):?>
					<option value="">Все статусы</option>
				<?foreach($status as $key=>$value):?>
					<option value="<?=$value->id?>"><?=$value->title?></option>
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
		status_id:$('#status_id option:selected').val(),
		type:$('#type option:selected').val(),
 		start:$('#start').val(),
		end:$('#end').val(),
	};
	$.ajax({
		type:"POST",
		url:"<?=base_url('report/repair_table')?>",
		data:data,
		success:function(result){
			//console.log(result);

			$("#get_table").html(result);
			$('#data').DataTable({

     							 "aoColumnDefs": [ { 'bSortable': false, 'aTargets': [ 1,2,3,4,5 ] }],
     							 "language": {"url": "//cdn.datatables.net/plug-ins/1.10.10/i18n/Russian.json"},
     							 				"order": [[ 0, "desc" ]],
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



