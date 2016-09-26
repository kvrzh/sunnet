<section class="content-header">
    <h1>Редактировать дом на улице <?=$street->title?><small></small></h1>
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
             <form role="form" method="post" class="form-horizontal" action="<?php echo base_url('option/house_edit_action');?>">
             		<input type="hidden" name="house[id]" value="<?=$house->id?>">
                    <input type="hidden" name="street_id" value="<?=$street->id?>">
                    <input type="hidden" name="house[date]" value="<?=date('U')?>">
             		<input type="hidden" name="house[user_id]" value="<?=$this->session->userdata('user_id')?>">
	        		<div class="form-group">
			  			<label  class="control-label col-md-2">Дом</label>
					  	<div class="col-md-4">
					  		<input type="text" value="<?=$house->title?>" name="house[title]" class="form-control" >
					  	</div>	
				  	</div>
                    <div class="form-group">
                        <label  class="control-label col-md-2">Квартир</label>
                        <div class="col-md-4">
                            <input type="number" value="<?=$house->house_count?>" name="house[house_count]" class="form-control" >
                        </div>  
                    </div>
                    <div class="form-group">
                        <label  class="control-label col-md-2">Заметка</label>
                        <div class="col-md-10">
                            <input type="hidden" value="<?=$house->note?>"  name="def_note" class="form-control" >
                            <textarea  name="house[note]" class="form-control" ><?=$house->note?></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label  class="control-label col-md-2">Проблемная заметка</label>
                        <div class="col-md-10">
                            <textarea  name="house[note_problem]" class="form-control" ><?=$house->note_problem?></textarea>
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
        <div class="box box-success">
            <div class="box-body">

                <div class="row">
                    <div class="col-md-6">
                        <h4>Свободные</h4>
                        <?foreach ($house_cable as $key => $value):?>
                            <?if($value->free==1):?>
                                <a href="<?=base_url('option/house_cable_edit/'.$value->id)?>"><b><?=$value->number?></b>
                                (п:<?=$value->porch?>, эт:<?=$value->floor?>); </a>
                            <?endif?>
                        <?endforeach;?>
                    </div>
                        <div class="col-md-6">
                        <h4>Занятые</h4>
                        <?foreach ($house_cable as $key => $value):?>
                            <?if($value->free==0):?>
                                <a href="<?=base_url('option/house_cable_edit/'.$value->id)?>"><b><?=$value->number?></b>
                                (п:<?=$value->porch?>, эт:<?=$value->floor?>); </a>
                            <?endif?>
                        <?endforeach;?>

                        
                    </div>
                    
                </div>

            </div>
        </div>
        </div>
    <div class="col-md-2">
        <a href="<?=base_url('option/house_delete_action/'.$house->id)?>" class="btn btn-block btn-danger btn-flat">Удалить</a> 

        <a href="<?=base_url('option/house_cable_create/'.$house->id)?>" class="btn btn-block btn-primary btn-flat">Добавить  кабель</a> 

        <div class="callout  callout-info" style="margin-top:5px">
            <h5>Изменено</h5>
            <p><i class="ion-person"> </i><?=$user->name?></p>
            <p><i class="ion-calendar"> </i><?=default_dt($house->date)?></p>
        </div>
    </div>
    <div class="col-md-12">
        <?if($house_note):?>
        <div class="box box-success">
            <div class="box-header with-borer"><h3 class="box-title">История изминений(заметки)</h3></div>
            <div class="box-body">
                    <table id="data" class="table table-striped table-bordered" cellspacing="0" width="100%">
                        <thead>
                            <tr>   
                            <th >Пользовanель</th>
                            <th >Дата</th>
                            <th >Заметка</th>
                            </tr>
                        </thead> <tbody>
                            <?foreach($house_note as $key=>$value):?>
                                <tr>
                                <td width="10%"><?=$value->name?></td>
                                <td width="8%"><?=default_dt($value->date)?></td>
                                <td width="82%"><?=$value->note?></td>
                               
                                </tr>
                            <?endforeach;?>  

                    </tbody></table>

            </div>
        </div>
    <?endif;?>
    </div>

	</div>
	

		
</section>
<script type="text/javascript">
    $(document).ready(function(){
                    $('#data').DataTable({
                             "language": {"url": "//cdn.datatables.net/plug-ins/1.10.10/i18n/Russian.json"},
                            "order": [[ 1, "asc" ]],
        });
    });
</script>