<ul class="sidebar-menu">
    <li><a href="<?=base_url('mounter/start/')?>"><i class="fa fa-circle-o text-red"></i> <span>Рабочий день день</span></a></li>
    <li class="treeview">
          <a href="#">
            <i class="fa fa-circle-o text-yellow"></i>
               <span>Подключения</span>
            <i class="fa fa-angle-left pull-right"></i>
          </a>
            <ul class="treeview-menu" style="">
             <li><a href="<?=base_url('operator/repair_create/1')?>"><i class="fa fa-circle-o"></i> <span>Принять</span></a></li>
             <li><a href="<?=base_url('operator/base/1')?>"><i class="fa fa-circle-o"></i> <span>База</span></a></li>
             <li><a href="<?=base_url('operator/calendar/1')?>"><i class="fa fa-circle-o"></i> <span>Календарь</span></a></li>
          </ul>
    </li>
    <li class="treeview">
          <a href="#">
            <i class="fa fa-circle-o text-teal"></i>
               <span>Ремонт</span>
            <i class="fa fa-angle-left pull-right"></i>
          </a>
            <ul class="treeview-menu" style="">
             <li><a href="<?=base_url('operator/repair_create/2')?>"><i class="fa fa-circle-o"></i> <span>Принять</span></a></li>
             <li><a href="<?=base_url('operator/base/2')?>"><i class="fa fa-circle-o"></i> <span>База</span></a></li>
             <li><a href="<?=base_url('operator/calendar/2')?>"><i class="fa fa-circle-o"></i> <span>Календарь</span></a></li>
          </ul>
    </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-circle-o text-lime"></i>
               <span>Другие работы</span>
            <i class="fa fa-angle-left pull-right"></i>
          </a>
            <ul class="treeview-menu" style="">
             <li><a href="<?=base_url('operator/repair_create/3')?>"><i class="fa fa-circle-o"></i> <span>Принять</span></a></li>
             <li><a href="<?=base_url('operator/base/3')?>"><i class="fa fa-circle-o"></i> <span>База</span></a></li>
             <li><a href="<?=base_url('operator/calendar/3')?>"><i class="fa fa-circle-o"></i> <span>Календарь</span></a></li>
          </ul>
    </li>
    <li class="treeview">
          <a href="#">
            <i class="fa fa-circle-o text-olive"></i>
               <span>Админ задачи</span>
            <i class="fa fa-angle-left pull-right"></i>
          </a>
            <ul class="treeview-menu" style="">
             <li><a href="<?=base_url('operator/repair_create/4')?>"><i class="fa fa-circle-o"></i> <span>Принять</span></a></li>
             <li><a href="<?=base_url('operator/base/4')?>"><i class="fa fa-circle-o"></i> <span>База</span></a></li>
             <li><a href="<?=base_url('operator/calendar/4')?>"><i class="fa fa-circle-o"></i> <span>Календарь</span></a></li>
          </ul>
    </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-circle-o text-green"></i>
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
