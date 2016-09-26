<section class="content-header">
    <h1>Результаты тестирования</h1>
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
    	</div>
	</div>
	<div class="row">
		<div class="col-md-10">
	        <div class="box box-success">
	            <div class="box-body">
	                <table id="data" class="table table-striped table-bordered" cellspacing="0" width="100%">
	                    <thead>
	                        <tr>   
	                        <th >#</th>
	                        <th >Пользователь</th>
	                        <th >Создан</th>
	                        <th >Начал тест</th>
	                        <th >Потратил</th>
	                        <th >Неправильных</th>
	                        </tr>
	                    </thead> <tbody>
	                    <?if($task):?>
	                        <?foreach($task as $key=>$value):?>
	                            <tr class="<?=$value->status_finish==0?'bg-y':''?>">
		                            <td width="4%"><a href="<?=base_url('test/detail/'.$value->id)?>"><?=$value->id?></td>
		                            <td width="25%"><?=$value->user_name?></a></td>
		                            <td width="20%"><?=default_dt($value->date)?></td>
		                            <td width="20%"><?=$value->start?default_dt($value->start):''?></td>
		                            <td width="10%"><?=($value->start && $value->finish)?default_ms($value->finish-$value->start):''?></td>
		                        	<td ><?=$value->wrong?></td>
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
	$(document).ready(function(){
					$('#data').DataTable({
     								"aoColumnDefs": [ { 'bSortable': false, 'aTargets': [ 2 ] }],
     							 "language": {"url": "//cdn.datatables.net/plug-ins/1.10.10/i18n/Russian.json"},
     							 				"order": [[ 0, "desc" ]],
		});
	});
</script>