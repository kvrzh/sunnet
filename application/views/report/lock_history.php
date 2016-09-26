<section class="content-header">
    <h1>История по електронных замках</h1>
</section>
<section class="content">
	<div class="row">
	  		<label class="control-label col-md-2">Пользователь</label>
		  	<div class="col-md-3">
					<select id="user_id" class="form-control" >
						<option value="">Все пользователи</option>
						<?if($users):?>
							<?foreach($users as $key=>$value):?>
								<option value="<?=$value->id?>"><?=$value->name?></option>
							<?endforeach;?>
						<?endif;?>


					</select>
		  	</div>
		  	<label class="control-label col-md-1">Замок</label>
		  	<div class="col-md-3">
					<select id="lock_id" class="form-control">
						<option value="">Все замки</option>
						<?if($lock):?>
							<?foreach($lock as $key=>$value):?>
								<option value="<?=$value->id?>"><?=$value->title?></option>
							<?endforeach;?>
						<?endif;?>
					</select>
		  	</div>
		<div class="col-md-10" style="margin-top:10px">
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
	 	user_id:$('#user_id option:selected').val(),
	 	lock_id:$('#lock_id option:selected').val(),

	};
	$.ajax({
		type:"POST",
		url:"<?=base_url('report/lock_table')?>",
		data:data,
		success:function(result){
			//console.log(result);

			$("#get_table").html(result);
			$(document).ready(function(){
							$('#data').DataTable({
		     							 "aoColumnDefs": [ { 'bSortable': false, 'aTargets': [  ] }],
		     							 "language": {"url": "//cdn.datatables.net/plug-ins/1.10.10/i18n/Russian.json"},
		     							 				"order": [[ 2, "desc" ]],
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