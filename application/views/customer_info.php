<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Информация о клиенте</h1>
    </div>
    <!-- /.col-lg-12 -->
</div>
<div class="row">
    <div class="col-lg-12">
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
        <!-- /.panel -->
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