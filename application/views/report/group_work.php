<section class="content-header">
    <h1>Отчет по монтажнику<small></small></h1>
</section>
<section class="content">
<div class="row">
	<div class="col-md-2">
		<select class="form-control select2" id="user_id">
			<?if($users):?>
					<option value="">Все монтажники</option>
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
		user_id:$('#user_id option:selected').val(),
 		start:$('#start').val(),
		end:$('#end').val(),
	};
	$.ajax({
		type:"POST",
		url:"<?=base_url('report/group_work_table')?>",
		data:data,
		success:function(result){
			//console.log(result);

			$("#get_table").html(result);
			$('#data').DataTable({

     							 "aoColumnDefs": [ { 'bSortable': false, 'aTargets': [ 2,3,4 ] }],
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

$('#start').datepicker('update', new Date(today.getFullYear(), today.getMonth(), today.getDate()-5));
$('#end').datepicker('update', new Date(today.getFullYear(), today.getMonth(), today.getDate()+5));
get_table();


	$('select').on('change',function(){
		get_table();
	});

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
$(document).on('click','.bg-purple',function(){
	var user_id=$(this).attr('user-id');
	$('#user_id').val(user_id);
		get_table();
})
</script>



