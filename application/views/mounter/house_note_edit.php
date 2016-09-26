<section class="content-header">
    <h1>Редактировать заметку дома <?=$house->title?> на улице <?=$street->title?><small></small></h1>
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
             <form role="form" method="post" class="form-horizontal" action="<?php echo base_url('mounter/house_note_edit_action');?>">
             		<input type="hidden" name="house[id]" value="<?=$house->id?>">
                    <input type="hidden" name="street_id" value="<?=$street->id?>">
                    <input type="hidden" name="house[date]" value="<?=date('U')?>">
             		<input type="hidden" name="house[user_id]" value="<?=$this->session->userdata('user_id')?>">
                    <div class="form-group">
                        <label  class="control-label col-md-2">Заметка</label>
                        <div class="col-md-10">
                            <input type="hidden" value="<?=$house->note?>"  name="def_note" class="form-control" >
                            <textarea  name="house[note]" class="form-control" ><?=$house->note?></textarea>
                        </div>
                    </div>
					
	                <div class="form-group">
                        <div class="col-md-offset-4 col-md-4"  style="margin-top: 0px;">
                            <button type="submit" class="btn bg-black btn-block">Сохранить</button>
                        </div>
                	</div>

		    </form>
            </div>
        </div>
        </div>
</section>