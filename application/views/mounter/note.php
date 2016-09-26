<section class="content-header">
    <h1>Заметки<small></small></h1>
</section>
<section class="content">
<div class="row">
	<div class="col-md-4">
		<select class="form-control select2" id="street" >
			<?if($streets):?>
					<option value="">Все Улицы</option>
				<?foreach($streets as $key=>$value):?>
					<option value="<?=$value->id?>"><?=$value->title?></option>
				<?endforeach;?>
			<?endif;?>
		</select>
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
			<div class="table-responsive">
	        	<div class="box-body" id="get_table">
	        	</div>
        	</div>
        </div>
    </div>
</div>
</section>
<script type="text/javascript">
function get_table(){
	var data={
		street_id:$('#street option:selected').val(),
	};
	$.ajax({
		type:"POST",
		url:"<?=base_url('mounter/note_table')?>",
		data:data,
		success:function(result){
			//console.log(result);

			$("#get_table").html(result);
			$('#data').DataTable({

     							 "aoColumnDefs": [ { 'bSortable': false, 'aTargets': [ 2,3 ] }],
     							 "language": {"url": "//cdn.datatables.net/plug-ins/1.10.10/i18n/Russian.json"},
     							 				"order": [[ 1, "asc" ]],
		});

		}
	})

}
$(document).ready(function(){
get_table();
$('.select2').select2();

$('select').on('change',function(){
	get_table();
});

});


</script>



