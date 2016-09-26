<section class="content-header">
    <h1>Наличие инвентаря</h1>
</section>
<section class="content">
<div class="row">
	<div class="col-md-6">
		<select id="cur_user" class="form-control">
		<option></option>
		<?if($users):?>
		<?foreach($users as $key=>$value):?>
			<option value="<?=$value->id?>"><?=$value->name?></option>
		<?endforeach;?>
		<?endif;?>	
	</select>
	</div>


</div>

<div class="row" id="goods" style="padding-top:5px">
	
</div>
</section>
<script type="text/javascript">
	$(document).ready(function(){
     $('#cur_user').select2({
    placeholder: "Выберите пользователя/помещение",
    });
		$("#cur_user").on('change',function(){
			var user_id=$('#cur_user option:selected').val();
			$('#goods').load('<?php echo base_url('storage/show_table');?>/'+user_id);
		})
	})
</script>