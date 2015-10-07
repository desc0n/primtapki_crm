<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">События</h1>
    </div>
    <!-- /.col-lg-12 -->
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                Список событий
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
                <div class="dataTable_wrapper">
                    <table class="table table-striped table-bordered table-hover actions-table" id="dataTables-example">
                        <thead>
                        <tr>
                            <th>Добавил</th>
                            <th>Дата добавления</th>
                            <th>Описание события</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?foreach ($actionsList as $action) {?>
                            <tr>
                                <td class="text-center"><?=$action['manager_name'];?></td>
                                <td class="text-center"><?=date('H:i d.m.Y', strtotime($action['date']));?></td>
                                <td><?=$action['text'];?></td>
                            </tr>
                        <?}?>
                        </tbody>
                    </table>
                </div>
                <!-- /.table-responsive -->
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
                <h4 class="modal-title" id="myModalLabel">Добавление клиента</h4>
            </div>
            <div class="modal-body">
                <form role="form" id="addCustomerForm" method="post">
                    <div class="form-group">
                        <div class="col-lg-6">
                            <label>Наименование *</label>
                            <label class="control-label hide" for="newName" id="newNameError">Поле пустое</label>
                            <input class="form-control" name="name" id="newName">
                        </div>
                        <div class="col-lg-6">
                            <label>Дата первого контакта</label>
                            <input class="form-control" name="date" id="newDate" value="<?=date('d.m.Y', time());?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-lg-6">
                            <label>Почтовый индекс</label>
                            <input class="form-control" name="postindex">
                        </div>
                        <div class="col-lg-6">
                            <label>Регион</label>
                            <input class="form-control" name="region">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-lg-12">
                            <label>Город</label>
                            <input class="form-control" name="city">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-lg-6">
                            <label>Улица</label>
                            <input class="form-control" name="street">
                        </div>
                            <div class="col-lg-6">
                            <label>Дом</label>
                            <input class="form-control" name="house">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-lg-6">
                            <label>Телефон *</label>
                            <label class="control-label hide" for="newPhone" id="newPhoneError">Длина номера 10 цифр</label>
                            <div class="input-group">
                                <span class="input-group-addon">+7</span>
                                <input class="form-control" name="phone" id="newPhone" autocomplete="off">
                            </div>
                        </div>
                            <div class="col-lg-6">
                            <label>Факс</label>
                            <input class="form-control" name="fax">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-lg-6">
                            <label>E-mail</label>
                            <input class="form-control" name="email">
                        </div>
                            <div class="col-lg-6">
                            <label>Сайт</label>
                            <input class="form-control" name="site">
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>
                <button type="button" class="btn btn-primary" id="addNewCustomer">Сохранить изменения</button>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(function () {
        $('#newDate').datetimepicker({
            locale: 'ru',
            format: 'DD.MM.YYYY'
        });
    });
</script>