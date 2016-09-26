    <table id="data" class="table table-striped table-bordered" cellspacing="0" width="100%">
        <thead>
            <tr> 
            <th >Кто</th>  
            <th >Дата</th>  
          
            <th >Коментарий</th>
            </tr>
        </thead> <tbody>
        <?if($work):?>
            <?foreach($work as $key=>$value):?>
                <tr>
             	<td><?=$value->name?></td>
             	<td><?=dt_day($value->start)?> <?=default_time($value->start)?> - <?=default_time($value->end)?></td>
             	<td><?=$value->comment?></td>
                </tr>
            <?endforeach;?>  
        <?endif;?>

    </tbody></table>