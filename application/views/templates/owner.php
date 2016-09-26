<?
echo $menu;
?>
<!--<ul class="sidebar-menu">
        <li class="treeview">
          <a href="#">
            <i class="fa fa-circle-o text-red"></i>
               <span>Бюджет и ЗП</span>
            <i class="fa fa-angle-left pull-right"></i>
          </a>
            <ul class="treeview-menu" style="">
            <li><a href="<?=base_url('budget')?>"><i class="fa fa-circle-o"></i>Бюджет</a></li>
            <li><a href="<?=base_url('budget/create')?>"><i class="fa fa-circle-o"></i>Добавить +-</a></li>
            <li><a href="<?=base_url('budget/wage')?>"><i class="fa fa-circle-o"></i>Ставки</a></li>
            <li><a href="<?=base_url('budget/sheet')?>"><i class="fa fa-circle-o"></i>Ведомость</a></li>
            <li><a href="<?=base_url('budget/user_fines')?>"><i class="fa fa-circle-o"></i>Штрафы и Премии</a></li>
            <li><a href="<?=base_url('budget/on_work')?>"><i class="fa fa-circle-o"></i>На работе</a></li>
          </ul>
        </li>

    <li class="treeview">
          <a href="#">
            <i class="fa fa-circle-o text-yellow"></i>
            <span>Склад</span>
             <i class="fa fa-angle-left pull-right"></i>
          </a>
          <ul class="treeview-menu" style="">
            <li><a href="<?=base_url('storage')?>"><i class="fa fa-circle-o"></i>Наличие</a></li>
            <li><a href="<?=base_url('storage/goods')?>"><i class="fa fa-circle-o"></i>Наименования</a></li>
          </ul>
	</li>
            <li class="treeview">
          <a href="#">
            <i class="fa fa-circle-o text-teal"></i>
               <span>Отчеты</span>
            <i class="fa fa-angle-left pull-right"></i>
          </a>
            <ul class="treeview-menu" style="">
            <li><a href="<?=base_url('report/storage')?>"><i class="fa fa-circle-o"></i>Инвентарь</a></li>
            <li><a href="<?=base_url('report/budget')?>"><i class="fa fa-circle-o"></i>Бюджет</a></li>
            <li><a href="<?=base_url('report/repair')?>"><i class="fa fa-circle-o"></i>Заявки</a></li>
          </ul>
        </li>
            <li class="treeview">
          <a href="#">
            <i class="fa fa-circle-o text-purple"></i>
               <span>Принять заявку</span>
            <i class="fa fa-angle-left pull-right"></i>
          </a>
            <ul class="treeview-menu" style="">
              <li class="treeview">
                    <a href="#">
                      <i class="fa fa-circle-o text-maroon"></i>
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
                      <i class="fa fa-circle-o text-maroon"></i>
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
                      <i class="fa fa-circle-o text-maroon"></i>
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
                      <i class="fa fa-circle-o text-maroon"></i>
                         <span>Админ задачи</span>
                      <i class="fa fa-angle-left pull-right"></i>
                    </a>
                      <ul class="treeview-menu" style="">
                       <li><a href="<?=base_url('operator/repair_create/4')?>"><i class="fa fa-circle-o"></i> <span>Принять</span></a></li>
                       <li><a href="<?=base_url('operator/base/4')?>"><i class="fa fa-circle-o"></i> <span>База</span></a></li>
                       <li><a href="<?=base_url('operator/calendar/4')?>"><i class="fa fa-circle-o"></i> <span>Календарь</span></a></li>
                    </ul>
              </li>
          </ul>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-circle-o text-red"></i>
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

    <li class="treeview">
          <a href="#">
            <i class="fa fa-circle-o text-lime"></i>
            <span>Администрирование</span>
             <i class="fa fa-angle-left pull-right"></i>
          </a>
          <ul class="treeview-menu" style="">
            <li><a href="<?=base_url('option/group_consist')?>"><i class="fa fa-circle-o"></i>Назначить монтажника на гр.</a></li>
            <li><a href="<?=base_url('user/show')?>"><i class="fa fa-circle-o"></i> Пользователи</a></li>
            <li><a href="<?=base_url('option/actions')?>"><i class="fa fa-circle-o"></i> Акции</a></li>
            <li><a href="<?=base_url('option/rates')?>"><i class="fa fa-circle-o"></i> Тарифы</a></li>
            <li><a href="<?=base_url('option/areas')?>"><i class="fa fa-circle-o"></i> Районы</a></li>
            <li><a href="<?=base_url('option/streets')?>"><i class="fa fa-circle-o"></i> Улицы</a></li>
            <li><a href="<?=base_url('option/damages')?>"><i class="fa fa-circle-o"></i> Поломки</a></li>
            <li><a href="<?=base_url('option/groups')?>"><i class="fa fa-circle-o"></i> Группы</a></li>
            <li><a href="<?=base_url('option/bid_status')?>"><i class="fa fa-circle-o"></i> Статусы</a></li>
            <li><a href="<?=base_url('option/budget_types')?>"><i class="fa fa-circle-o"></i> Статьи Бюджета</a></li>
          </ul>
    </li>
    <li><a href="<?=base_url('user/logout')?>"><i class="fa fa-circle-o text-aqua"></i> <span>Выйти</span></a></li>
 </ul>
-->