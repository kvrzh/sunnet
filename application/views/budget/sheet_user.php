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
	                        <th >Дата</th>  
	                        <th >По параметру</th>
	                        <th >По времени</th>
	                        <th >Заработал</th>
	                        <th >Премия</th>
	                        <th >Штраф</th>
	                        <th >Выплатили</th>
	                        <th >Всего</th>
	                        <th >Остаток</th>
	
	                        </tr>
	                    </thead> <tbody>
	                    <?if(isset($user['mon'])):?>
	                    <?if($user['mon']):?>
	                        <?foreach($user['mon'] as $key=>$value):?>
	                            <tr>
                             	<td><a href="<?=base_url('budget/sheet_mon/?date='.$key.'&user='.$user_id)?>"><?=$key?></a></td>
                             	<td><?=$value['koef']?></td>
                             	<td><?=$value['hour']?></td>
                             	<td><?=$value['salary']?></td>
                             	<td><?=$value['fine']?></td>
                             	<td><?=$value['damage']?></td>
                             	<td><?=$value['pay']?></td>
                             	<td><?=$value['total']?></td>
                             	<td><?=$value['rest']?></td>
	                            </tr>
	                        <?endforeach;?>  
	                    <?endif;?>
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
