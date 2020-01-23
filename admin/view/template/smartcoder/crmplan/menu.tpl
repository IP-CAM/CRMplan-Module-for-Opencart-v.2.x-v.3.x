<?php $table = false; ?>
<?php if (isset($_GET['table'])) $table = $_GET['table']; ?>

<a href="<?php echo $main_link; ?>" class="btn btn-<?php echo ($_GET['route'] == 'smartcoder/crmplan'       ? 'primary' : 'info');?> btn-sm"><i class="fa fa-bar-chart"></i> <span class="hidden-xs"><?php echo $text_main; ?></span></a>
<a href="<?php echo $list_link; ?>" class="btn btn-<?php echo ($_GET['route'] == 'smartcoder/crmplan/leads'  || $table == 'crmplan'    ? 'primary' : 'info');?> btn-sm"><i class="fa fa-plus"></i> <span class="hidden-xs"><?php echo $text_leads; ?></span></a>
<a href="<?php echo $tasks_link; ?>" class="btn btn-<?php echo ($_GET['route'] == 'smartcoder/crmplan/tasks' || $table == 'crmplan_tasks'      ? 'primary' : 'info');?> btn-sm"><i class="fa fa-list"></i> <span class="hidden-xs"><?php echo $text_tasks; ?></span></a>
<a href="<?php echo $costs_link; ?>" class="btn btn-<?php echo ($_GET['route'] == 'smartcoder/crmplan/costs' || $table == 'crmplan_costs'      ? 'primary' : 'info');?> btn-sm"><i class="fa fa-minus"></i> <span class="hidden-xs"><?php echo $text_costs; ?></span></a>
<a href="<?php echo $settings_link; ?>" class="btn btn-<?php echo ($_GET['route'] == 'smartcoder/crmplan/settings'      ? 'primary' : 'info');?> btn-sm"><i class="fa fa-gears"></i> <span class="hidden-xs"><?php echo $text_settings; ?></span></a>
