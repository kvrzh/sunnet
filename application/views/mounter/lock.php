<section class="content-header">
    <h1>Электронный замок</h1>
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
            <?if($lock):?>
                <?foreach($lock as $key=>$value):?>
                    <div class="col-md-6" style="margin-top:10px">
                        <a class="btn btn-block bg-light-blue" href="<?=base_url('mounter/lock_open/'.$key)?>"><?=$value?></a>
                    </div>
                <?endforeach;?>
            <?else:?>
            <h3>У вас нет доступа к замкам</h3>
            <?endif;?>
        	</div>
   		 </div>
	 </div>
 </div>
 
</section>



