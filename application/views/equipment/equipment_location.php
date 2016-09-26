<section class="content-header">
    <h1>Места оборудования</h1>
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
	                        <th >#</th>
	                        <th >Место</th>
	                        </tr>
	                    </thead> <tbody>
	                    <?if($equipment_location):?>
	                        <?foreach($equipment_location as $key=>$value):?>
	                            <tr>
	                            <td width="2%"><?=$value->id?></td>
	                            <td width="70%"><a href="<?=base_url('equipment/equipment_location_edit/'.$value->id)?>"><?=$value->title?></a></td>
	                            </tr>
	                        <?endforeach;?>  
	                    <?endif;?>

	                </tbody></table>
	            </div><!-- /.box-body -->

	        </div>
			
		</div>
	    <div class="col-md-2">
	        <a href="<?=base_url('equipment/equipment_location_create')?>" class="btn btn-block btn-primary btn-flat">Добавить</a>
	    </div>
	</div>
</section>
<script type="text/javascript">
	$(document).ready(function(){
					$('#data').DataTable({
     							// "aoColumnDefs": [ { 'bSortable': false, 'aTargets': [ 4 ] }],
     							 "language": {"url": "//cdn.datatables.net/plug-ins/1.10.10/i18n/Russian.json"},
     							 				"order": [[ 0, "asc" ]],
		});
	});
</script>