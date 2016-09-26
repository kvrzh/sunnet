<section class="content-header">
    <h1>Телефонная книга</h1>
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
	                        <th >Имя</th>
	                        <th >Телефон1</th>
	                        <th >Телефон2</th>
	                        <th >Отдел</th>
	                        <th >Коментарий</th>
	                        </tr>
	                    </thead> <tbody>
	                    <?if($phonebook):?>
	                        <?foreach($phonebook as $key=>$value):?>
	                            <tr>
	                            <td><?=$value->id?></td>
	                            <?if($this->session->userdata('user_role')==1 || $this->session->userdata('user_role')==2):?>
	                            <td><a href="<?=base_url('social/phonebook_edit/'.$value->id)?>"><?=$value->title?></a></td>
	                            <?else:?>
	                            <td><?=$value->title?></td>
	                            <?endif;?>
	                            <td><?=$value->phone1?></td>
	                            <td><?=$value->phone2?></td>
	                            <td><?=$value->department?></td>
	                            <td><?=$value->comment?></td>

	                            </tr>
	                        <?endforeach;?>  
	                    <?endif;?>

	                </tbody></table>
	            </div><!-- /.box-body -->

	        </div>
			
		</div>
	    <div class="col-md-2">
	        <a href="<?=base_url('social/phonebook_create')?>" class="btn btn-block btn-primary btn-flat">Добавить</a>
	    </div>
	</div>
</section>
<script type="text/javascript">
	$('#data').DataTable({"language": {"url": "//cdn.datatables.net/plug-ins/1.10.10/i18n/Russian.json"}});
</script>
