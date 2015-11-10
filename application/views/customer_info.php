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
            <li><a href="#products" data-toggle="tab">Товары</a>
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
                            <table class="table table-striped table-bordered table-hover  actions-table">
                                <thead>
                                    <tr>
                                        <th class="text-center">Добавил</th>
                                        <th class="text-center">Дата добавления</th>
                                        <th class="text-center">Способ связи</th>
                                        <th class="text-center">Тип события</th>
                                        <th>Описание события</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?foreach ($customerActions as $action) {?>
                                    <tr>
                                        <td class="text-center"><?=$action['manager_name'];?></td>
                                        <td class="text-center"><?=date('H:i d.m.Y', strtotime($action['date']));?></td>
                                        <td class="text-center"><?=$action['communication_method_name'];?></td>
                                        <td class="text-center"><?=$action['type_name'];?></td>
                                        <td><?=$action['text'];?></td>
                                    </tr>
                                    <?}?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="products">
                <div class="panel-body">
                    <div class="form-group">
                        <button class="btn btn-default" data-toggle="modal" data-target="#addProductModal">Добавить товар <i class="fa fa-plus fa-fw"></i></button>
                    </div>
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Список отслеживаемых товаров
                        </div>
                        <div class="panel-body">
                            <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                <tr>
                                    <th>Добавил</th>
                                    <th>Код товара</th>
                                    <th>Название товара</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?foreach ($customerProducts as $product) {?>
                                    <tr>
                                        <td class="text-center"><?=$product['manager_name'];?></td>
                                        <td class="text-center"><?=$product['product_code'];?></td>
                                        <td><?=$product['product_name'];?></td>
                                    </tr>
                                <?}?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="sales">
                <div class="panel-body">
                    <div class="form-group">
                        <button class="btn btn-default" data-toggle="modal" data-target="#addSaleModal">Добавить документ <i class="fa fa-plus fa-fw"></i></button>
                    </div>
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Список продаж
                        </div>
                        <div class="panel-body">
                            <table class="table table-striped table-bordered table-hover" id="dataTables-sales">
                                <thead>
                                <tr>
                                    <th>Добавил</th>
                                    <th>Товар</th>
                                    <th>Резерв</th>
                                    <th>Оплата</th>
                                    <th>Доставка</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?foreach ($customerSales as $sale) {?>
                                    <tr>
                                        <td class="text-center"><?=$sale['manager_name'];?></td>
                                        <td><?=$sale['products'];?></td>
                                        <td class="text-center"><?=$sale['reserve_name'];?></td>
                                        <td class="text-center"><?=$sale['method_name'];?></td>
                                        <td class="text-center"><?=$sale['delivery_name'];?></td>
                                    </tr>
                                <?}?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
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
                        <label for="newActionCommunicationMethod">Способ связи</label>
                        <select class="form-control" id="newActionCommunicationMethod" name="newActionCommunicationMethod">
                            <?foreach ($communicationMethods as $method) {?>
                                <option value="<?=$method['id'];?>"><?=$method['name'];?></option>
                            <?}?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="newActionType">Тип события</label>
                        <select class="form-control" id="newActionType" name="newActionType">
                            <?foreach ($actionTypes as $type) {?>
                            <option value="<?=$type['id'];?>"><?=$type['name'];?></option>
                            <?}?>
                        </select>
                    </div>
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
<!-- Modal -->
<div class="modal fade" id="addProductModal" tabindex="-1" role="dialog" aria-labelledby="addProductModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="addProductModalLabel">Добавление отслеживаемого товара</h4>
            </div>
            <div class="modal-body">
                <form role="form" method="post" id="addProductForm">
                    <div class="form-group">
                        <label for="newProductCode">Товар</label>
                        <input class="col-lg-3-important form-control" id="newProductCode" name="newProductCode" placeholder="Код товара" autocomplete="off">
                        <input class="col-lg-7-important form-control" id="newProductName" name="newProductName" placeholder="Название товара" autocomplete="off">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>
                <button type="button" class="btn btn-primary" onclick="addProductForm.submit();">Сохранить изменения</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="addSaleModal" tabindex="-1" role="dialog" aria-labelledby="addSaleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="addSaleModalLabel">Добавление документа</h4>
            </div>
            <div class="modal-body">
                <form role="form" method="post" id="addSaleForm">
                    <div class="form-group">
                        <label for="newSaleMethod">Способ оплаты</label>
                        <select class="form-control" id="newSaleMethod" name="newSaleMethod">
                            <?foreach ($saleMethods as $method) {?>
                                <option value="<?=$method['id'];?>"><?=$method['name'];?></option>
                            <?}?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="newSaleType">Тип документа</label>
                        <select class="form-control" id="newSaleType" name="newSaleType">
                            <?foreach ($saleTypes as $type) {?>
                                <option value="<?=$type['id'];?>"><?=$type['name'];?></option>
                            <?}?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="newSaleDelivery">Тип доставки</label>
                        <select class="form-control" id="newSaleDelivery" name="newSaleDelivery">
                            <?foreach ($saleDeliveries as $delivery) {?>
                                <option value="<?=$delivery['id'];?>"><?=$delivery['name'];?></option>
                            <?}?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="newSaleReserve">Резерв</label>
                        <select class="form-control" id="newSaleReserve" name="newSaleReserve">
                            <?foreach ($saleReserves as $reserve) {?>
                                <option value="<?=$reserve['id'];?>"><?=$reserve['name'];?></option>
                            <?}?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Товар</label>
                        <p id="newSaleProductList">
                            <p id="row-1" class="newSaleProductRow">
                                <input type="hidden" id="newSaleProductCode1" name="newSaleProductCode[]">
                                <input class="col-lg-12-important form-control newSaleProductName"
                                       id="newSaleProductName1" data-row="1" name="newSaleProductName[]"
                                       placeholder="Название товара" autocomplete="off">
                            </p>
                            <script>
                                $('#newSaleProductName1').typeahead({
                                    source: function (item, process) {
                                        return $.get('/crm/ajax/find_product_by_item', {
                                            item: item
                                        }, function (response) {
                                            var data = [];
                                            var parseResponse = JSON.parse(response);

                                            for (var i in parseResponse) {
                                                data.push(parseResponse[i].item_id + '#' + parseResponse[i].full_size + ' ' + parseResponse[i].model);
                                            }

                                            return process(data);
                                        });
                                    },
                                    highlighter: function (item) {
                                        var parts = item.split('#');
                                        var html = '<div class="typeahead">' +
                                            '<div class="pull-left margin-small">' +
                                            '<div class="text-left"><strong>' + parts[0] + '#' + parts[1] + '</strong></div>' +
                                            '</div>' +
                                            '<div class="clearfix"></div>' +
                                            '</div>';

                                        return html;
                                    },
                                    updater: function (item) {
                                        var parts = item.split('#');
                                        $('#newSaleProductCode1').val(parts[0]);

                                        return parts[1];
                                    }
                                });
                            </script>
                        </p>
                        <p>
                            <button class="btn btn-success" type="button" id="addSaleProductRow">Добавить строку  <i class="fa fa-indent fa-fw"></i></button>
                        </p>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>
                <button type="button" class="btn btn-primary" onclick="addSaleForm.submit();">Сохранить изменения</button>
            </div>
        </div>
    </div>
</div>
