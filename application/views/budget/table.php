<div class="row" style="margin-bottom:5px">
    <div class="col-md-2 badge bg-green">Доход: <?=$sum_in?></div>
    <div class="col-md-2 badge bg-red">Расход: <?=$sum_out?></div>
    <div class="col-md-2 badge bg-blue">Сальдо: <?=round($sum_in-$sum_out,2)?></div>
</div>
<table id="data" class="table table-striped table-bordered" cellspacing="0" width="100%">
    <thead>
        <tr>   
        <th >Дата</th>
        <th >Получатель</th>
        <th >Тип</th>
        <th >Доход</th>
        <th >Расход</th>
        <th >Коментарий</th>
        <th >Источник</th>
        <th ><i class="ion-edit"></i></th>
        </tr>
    </thead> <tbody>
    <?if($budget):?>
        <?foreach($budget as $key=>$value):?>
            <tr>
            <td><?=default_dt($value->date)?></td>
            <td><?=$value->in?></a></td>
            <td><?=$value->type?></td>
            <td><?=$value->sum_in?></td>
            <td><?=$value->sum_out?></td>
            <td><?=$value->comment?></td>
            <td><?=$value->out?></td>
            <td><span class="<?=$value->chng==1?' badge bg-red':''?>" ><a href="<?=base_url('budget/change/'.$value->id)?>"><i class="ion-edit"></i></a></span></td>
           

            </tr>
        <?endforeach;?>  
    <?endif;?>

</tbody></table>
<?
?>