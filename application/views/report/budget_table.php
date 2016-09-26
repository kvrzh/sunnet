
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
            </tr>
        <?endforeach;?>  
    <?endif;?>

</tbody></table>
<?
?>