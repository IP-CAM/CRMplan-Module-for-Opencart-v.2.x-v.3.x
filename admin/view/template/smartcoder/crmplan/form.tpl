<?php echo $header; ?><?php echo $column_left; ?>
<div id="content">
  <div class="page-header">
    <div class="container-fluid">
      <div class="pull-right">
        <button type="submit" form="form-information" data-toggle="tooltip"  class="btn btn-primary"><i class="fa fa-save"></i></button>
        <a href="<?php echo $list_link; ?>" data-toggle="tooltip"  class="btn btn-default"><i class="fa fa-reply"></i></a>
      </div>
      <h1><?php echo $heading_title; ?> - <?php echo (isset($_GET['id']) ? $text_edit : $text_add); ?></h1><br>
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
    <div class="panel panel-default">
      <div class="panel-heading">
        <h3 class="panel-title"><?php echo (isset($_GET['id']) ? $text_edit : $text_add); ?></h3>
      </div>
      <div class="panel-body">
        <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form-information" class="form-horizontal">

            <ul class="nav nav-tabs">
                <li class="active"><a href="#tab-general" data-toggle="tab"><?php echo $tab_general; ?></a></li>
                <?php if ($customer_id) { ?><li><a href="#tab-customer" data-toggle="tab"><?php echo $tab_customer; ?></a></li><?php } ?>
                <?php if (isset($_GET['id']) and $table == 'crmplan') { ?><li><a href="#tab-history" data-toggle="tab"><?php echo $tab_history; ?></a></li><?php } ?>
            </ul>


          <div class="tab-content">
            <div class="tab-pane active" id="tab-general">
              
              

                <fieldset>

                    <?php foreach ($columns as $column) { ?>

                        <?php if ($column['name'] == 'id') { ?>
                        <?php } elseif ($column['name'] == 'created_at') { ?>
                        <?php } elseif ($column['name'] == 'user_group_id') { ?>

                            <div class="form-group bg-body-light ">
                                <label class="col-sm-2 control-label"><?php echo $column_user_group_id; ?></label>
                                <div class="col-sm-10">
                                    <select name="user_group_id" id="input-status" class="form-control">
                                        <option value="*"><?php echo $text_select; ?></option>
                                        <?php foreach ($user_groups as $user_group) { ?>
                                            <option <?php if ($column['value'] == $user_group['user_group_id']) { ?> selected="selected" <?php } ?> value="<?php echo $user_group['user_group_id']; ?>"><?php echo $user_group['name']; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>

                        <?php } elseif ($column['name'] == 'customer_id') { ?>

                            <div class="form-group">
                                <label class="col-sm-2 control-label" for="input-customer"><?php echo $column_customer_id; ?></label>
                                <div class="col-sm-10">
                                    <input type="text" name="customer" value="<?php echo $customer_name; ?>" id="input-customer" class="form-control" />
                                    <input type="hidden" name="customer_id" value="<?php echo $column['value']; ?>" />
                                </div>
                            </div>

                        <?php } elseif ($column['name'] == 'user_id') { ?>

                            <div class="form-group bg-body-light">
                                <label class="col-sm-2 control-label"><?php echo $column_user_id; ?></label>
                                <div class="col-sm-10">
                                    <select name="user_id" id="input-status" class="form-control">
                                        <option value="*"><?php echo $text_select; ?></option>
                                        <?php foreach ($users as $user) { ?>
                                            <option <?php if ($column['value'] == $user['user_id']) { ?>selected="selected" <?php } ?> value="<?php echo $user['user_id']; ?>"><?php echo $user['firstname']; ?> <?php echo $user['lastname']; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                        <?php } elseif ($column['name'] == 'currency_id') { ?>

                            <div class="form-group">
                                <label class="col-sm-2 control-label"><?php echo $column_currency_id; ?></label>
                                <div class="col-sm-10">

                                    <select name="currency_id" id="input-status" class="form-control">
                                        <?php foreach ($currencies as $currency) { ?>
                                            <option <?php if ($column['value'] == $currency['currency_id'] or $currency['code'] == $config_currency and $column['value'] == "") { ?>selected="selected" <?php } ?> value="<?php echo $currency['currency_id']; ?>"><?php echo $currency['title']; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                        <?php } elseif ($column['name'] == 'description') { ?>

                            <div class="form-group">
                                <label class="col-sm-2 control-label"><?php echo $column_description; ?></label>
                                <div class="col-sm-10">
                                    <textarea class="form-control" name="<?php echo $column['name']; ?>"></textarea>
                                </div>
                            </div>

                        <?php } elseif ($column['name'] == 'status') { ?>

                            <div class="form-group">
                                <label class="col-sm-2 control-label"><?php echo $column['translate']; ?></label>
                                <div class="col-sm-10">
                                    <select name="status" id="input-status" class="form-control">
                                        <?php if ($table != 'crmplan') { ?>
                                            <option value="6"  <?php if ($column['value'] == 6) { ?>selected="selected"<?php } ?>><?php echo $text_status_6; ?></option>
                                            <option value="4"  <?php if ($column['value'] == 4) { ?>selected="selected"<?php } ?>><?php echo $text_status_4; ?></option>
                                            <option value="5"  <?php if ($column['value'] == 5) { ?>selected="selected"<?php } ?>><?php echo $text_status_5; ?></option>
                                        <?php } else { ?>
                                            <option value="1"  <?php if ($column['value'] == 1) { ?>selected="selected"<?php } ?>><?php echo $text_status_1; ?></option>
                                            <option value="2"  <?php if ($column['value'] == 2) { ?>selected="selected"<?php } ?>><?php echo $text_status_2; ?></option>
                                            <option value="3"  <?php if ($column['value'] == 3) { ?>selected="selected"<?php } ?>><?php echo $text_status_3; ?></option>
                                            <option value="4"  <?php if ($column['value'] == 4) { ?>selected="selected"<?php } ?>><?php echo $text_status_4; ?></option>
                                            <option value="5"  <?php if ($column['value'] == 5) { ?>selected="selected"<?php } ?>><?php echo $text_status_5; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>

                        <?php } elseif ($column['name'] == 'type') { ?>

                            <div class="form-group">
                                <label class="col-sm-2 control-label"><?php echo $column['translate']; ?></label>
                                <div class="col-sm-10">

                                    <select name="type" id="input-status" class="form-control">
                                        <?php if ($types) { ?>
                                            <?php foreach ($types as $key => $type) { ?>
                                                <option value="<?php echo $key; ?>" <?php if ($column['value'] == $key) { ?>selected="selected"<?php } ?>><?php echo $type; ?></option>
                                            <?php } ?>
                                        <?php } else { ?>
                                            <option value="1" <?php if ($column['value'] == "" or $column['value'] == 1) { ?>selected="selected"<?php } ?>><?php echo $text_type_lead; ?></option>
                                            <option value="2" <?php if ($column['value'] == 2) { ?>selected="selected"<?php } ?>><?php echo $text_type_task; ?></option>
                                            <option value="3" <?php if ($column['value'] == 3) { ?>selected="selected"<?php } ?>><?php echo $text_type_sale; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>


                        <?php } else { ?>
                            <div class="form-group">
                                <label class="col-sm-2 control-label"><?php echo $column['translate']; ?></label>
                                <div class="col-sm-10">
                                    <input type="text" placeholder="<?php echo $column['translate']; ?>" name="<?php echo $column['name']; ?>" class="form-control" value="<?php echo $column['value']; ?>" />
                                </div>
                            </div>
                        <?php } ?>
                    <?php } ?>
                </fieldset>



            </div>
            <div class="tab-pane" id="tab-customer">
                <div class="form-group">
                    <label class="col-sm-2"><?php echo $column_customer_id; ?></label>
                    <div class="col-sm-10">
                        <?php echo $customer_name; ?>
                    </div>
                </div>

                <?php if ($customer_info) { ?>
                    <div class="form-group">
                        <label class="col-sm-2"><?php echo $column_email; ?></label>
                        <div class="col-sm-10">
                            <?php echo $customer_info['email']; ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2"><?php echo $column_phone; ?></label>
                        <div class="col-sm-10">
                            <?php echo $customer_info['telephone']; ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2"><?php echo $column_group_name; ?></label>
                        <div class="col-sm-10">
                            <?php echo $customer_info['group_name']; ?>
                        </div>
                    </div>
                <?php } ?>

            </div>
            <div class="tab-pane" id="tab-history">

                <br>

                <!-- Add Comment -->
                <div class="panel panel-default m-t-md m-b-n-sm pos-rlt mb-4">
                    <textarea class="form-control no-border js-history-message" rows="3" placeholder="Добавить запись к сделке.."></textarea>
                    <div class="bg-body-light" style="padding: 20px">
                        <a onclick="addHistory();" class="btn btn-info btn-sm"><?php echo $text_add; ?></a>
                    </div>
                </div>
                <!-- Add Comment -->

                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead>
                        <tr>
                            <td class="text-left"><?php echo $text_comment; ?></td>
                            <td class="text-left"><?php echo $column_user_id; ?></td>
                            <td class="text-left"><?php echo $text_date_added; ?></td>
                            <td class="text-right"><?php echo $column_action; ?></td>
                        </tr>
                        </thead>
                        <tbody class="js-history">

                            <?php if ($histories) { ?>
                                <?php foreach ($histories as $history) { ?>
                                <tr>
                                    <td class="text-left"><?php echo $history['comment']; ?></td>
                                    <td class="text-left"><?php echo $history['user_name']; ?></td>
                                    <td class="text-left"><?php echo $history['created_at']; ?></td>
                                    <td class="text-right"><a onclick="deleteHistory(<?php echo $history['id']; ?>)" class="btn btn-danger"><i class="fa fa-trash"></i></a> </td>
                                </tr>
                                <?php } ?>
                            <?php } else { ?>
                                <tr>
                                    <td colspan="4" class="text-center"><?php echo $text_no_results; ?></td>
                                </tr>
                            <?php } ?>

                        </tbody>
                    </table>
                </div>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
  <script type="text/javascript"><!--
$('#language a:first').tab('show');
//--></script>


    <script>
        $('input[name=\'customer\']').autocomplete({
            'source': function(request, response) {
                $.ajax({
                    url: 'index.php?route=customer/customer/autocomplete&<?php echo $admin_token; ?>&filter_name=' +  encodeURIComponent(request),
                    dataType: 'json',
                    success: function(json) {
                        json.unshift({
                            customer_id: '0',
                            customer_group_id: '<?php echo $customer_group_id; ?>',
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
                $('#tab-general input[name=\'customer\']').val(item['label']);
                $('#tab-general input[name=\'customer_id\']').val(item['value']);
                $('#tab-general select[name=\'customer_group_id\']').val(item['customer_group_id']);


                $('select[name=\'customer_group_id\']').trigger('change');

                html = '<option value="0"><?php echo $text_none; ?></option>';

            }
        });

    </script>

    <script type="text/javascript">
        function addHistory() {
            var f = $(this).parent().parent();

            var post_data = {
                comment: $('.js-history-message').val(),
                lead_id: '<?php echo (isset($_GET['id']) ? $_GET['id'] : 0); ?>',
            }

            $.ajax({
                url: './index.php?route=smartcoder/crmplan/addComment&<?php echo $admin_token; ?>',
                type: 'post',
                data: post_data,
                dataType: 'json',
                success: function(json) {


                    if (json['success']) {
                        $('.js-history-message').val('');
                    }

                    if (json['lead_history']) {
                        $('.js-history').html(json['lead_history']);
                    }


                }
            });
        }


    </script>

    <script type="text/javascript">
        function deleteHistory(id) {
            var f = $(this).parent().parent();

            var post_data = {
                id: id,
                lead_id: '<?php echo (isset($_GET['id']) ? $_GET['id'] : 0); ?>',
            }

            $.ajax({
                url: './index.php?route=smartcoder/crmplan/deleteHistory&<?php echo $admin_token; ?>',
                type: 'post',
                data: post_data,
                dataType: 'json',
                success: function(json) {

                    if (json['success']) {
                        $('.js-history-message').val('');
                    }

                    if (json['lead_history']) {
                        $('.js-history').html(json['lead_history']);
                    } else if (json['lead_history'] == '') {
                        $('.js-history').html('<tr>\n' + '<td colspan="4" class="text-center"><?php echo $text_no_results; ?></td>\n' + '</tr>');
                    }

                }
            });
        }


    </script>

    <script type="text/javascript">
        function autocomplite($type) {
            var f = $(this).parent().parent();

            var post_data = {
                val: $(this).val(),
                lead_id: '<?php echo (isset($_GET['id']) ? $_GET['id'] : 0); ?>',
            }

            $.ajax({
                url: './index.php?route=smartcoder/crmplan/autocomplete&<?php echo $admin_token; ?>',
                type: 'post',
                data: post_data,
                dataType: 'json',
                success: function(json) {


                    if (json['success']) {
                        $('.js-history-message').val('');
                    }

                    if (json['lead_history']) {
                        $('.js-history').html(json['lead_history']);
                    }


                }
            });
        }


    </script>



</div>
<?php echo $footer; ?>