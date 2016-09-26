<section class="content-header">
    <h1>Файлы</h1>
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
	                        <th >Файл</th>
	                        <th >Отправитель</th>
	                        <th >Тема</th>
	                        <th >Дата</th>
	
	                        </tr>
	                    </thead> <tbody>
	                    <?if($files):?>
	                        <?foreach($files as $key=>$value):?>
	                            <tr>
	                            <td><a href="<?=base_url('uploads/files/'.$value->file)?>"><?=$value->file?></a></td>
	                            <td><?=$value->sender?></td>
	                            <td><?=$value->subject?></td>
	                            <td><?=default_dt($value->date)?>
	                            <?if($this->session->userdata('user_role')==1):?>
	                            	<a href="<?=base_url('social/delete_file/'.$value->id)?>"><i class="ion-trash-a"></i></a>
	                            <?endif;?>
	                            </td>


	                            </tr>
	                        <?endforeach;?>  
	                    <?endif;?>
	                </tbody></table>
	            </div><!-- /.box-body -->

	        </div>
			
		</div>
	</div>
</section>
