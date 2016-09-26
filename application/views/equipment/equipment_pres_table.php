<table id="data" class="table table-striped table-bordered" cellspacing="0" width="100%">
    <thead>
        <tr>   
        <th >#</th>
        <th ><i class="ion-image"></i></th>
        <th >Тип</th>
        <th >Вендор/Модель</th>
        <th >Т</th>
        <th >Мин.</th>
        <th >Нал.</th>
        <th >Описание</th>
        <th><i class="ion-log-out"></i></th>
        </tr>
    </thead> <tbody>
    <?if($equipment):?>
        <?foreach($equipment as $key=>$value):?>
            <tr>
            <td width="3%"><?=$key?></td>
            <td width="4%">
            <?if($value['photo_thumb']):?>
            	<img class="img img-responsive img_stable" src="<?=base_url($value['photo_thumb'])?>" data-toggle="lightbox"  href="<?=base_url($value['photo'])?>">
            <?endif;?>
            	</td>
            <td ><?=$value['type']?></td>
            <td ><?=$value['vendor']?> <?=$value['model']?></td>
            <td width="2%"><?=$value['use_n'];?></td>
            <td width="5%"><?=$value['min'];?></td>
            <td width="5%"   data-toggle="modal" data-target="#modal_<?=$key?>" >
            <?if($value['min']>$value['count']):?>
            	<span class="text-red"><?=$value['count'];?></span>
            <?else:?>
             	<?=$value['count'];?>
            <?endif;?>
            </td>
            <td width="50%"><?=$value['description']?></td>
            <?if($head->move==1):?>
            	<td><a href="<?=base_url('equipment/equipment_one/'.$key)?>"><i class="ion-log-out"></i></a></td>
            <?else:?>
            	<td><i class="ion-log-out"></i></td>
          	<?endif;?>
            </tr>
                <div class="modal fade" id="modal_<?=$key;?>" tabindex="-1" role="dialog" aria-labelledby="label_<?=$key;?>">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="modal_<?=$key;?>">Серийные номера</h4>
                  </div>
                  <div class="modal-body">
                  <?=$value['serial']?>
                  </div>
                </div>
              </div>
            </div>
        <?endforeach;?>  
    <?endif;?>

</tbody></table>
