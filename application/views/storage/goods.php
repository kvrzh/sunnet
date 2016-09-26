
<section class="content-header">
    <h1>Список всего инвентаря</h1>
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
                <table id="data" class="table table-striped table-bordered" cellspacing="0" width="100%">
                    <thead>
                        <tr>   
                        <th >#</th>
                        <th >Название</th>
                        <th >Единицы</th>
                        <th >Цена</th>
                        <th >Детально</th>
                        </tr>
                    </thead> <tbody>
                    <?if($goods):?>
                        <?foreach($goods as $key=>$value):?>
                            <tr>
                            <td><?=$value->id?></td>
                            <td><a href="<?=base_url('storage/goods_edit/'.$value->id)?>"><?=$value->title?></a></td>
                            <td><?=$value->unit?></td>
                            <td><?=$value->price?></td>
                            <td><?=$value->description?></td>

                            </tr>
                        <?endforeach;?>  
                    <?endif;?>

                </tbody></table>
            </div><!-- /.box-body -->

        </div>
    </div>
    <div class="col-md-2">
        <a href="<?=base_url('storage/goods_create')?>" class="btn btn-block btn-primary btn-flat">Добавить</a>
        
    </div>
  
</div>

    
</section>

<script type="text/javascript">
  $(document).ready(function(){
     $('#data').DataTable({"language": {"url": "//cdn.datatables.net/plug-ins/1.10.10/i18n/Russian.json"}});
  })
</script>
