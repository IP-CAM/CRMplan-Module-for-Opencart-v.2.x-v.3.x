<?php echo $header; ?><?php echo $column_left; ?>
<div id="content">
  <div class="page-header">
    <div class="container-fluid">
      <div class="pull-right">
          <a href="<?php echo $add_link; ?>" data-toggle="tooltip"  class="btn btn-primary"><i class="fa fa-plus"></i></a>
          <button type="button" data-toggle="tooltip"  class="btn btn-danger js-delete" ><i class="fa fa-trash-o"></i></button>
      </div>
      <h1><?php echo $heading_title; ?></h1>
        <br>
      <ul class="breadcrumb">
        <?php foreach ($breadcrumbs as $breadcrumb) { ?>
        <li><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
        <?php } ?>
      </ul>
        <br>
        <?php require(DIR_TEMPLATE.'smartcoder/crmplan/menu.tpl'); ?>
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


    <!-- Status leads-->
    <div class="tab-pane active" id="tab-posts">

    <?php if ($table_setting == 'crmplan') { ?>
    <!-- Stats -->
    <div class="row">
        <div class="col">
            <form action="<?php echo $search_link; ?>" id="status_1" method="post" enctype="multipart/form-data">
                <input type="hidden" name="search[status]" class="form-control form-control-sm hidden" value="1">
                <a class="block block-rounded block-link-pop border-left border-warning border-4x" href="javascript:void(0)" onclick="$('#status_1').submit()">
                    <div class="block-content block-content-full  static-block">
                        <div class="font-size-sm font-w600 text-uppercase text-muted head-bl"><?php echo $text_status_1; ?></div>
                        <div class="font-size-h3 font-w400 text-dark"><?php echo $sum_1_leads; ?> <?php echo $currency; ?></div>
                        <div class="text-dark"><?php echo $count_1_leads; ?> <?php echo $text_leads_plural; ?></div>
                    </div>
                </a>
            </form>
        </div>
        <div class="col">
            <form action="<?php echo $search_link; ?>" id="status_2" method="post" enctype="multipart/form-data">
                <input type="hidden" name="search[status]" class="form-control form-control-sm hidden" value="2">
                <a class="block block-rounded block-link-pop border-left border-info border-4x" href="javascript:void(0)" onclick="$('#status_2').submit()">
                  <div class="block-content block-content-full  static-block">
                      <div class="font-size-sm font-w600 text-uppercase text-muted head-bl"><?php echo $text_status_2; ?></div>
                      <div class="font-size-h3 font-w400 text-dark"><?php echo $sum_2_leads; ?> <?php echo $currency; ?></div>
                      <div class="text-dark"><?php echo $count_2_leads; ?> <?php echo $text_leads_plural; ?></div>
                  </div>
                </a>
            </form>
        </div>
        <div class="col">
            <form action="<?php echo $search_link; ?>" id="status_3" method="post" enctype="multipart/form-data">
                <input type="hidden" name="search[status]" class="form-control form-control-sm hidden" value="3">
                <a class="block block-rounded block-link-pop border-left border-primary border-4x" href="javascript:void(0)" onclick="$('#status_3').submit()">
                  <div class="block-content block-content-full  static-block">
                      <div class="font-size-sm font-w600 text-uppercase text-muted head-bl"><?php echo $text_status_3; ?></div>
                      <div class="font-size-h3 font-w400 text-dark"><?php echo $sum_3_leads; ?> <?php echo $currency; ?></div>
                      <div class="text-dark"><?php echo $count_3_leads; ?> <?php echo $text_leads_plural; ?></div>
                  </div>
                </a>
            </form>
        </div>

        <div class="col">
            <form action="<?php echo $search_link; ?>" id="status_4" method="post" enctype="multipart/form-data">
                <input type="hidden" name="search[status]" class="form-control form-control-sm hidden" value="4">
                <a class="block block-rounded block-link-pop border-left border-success border-4x" href="javascript:void(0)" onclick="$('#status_4').submit()">
                  <div class="block-content block-content-full  static-block">
                      <div class="font-size-sm font-w600 text-uppercase text-muted head-bl"><?php echo $text_status_4; ?></div>
                      <div class="font-size-h3 font-w400 text-dark"><?php echo $sum_4_leads; ?> <?php echo $currency; ?></div>
                      <div class="text-dark"><?php echo $count_4_leads; ?> <?php echo $text_leads_plural; ?></div>
                  </div>
                </a>
            </form>
        </div>

        <div class="col">
            <form action="<?php echo $search_link; ?>" id="status_5" method="post" enctype="multipart/form-data">
                <input type="hidden" name="search[status]" class="form-control form-control-sm hidden" value="5">
                <a class="block block-rounded block-link-pop border-left border-danger border-4x" href="javascript:void(0)" onclick="$('#status_5').submit()">
                  <div class="block-content block-content-full  static-block">
                      <div class="font-size-sm font-w600 text-uppercase text-muted head-bl"><?php echo $text_status_5; ?></div>
                      <div class="font-size-h3 font-w400 text-dark"><?php echo $sum_5_leads; ?> <?php echo $currency; ?></div>
                      <div class="text-dark"><?php echo $count_5_leads; ?> <?php echo $text_leads_plural; ?></div>
                  </div>
                </a>
            </form>
        </div>

    </div>
    <!-- END Stats -->
    <?php } ?>




    </div>
    <!-- End Status leads-->


    <div class="panel panel-default">
      <div class="panel-heading">
        <h3 class="panel-title"><i class="fa fa-list"></i> <?php echo $text_list; ?></h3>
      </div>
      <div class="panel-body">
          <div class="table-responsive">
            <table class="table table-bordered table-hover">
              <thead>
                <tr>

                    <!--Начало списка колонок, показывается в настройках модуля-->
                    <?php foreach ($columns as $key => $column) { ?>

                        <?php if ($column['translate'] == 'column_id') { ?>
                            <td style="width: 1px;" class="text-center"><input type="checkbox" onclick="$('input[name*=\'selected\']').prop('checked', this.checked);" /></td>
                        <?php } else { ?>

                            <?php if (isset($config[$table_setting]['show_columns'][$column['name']]) or !isset($config[$table_setting]['show_columns'])) { ?>
                                <td class="text-left">
                                    <?php if ($sort == $column['name']) { ?>
                                        <a href="<?php echo $column['sort_links']; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column['translate']; ?></a>
                                    <?php } else { ?>
                                        <a href="<?php echo $column['sort_links']; ?>"><?php echo $column['translate']; ?></a>
                                    <?php } ?>
                                </td>
                            <?php } ?>

                        <?php } ?>

                    <?php } ?>
                    <!--Конец списка колонок, показывается в настройках модуля-->


                    <td class="text-right"><?php echo $column_action; ?></td>

                </tr>

              <!--Фильтр-->
              <tr class="bg-body-light">

                  <form action="<?php echo $search_link; ?>" id="search" method="post" enctype="multipart/form-data">

                  <!--Начало списка колонок, показывается в настройках модуля-->
                  <?php foreach ($columns as $key => $column) { ?>

                      <?php if ($column['translate'] == 'column_id') { ?>
                          <td style="width: 1px;" class="text-center"></td>
                      <?php } else { ?>

                          <!--Начало поиска-->
                          <?php if (isset($config[$table_setting]['show_columns'][$column['name']]) or !isset($config[$table_setting]['show_columns'])) { ?>
                              <td class="text-left <?php if (!empty($column['search'])) { ?>bg-primary<?php } ?>">
                                  <?php if ($column['name'] == 'customer_id') { ?>
                                      <input type="text" name="customer" class="form-control form-control-sm" value="<?php echo $customer; ?>" placeholder="<?php echo $column['translate']; ?>">
                                      <input type="text" name="search[<?php echo $column['name']; ?>]" class="form-control form-control-sm hidden" value="<?php echo $column['search']; ?>" placeholder="<?php echo $column['translate']; ?>">
                                  <?php } elseif ($column['name'] == 'created_at') { ?>
                                      <input data-date-format="YYYY-MM-DD" id="input-date-available" type="text" name="search[<?php echo $column['name']; ?>]" class="form-control form-control-sm date" value="<?php echo $column['search']; ?>" placeholder="<?php echo $column['translate']; ?>">
                                  <?php } elseif ($column['name'] == 'user_id') { ?>
                                      <input type="text" name="user" class="form-control form-control-sm" value="<?php echo $user; ?>" placeholder="<?php echo $column['translate']; ?>">
                                      <input type="text" name="search[<?php echo $column['name']; ?>]" class="form-control form-control-sm hidden" value="<?php echo $column['search']; ?>" placeholder="<?php echo $column['translate']; ?>">
                                  <?php } elseif ($column['name'] == 'user_group_id') { ?>
                                      <input type="text" name="user_group" class="form-control form-control-sm" value="<?php echo $user_group; ?>" placeholder="<?php echo $column['translate']; ?>">
                                      <input type="text" name="search[<?php echo $column['name']; ?>]" class="form-control form-control-sm hidden" value="<?php echo $column['search']; ?>" placeholder="<?php echo $column['translate']; ?>">
                                  <?php } elseif ($column['name'] == 'type') { ?>
                                      <input readonly type="text" name="type_search" class="form-control form-control-sm" value="<?php echo $type_search; ?>" placeholder="<?php echo $column['translate']; ?>">
                                      <input type="text" name="search[<?php echo $column['name']; ?>]" class="form-control form-control-sm hidden" value="<?php echo $column['search']; ?>" placeholder="<?php echo $column['translate']; ?>">
                                  <?php } elseif ($column['name'] == 'status') { ?>
                                      <input readonly type="text" name="status_search" class="form-control form-control-sm" value="<?php echo $status_search; ?>" placeholder="<?php echo $column['translate']; ?>">
                                      <input type="text" name="search[<?php echo $column['name']; ?>]" class="form-control form-control-sm hidden" value="<?php echo $column['search']; ?>" placeholder="<?php echo $column['translate']; ?>">
                                  <?php } else { ?>
                                    <input name="search[<?php echo $column['name']; ?>]" class="form-control form-control-sm" value="<?php echo $column['search']; ?>" placeholder="<?php echo $column['translate']; ?>">
                                  <?php } ?>
                              </td>
                          <?php } ?>
                          <!--Конец Поиска-->
                      <?php } ?>

                  <?php } ?>
                  <!--Конец списка колонок, показывается в настройках модуля-->


                  <td class="text-right"><button onclick="$('#search').submit()" class="btn btn-primary btn-sm"><i class="fa fa-search"></i> <?php echo $text_search; ?></button> </td>

                  </form>

              </tr>
              <!--Конец фильтр-->


              </thead>

                <form action="<?php echo $delete_link; ?>" method="post" enctype="multipart/form-data" id="form-items">
                    <tbody>
                    <?php if ($items) { ?>
                    <?php foreach ($items as $item) { ?>
                    <tr>

                        <?php foreach ($columns as $column) { ?>
                            <?php if ($column['name'] == 'id') { ?>
                                <td class="text-center"><input type="checkbox" name="selected[]" value="<?php echo $item[$column['name']]; ?>" /></td>
                            <?php } else { ?>

                                <!--Начало списка колонок, показывается в настройках модуля-->
                                <?php if (isset($config[$table_setting]['show_columns'][$column['name']]) or !isset($config[$table_setting]['show_columns'])) { ?>
                                    <?php if ($column['name'] == 'status') { ?>

                                        <?php if ($item[$column['name']] == 1) { ?><td><span class="label label-warning"><?php echo $text_status_1; ?></span></td>
                                        <?php } elseif ($item[$column['name']] == 2) { ?><td><span class="label label-info"><?php echo $text_status_2; ?></span></td>
                                        <?php } elseif ($item[$column['name']] == 3) { ?><td><span class="label label-primary"><?php echo $text_status_3; ?></span></td>
                                        <?php } elseif ($item[$column['name']] == 4) { ?><td><span class="label label-success"><?php echo $text_status_4; ?></span></td>
                                        <?php } elseif ($item[$column['name']] == 5) { ?><td><span class="label label-danger"><?php echo $text_status_5; ?></span></td>
                                        <?php } elseif ($item[$column['name']] == 6) { ?><td><span class="label label-warning"><?php echo $text_status_6; ?></span></td>

                                        <?php } else { ?>
                                            <td class="text-left"><span class="label label-danger"><?php echo $text_disable; ?></span></td>
                                        <?php } ?>


                                    <?php } else { ?>
                                        <td class="text-left"><?php echo $item[$column['name']]; ?></td>
                                    <?php } ?>
                                <?php } ?>
                                <!--Конец списка колонок, показывается в настройках модуля-->


                            <?php } ?>

                        <?php } ?>

                        <td class="text-right"><a href="<?php echo $item['edit']; ?>" data-toggle="tooltip" title="Редактировать" class="btn btn-primary"><i class="fa fa-pencil"></i></a></td>
                    </tr>
                    <?php } ?>
                    <?php } else { ?>
                    <tr>
                      <td class="text-center" colspan="<?php echo count($columns)+1; ?>"><?php echo $text_no_results; ?></td>
                    </tr>
                    <?php } ?>
                  </tbody>
              </form>
            </table>
          </div>
        <div class="row">
          <div class="col-sm-6 text-left"><?php echo $pagination; ?></div>
          <div class="col-sm-6 text-right"><?php echo $results; ?></div>
        </div>
      </div>
    </div>
  </div>
</div>


<script type="text/javascript">
    $(document).on('click', '.js-delete', function (e) {
        var name = $(this).data('name');

        Swal.fire({
            title: "<?php echo $text_delete; ?>",
            text:  "<?php echo $text_confirm;?>",
            type: "error",
            confirmButtonClass: "btn-danger",
            confirmButtonText: "<?php echo $text_confirm_true; ?>",
            cancelButtonText: "<?php echo $text_confirm_false; ?>",
            showCancelButton: true,

        }).then(result => {
            if (result.value) {
                $('#form-items').submit();

            } else {
                // handle dismissals
                // result.dismiss can be 'cancel', 'overlay', 'esc' or 'timer'
            }
        })
    });
</script>


    <script>
        // Поиск
        $('input[name=\'customer\']').autocomplete({
            'source': function(request, response) {
                $.ajax({
                    url: 'index.php?route=customer/customer/autocomplete&<?php echo $admin_token; ?>&filter_name=' +  encodeURIComponent(request),
                    dataType: 'json',
                    success: function(json) {
                        json.unshift({
                            customer_id: '0',
                            name: '<?php echo $text_none; ?>',
                            customer_group: '',
                            firstname: '',
                            lastname: '',
                            email: '',
                            telephone: '',
                            fax: '',
                            custom_field: [],
                            address: []
                        });

                        response($.map(json, function(item) {
                            return {
                                category: item['customer_group'],
                                label: item['name'],
                                value: item['customer_id'],
                                customer_group_id: item['customer_group_id'],
                                firstname: item['firstname'],
                                lastname: item['lastname'],
                                email: item['email'],
                                telephone: item['telephone'],
                                fax: item['fax'],
                                custom_field: item['custom_field'],
                                address: item['address']
                            }
                        }));
                    }
                });
            },
            'select': function(item) {
                // Reset all custom fields
                $('input[name=\'customer\']').val(item['label']);
                $('input[name=\'search[customer_id]\']').val(item['value']);
                html = '<option value="0"><?php echo $text_none; ?></option>';

            }
        });

    </script>

    <script>
        // Поиск
        $('input[name=\'user\']').autocomplete({
            'source': function(request, response) {
                $.ajax({
                    url: 'index.php?route=smartcoder/crmplan/autocomplete&type=user&<?php echo $admin_token; ?>&search=' +  encodeURIComponent(request),
                    dataType: 'json',
                    success: function(json) {
                        json.unshift({
                            id: '0',
                            name: '<?php echo $text_none; ?>',
                        });

                        response($.map(json, function(item) {
                            return {
                                label: item['name'],
                                value: item['id'],
                            }
                        }));
                    }
                });
            },
            'select': function(item) {
                // Reset all custom fields
                $('input[name=\'user\']').val(item['label']);
                $('input[name=\'search[user_id]\']').val(item['value']);
                html = '<option value="0"><?php echo $text_none; ?></option>';

            }
        });

    </script>

    <script>
        // Поиск
        $('input[name=\'user_group\']').autocomplete({
            'source': function(request, response) {
                $.ajax({
                    url: 'index.php?route=smartcoder/crmplan/autocomplete&type=user_group&<?php echo $admin_token; ?>&search=' +  encodeURIComponent(request),
                    dataType: 'json',
                    success: function(json) {
                        json.unshift({
                            id: '0',
                            name: '<?php echo $text_none; ?>',
                        });

                        response($.map(json, function(item) {
                            return {
                                label: item['name'],
                                value: item['id'],
                            }
                        }));
                    }
                });
            },
            'select': function(item) {
                // Reset all custom fields
                $('input[name=\'user_group\']').val(item['label']);
                $('input[name=\'search[user_group_id]\']').val(item['value']);
                html = '<option value="0"><?php echo $text_none; ?></option>';

            }
        });

    </script>

    <script>
        // Поиск
        $('input[name=\'status_search\']').autocomplete({
            'source': function(request, response) {
                $.ajax({
                    url: 'index.php?route=smartcoder/crmplan/autocomplete&type=status&<?php echo $admin_token; ?>&search=' +  encodeURIComponent(request),
                    dataType: 'json',
                    success: function(json) {
                        json.unshift({
                            id: '0',
                            name: '<?php echo $text_none; ?>',
                        });

                        response($.map(json, function(item) {
                            return {
                                label: item['name'],
                                value: item['id'],
                            }
                        }));
                    }
                });
            },
            'select': function(item) {
                // Reset all custom fields
                $('input[name=\'status_search\']').val(item['label']);
                $('input[name=\'search[status]\']').val(item['value']);
                html = '<option value="0"><?php echo $text_none; ?></option>';

            }
        });

    </script>

    <script>
        // Поиск
        $('input[name=\'type_search\']').autocomplete({
            'source': function(request, response) {
                $.ajax({
                    url: 'index.php?route=smartcoder/crmplan/autocomplete&type=type&<?php echo $admin_token; ?>&search=' +  encodeURIComponent(request),
                    dataType: 'json',
                    success: function(json) {
                        json.unshift({
                            id: '0',
                            name: '<?php echo $text_none; ?>',
                        });

                        response($.map(json, function(item) {
                            return {
                                label: item['name'],
                                value: item['id'],
                            }
                        }));
                    }
                });
            },
            'select': function(item) {
                // Reset all custom fields
                $('input[name=\'type_search\']').val(item['label']);
                $('input[name=\'search[type]\']').val(item['value']);
                html = '<option value="0"><?php echo $text_none; ?></option>';

            }
        });

    </script>

    <script type="text/javascript"><!--
        $('.date').datetimepicker({
            pickTime: false,
        });

        $('.time').datetimepicker({
            pickDate: false
        });

        $('.datetime').datetimepicker({
            pickDate: true,
            pickTime: true
        });
        //--></script>



<?php echo $footer; ?>