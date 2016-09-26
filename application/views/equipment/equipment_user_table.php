
<table id="data" class="table table-striped table-bordered" cellspacing="0" width="100%">
    <thead>
        <tr>  
        <th >Имя</th> 
        <th >Вендор/Модель</th>
        <th>Т</th>
        <th >Позциция</th>
        <th >Кол</th>
        <th >Начислено</th>
        </tr>
    </thead> <tbody>
    <?if($equipment):?>
        <?foreach($equipment as $key=>$value):?>
            <tr>
            <td width="17%"><?=$value->user_name?></td>
            <td width="">
            <?if($value->photo_thumb):?>
	            	<a class="img" src="<?=base_url($value->photo_thumb)?>" data-toggle="lightbox"  href="<?=base_url($value->photo)?>"><i class="ion-image"></i></a>
	            <?endif;?> 
            <?=$value->type?> <?=$value->vendor?> <?=$value->model?></a></td>
            <td width="2%"><?=$value->use_n?></td>
            <td width=""><a href="<?=base_url('equipment/equipment_remove/'.$value->id)?>"><i class="ion-log-out"></i></a> <?=$value->serial?></td>
             <td width="2%"><?=$value->total_count?></td>
            <td width="18%"><?=default_dt($value->up_date)?> <?=$value->up_name?></td>

            </tr>
        <?endforeach;?>  
    <?endif;?>

</tbody></table>
