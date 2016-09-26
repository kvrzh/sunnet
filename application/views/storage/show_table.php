
<div class="col-md-8">
        <?if($this->session->flashdata('success')):?>
          <div class="alert alert-success alert-dismissible">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <?=$this->session->flashdata('success')?>
          </div>
        <?endif;?>
<h3><?=$user->name?> <small><?=$role?></small></h3>
<input name="user_id" type="hidden" value="<?=$user->id?>">
<input name="user" type="hidden" value="<?=$this->session->userdata('user_id')?>">
<input name="date_move" type="hidden" value="<?=date('U')?>">
    <div class="box box-success">
        <div class="box-body">
            <table id="data" class="table table-striped table-bordered" cellspacing="0" width="100%">
                <thead>
                    <tr>   
                    <th >#</th>
                    <th >Название</th>
                    <th >Единицы</th>
                    <th >Количество</th>
                    <th >Детально</th>
                    </tr>
                </thead> <tbody>
                <?if($gds):?>
                    <?foreach($gds as $key=>$value):?>
                        <tr>
                        <td><?=$value->id?></td>
                        <td><a class="gds" id="<?=$value->id?>"><?=$value->title?></a></td>
                        <td><?=$value->unit?></td>
                        <td><?=$value->count?></td>
                        <td><?=$value->description?></td>

                        </tr>
                    <?endforeach;?>  
                <?endif;?>

            </tbody></table>
        </div><!-- /.box-body -->

    </div>
</div>
<div class="col-md-4">
	<h4>Добавить</h4>
	<div class="box box-primary">
		<div class="box-body">
		<form id="add" class="form-horizontal formself"  data-toggle="validator" role="form">
			<div class="form-group">
			<div class="col-md-12">
				<select class=" form-control  gds_select select2" name="gds_id" required>
				<option></option>
					<?if($gds_all):?>
					<?foreach($gds_all as $key=>$value):?>
						<option value="<?=$value->id?>"><?=$value->title.' '.$value->unit?></option>
					<?endforeach;?>
					<?endif;?>
				</select>
			</div>
			</div>
    		<div class="form-group">
  			<label  class="control-label col-md-4">Количество*</label>
		  	<div class="col-md-3">
		  		<input  type="number" step="0.01"  min="0" type="text"  name="count" class="form-control" data-error="Неправильный формат " required>
			<div class="help-block with-errors"></div>
		  	</div>
		  	<div class="col-md-5"><button type="submit" class="btn bg-blue btn-block">Добавить</button></div>
		  	</div>	
		</form>
</div>
	</div>

	<h4>Списать</h4>
		<div class="box box-danger">
		<div class="box-body">
			<form id="delete" class="form-horizontal formself"  data-toggle="validator" role="form">
			<div class="form-group">
			<div class="col-md-12">
				<select id="delete_select" class=" form-control  gds_select select2" name="gds_id" required>
				<option></option>
					<?if($gds_all):?>
					<?foreach($gds_all as $key=>$value):?>
						<option value="<?=$value->id?>"><?=$value->title.' '.$value->unit?></option>
					<?endforeach;?>
					<?endif;?>
				</select>
			</div>
			</div>
    		<div class="form-group">
  			<label  class="control-label col-md-4">Количество*</label>
		  	<div class="col-md-3">
		  		<input id="delete_count" type="number" step="0.01" max="0" min="0" type="text"  name="count" class="form-control" data-error="Неправильный формат " required>
			<div class="help-block with-errors"></div>
		  	</div>
		  	<div class="col-md-5"><button type="submit" class="btn bg-red btn-block">Списать</button></div>
		  	</div>	
		  	<div class="form-group">
		  		<label class="control-label col-md-4">Коментарий	</label>
		  		<div class="col-md-8">
		  			<input type="text" name="comment" class="form-control">
		  		</div>
		  	</div>
		</form>
	</div>
</div>

	<h4>Переместить</h4>
		<div class="box box-warning">
		<div class="box-body">
			<form id="move" class="form-horizontal formself"  data-toggle="validator" role="form">
			<div class="form-group">
			<div class="col-md-12">
				<select id="move_select" class=" form-control  gds_select select2" name="gds_id" required>
				<option></option>
					<?if($gds_all):?>
					<?foreach($gds_all as $key=>$value):?>
						<option value="<?=$value->id?>"><?=$value->title.' '.$value->unit?></option>
					<?endforeach;?>
					<?endif;?>
				</select>
			</div>
			</div>
			<div class="form-group">
				<div class="col-md-12">
				<select id="move_select" class=" form-control  user_select select2" name="user_to" required>
				<option></option>
					<?if($user_all):?>
					<?foreach($user_all as $key=>$value):?>
						<option value="<?=$value->id?>"><?=$value->name?></option>
					<?endforeach;?>
					<?endif;?>
				</select>
			</div>

			</div>
    		<div class="form-group">
  			<label  class="control-label col-md-4">Количество*</label>
		  	<div class="col-md-3">
		  		<input id="move_count" type="number" step="0.01" max="0" min="0" type="text"  name="count" class="form-control" data-error="Неправильный формат " required>
			<div class="help-block with-errors"></div>
		  	</div>
		  	<div class="col-md-5"><button type="submit" class="btn bg-yellow btn-block">Переместить</button></div>
		  	</div>	
		  	<div class="form-group">
		  		<label class="control-label col-md-4">Коментарий	</label>
		  		<div class="col-md-8">
		  			<input type="text" name="comment" class="form-control">
		  		</div>
		  	</div>
		</form>
	</div>
</div>
	
</div>
<script type="text/javascript">
  $(document).ready(function(){
     $('#data').DataTable({"language": {"url": "//cdn.datatables.net/plug-ins/1.10.10/i18n/Russian.json"}});
     $('.gds_select').select2({
    placeholder: "Выберите Инвентарь",
    });
  	$('.user_select').select2({
    placeholder: "Выберите получателя",
    });
      $('.alert').fadeOut(2000);

  	$('#delete_select').on('change',function(){
  		var gds_id=$('#delete_select  option:selected').val();
  		var user_id=$('input[name=user_id]').val();
        $.ajax({
            type:"POST",
            url:"<?=base_url('storage/get_count');?>",
            data:{
            	gds_id:gds_id,
            	user_id
            },
            success:function(count){
                 $("#delete_count").attr('max',JSON.parse(count));
            }

        });
  	})
	$('#move_select').on('change',function(){
  		var gds_id=$('#move_select  option:selected').val();
  		var user_id=$('input[name=user_id]').val();
        $.ajax({
            type:"POST",
            url:"<?=base_url('storage/get_count');?>",
            data:{
            	gds_id:gds_id,
            	user_id
            },
            success:function(count){
                 $("#move_count").attr('max',JSON.parse(count));
            }

        });
  	})
  	$('.gds').on('click',function(){
  		var gds_id=$(this).attr('id');
  		console.log(gds_id);
  		$('.gds_select').val(gds_id).change();
  	})





     $('#add').on('submit',function(){
     	var count =$(this).find('input[name=count]').val();
     	var gds_id=$(this).find('select[name=gds_id] option:selected').val();
     	var user_to=$('input[name=user_id]').val();
     	var user_id=$('input[name=user]').val();
     	var date_move=$('input[name=date_move]').val();
        $.ajax({
            type:"POST",
            url:"<?=base_url('storage/update_stock');?>",
            data:{
                count:count,
                gds_id:gds_id,
                user_to:user_to,
                user_id:user_id,
                move_type:'1',
                date_move:date_move
            },
            success:function(result){
                 $('#goods').load('<?php echo base_url('storage/show_table');?>/'+user_to);

                
            }

        });
     	return false;


     });

     $('#delete').on('submit',function(){
     	var count =$(this).find('input[name=count]').val();
     	var gds_id=$(this).find('select[name=gds_id] option:selected').val();
     	var user_from=$('input[name=user_id]').val();
     	var user_id=$('input[name=user]').val();
     	var comment=$('input[name=comment]').val();
     	var date_move=$('input[name=date_move]').val();
        $.ajax({
            type:"POST",
            url:"<?=base_url('storage/update_stock');?>",
            data:{
                count:count,
                gds_id:gds_id,
                user_from:user_from,
                comment:comment,
                user_id:user_id,
                move_type:'2',
                date_move:date_move

            },
            success:function(result){
                $('#goods').load('<?php echo base_url('storage/show_table');?>/'+user_from);
                
            }

        });
     	return false;

     });
      	$('#move').on('submit',function(){
     	var count =$(this).find('input[name=count]').val();
     	var gds_id=$(this).find('select[name=gds_id] option:selected').val();
     	var user_from=$('input[name=user_id]').val();
     	var user_to=$('select[name=user_to]').val();
     	var user_id=$('input[name=user]').val();
     	var comment=$('input[name=comment]').val();
     	var date_move=$('input[name=date_move]').val();
        $.ajax({
            type:"POST",
            url:"<?=base_url('storage/update_stock');?>",
            data:{
                count:count,
                gds_id:gds_id,
                user_from:user_from,
                user_to:user_to,
                comment:comment,
                user_id:user_id,
                move_type:'3',
                date_move:date_move

            },
            success:function(result){
                $('#goods').load('<?php echo base_url('storage/show_table');?>/'+user_from);
                
            }

        });
     	return false;

     });

  });

</script>

	

