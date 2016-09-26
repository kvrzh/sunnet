
    <div class="box box-success">
        <div class="box-body">
            <table id="data" class="table table-striped table-bordered" cellspacing="0" width="100%">
                <thead>
                    <tr> 
                    <th >День</th>  
                    <th >Сумма</th>
                    <th >Коментарий</th>
                    <th >Тип</th> 
                    </tr>
                </thead> <tbody>
                <?if($fine):?>
                    <?foreach($fine as $key=>$value):?>
                        <tr>
                         <td><?=dt_one($value->date)?></td>
   
                        <td><?=$value->sum?></td>
                        <td><?=$value->comment?></td>
                        <?if($value->type==1):?>
                        	<td><span class=" badge bg-green">Премия</span></td>
                        <?else:?>
                        	<td><span class="badge bg-red">Штраф</span></td>
                        <?endif;?>
                        </tr>
                    <?endforeach;?>  
                <?endif;?>
                <?if($salary):?>
                <?foreach($salary as $key=>$value):?>
                        	<tr>
                         <td><?=dt_one($value->date)?></td>
                        <td><?=$value->sum_out?></td>
                        <td><?=$value->comment?></td>
                    	<td><span class=" badge bg-blue">ЗП</span></td>
      
                        </tr>
                <?endforeach;?>
                <?endif;?>

            </tbody></table>
        </div><!-- /.box-body -->

    </div>