<table id="data" class="table table-striped table-bordered" cellspacing="0" width="100%">
    <thead>
        <tr>   
        <th >#</th>
        <th ><i class="ion-image"></i></th>
        <th >Тип</th>
        <th >Вендор/Модель</th>
        <th >Т</th>
        <th >Мин.</th>
        <th >Закупка</th>
        <th >Продажа</th>
        <th >Описание товара</th>
        </tr>
    </thead> <tbody>
    <?if($equipment_model):?>
        <?foreach($equipment_model as $key=>$value):?>
            <tr>
            <td width="1%"><?=$value->id?></td>
            <td width="5%">
            <?if($value->photo_thumb):?>
            	<img class="img img-responsive img_stable" src="<?=base_url($value->photo_thumb)?>" data-toggle="lightbox"  href="<?=base_url($value->photo)?>">
            <?endif;?>
            	</td>
            <td width="7%"><?=$value->type?></td>
            <td width="18%"><a href="<?=base_url('equipment/equipment_model_edit/'.$value->id)?>"><?=$value->vendor?> <?=$value->title?></a></td>
            <td width="2%"><?=$value->use_n?></td>
            <td width="3%"><?=$value->min?></td>
            <td width="3%"><?=$value->price_in?></td>
            <td width="3%"><?=$value->price_out?></td>
            <td width="60%"><?=$value->description?></td>

            </tr>
        <?endforeach;?>  
    <?endif;?>

</tbody></table>