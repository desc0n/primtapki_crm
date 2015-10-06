<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Информация о клиенте</h1>
    </div>
    <!-- /.col-lg-12 -->
</div>
<div class="row">
    <div class="col-lg-12">
        <!-- Nav tabs -->
        <ul class="nav nav-tabs">
            <li class="active"><a href="#data" data-toggle="tab">Данные</a>
            </li>
            <li><a href="#actions" data-toggle="tab">События</a>
            </li>
            <li><a href="#sales" data-toggle="tab">Продажи</a>
            </li>
        </ul>

        <!-- Tab panes -->
        <div class="tab-content">
            <div class="tab-pane fade in active" id="data">
                <div class="panel-body">
                    <div class="panel panel-default">
                    <div class="panel-heading">
                        Основные данные
                        <a href="#" class="pull-right" data-toggle="modal" data-target="#myModal"><i class="fa fa-pencil fa-fw"></i></a>
                    </div>
                    <div class="panel-body">
                        <h4>Название</h4>
                        <p><?=Arr::get($customerData, 'name');?></p>
                        <h4>Контактная информация</h4>
                        <address>
                            <p>
                                <strong>
                                    <?=Arr::get($customerData, 'listview_postindex');?>
                                    <?=Arr::get($customerData, 'listview_region');?>
                                    <?=Arr::get($customerData, 'listview_city');?>
                                    <?=Arr::get($customerData, 'listview_street');?>
                                    <?=Arr::get($customerData, 'listview_house');?>
                                </strong>
                                <br>
                            </p>
                            <abbr>Телефон:</abbr> +7 (<?=substr(Arr::get($customerData, 'phone'), 0, 3);?>) <?=substr(Arr::get($customerData, 'phone'), 3);?>
                        </address>
                        <h4>Интернет-контакты</h4>
                        <address>
                            <strong>Сайт</strong>
                            <br>
                            <a href="<?=Arr::get($customerData, 'site');?>"><?=Arr::get($customerData, 'site');?></a>
                            <br>
                            <strong>E-mail</strong>
                            <br>
                            <a href="mailto:<?=Arr::get($customerData, 'email');?>"><?=Arr::get($customerData, 'email');?></a>
                        </address>
                    </div>
                    <!-- /.panel-body -->
                </div>
                </div>
                <!-- /.panel -->
            </div>
            <div class="tab-pane fade" id="actions">
                <div class="panel-body">
                    <div class="form-group">
                        <button class="btn btn-default" data-toggle="modal" data-target="#addActionModal">Добавить событие <i class="fa fa-plus fa-fw"></i></button>
                    </div>
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Список событий
                        </div>
                        <div class="panel-body">
                            <table class="table table-striped table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>Добавил</th>
                                        <th>Дата добавления</th>
                                        <th>Описание события</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="sales">
                <h4>Settings Tab</h4>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
            </div>
        </div>
    </div>
    <!-- /.col-lg-12 -->
</div>
<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Редактирование данных клиента</h4>
            </div>
            <div class="modal-body">
                <form role="form" id="redactCustomerForm" method="post">
                    <div class="form-group">
                        <div class="col-lg-6">
                            <label>Наименование *</label>
                            <label class="control-label hide" for="redactName" id="redactNameError">Поле пустое</label>
                            <input class="form-control" name="name" id="redactName" value="<?=Arr::get($customerData, 'name');?>">
                        </div>
                        <div class="col-lg-6">
                            <label>Дата первого контакта</label>
                            <input class="form-control" disabled value="<?=date('d.m.Y', strtotime(Arr::get($customerData, 'date', '0000-00-00')));?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-lg-6">
                            <label>Почтовый индекс</label>
                            <input class="form-control" name="postindex" value="<?=Arr::get($customerData, 'postindex');?>">
                        </div>
                        <div class="col-lg-6">
                            <label>Регион</label>
                            <input class="form-control" name="region" value="<?=Arr::get($customerData, 'region');?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-lg-12">
                            <label>Город</label>
                            <input class="form-control" name="city" value="<?=Arr::get($customerData, 'city');?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-lg-6">
                            <label>Улица</label>
                            <input class="form-control" name="street" value="<?=Arr::get($customerData, 'street');?>">
                        </div>
                        <div class="col-lg-6">
                            <label>Дом</label>
                            <input class="form-control" name="house" value="<?=Arr::get($customerData, 'house');?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-lg-6">
                            <label>Телефон</label>
                            <label class="control-label hide" for="redactPhone" id="redactPhoneError">Длина номера 10 цифр</label>
                            <div class="input-group">
                                <span class="input-group-addon">+7</span>
                                <input class="form-control" id="redactPhone" disabled value="<?=Arr::get($customerData, 'phone');?>">
                                <input type="hidden" name="phone" value="<?=Arr::get($customerData, 'phone');?>">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <label>Факс</label>
                            <input class="form-control" name="fax" value="<?=Arr::get($customerData, 'fax');?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-lg-6">
                            <label>E-mail</label>
                            <input class="form-control" name="email" value="<?=Arr::get($customerData, 'email');?>">
                        </div>
                        <div class="col-lg-6">
                            <label>Сайт</label>
                            <input class="form-control" name="site" value="<?=Arr::get($customerData, 'site');?>">
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>
                <button type="button" class="btn btn-primary" id="redactNewCustomer">Сохранить изменения</button>
            </div>
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="addActionModal" tabindex="-1" role="dialog" aria-labelledby="addActionModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="addActionModalLabel">Добавление события</h4>
            </div>
            <div class="modal-body">
                <form role="form" method="post" id="addActionForm">
                    <div class="form-group">
                        <label for="newActionText">Описание события</label>
                        <textarea class="form-control" id="newActionText" name="newActionText" rows="5"></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>
                <button type="button" class="btn btn-primary" onclick="addActionForm.submit();">Сохранить изменения</button>
            </div>
        </div>
    </div>
</div>