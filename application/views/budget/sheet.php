<section class="content-header">
    <h1>Ведомость</h1>
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
	        <div class="box box-success">
	            <div class="box-body">
	                <table id="data" class="table table-striped table-bordered" cellspacing="0" width="100%">
	                    <thead>
	                        <tr> 
	                        <th >Имя</th>  
	                        <th >Позиция</th>
	                        <th >За месяц</th>
	                        <th >Премия</th>
	                        <th >Штраф</th>
	                        <th >Выдали</th>
	                        <th >Зароботал</th>
	                        <th >Остаток</th>
	
	                        </tr>
	                    </thead> <tbody>
	                    <?if($users):?>
	                        <?foreach($users as $key=>$value):?>
	                            <tr>
                             	<td><a href="<?=base_url('budget/sheet_user/'.$key)?>"><?=$value['name']?></a></td>
                             	<td><?=$value['role']?></td>
                             	<?$rest =isset($value['rest'])?$value['rest']:0?>
	                            <td><?=isset($value['salary'])?$value['salary']:0?></td>
	                            <td><?=isset($value['fine'])?$value['fine']:0?></td>
	                            <td><?=isset($value['damage'])?$value['damage']:0?></td>
	                            <td><?=isset($value['pay'])?$value['pay']:0?></td>
	                            <td><?=isset($value['total'])?$value['total']:0?></td>
	                            <td><a href="<?=base_url('budget/create/?user_id='.$key.'&sum_out='.$rest)?>"><?=isset($value['rest'])?$value['rest']:0?></a></td>
	                           
	                            

	                            </tr>
	                        <?endforeach;?>  
	                    <?endif;?>

	                </tbody></table>
	            </div><!-- /.box-body -->

	        </div>
			
		</div>
	</div>
</section>
<script type="text/javascript">
	$('#data').DataTable({
	 "aoColumnDefs": [ { 'bSortable': false, 'aTargets': [ 4 ] }],
	 "language": {"url": "//cdn.datatables.net/plug-ins/1.10.10/i18n/Russian.json"}
	});
</script>
