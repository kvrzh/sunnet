<section class="content-header">
    <h1>История изминений<small></small></h1>
</section>
<section class="content">
<?
?>
    <?if($this->session->flashdata('danger')):?>
      <div class="alert alert-danger alert-dismissible">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <?=$this->session->flashdata('danger')?>
      </div>
    <?endif;?>
<h4>Изминения заявки</h4>
<div class="box box-success">
    <div class="box-body">
		<table id="data" class="table table-striped table-bordered" cellspacing="0" width="100%">
		    <thead>

		        <tr>   
		        <th >Статус</th>
		        <th >Дата заявки</th>
		        <th >Звонок</th>
		        <?if($type==1):?>
		        	<th>Тариф</th>
		        	<th>Акции</th>
		        	<th>Кабель</th>
		        <?endif;?>
		        <?if($type==2 || $type==3 || $type==4):?>
		        	<th>Поломка</th>
		        <?endif;?>
		        <th >Коментарий</th>
		        <th >Дополнительно</th>
		        <th >Изменено</th>
		        <th >Кем</th>
		        </tr>
		    </thead> <tbody>
		    <?if($history):?>
		        <?foreach($history as $key=>$value):?>
		            <tr>
		            <td><span class="badge" style="background-color:<?=$value->color?>"><?=$value->status?></span></td>
		            <td><?=default_dt($value->date_repair)?></td>
		               <td><?=$value->date_phone?></td>
					<?if($type==1):?>
						<td><?=$value->rate?></td>
						<td><?=$value->action1?>,<?=$value->action2?></td>
						<td><?=$value->cable?></td>
					<?endif;?>
					<?if($type==2 || $type==3 || $type==4):?>
						<td><?=$value->damage?></td>
					<?endif;?>
		            <td><?=$value->comment?></td>
		            <td>
		            	<?if($value->urgency==1):?>
		            	<span class="badge bg-red">Срочная</span>
		            	<?endif;?>
		            	<?if($value->sms==1):?>
		            	<span class="badge bg-yellow">sms</span>
		            	<?endif;?>
		            </td>
		            <td ><?=default_dt($value->date_created)?></td>
		            <td><?=$value->operator?></td>
		        </tr>
		        <?endforeach;?>  
		    <?endif;?>
		            <tr class="bg-olive">
		            <td><span class="badge" style="background-color:<?=$repair->color?>"><?=$repair->status?></span></td>
		            <td><?=default_dt($repair->date_repair)?></td>
		            <td><?=$repair->date_phone?></td>
					<?if($type==1):?>
						<td><?=$repair->rate?></td>
						<td><?=$repair->action1?>,<?=$repair->action2?></td>
						<td><?=$repair->cable?></td>
					<?endif;?>
					<?if($type==2 || $type==3 || $type==4):?>
						<td><?=$repair->damage?></td>
					<?endif;?>
		            <td><?=$repair->comment?></td>
		            <td>
		            	<?if($repair->urgency==1):?>
		            	<span class="badge bg-red">Срочная</span>
		            	<?endif;?>
		            	<?if($repair->sms==1):?>
		            	<span class="badge bg-yellow">sms</span>
		            	<?endif;?>
		            </td>
		            <td ><?=default_dt($repair->date_created)?></td>
		            <td><?=$repair->operator?></td>
		        </tr>
		</tbody></table>
	</div>
</div>
<h4>Изминения профиля клиента</h4>
<div class="box box-success">
    <div class="box-body">
		<table id="data" class="table table-striped table-bordered" cellspacing="0" width="100%">
		    <thead>

		        <tr>   
		        <th >ФИО</th>
		        <th >Микрорайон</th>
		        <th >Улица</th>
		        <th >Адрес</th>
		        <th >Телефон</th>
		        </tr>
		    </thead> <tbody>
		    <?if($history):?>
		        <?foreach($history as $key=>$value):?>
		        	<?if($value->name):?>
		            <tr>
		            <td><?=$value->name?></a></td>
		            <td><?=$value->area?></td>
		            <td><?=$value->street?></td>
		            <td>Дом: <?=$value->address_house?>,Подъезд: <?=$value->address_porch?>, Этаж: <?=$value->address_floor?>, Квартира: <?=$value->address_room?> </td>
		            <td><?=$value->phone1?>, <?=$value->phone2?></td>
		        </tr>
		        	<?endif;?>
		        <?endforeach;?>  

		    <?endif;?>
		        <tr class="bg-olive">
		            <td><?=$repair->name?></a></td>
		            <td><?=$repair->area?></td>
		            <td><?=$repair->street?></td>
		            <td>Дом: <?=$repair->address_house?>,Подъезд: <?=$repair->address_porch?>, Этаж: <?=$repair->address_floor?>, Квартира: <?=$repair->address_room?> </td>
		            <td><?=$repair->phone1?>, <?=$repair->phone2?></td>
		        </tr>

		</tbody></table>
	</div>
</div>
<?
/*echo "<pre>";
print_r($repairs);
echo "</pre>";*/
?>
</section>