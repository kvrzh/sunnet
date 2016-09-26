<section class="content-header">
    <h1>Принять тз</h1>
</section>
<section class="content">
<div class="row">

   <?if($work3):?>
<div class="col-md-12">
<h4>На вас назначена задача с конечным скором выполнения</h4>
        <div class="table-responsive">
                    <table id="data" class="table table-striped table-bordered" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                            <th >Дата</th>
                            <th>#</th>
                            <th>Улица</th>
                            <th >Комментарий</th>
                            <th >Статус</th>
                            <th ><i class="ion-edit"></i></th>   
                            </tr>
                        </thead> <tbody>
                            <?foreach($work3 as $key=>$value):?>
                                <tr>
                                <td  width="10%">
                                <div class="td-top"><?=short_dt($value->start)?></div>
                                <div class="td-mbot"><?=short_dt($value->start+$value->fine_time)?></div>
                                </td>
                                     <td  width="1%" class="td-bold <?=$value->urgency==1?'text-red':''?>"><?=$value->id?></td>
                                    <td width="20%"><div class="td-top"><span class="label label-success"> <?=$value->short?></span><span class="td-mbold"><?=$value->street?></span></div>
                                    <div class="td-bot">Дом: <span class="td-bold"><?=$value->address_house?></span> Подъезд: <span class="td-bold"><?=$value->address_porch?></div></td>
                                    <td width="55%">
                                    <span class="td-comment"><div class="td-top">Заявки: <span><?=mb_substr($value->comment,0,250)?></span></span></div>
                                    <div class="td-bot"><span class="td-comment">Мастера: <span><?=mb_substr($value->comment_master,0,250)?></span></span></div></td>
                                    <td width="8%"><div class="td-top"><span class="badge" style="background-color:<?=$value->color?>"><?=$value->status?></span>            <?if($value->status_id==7):?>
                <i class="ion-clock"></i> <?=$value->status_time==60?'40+':$value->status_time?> мин.

            <?endif;?></div>
            <div class="td-bot"><span class="label bg-red">штраф: <?=$value->fine_sum?> Грн</span></div></td>
                                     <td width="1%"><a href="<?=base_url('mounter/task/'.$value->id)?>"><i class="ion-edit"></i></a></td>
                            </tr>
                            <?endforeach;?>  
                    </tbody></table></div>
</div>
<?endif;?>
	<div class="col-md-2 col-sm-4 col-xs-4">
		<a href="<?=base_url('mounter/day/-1')?>" class="btn btn-block bg-yellow ">На вчера</a>
	</div>
	<div class="col-md-2 col-sm-4 col-xs-4">
		<a href="<?=base_url('mounter/day/')?>" class="btn btn-block bg-green ">На сегодня</a>
	</div>
	<div class="col-md-2 col-sm-4 col-xs-4">
		<a href="<?=base_url('mounter/day/1')?>" class="btn btn-block bg-red ">На завтра</a>
	</div>
	<div class="col-md-2 col-sm-4 col-xs-4">
		<a target="blank" href="<?=base_url('mounter/day_print/'.$act_day)?>" class="btn btn-block bg-black "><i class="ion-printer"></i> Печать</a>
	</div>
</div>

<div class="row">
<div class="col-md-12">
        <?if($this->session->flashdata('success')):?>
          <div class="alert alert-success alert-dismissible" style="margin-top:10px">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <?=$this->session->flashdata('success')?>
          </div>
        <?endif;?>
            <?if($this->session->flashdata('danger')):?>
      <div class="alert alert-danger alert-dismissible" style="margin-top:10px">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <?=$this->session->flashdata('danger')?>
      </div>
    <?endif;?>
	<?$act=1?>
	<?if($work):?>
	
		<div class="nav-tabs-custom">
			<ul class="nav nav-tabs">
			<?foreach($work as $key=>$value):?>
				<?if($value['work']):?>
				<li class="<?=$act==1?'active':''?>"><a href="#tab_<?=$key?>" data-toggle="tab" aria-expanded="false"><?=$value['group']?> <small class="label pull-right <?=$value['done']==1?'bg-green':'bg-red'?>"><?=count($value['work'])?></small></a></li>
				<?$act=0;?>
				<?endif;?>
			<?endforeach;?>
				<?if($work4):?>
				<li class="<?=$act==1?'active':''?>"><a href="#tab_10" data-toggle="tab" aria-expanded="false">Строительство <small class="label pull-right bg-red"><?=count($work4)?></small></a></li>
				<?endif;?>
			</ul>

				<div class="tab-content tab2">
				<?$act=1?>
				<?foreach($work as $key=>$value_w):?>
					<?if($value_w['work']):?>
				<div class="tab-pane <?=$act==1?'active':''?>" id="tab_<?=$key?>">
				<h4>Дата <?=dot_day($value_w['work'][0]->start)?></h4>
				<div class="table-responsive">
					<table id="data" class="table table-striped table-bordered" cellspacing="0" width="100%">
					    <thead>
					        <tr>
					        <th >Время</th>
					        <th>#</th>
					        <th>Улица</th>
					        <th>Дом</th>
			                <?if($value_w['type']!=3):?>
					        <th>Кв</th>
					        <th>Телефон</th>
					         <?endif;?>
					        <th >Комментарий</th>
					        <th >Статус</th>
			             	<th ><i class="ion-edit"></i></th>   

					        
					        </tr>
					    </thead> <tbody>
					    <?if($value_w['work']):?>
					        <?foreach($value_w['work'] as $key=>$value):?>
					            <tr>
					            <td  width="10%"><?=default_time($value->start)?>- <?=default_time($value->end)?></td>
					              	 <td  width="1%" class="td-bold <?=$value->urgency==1?'text-red':''?>"><?=$value->id?></td>
					              	<td width="20%"><div class="td-top"><span class="label label-success"> <?=$value->short?></span><span class="td-mbold"><?=$value->street?></span></div>
						            <div class="td-bot"><?=$value->name?></div></td>
						            <td width="7%"><div class="td-top"><span class="td-mbold"><?=$value->address_house?></span></div><div class="td-bot">Подъезд: <span class="td-bold"><?=$value->address_porch?></span></div></td>
					               <?if($value_w['type']!=3):?>
						            <td width="5%"><div class="td-top"><span class="td-mbold"><?=$value->address_room?></span></div><div class="td-bot"></span>Этаж: <span class="td-bold"><?=$value->address_floor?></span></div></td> 
						            <td width="8%" class="td-comment"><div class="td-top"><span><?=phone_ch($value->phone1)?></div><div class="td-mbot"><?=phone_ch($value->phone2)?></span></div></td>
						             <?endif;?>
						            <td width="45%">
						            <span class="td-comment"><div class="td-top">Заявки: <span><?=mb_substr($value->comment,0,250)?></span></span></div>
						            <div class="td-bot"><span class="td-comment">Мастера: <span><?=mb_substr($value->comment_master,0,250)?></span></span></div></td>
						            <td width="8%"><span class="badge" style="background-color:<?=$value->color?>"><?=$value->status?></span>            <?if($value->status_id==7):?>
                <i class="ion-clock"></i> <?=$value->status_time==60?'40+':$value->status_time?> мин.
            <?endif;?></td>
						             <td width="1%"><a href="<?=base_url('mounter/task/'.$value->id)?>"><i class="ion-edit"></i></a></td>
					        </tr>
					        <?endforeach;?>  
					    <?endif;?>

					</tbody></table></div>
				
				</div>
					<?$act=0;?>
				<?endif;?>
				
				<?endforeach;?>
				<?if($work4):?>
				<div class="tab-pane <?=$act==1?'active':''?>" id="tab_10">
				<div class="table-responsive">
                    <table id="data" class="table table-striped table-bordered" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                            <th >Дата</th>
                            <th>#</th>
                            <th>Улица</th>
                            <th >Комментарий</th>
                            <th >Статус</th>
                            <th ><i class="ion-edit"></i></th>   
                            </tr>
                        </thead> <tbody>
                            <?foreach($work4 as $key=>$value):?>
                                <tr>
                                <td  width="10%">
                                <div class="td-top"><?=short_dt($value->start)?></div>
                                <div class="td-mbot"></div>
                                </td>
                                     <td  width="1%" class="td-bold <?=$value->urgency==1?'text-red':''?>"><?=$value->id?></td>
                                    <td width="20%"><div class="td-top"><span class="label label-success"> <?=$value->short?></span><span class="td-mbold"><?=$value->street?></span></div>
                                    <div class="td-bot">Дом: <span class="td-bold"><?=$value->address_house?></span> Подъезд: <span class="td-bold"><?=$value->address_porch?></div></td>
                                    <td width="55%">
                                    <span class="td-comment"><div class="td-top">Заявки: <span><?=mb_substr($value->comment,0,250)?></span></span></div>
                                    <div class="td-bot"><span class="td-comment">Мастера: <span><?=mb_substr($value->comment_master,0,250)?></span></span></div></td>
                                    <td width="8%"><div class="td-top"><span class="badge" style="background-color:<?=$value->color?>"><?=$value->status?></span>            <?if($value->status_id==7):?>
                <i class="ion-clock"></i> <?=$value->status_time==60?'40+':$value->status_time?> мин.

            <?endif;?></div>
            <div class="td-bot"><span class="label bg-red">штраф: <?=$value->fine_sum?> Грн</span></div></td>
                                     <td width="1%"><a href="<?=base_url('mounter/task/'.$value->id)?>"><i class="ion-edit"></i></a></td>
                            </tr>
                            <?endforeach;?>  
                    </tbody></table></div>
				
				</div>
				<?endif;?>
			</div>
		</div>
	<?endif;?>
</div>
</span>
	<div class="col-md-4 col-sm-12 col-xs-12">
		<a href="<?=base_url('mounter/in_work')?>" class="btn btn-block bg-aqua ">Принят ВСЕ</a>
	</div>


    
</section>
<script type="text/javascript">

</script>

