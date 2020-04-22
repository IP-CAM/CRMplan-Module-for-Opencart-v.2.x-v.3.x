<?php echo $header; ?><?php echo $column_left; ?>
    <div id="content" xmlns="http://www.w3.org/1999/html">
        <div class="page-header">
            <div class="container-fluid">
                <div class="pull-right">
                    <button type="submit" form="form-account" data-toggle="tooltip" title="<?php echo $button_save; ?>" class="btn btn-primary"><i class="fa fa-save"></i></button>
                    <a href="<?php echo $cancel; ?>" data-toggle="tooltip" title="<?php echo $button_cancel; ?>" class="btn btn-default"><i class="fa fa-reply"></i></a>
                </div>
                <h1><?php echo $heading_title_2; ?></h1>
                <br>
                <ul class="breadcrumb">
                    <?php foreach ($breadcrumbs as $breadcrumb) { ?>
                        <li><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
                    <?php } ?>
                </ul>
            </div>
        </div>
        <div class="container-fluid">
            <?php if ($error_warning) { ?>
                <div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> <?php echo $error_warning; ?>
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                </div>
            <?php } ?>
            <?php if ($success) { ?>
                <div class="alert alert-success"><i class="fa fa-check-circle"></i> <?php echo $success; ?>
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                </div>
            <?php } ?>
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="tab-content">


                        <?php // echo "<pre>"; print_r($config); echo "</pre>"?>


                        <div class="tab-pane active" id="tab-posts">

                            <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form-account" class="form-horizontal">
                                <ul class="nav nav-tabs">
                                    <li class="active"><a href="#tab-main" data-toggle="tab"><?php echo $tab_main; ?></a></li>
                                    <li><a href="#tab-leads" data-toggle="tab"><?php echo $tab_leads; ?></a></li>
                                    <li><a href="#tab-tasks" data-toggle="tab"><?php echo $tab_tasks; ?></a></li>
                                    <li><a href="#tab-costs" data-toggle="tab"><?php echo $tab_costs; ?></a></li>
<!--                                    <li><a href="#tab-api" data-toggle="tab">--><?php //echo $text_integration; ?><!--</a></li>-->
                                    <li><a href="#tab-license" data-toggle="tab"><?php echo $text_license; ?></a></li>
                                </ul>
                                <div class="tab-content">




                                    <div class="tab-pane active" id="tab-main">

                                        <fieldset>
                                            <legend><?php echo $tab_main; ?></legend>

                                            <div class="form-group">
                                                <label class="col-sm-2 control-label" for="input-status"><?php echo $entry_show_dashboard; ?></label>
                                                <div class="col-sm-10">
                                                    <select class="form-control" name="config[main][show_on_dashboard]">
                                                        <option value="show" <?php echo ((isset($config['main']['show_on_dashboard']) && $config['main']['show_on_dashboard'] == 'show') ? 'selected="selected"' : ''); ?>><?php echo $text_show; ?></option>
                                                        <option value="not_show" <?php echo ((isset($config['main']['show_on_dashboard']) && $config['main']['show_on_dashboard'] == 'not_show') ? 'selected="selected"' : ''); ?>><?php echo $text_not_show; ?></option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-sm-2 control-label" for="input-status"><?php echo $entry_period_date; ?></label>
                                                <div class="col-sm-10">
                                                    <select class="form-control" name="config[main][period]">
                                                        <option value="month" <?php echo ((isset($config['main']['period']) && $config['main']['period'] == 'month') ? 'selected="selected"' : ''); ?>><?php echo $text_period_month; ?></option>
                                                        <option value="week" <?php echo ((isset($config['main']['period']) && $config['main']['period'] == 'week') ? 'selected="selected"' : ''); ?>><?php echo $text_period_week; ?></option>
                                                        <option value="today" <?php echo ((isset($config['main']['period']) && $config['main']['period'] == 'today') ? 'selected="selected"' : ''); ?>><?php echo $text_period_today; ?></option>
                                                        <option value="yesterday" <?php echo ((isset($config['main']['period']) && $config['main']['period'] == 'yesterday') ? 'selected="selected"' : ''); ?>><?php echo $text_period_yesterday; ?></option>
                                                    </select>
                                                </div>
                                            </div>
                                        </fieldset>


                                    </div>

                                    <div class="tab-pane" id="tab-api">
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label" for="input-status"><?php echo $text_domain; ?></label>
                                            <div class="col-sm-10">
                                                <input type="text" value="<?php echo $_SERVER['SERVER_NAME']; ?>" id="input-secret_key" class="form-control" readonly>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-sm-2 control-label" for="input-status"><?php echo $text_secret_key; ?></label>
                                            <div class="col-sm-10">
                                                <input type="text" value="<?php echo (isset($config['secret_key']) ? $config['secret_key'] : ''); ?>" name="config[secret_key]" id="input-secret_key" class="form-control">
                                            </div>
                                        </div>


                                    </div>



                                    <div class="tab-pane" id="tab-leads">

                                        <fieldset>
                                            <legend><?php echo $text_visible; ?></legend>

                                            <?php foreach ($columns as $key => $column) { ?>
                                                <div class="form-group">
                                                    <label class="col-sm-2 control-label" for="input-status"><?php echo $column['translate']; ?></label>
                                                    <div class="col-sm-10">
                                                        <input name="config[crmplan][show_columns][<?php echo $column['name']; ?>]" value="1" type="checkbox" class="form-control" <?php if (isset($config['crmplan']['show_columns'][$column['name']]) or !isset($config['crmplan']['show_columns'])) { ?>checked="checked"<?php } ?>>
                                                    </div>
                                                </div>
                                            <?php } ?>

                                        </fieldset>

                                    </div>


                                    <div class="tab-pane" id="tab-costs">

                                        <fieldset>
                                            <legend><?php echo $text_visible; ?></legend>

                                            <?php foreach ($columns_costs as $key => $columns_cost) { ?>
                                                <div class="form-group">
                                                    <label class="col-sm-2 control-label" for="input-status"><?php echo $columns_cost['translate']; ?></label>
                                                    <div class="col-sm-10">
                                                        <input name="config[crmplan_costs][show_columns][<?php echo $columns_cost['name']; ?>]" value="1" type="checkbox" class="form-control" <?php if (isset($config['crmplan_costs']['show_columns'][$columns_cost['name']]) or !isset($config['crmplan_costs']['show_columns'])) { ?>checked="checked"<?php } ?>>
                                                    </div>
                                                </div>
                                            <?php } ?>

                                        </fieldset>

                                    </div>

                                    <div class="tab-pane" id="tab-tasks">

                                        <fieldset>
                                            <legend><?php echo $text_type_tasks; ?></legend>

                                            <div class="form-group">
                                                <label class="col-sm-2 control-label" for="input-status"><?php echo $text_type_tasks; ?><?php echo $text_type_tasks_help; ?></label>
                                                <div class="col-sm-10">
                                                    <input width="100%" data-role="tagsinput" class="form-control" type="text" value="<?php echo (isset($config['crmplan_tasks']['type']) ? $config['crmplan_tasks']['type'] : ''); ?>" name="config[crmplan_tasks][type]" id="input-type">
                                                </div>
                                            </div>

                                        </fieldset>


                                        <fieldset>
                                            <legend><?php echo $text_visible; ?></legend>

                                            <?php foreach ($columns_tasks as $column_task) { ?>
                                                <div class="form-group">
                                                    <label class="col-sm-2 control-label" for="input-status"><?php echo $column_task['translate']; ?></label>
                                                    <div class="col-sm-10">
                                                        <input name="config[crmplan_tasks][show_columns][<?php echo $column_task['name']; ?>]" value="1" type="checkbox" class="form-control" <?php if (isset($config['crmplan_tasks']['show_columns'][$column_task['name']]) or !isset($config['crmplan_tasks']['show_columns'])) { ?>checked="checked"<?php } ?>>
                                                    </div>
                                                </div>
                                            <?php } ?>

                                        </fieldset>


                                    </div>





                                    <div class="tab-pane" id="tab-license">




                                        <div class="mt-4">
                                            <fieldset>
                                                <legend>Модуль: CRMplan для Opencart</legend>
                                                Версия модуля: <?php echo $version; ?> <br>
                                                Автор модуля: @smartcoder <br>
                                                Пишите нам по любому вопросу. Идеи, предложения пожелания так же принимаются.😉<br>
                                                <br>
                                                <a target="_blank" href="https://smart-coder.ru"><i class="fa fa-share-square-o"></i> https://smart-coder.ru</a> <br>
                                                <i class="fa fa-envelope-o" aria-hidden="true"></i>  support@smart-coder.ru<br><br>
                                            </fieldset>

                                            <fieldset>
                                                <legend>Подписывайтесь!</legend>
                                                Новости и обновления, интересные статьи по платформе Opencart и не только!

                                                <br><br>

                                                <a href="https://vk.com/smart_coder_ru" class="btn btn-vk btn-sm"><i class="fa fa-vk"></i> <span class="hidden-xs">Вконтакте</span></a>
                                                <a href="https://t.me/smart_coder_ru" class="btn btn-info btn-sm"><i class="fa fa-send"></i> <span class="hidden-xs">Телеграм</span></a>
                                                <a href="https://ok.ru/group/56816967614706" class="btn btn-warning btn-sm"><i class="fa fa-odnoklassniki"></i> <span class="hidden-xs">Одноклассники</span></a>

                                            </fieldset>


                                        </div>



                                    </div>




                                </div>


                            </form>

                        </div>


                    </div>
                </div>
            </div>
        </div>
    </div>
<?php echo $footer; ?>