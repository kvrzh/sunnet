<section class="content-header">
    <h1>Назначить монтажника на группу<small></small></h1>
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
            <form action="<?=base_url('option/consist_save')?>" method="post">
                <div class="table-responsive">
            <table id="data" class="table table-striped table-bordered" cellspacing="0" width="100%">

                        <thead>
                            <tr>   
                            <th>Монтажник</th>
                            <?if($headers):?>
                                <?foreach($headers as $key=>$value):?>
                                    <th><?=$value?></th>
                                <?endforeach;?>
                            <?endif;?>
    
                            </tr>
                        </thead> <tbody>
                        <?if($users):?>
                            <?foreach($users as $user_key=>$user):?>
                                <tr>
                                    <?foreach($user as $consist_key=>$consist):?>
                                        <?if($consist_key=='user'):?>
                                        <td><?=$consist?></td>
                                        <?else:?>
                                        <td class="<?=$consist==1?"bg-red":""?>"><input type="checkbox" name="consist[<?=$user_key?>][<?=$consist_key?>]"  <?=$consist==1?"checked":""?>></td>
                                        <?endif;?>
                                    <?endforeach;?>

                                </tr>
                            <?endforeach;?>  
                        <?endif;?>

                    </tbody></table></div>
                     <button type="submit" class="btn bg-black btn-block">Сохранить</button>
                     </form>
            </div>
        </div>
    </div>
</div>

	

		
</section>
