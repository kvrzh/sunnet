<section class="content-header">
    <h1>Сейчас на работе</h1>
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
	                        <th >Имя</th>
	                        <th >Дата</th>  
	                        <th >Начальный  коэффициентт</th>  
	                        </tr>
	                    </thead> <tbody>
	                    <?if($work):?>
	                        <?foreach($work as $key=>$value):?>
	                            <tr>
	                             <td><?=$value->name?></td>
	                             <td><?=default_dt($value->start)?></td>
	                            <td><?=$value->koef_start?></td>

	                           
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
	$('#data').DataTable({"language": {"url": "//cdn.datatables.net/plug-ins/1.10.10/i18n/Russian.json"}
	});
</script>
