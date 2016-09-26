<section class="content-header">
    <h1>Модели оборудования</h1>
</section>
<section class="content">
	<div class="row">
	    <div class="col-md-2">
	        <a href="<?=base_url('equipment/equipment_model_create')?>" class="btn btn-block btn-primary btn-flat">Добавить</a>
	    </div>
	  		<label class="control-label col-md-1">Тип</label>
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
		  	<label class="control-label col-md-1">Вендор</label>
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
	 	type_id:$('#type_id option:selected').val(),
	 	vendor_id:$('#vendor_id option:selected').val(),

	};
	$.ajax({
		type:"POST",
		url:"<?=base_url('equipment/equipment_model_table')?>",
		data:data,
		success:function(result){
			//console.log(result);

			$("#get_table").html(result);
			$(document).ready(function(){
							$('#data').DataTable({
		     							 "aoColumnDefs": [ { 'bSortable': false, 'aTargets': [ 1,4,5,6,7,8 ] }],
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
    $(document).delegate('*[data-toggle="lightbox"]', 'click', function(event) {
    event.preventDefault();
    $(this).ekkoLightbox();
});
});

</script>