<?php echo $header; ?><?php echo $column_left; ?>
    <div id="content">
        <div class="page-header">
            <div class="container-fluid">
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


            <div class="content content-narrow mb-4">
                <div class="row">
                    <div class="col-sm-12 text-center">
                        <div class="btn-group" role="group" aria-label="Horizontal Outline Primary">


                            <?php if ($filter == 'today') { ?>
                            <a href="<?php echo $list_link_filter_today; ?>" class="btn btn-primary"><?php echo $text_period_today; ?></a>
                            <?php } else { ?>
                            <a href="<?php echo $list_link_filter_today; ?>" class="btn btn-outline-primary"><?php echo $text_period_today; ?></a>
                            <?php } ?>

                            <?php if ($filter == 'yesterday') { ?>
                            <a href="<?php echo $list_link_filter_yesterday; ?>" class="btn btn-primary"><?php echo $text_period_yesterday; ?></a>
                            <?php } else { ?>
                            <a href="<?php echo $list_link_filter_yesterday; ?>" class="btn btn-outline-primary"><?php echo $text_period_yesterday; ?></a>
                            <?php } ?>

                            <?php if ($filter == 'week') { ?>
                            <a href="<?php echo $list_link_filter_week; ?>" class="btn btn-primary"><?php echo $text_period_week; ?></a>
                            <?php } else { ?>
                            <a href="<?php echo $list_link_filter_week; ?>" class="btn btn-outline-primary"><?php echo $text_period_week; ?></a>
                            <?php } ?>


                            <?php if ($filter == 'month') { ?>
                            <a href="<?php echo $list_link_filter_month; ?>" class="btn btn-primary"><?php echo $text_period_month; ?></a>
                            <?php } else { ?>
                            <a href="<?php echo $list_link_filter_month; ?>" class="btn btn-outline-primary"><?php echo $text_period_month; ?></a>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>





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


            <div class="row">
                <div class="col-sm-12">
                    <!-- График -->
                    <div class="panel panel-default">
                        <div class="panel-heading"><?php echo $text_stats_leads; ?>
                        </div>

                        <div class="panel-body chart-stats">
                            <div class="block-rounded block-mode-loading-oneui">
                                <div class="block-content p-0 bg-body-light text-center">
                                    <div class="pt-3" style="height: 360px;"><canvas class="js-chartjs-dashboard-sales"></canvas></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End График -->
                </div>
<!--                <div class="col-sm-4"></div>-->
            </div>



            <!-- Customer -->
            <div class="row">
                <div class="col-md-2 col-xl-2">
                    <div class="block block-themed">
                        <div class="block-header">
                            <h3 class="block-title"><?php echo $text_customers; ?> <?php echo $word_period; ?></h3>
                        </div>
                        <div class="block-content">
                            <p class="font-size-h2 font-w400 text-dark"><?php echo $total_customers; ?></p>
                        </div>
                    </div>
                </div>

                <div class="col-md-2 col-xl-2">
                    <div class="block block-themed">
                        <div class="block-header bg-modern">
                            <h3 class="block-title"><?php echo $text_leads; ?> <?php echo $word_period; ?></h3>
                        </div>
                        <div class="block-content">
                            <p class="font-size-h2 font-w400 text-dark"><?php echo $total_leads; ?></p>
                        </div>
                    </div>
                </div>

                <div class="col-md-2 col-xl-2">
                    <div class="block block-themed">
                        <div class="block-header bg-modern">
                            <h3 class="block-title"><?php echo $text_sum_leads; ?> <?php echo $word_period; ?></h3>
                        </div>
                        <div class="block-content">
                            <p class="font-size-h2 font-w400 text-dark"><?php echo $total_sum_leads; ?> <?php echo $currency; ?></p>
                        </div>
                    </div>
                </div>

                <div class="col-md-2 col-xl-2">
                    <div class="block block-themed">
                        <div class="block-header bg-city">
                            <h3 class="block-title"><?php echo $text_costs; ?> <?php echo $word_period; ?></h3>
                        </div>
                        <div class="block-content">
                            <p class="font-size-h2 font-w400 text-dark"><?php echo $total_costs; ?></p>
                        </div>
                    </div>
                </div>

                <div class="col-md-2 col-xl-2">
                    <div class="block block-themed">
                        <div class="block-header bg-city">
                            <h3 class="block-title"><?php echo $text_costs_leads; ?> <?php echo $word_period; ?></h3>
                        </div>
                        <div class="block-content">
                            <p class="font-size-h2 font-w400 text-dark"><?php echo $total_sum_costs; ?> <?php echo $currency; ?></p>
                        </div>
                    </div>
                </div>

                <div class="col-md-2 col-xl-2">
                    <div class="block block-themed">
                        <div class="block-header bg-info">
                            <h3 class="block-title"><?php echo $text_profit; ?> <?php echo $word_period; ?></h3>
                        </div>
                        <div class="block-content">
                            <p class="font-size-h2 font-w400 text-dark"><?php echo $total_sum_profit; ?> <?php echo $currency; ?></p>
                        </div>
                    </div>
                </div>


            </div>
            <!-- END Customer -->


            <!-- Customers and Latest Orders -->
            <div class="row row-deck">

                <div class="col-lg-6">
                    <div class="block block-mode-loading-oneui">
                        <div class="block-header border-bottom">
                            <h3 class="block-title">Топ клиентов</h3>
                            <div class="block-options">
                                <a href="<?php echo $opencart_customer_link; ?>" class="btn btn-sm btn-outline-info">Список клиентов</a>
                            </div>
                        </div>
                        <div class="block-content block-content-full">
                            <table class="table table-striped table-hover table-borderless table-vcenter font-size-sm mb-0">
                                <thead class="">
                                <tr class="text-uppercase">
                                    <th class="font-w700">Имя</th>
                                    <th class="d-none d-sm-table-cell font-w700 text-center">Приход</th>
                                    <th class="d-none d-sm-table-cell font-w700 text-center">Сделок</th>
                                </tr>
                                </thead>
                                <tbody>

                                <?php if ($customers) { ?>

                                    <?php foreach ($customers as $customer) { ?>

                                    <tr>
                                        <td class="font-w600"><?php echo $customer['name']; ?></td>
                                        <td class="d-none d-sm-table-cell text-center"><?php echo $customer['amount']; ?> <?php echo $currency; ?></td>
                                        <td class="d-none d-sm-table-cell text-center"><?php echo $customer['count']; ?></td>
                                    </tr>

                                    <?php } ?>
                                <?php } else { ?>

                                    <tr><td colspan="3" class="text-center"><?php echo $text_no_results; ?></td><tr>

                                <?php } ?>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>


                <div class="col-lg-6">
                    <div class="block block-mode-loading-oneui">
                        <div class="block-header border-bottom">
                            <h3 class="block-title">Топ пользователей</h3>
                            <div class="block-options">
                                <a href="<?php echo $opencart_user_link; ?>" class="btn btn-sm btn-outline-info">Список менеджеров</a>
                            </div>
                        </div>
                        <div class="block-content block-content-full">
                            <table class="table table-striped table-hover table-borderless table-vcenter font-size-sm mb-0">
                                <thead class="">
                                <tr class="text-uppercase">
                                    <th class="font-w700">Имя</th>
                                    <th class="d-none d-sm-table-cell font-w700 text-center">Приход</th>
                                    <th class="d-none d-sm-table-cell font-w700 text-center">Сделок</th>
                                </tr>
                                </thead>
                                <tbody>

                                <?php if ($users) { ?>

                                    <?php foreach ($users as $user) { ?>

                                        <tr>
                                            <td class="font-w600"><?php echo $user['name']; ?></td>
                                            <td class="d-none d-sm-table-cell text-center"><?php echo $user['amount']; ?> <?php echo $currency; ?></td>
                                            <td class="d-none d-sm-table-cell text-center"><?php echo $user['count']; ?></td>
                                        </tr>

                                    <?php } ?>
                                <?php } else { ?>

                                    <tr><td colspan="3" class="text-center"><?php echo $text_no_results; ?></td><tr>

                                <?php } ?>


                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END Customers and Latest Orders -->



        </div>
    </div>

    <!-- Page JS Code -->
    <script>

        ! function(r) {
            var e = {};

            function o(t) {
                if (e[t]) return e[t].exports;
                var a = e[t] = {
                    i: t,
                    l: !1,
                    exports: {}
                };
                return r[t].call(a.exports, a, a.exports, o), a.l = !0, a.exports
            }
            o.m = r, o.c = e, o.d = function(r, e, t) {
                o.o(r, e) || Object.defineProperty(r, e, {
                    enumerable: !0,
                    get: t
                })
            }, o.r = function(r) {
                "undefined" != typeof Symbol && Symbol.toStringTag && Object.defineProperty(r, Symbol.toStringTag, {
                    value: "Module"
                }), Object.defineProperty(r, "__esModule", {
                    value: !0
                })
            }, o.t = function(r, e) {
                if (1 & e && (r = o(r)), 8 & e) return r;
                if (4 & e && "object" == typeof r && r && r.__esModule) return r;
                var t = Object.create(null);
                if (o.r(t), Object.defineProperty(t, "default", {
                    enumerable: !0,
                    value: r
                }), 2 & e && "string" != typeof r)
                    for (var a in r) o.d(t, a, function(e) {
                        return r[e]
                    }.bind(null, a));
                return t
            }, o.n = function(r) {
                var e = r && r.__esModule ? function() {
                    return r.default
                } : function() {
                    return r
                };
                return o.d(e, "a", e), e
            }, o.o = function(r, e) {
                return Object.prototype.hasOwnProperty.call(r, e)
            }, o.p = "", o(o.s = 18)
        }({
            18: function(r, e, o) {
                r.exports = o(19)
            },
            19: function(r, e) {
                function o(r, e) {
                    for (var o = 0; o < e.length; o++) {
                        var t = e[o];
                        t.enumerable = t.enumerable || !1, t.configurable = !0, "value" in t && (t.writable = !0), Object.defineProperty(r, t.key, t)
                    }
                }
                var t = function() {
                    function r() {
                        ! function(r, e) {
                            if (!(r instanceof e)) throw new TypeError("Cannot call a class as a function")
                        }(this, r)
                    }
                    var e, t, a;
                    return e = r, a = [{
                        key: "initCharts",
                        value: function() {
                            Chart.defaults.global.defaultFontColor = "#495057", Chart.defaults.scale.gridLines.color = "transparent", Chart.defaults.scale.gridLines.zeroLineColor = "transparent", Chart.defaults.scale.display = !1, Chart.defaults.scale.ticks.beginAtZero = !0, Chart.defaults.global.elements.line.borderWidth = 0, Chart.defaults.global.elements.point.radius = 0, Chart.defaults.global.elements.point.hoverRadius = 0, Chart.defaults.global.tooltips.cornerRadius = 3, Chart.defaults.global.legend.labels.boxWidth = 12;
                            var r, e, o, t, a = jQuery(".js-chartjs-dashboard-earnings"),
                                n = jQuery(".js-chartjs-dashboard-sales");
                            o = {
                                maintainAspectRatio: !1,
                                scales: {
                                    yAxes: [{
                                        ticks: {
                                            suggestedMax: '<?php echo $chart_max_value; ?>'
                            }
                        }]
                        },
                            tooltips: {
                                intersect: !1,
                                    callbacks: {
                                    label: function(r, e) {
                                        return " " + r.yLabel + " <?php echo $currency; ?>"
                                    }
                                }
                            }
                        }, t = {
                                labels: ["<?php echo $chart_days; ?>"],
                                datasets: [{
                                    label: "<?php echo $text_leads; ?>",
                                    fill: !0,
                                    backgroundColor: "rgba(34, 184, 207, .3)",
                                    borderColor: "transparent",
                                    pointBackgroundColor: "rgba(34, 184, 207, 1)",
                                    pointBorderColor: "#fff",
                                    pointHoverBackgroundColor: "#fff",
                                    pointHoverBorderColor: "rgba(34, 184, 207, 1)",
                                    data: [<?php echo $chart_month_leads; ?>]
                                }, {
                                    label: "<?php echo $text_costs; ?>",
                                    fill: !0,
                                    backgroundColor: "#ff6b6b",
                                    borderColor: "transparent",
                                    pointBackgroundColor: "rgba(233, 236, 239, 1)",
                                    pointBorderColor: "#fff",
                                    pointHoverBackgroundColor: "#fff",
                                    pointHoverBorderColor: "rgba(233, 236, 239, 1)",
                                    data: [<?php echo $chart_month_costs; ?>]
                                }]
                            }, a.length && new Chart(a, {
                                type: "line",
                                data: e,
                                options: r
                            }), n.length && new Chart(n, {
                                type: "line",
                                data: t,
                                options: o
                            })
                        }
                    }, {
                        key: "init",
                        value: function() {
                            this.initCharts()
                        }
                    }], (t = null) && o(e.prototype, t), a && o(e, a), r
                }();
                jQuery(function() {
                    t.init()
                })
            }
        });
    </script>
<?php echo $footer; ?>