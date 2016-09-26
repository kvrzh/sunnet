<section class="content-header">
    <h1>Список всех пользователей/помещений</h1>
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
                    <th >Должность</th>
                    <th >Телефон</th>
                    <th >Статус</th>
                    <th ><i class="ion-key"></i></th>
                    </tr>
                </thead> <tbody>
                <?if($users):?>
                    <?foreach($users as $key=>$value):?>
                        <tr>
                        <td><?=$value->id?></td>
                        <td><a  href="<?=base_url('user/edit/'.$value->id)?>"><?=$value->name?></a></td>
                        <td><?=$value->role_title?></td>
                        <td><?=$value->phone?></td>
                        <?if($value->active==1):?>
                        <td><span class="badge bg-green">Активний</span></td>
                        <?else:?>
                        <td><span class="badge bg-red">Неактиный</span></td>
                        <?endif;?>
                        <td><a href="<?=base_url('option/permission/'.$value->id)?>"><i style="font-size:20px"class="ion-key"></i></a></td>
        
                        </tr>
                    <?endforeach;?>  
                <?endif;?>

            </tbody></table>
        </div><!-- /.box-body -->

    </div>
		
	</div>
	    <div class="col-md-2">
        <a href="<?=base_url('user/create')?>" class="btn btn-block btn-primary btn-flat">Добавить</a>
        <?if($active==1):?>
        <a href="<?=base_url('user/show/2')?>" class="btn btn-block btn-danger btn-flat">Неактивные <i class="ion-person-stalker"></i></a>
        <?endif;?>
        <?if($active==0):?>
        <a href="<?=base_url('user/show')?>" class="btn btn-block btn-success btn-flat">Активные <i class="ion-person-stalker"></i></a>
        <?endif;?>
        
    </div>
	
</div>
</section>
<script type="text/javascript">
	$(document).ready(function(){
		  $('#data').DataTable();
	});
</script>