<section class="content-header">
    <h1><?=lang('my_event')?><small></small></h1>
</section>
<section class="content">
<div class="row">
	<div class="col-md-9">
    <?if($this->session->flashdata('success')):?>
      <div class="alert alert-success alert-dismissible">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <?=$this->session->flashdata('success')?>
      </div>
    <?endif;?>
		<div class="box box-success">
                <div class="box-body">
                 <table id="data" class="table table-striped table-bordered" cellspacing="0" width="100%">
                  <thead>
                    <tr>   
                        <th ><?=lang('event_name')?></th>
                        <th ><?=lang('user_name')?></th>
                        <th ><?=lang('date')?></th>
                        <th ><?=lang('type')?></th>
                        <th ><?=lang('city')?></th>  
                      <th ><?=lang('status')?></th> 
                    </tr>
                    </thead>
                    <tbody>
                    <?if($events):?>
                        <?foreach($events as $key=>$value):?>
                        <tr>
                            <td><a href="<?=base_url('event/show/'.$value->id)?>"><?=$value->title?></td>
                            <td><?=dt($value->date_registrated)?></td>
                            <td><?=dt($value->date_start)?></td>
                            <td><?=$value->type?></td>
                            <td><?=$value->city?></td>
                            <td><?=$value->status_text?></td>
                        </tr>
                        <?endforeach;?>  
                   <?endif;?>
               
                     
                  </tbody></table>
                </div><!-- /.box-body -->

                <div class="box-footer clearfix">

                </div>
              </div>
	</div>
	
</div>

		
</section>
