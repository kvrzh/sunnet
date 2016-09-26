<section class="content-header">
    <h1>Улицы</h1>
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
	                        <th >Улица</th>
	                        <th >Район</th>
	                        <th >Ул.</th>
	                        <th ><i class="ion-home"></i></th>
	                        </tr>
	                    </thead> <tbody>
	                    <?if($streets):?>
	                        <?foreach($streets as $key=>$value):?>
	                            <tr>
	                            <td width="2%"><?=$value->id?></td>
	                            <td><a href="<?=base_url('option/street_edit/'.$value->id)?>"><?=$value->title?></a></td>
	                            <td><?=$value->area?></td>
	                            <td width="10%"><?=$value->short?></td>
	                            <td width="6%"><a href="<?=base_url('option/house/'.$value->id)?>"><i style="font-size:22px"class="ion-home"></i></a></td>

	                            </tr>
	                        <?endforeach;?>  
	                    <?endif;?>

	                </tbody></table>
	            </div><!-- /.box-body -->

	        </div>
			
		</div>
	    <div class="col-md-2">
	        <a href="<?=base_url('option/street_create')?>" class="btn btn-block btn-primary btn-flat">Добавить</a>
	    </div>
	    	    <div class="col-md-2" style="margin-top:10px">
	        <a href="<?=base_url('option/vision')?>" class="btn btn-block btn-danger btn-flat">Проникновения</a>
	    </div>
	</div>
</section>
<script type="text/javascript">
	$(document).ready(function(){
					$('#data').DataTable({

     							 "aoColumnDefs": [ { 'bSortable': false, 'aTargets': [ 4 ] }],
     							 "language": {"url": "//cdn.datatables.net/plug-ins/1.10.10/i18n/Russian.json"},
     							 				"order": [[ 1, "asc" ]],
		});
	});
</script>