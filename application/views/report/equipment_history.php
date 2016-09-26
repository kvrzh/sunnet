<section class="content-header">
    <h1>Временное оборудование</h1>
</section>
<section class="content">
	<div class="row">
		<div class="col-md-12">
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

		<div class="col-md-3">
			<select id="location_id" class="form-control" >
				<option value="">Все места</option>
				<?if($equipment_location):?>
					<?foreach($equipment_location as $key=>$value):?>
						<option value="<?=$value->id?>"><?=$value->title?></option>
					<?endforeach;?>
				<?endif;?>
			</select>
		</div>
	  	<div class="col-md-3">
			<select id="type_id" class="form-control" >
				<option value="">Все типы</option>
				<?if($equipment_type):?>
					<?foreach($equipment_type as $key=>$value):?>
						<option value="<?=$value->id?>"><?=$value->title?></option>
					<?endforeach;?>
				<?endif;?>


			</select>
		</div>
		<div class="col-md-3">
			<select id="vendor_id" class="form-control">
				<option value="">Все вендеры</option>
				<?if($equipment_vendor):?>
					<?foreach($equipment_vendor as $key=>$value):?>
						<option value="<?=$value->id?>"><?=$value->title?></option>
					<?endforeach;?>
				<?endif;?>
			</select>
		</div>
		<div class="col-md-3">
			<select id="user_id" class="form-control">
				<option value="">Все пользователи</option>
				<?if($users):?>
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
	<div class="col-md-6">
	    	<div class="btn-group">
            <button class="btn btn-default" onclick="change_day('-5')">-5</button>
            <button class="btn btn-default" onclick="change_day('-4')">-4</button>
            <button class="btn btn-default" onclick="change_day('-3')">-3</button>
            <button class="btn btn-default" onclick="change_day('-2')">-2</button>
            <button class="btn btn-default" onclick="change_day('-1')">-1</button>
            <button class="btn btn-success" onclick="change_day('0')">Сегодня</button>
            <button class="btn btn-default" onclick="change_day('1')">1</button>
            <button class="btn btn-default" onclick="change_day('2')">2</button>
            <button class="btn btn-default" onclick="change_day('3')">3</button>
            <button class="btn btn-default" onclick="change_day('4')">4</button>
            <button class="btn btn-default" onclick="change_day('5')">5</button>
             <button class="btn btn-warning" onclick="without_day('5')">Без даты</button>
    	</div>
		
	</div>
		  	<div class="col-md-12" style="margin-top:10px">

	        <div class="box box-success">
	            <div class="box-body" id="get_table" style="margin-top:10px"> 

	            </div><!-- /.box-body -->

	        </div>
			</div>
		</div>
	</div>
</section>
<script type="text/javascript">
function get_table(){
	var data={
	 	type_id:$('#type_id option:selected').val(),
	 	vendor_id:$('#vendor_id option:selected').val(),
	 	user_id:$('#user_id option:selected').val(),
	 	location_id:$('#location_id option:selected').val(),
	 	 		start:$('#start').val(),
		end:$('#end').val(),

	};
	$.ajax({
		type:"POST",
		url:"<?=base_url('report/equipment_history_table')?>",
		data:data,
		success:function(result){

			$("#get_table").html(result);
			$(document).ready(function(){
							$('#data').DataTable({
		     							 "aoColumnDefs": [ { 'bSortable': false, 'aTargets': [ 4 ] }],
		     							 "language": {"url": "//cdn.datatables.net/plug-ins/1.10.10/i18n/Russian.json"},
		     							 				"order": [[ 0, "asc" ]],
				});
			});

		}
	})

}
$('select').on('change',function(){
	get_table();
})
$(document).ready(function(){
	get_table();
	    $('#img').ekkoLightbox();
	    $('.ctable').ekkoLightbox();
    $(document).delegate('*[data-toggle="lightbox"]', 'click', function(event) {
    event.preventDefault();
    $(this).ekkoLightbox();
});
});
$('.date').datepicker({language: 'ru'}).on('changeDate',function(){
		get_table();
	});
function change_day (result) {
	var today=new Date();
	$('#start').datepicker('update', new Date(today.getFullYear(), today.getMonth(), today.getDate()+parseInt(result)));
	$('#end').datepicker('update', new Date(today.getFullYear(), today.getMonth(), today.getDate()+parseInt(result)));
	get_table();
}
function without_day () {
	$('#start').datepicker('update', false);
	$('#end').datepicker('update',false );
	get_table();
}
</script>