<ul class="sidebar-menu">
    <li><a href="<?=base_url('mounter/start/')?>"><i class="fa fa-circle-o text-red"></i> <span>Рабочий день</span></a></li>
		<li><a href="<?=base_url('mounter/day/')?>"><i class="fa fa-circle-o text-yellow"></i> <span>Список тз</span></a></li>
        <li class="treeview">

          <a href="#">

            <i class="fa fa-circle-o text-olive"></i>
               <span>Общее</span>
                <small style="margin-right:20px" class="label pull-right <?=$count_m>0?'bg-red':'bg-green'?>"><?=$count_m?></small>
           <i class="fa fa-angle-left pull-right"></i>
          </a>
            <ul class="treeview-menu" style="">
            <li><a href="<?=base_url('social/message_create')?>"><i class="fa fa-circle-o"></i>Создать сообщение</a></li>
            <li><a href="<?=base_url('social/in_message')?>"><i class="fa fa-circle-o"></i>Входящие</a></li>
            <li><a href="<?=base_url('social/out_message')?>"><i class="fa fa-circle-o"></i>Исходящие</a></li>
            <li><a href="<?=base_url('social/files')?>"><i class="fa fa-circle-o"></i>Файлы</a></li>
            <li><a href="<?=base_url('social/phonebook')?>"><i class="fa fa-circle-o"></i>Телефонная книга</a></li>
          </ul>
        </li>

    <li><a href="<?=base_url('user/logout')?>"><i class="fa fa-circle-o text-aqua"></i> <span>Выйти</span></a></li>
 </ul>

