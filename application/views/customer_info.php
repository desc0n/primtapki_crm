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
                Контактная информация
            </div>
            <div class="panel-body">
                <h4>Название</h4>
                <p><?=Arr::get($customerData, 'name');?></p>
                <h4>Адрес</h4>
                <address>
                    <p>
                    <strong><?=Arr::get($customerData, 'postindex');?></strong>
                    <br>
                        <?=Arr::get($customerData, 'region');?>
                        <?=Arr::get($customerData, 'city');?>
                        <?=Arr::get($customerData, 'street');?>
                        <?=Arr::get($customerData, 'house');?>
                    <br>
                    </p>
                    <abbr>Телефон:</abbr> +7 <?=Arr::get($customerData, 'phone');?>
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