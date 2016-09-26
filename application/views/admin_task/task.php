<section class="content-header">
    <h1>База админ задач</h1>
</section>
<section class="content">
	<div class="row">

	  		<label class="control-label col-md-1">Статус</label>
		  	<div class="col-md-3">
				<select id="status_id" class="form-control" >
					<option value="">Все статуси</option>
					<?if($admin_status):?>
						<?foreach($admin_status as $key=>$value):?>
							<option value="<?=$value->id?>"><?=$value->title?></option>
						<?endforeach;?>
					<?endif;?>
				</select>
		  	</div>
		  	<label class="control-label col-md-1">Типы</label>
		  	<div class="col-md-3">
				<select id="type_id" class="form-control">
					<option value="">Все типы</option>
					<?if($admin_type):?>
						<?foreach($admin_type as $key=>$value):?>
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
		<div class="col-md-12" style="margin-top:10px">
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
	            <div class="box-body" id="get_table">

	            </div><!-- /.box-body -->

	        </div>
			
		</div>

	</div>
</section>
<script type="text/javascript">
function get_table(){
	var data={
	 	status_id:$('#status_id option:selected').val(),
	 	type_id:$('#type_id option:selected').val(),
	 	start:$('#start').val(),
	 	end:$('#end').val(),
	};
	console.log(data);
	$.ajax({
		type:"POST",
		url:"<?=base_url('admin_task/task_table')?>",
		data:data,
		success:function(result){
			//console.log(result);

			$("#get_table").html(result);
			$(document).ready(function(){
							$('#data').DataTable({
		     							 "aoColumnDefs": [ { 'bSortable': false, 'aTargets': [ 1,3,5 ] }],
		     							 "language": {"url": "//cdn.datatables.net/plug-ins/1.10.10/i18n/Russian.json"},
		     							 				"order": [[ 0, "desc" ]],
				});
			});



		}
	})

}

$('select').on('change',function(){
	get_table();

})
$(document).ready(function(){
	$('.date').datepicker({language: 'ru'}).on('changeDate',function(){
		get_table();
	});
	get_table();
	var today=new Date();
	var day=today.getDate();



});

</script>