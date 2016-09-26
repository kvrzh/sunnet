<section class="content-header">
    <h1>Зарплатные ставки</h1>
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
	            <form action="<?=base_url('budget/wage_save')?>" method="post">
	                <table id="data" class="table table-striped table-bordered" cellspacing="0" width="100%">
	                    <thead>
	                        <tr>   
	                        <th >#</th>
	                        <th >Имя</th>
	                        <th >Почасовая ставка</th>
	                        <th >Доп. коэффициент</th>
	                        <th >Время штрафа</th>
	                        <th >Сумма</th>
	                        </tr>
	                    </thead> <tbody>
	                    <?if($users):?>
	                        <?foreach($users as $key=>$value):?>
	                            <tr>
	                            <td><?=$value->id?></td>
	                        	<td><?=$value->name?></td>
	                            <td><input type="number" step="0.01"  min="0" class="form-control width-150"  name="wage[<?=$value->id?>][0]" value="<?=$value->wage_hour?>"></td>
	                            <td><input type="number" step="0.01"  min="0" class="form-control width-150"  name="wage[<?=$value->id?>][1]" value="<?=$value->wage_koef?>"></td>
	                            <td><div class="input-append time">
	                            <input data-format="hh:mm" type="text"  name="wage[<?=$value->id?>][2]" value="<?=$value->fine_time?>"></input><span class="add-on"><i data-time-icon="ion-android-time" data-date-icon="ion-calendar"></i></span>
	                            </div></td>
	                            <td><input type="number" step="0.01"  min="0" class="form-control width-150"  name="wage[<?=$value->id?>][3]" value="<?=$value->fine?>"></td>
	                            </tr>
	                        <?endforeach;?>  
	                    <?endif;?>

	                </tbody></table>
	                       <button type="submit" class=" col-md-offset-4 col-md-4 btn bg-black ">Сохранить</button>
                     </form>
	            </div><!-- /.box-body -->

	        </div>
			
		</div>
	</div>
</section>
<script type="text/javascript">
  $(function() {
    $('.time').datetimepicker({
      pickDate: false,
      pickSeconds: false,
    });
  });
</script>
