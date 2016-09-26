<section class="content-header">
    <h1>Штрафы премии</h1>
</section>
<section class="content">
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
	        <div class="box box-success">
	            <div class="box-body">
	                <table id="data" class="table table-striped table-bordered" cellspacing="0" width="100%">
	                    <thead>
	                        <tr> 
	                        <th >Дата</th>  
	                        <th >Кому</th>
	                        <th >Сумма</th>
	                        <th >Коментарий</th>
	                        <th >Тип</th>
	                        <th >Выписал</th>
	                        <th><i class="ion-trash-a"></i></th>
	                        </tr>
	                    </thead> <tbody>
	                    <?if($user_fines):?>
	                        <?foreach($user_fines as $key=>$value):?>
	                            <tr>
	                             <td><?=default_dt($value->date)?></td>
	                            <td><?=$value->user?></td>
	                            <td><?=$value->sum?></td>
	                            <td><?=$value->comment?></td>
	                            <?if($value->type==1):?>
	                            	<td><span class=" badge bg-green">Премия</span></td>
	                            <?else:?>
	                            	<td><span class="badge bg-red">Штраф</span></td>
	                            <?endif;?>
	                              <td><?=$value->admin?></td>
	                            <td><a href="<?=base_url('budget/user_fine_delete_action/'.$value->id)?>"><i class="ion-trash-a"></i></a></td>
	                            

	                            </tr>
	                        <?endforeach;?>  
	                    <?endif;?>

	                </tbody></table>
	            </div><!-- /.box-body -->

	        </div>
			
		</div>
	    <div class="col-md-2">
	        <a href="<?=base_url('budget/user_fine_create')?>" class="btn btn-block btn-primary btn-flat">Добавить</a>
	    </div>
	</div>
</section>
<script type="text/javascript">
	$('#data').DataTable({
	 "aoColumnDefs": [ { 'bSortable': false, 'aTargets': [ 4 ] }],
	 "language": {"url": "//cdn.datatables.net/plug-ins/1.10.10/i18n/Russian.json"}
	});
</script>
