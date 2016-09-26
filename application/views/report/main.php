<section class="content-header">
    <h1>Отчет</h1>
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

</div>
</div>

    
</section>


