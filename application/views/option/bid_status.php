<section class="content-header">
    <h1>Статусы заявок</h1>
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
		<div class="col-md-6">
		<h4>Статусы основных заявок</h4>
    		<a href="<?=base_url('option/bid_status_create')?>" class="btn btn-block btn-primary btn-flat">Добавить</a>
	        <div class="box box-success">
	            <div class="box-body">
	                <table id="data" class="table table-striped table-bordered" cellspacing="0" width="100%">
	                    <thead>
	                        <tr>   
	                        <th >#</th>
	                        <th >Статус</th>
	                        <th >Цвет</th>
	                        </tr>
	                    </thead> <tbody>
	                    <?if($bid_status):?>
	                        <?foreach($bid_status as $key=>$value):?>
	                            <tr>
	                            <td><?=$value->id?></td>
	                            <td><a href="<?=base_url('option/bid_status_edit/'.$value->id)?>"><?=$value->title?></a></td>
	                            <td style="background-color:<?=$value->color?>"><?=$value->color?></td>
	                            </tr>
	                        <?endforeach;?>  
	                    <?endif;?>
	                </tbody></table>
	            </div><!-- /.box-body -->
	        </div>
		</div>
	    <div class="col-md-6">
    		<h4>Статусы админ задач</h4>
    		<a href="<?=base_url('option/admin_status_create')?>" class="btn btn-block btn-primary btn-flat">Добавить</a>
	        <div class="box box-success">
	            <div class="box-body">
	                <table id="data" class="table table-striped table-bordered" cellspacing="0" width="100%">
	                    <thead>
	                        <tr>   
	                        <th >#</th>
	                        <th >Статус</th>
	                     	<th>Цвет</th>
	                        </tr>
	                    </thead> <tbody>
	                    <?if($admin_status):?>
	                        <?foreach($admin_status as $key=>$value):?>
	                            <tr>
	                            <td><?=$value->id?></td>
	                            <td><a href="<?=base_url('option/admin_status_change/'.$value->id)?>"><?=$value->title?></a></td>
                                <td style="background-color:<?=$value->color?>"><?=$value->color?></td>
	                            </tr>
	                        <?endforeach;?>  
	                    <?endif;?>

	                </tbody></table>
	            </div><!-- /.box-body -->
	    </div>
		<h4>Типы админ задач</h4>
    		<a href="<?=base_url('option/admin_type_create')?>" class="btn btn-block btn-danger btn-flat">Добавить</a>
	        <div class="box box-success">
	            <div class="box-body">
	                <table id="data" class="table table-striped table-bordered" cellspacing="0" width="100%">
	                    <thead>
	                        <tr>   
	                        <th >#</th>
	                        <th >Статус</th>
	                        </tr>
	                    </thead> <tbody>
	                    <?if($admin_type):?>
	                        <?foreach($admin_type as $key=>$value):?>
	                            <tr>
	                            <td><?=$value->id?></td>
	                            <td><a href="<?=base_url('option/admin_type_change/'.$value->id)?>"><?=$value->title?></a></td>
	                            </tr>
	                        <?endforeach;?>  
	                    <?endif;?>

	                </tbody></table>
	            </div><!-- /.box-body -->


	        
	    </div>
	</div>
</section>
