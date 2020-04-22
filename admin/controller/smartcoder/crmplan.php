<?php

/**
 *  @module Goods for Opencart
 *  @author smartcoder
 *  @version 1.1
 *  @copyright www.smart-coder.ru
 */

class ControllerSmartcoderCrmplan extends Controller {


    private $error = array();

    /*
    |--------------------------------------------------------------------------
    | Конфигурация модуля
    |--------------------------------------------------------------------------
    |
    */
    private $version = 1.4;
    private $module_name = 'crmplan';
    private $module_folder = 'smartcoder/crmplan';
    private $admin_token;

    function __construct($registry)
    {
        parent::__construct($registry);

        #	Languages
        $this->load->language($this->module_folder);
        $this->document->setTitle( $this->language->get('heading_title') );

        #	Models
        $this->load->model($this->module_folder);
        $this->load->model('tool/image');


        #	Styles
        $this->document->addStyle('view/template/smartcoder/assets/css/crmplan.css');
        $this->document->addStyle('view/template/smartcoder/assets/css/smartcoder.css');
        $this->document->addStyle('view/template/smartcoder/assets/plugins/sweetalert2/sweetalert2.css');
        $this->document->addStyle('view/template/smartcoder/assets/plugins/bootstrap-taginsput/bootstrap-tagsinput.css');

//        $this->document->addStyle('view/template/smartcoder/assets/plugins/select2/css/select2.min.css');

        #	Scripts
        $this->document->addScript('view/template/smartcoder/assets/plugins/sweetalert2/sweetalert2.min.js');
        $this->document->addScript('view/template/smartcoder/assets/plugins/chart.js/Chart.js');
        $this->document->addScript('view/template/smartcoder/assets/plugins/bootstrap-taginsput/bootstrap-tagsinput.js');

//        $this->document->addScript('view/template/smartcoder/assets/plugins/select2/js/select2.full.min.js');


        #   Token and Url
        if (version_compare(VERSION, '3.0.0') >= 0) {
            $this->admin_token = 'user_token=' . $this->session->data['user_token'];
            $this->paginate_params .= 'user_token=' . $this->session->data['user_token'];
        } else {
            $this->admin_token = 'token=' . $this->session->data['token'];
            $this->paginate_params .= 'token=' . $this->session->data['token'];
        }

        $url = '';
        $paginate_params = '';

        if (isset($this->request->get['sort'])) {
            if ($this->request->get['sort']  != '' ) {
                $url .= '&sort=' . $this->request->get['sort'];
                $paginate_params .= '&sort=' . $this->request->get['sort'];
            }
        }

        if (isset($this->request->get['order'])) {
            if ($this->request->get['order'] != '') {
                $url .= '&order=' . $this->request->get['order'];
                $paginate_params .= '&sort=' . $this->request->get['sort'];
            }
        }

        if (isset($this->request->get['page'])) {
                $url .= '&page=' . $this->request->get['page'];

        }

        $this->paginate_params .= $paginate_params;


    }


    /*
    |--------------------------------------------------------------------------
    | Ссылки, языки, настройки
    |--------------------------------------------------------------------------
    |
    */
    private function links()
    {
        return array(

            'main_link' => $this->url->link($this->module_folder.'', $this->admin_token, 'SSL'),

            //  Form
            'add_link' => $this->url->link($this->module_folder.'/add', $this->admin_token, 'SSL'),
            'edit_link' => $this->url->link($this->module_folder.'/edit', $this->admin_token, 'SSL'),

            //  List
            'list_link' => $this->url->link($this->module_folder.'/leads', $this->admin_token, 'SSL'),

            //  Tasks
            'tasks_link' => $this->url->link($this->module_folder.'/tasks', $this->admin_token, 'SSL'),

            'costs_link' => $this->url->link($this->module_folder.'/costs', $this->admin_token, 'SSL'),

            // Main
            'list_link_filter_month' => $this->url->link($this->module_folder.'&filter=month', $this->admin_token, 'SSL'),
            'list_link_filter_week' => $this->url->link($this->module_folder.'&filter=week', $this->admin_token, 'SSL'),
            'list_link_filter_yesterday' => $this->url->link($this->module_folder.'&filter=yesterday', $this->admin_token, 'SSL'),
            'list_link_filter_today' => $this->url->link($this->module_folder.'&filter=today', $this->admin_token, 'SSL'),

            //  OpencartDefaults
            'opencart_customer_link' => $this->url->link('customer/customer', $this->admin_token, 'SSL'),
            'opencart_user_link' => $this->url->link('user/user', $this->admin_token, 'SSL'),


            //Settings
            'settings_link' => $this->url->link($this->module_folder.'/settings', $this->admin_token, 'SSL'),
            'cancel' => $this->url->link($this->module_folder , $this->admin_token, 'SSL'),
        );
    }
    private function languages() {
        return $this->language->all();
    }
    private function config() {

        $data['module_name'] = $this->module_name;
        $data['version'] = $this->version;

        #	USER CONFIG
        $this->load->model('setting/setting');
        $config = $this->model_setting_setting->getSetting($this->module_name);

        $data['config'] = array();
        if (isset($config[$this->module_name]['config'])) {
            $data['config'] = $config[$this->module_name]['config'];
        }

        #   Список пользователей
        $this->load->model('user/user');
        $data['users'] =$this->model_user_user->getUsers();

        #   Группы пользователей
        $this->load->model('user/user_group');
        $data['user_groups'] = $this->model_user_user_group->getUserGroups();

        #   Валюты
        $this->load->model('localisation/currency');
        $data['currencies'] = $this->model_localisation_currency->getCurrencies();
        $data['config_currency'] = $this->config->get('config_currency');

        #   Токен
        $data['admin_token'] = $this->admin_token;


        #   DEFAULT OPENCART

        $data['breadcrumbs'] = array();

        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('heading_title'),
            'href' => $this->url->link($this->module_folder, $this->admin_token),
        );

        if (isset($this->error['warning'])) {
            $data['error_warning'] = $this->error['warning'];
        } else {
            $data['error_warning'] = '';
        }

        if (isset($this->session->data['success'])) {
            $data['success'] = $this->session->data['success'];
            unset($this->session->data['success']);
        } else {
            $data['success'] = '';
        }

        $data['header'] = $this->load->controller('common/header');
        $data['column_left'] = $this->load->controller('common/column_left');
        $data['footer'] = $this->load->controller('common/footer');

        return $data;
    }
    private function load_module_data() {

        $data = array_merge($this->links(),$this->languages(),$this->config());
        return $data;
    }

    ####################################################################

    public function index()
    {
        $data = $this->load_module_data();

        /*
        |--------------------------------------------------------------------------
        | График
        |--------------------------------------------------------------------------
        |
        */


        $day_in_month = cal_days_in_month(CAL_GREGORIAN, date('m'), date('Y'));

        for ($i=1; $i <= $day_in_month; $i++) {
            $arr_chart['day'][] = $i;
            $arr_chart['current_month_leads'][] = $this->model('getSummLeadsOnCurrentMonth', $i);
            $arr_chart['current_month_costs'][] = $this->model('getSummCostsOnCurrentMonth', $i);
            //$arr_chart['last_month'][] = $this->model('getSummOnLastMonth', $i);
            //$arr_chart['current_month'][] = $this->model('getSummOnLastMonth', $i);
        }

        $data['chart_max_value'] = max(array_merge($arr_chart['current_month_leads'],$arr_chart['current_month_costs']));

        $data['chart_days'] = implode(' '.$this->language->get('text_day').'","', $arr_chart['day']);
        $data['chart_month_leads'] = implode(',', $arr_chart['current_month_leads']);
        $data['chart_month_costs'] = implode(',', $arr_chart['current_month_costs']);
        //$data['chart_last_month'] = implode(',', $arr_chart['last_month']);

        /*
        |--------------------------------------------------------------------------
        | Filter
        |--------------------------------------------------------------------------
        |
        */
        $default_filter = isset($data['config']['main']['period']) ? $data['config']['main']['period'] : 'month';
        $data['filter'] = isset($this->request->get['filter'])  ? $this->request->get['filter'] : $default_filter;

        $thisDate = date('Y-m-d');

        switch ($data['filter']) {
            case 'month':

                $date = new DateTime($thisDate);
                $date->modify('-1 month');

                $filter_since = $date->format('Y-m-d');
                $filter_before = $thisDate;

                $filter_data = array(
                    'filter_since' => $filter_since,
                    'filter_before' => $filter_before,
                );

                $data['word_period'] = 'за месяц';
                $data['total_customers'] = $this->model('getTotalCustomers',$filter_data);
                $data['total_leads'] = $this->model('getTotalLeads',$filter_data);
                $data['total_costs'] = $this->model('getTotalCosts',$filter_data);
                $data['total_sum_leads'] = $this->model('getTotalSumLeads',$filter_data);
                $data['total_sum_costs'] = $this->model('getTotalSumCosts',$filter_data);
                $data['total_sum_profit'] = $this->model('getTotalProfit',$filter_data);

                break;
            case 'week':

                $date = new DateTime($thisDate);
                $date->modify('-7 day');

                $filter_since = $date->format('Y-m-d');
                $filter_before = $thisDate;

                $filter_data = array(
                    'filter_since' => $filter_since,
                    'filter_before' => $filter_before,
                );

                $data['word_period'] = 'за неделю';
                $data['total_customers'] = $this->model('getTotalCustomers',$filter_data);
                $data['total_leads'] = $this->model('getTotalLeads',$filter_data);
                $data['total_costs'] = $this->model('getTotalCosts',$filter_data);
                $data['total_sum_leads'] = $this->model('getTotalSumLeads',$filter_data);
                $data['total_sum_costs'] = $this->model('getTotalSumCosts',$filter_data);
                $data['total_sum_profit'] = $this->model('getTotalProfit',$filter_data);
                break;
            case 'yesterday':


                $date = new DateTime($thisDate);
                $date->modify('-1 day');

                $filter_since = $date->format('Y-m-d');
                $filter_before = $thisDate;

                $filter_data = array(
                    'filter_since' => $filter_since,
                    'filter_before' => $filter_before,
                );

                $data['word_period'] = 'вчера';
                $data['total_customers'] = $this->model('getTotalCustomers',$filter_data);
                $data['total_leads'] = $this->model('getTotalLeads',$filter_data);
                $data['total_costs'] = $this->model('getTotalCosts',$filter_data);
                $data['total_sum_leads'] = $this->model('getTotalSumLeads',$filter_data);
                $data['total_sum_costs'] = $this->model('getTotalSumCosts',$filter_data);
                $data['total_sum_profit'] = $this->model('getTotalProfit',$filter_data);


                break;
            case 'today':

                $filter_since = $thisDate;
                $filter_before = $thisDate;

                $filter_data = array(
                    'filter_since' => $filter_since,
                    'filter_before' => $filter_before,
                );

                $data['word_period'] = 'сегодня';
                $data['total_customers'] = $this->model('getTotalCustomers',$filter_data);
                $data['total_leads'] = $this->model('getTotalLeads',$filter_data);
                $data['total_costs'] = $this->model('getTotalCosts',$filter_data);
                $data['total_sum_leads'] = $this->model('getTotalSumLeads',$filter_data);
                $data['total_sum_costs'] = $this->model('getTotalSumCosts',$filter_data);
                $data['total_sum_profit'] = $this->model('getTotalProfit',$filter_data);


                break;

            default:


                $date = new DateTime($thisDate);
                $date->modify('-1 month');

                $filter_since = $date->format('Y-m-d');
                $filter_before = $thisDate;

                $filter_data = array(
                    'filter_since' => $filter_since,
                    'filter_before' => $filter_before,
                );

                $data['word_period'] = 'за месяц';
                $data['total_customers'] = $this->model('getTotalCustomers',$filter_data);
                $data['total_leads'] = $this->model('getTotalLeads',$filter_data);
                $data['total_costs'] = $this->model('getTotalCosts',$filter_data);
                $data['total_sum_leads'] = $this->model('getTotalSumLeads',$filter_data);
                $data['total_sum_costs'] = $this->model('getTotalSumCosts',$filter_data);
                $data['total_sum_profit'] = $this->model('getTotalProfit',$filter_data);


                break;
        }


        /*
        |--------------------------------------------------------------------------
        | Первичный контакт
        |--------------------------------------------------------------------------
        |
        */
        $filter_data = array(
            'filter_since' => $filter_since,
            'filter_before' => $filter_before,
            'filter_status' => 1,
        );

        $data['sum_1_leads'] = $this->model('getSumLeads',$filter_data);
        $data['count_1_leads'] = $this->model('getCountLeads',$filter_data);

        /*
        |--------------------------------------------------------------------------
        | Переговоры
        |--------------------------------------------------------------------------
        |
        */

        $filter_data = array(
            'filter_since' => $filter_since,
            'filter_before' => $filter_before,
            'filter_status' => 2,
        );

        $data['sum_2_leads'] = $this->model('getSumLeads',$filter_data);
        $data['count_2_leads'] = $this->model('getCountLeads',$filter_data);

        /*
        |--------------------------------------------------------------------------
        | Принимают решение
        |--------------------------------------------------------------------------
        |
        */

        $filter_data = array(
            'filter_since' => $filter_since,
            'filter_before' => $filter_before,
            'filter_status' => 3,
        );

        $data['sum_3_leads'] = $this->model('getSumLeads',$filter_data);
        $data['count_3_leads'] = $this->model('getCountLeads',$filter_data);

        /*
        |--------------------------------------------------------------------------
        | Успешно и реализовано
        |--------------------------------------------------------------------------
        |
        */

        $filter_data = array(
            'filter_since' => $filter_since,
            'filter_before' => $filter_before,
            'filter_status' => 4,
        );

        $data['sum_4_leads'] = $this->model('getSumLeads',$filter_data);
        $data['count_4_leads'] = $this->model('getCountLeads',$filter_data);

        /*
        |--------------------------------------------------------------------------
        | Закрыто и нереализовано
        |--------------------------------------------------------------------------
        |
        */

        $filter_data = array(
            'filter_since' => $filter_since,
            'filter_before' => $filter_before,
            'filter_status' => 5,
        );

        $data['sum_5_leads'] = $this->model('getSumLeads',$filter_data);
        $data['count_5_leads'] = $this->model('getCountLeads',$filter_data);
        $data['currency'] = $this->config->get('config_currency');

        /*
       |--------------------------------------------------------------------------
       | ТОП клиентов
       |--------------------------------------------------------------------------
       |
       */

        $data['customers'] = array();

        $customer_results = $this->model('getTopCustomers');
        foreach ($customer_results as $key => $customer) {
            $data['customers'][] = array(
                'id' => $customer['customer_id'],
                'name' => $customer['firstname'] . ' ' . $customer['lastname'],
                'count' => $customer['count'],
                'amount' => $customer['amount'] ? $customer['amount'] : 0,
            );
        }

        /*
        |--------------------------------------------------------------------------
        | ТОП пользователей
        |--------------------------------------------------------------------------
        |
        */
        $data['users'] = array();
        $user_results = $this->model('getTopUsers');
        foreach ($user_results as $key => $user) {
            $data['users'][] = array(
                'id' => $user['user_id'],
                'name' => $user['firstname'] . ' ' . $user['lastname'],
                'count' => $user['count'],
                'amount' => $user['amount'] ? $user['amount'] : 0,
            );
        }


        $data['search_link'] = $this->url->link($this->module_folder.'/leads', $this->admin_token, 'SSL');



        if (version_compare(VERSION, '2.3') >= 0) {
            $this->response->setOutput($this->load->view($this->module_folder.'/main', $data));
        } else {
            $this->response->setOutput($this->load->view($this->module_folder.'/main.tpl', $data));
        }
    }

    public function leads() {
        $this->getList();
    }

    public function tasks() {
        $this->getList("crmplan_tasks");
    }

    public function costs() {
        $this->getList("crmplan_costs");
    }

	public function add($table = false)
    {

        if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
            if (isset($this->request->get['table'])) {
                $this->request->post['table'] = $this->request->get['table'];
            }
            $this->model('add',$this->request->post);

            if (isset($this->request->get['table'])) {
                if ($this->request->get['table'] == 'crmplan_tasks') {
                    $this->response->redirect($this->url->link($this->module_folder.'/tasks', $this->admin_token ));
                }
            }

            $this->response->redirect($this->url->link($this->module_folder.'/leads', $this->admin_token ));
		}

        //  Выбираем нужную таблицу
        if (isset($this->request->get['table'])) $table = $this->request->get['table'];
		$this->getForm($table);
	}

	public function edit()
    {
		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {

            if (isset($this->request->get['table'])) {
                $this->request->post['table'] = $this->request->get['table'];
            }
		    $this->model('edit',$this->request->post);

            if (isset($this->request->get['table'])) {
                if ($this->request->get['table'] == 'crmplan_tasks') {
                    $this->response->redirect($this->url->link($this->module_folder.'/tasks', $this->admin_token ));
                }
            }

            $this->response->redirect($this->url->link($this->module_folder.'/leads', $this->admin_token ));

		}

        //  Выбираем нужную таблицу
        if (isset($this->request->get['table'])) {
            $table = $this->request->get['table'];
        } else {
            $table = false;
        }
		$this->getForm($table);
	}

	public function delete()
    {
        if (isset($this->request->get['table'])) {
            $table = $this->request->get['table'];
        } else {
            $table = false;
        }

		if (isset($this->request->post['selected']) && $this->validateForm()) {
			foreach ($this->request->post['selected'] as $item_id) {
                $this->model('delete',array('id' => $item_id, 'table' => $table));
			}
            $this->response->redirect($this->url->link($this->module_folder, $this->admin_token ));
		}


		$this->getList();
	}


    protected function getList($table=false)
    {

        $data = $this->load_module_data();


        if (!$table) {
            $table = $this->module_name;
            $pagination_module = $this->module_folder.'/leads';
            $data['table_setting'] = $this->module_name;    // Для показа колонок
        } else {
            $data['table_setting'] = $table;    // Для показа колонок
        }

        if ($table == 'crmplan_tasks') {
            $data['heading_title'] = $this->language->get('heading_title_3');
            $data['text_status_4'] = $this->language->get('text_status_success');

            $data['text_list'] = $this->language->get('text_tasks');
            $data['breadcrumbs'][] = array(
                'text' => $this->language->get('text_tasks'),
                'href' => $data['tasks_link'],
            );

            $data['search_link'] = $this->url->link($this->module_folder.'/tasks', $this->admin_token, 'SSL');

            $pagination_module = $this->module_folder.'/tasks';

        } elseif ($table == 'crmplan_costs') {
            $data['heading_title'] = $this->language->get('heading_title_4');
            $data['text_status_4'] = $this->language->get('text_status_success');

            $data['text_list'] = $this->language->get('text_costs');
            $data['breadcrumbs'][] = array(
                'text' => $this->language->get('text_costs'),
                'href' => $data['costs_link'],
            );

            $data['search_link'] = $this->url->link($this->module_folder.'/tasks', $this->admin_token, 'SSL');

            $pagination_module = $this->module_folder.'/costs';
        } else {

            $data['text_list'] = $this->language->get('text_leads');
            $data['heading_title'] = $this->language->get('heading_title_1');
            $data['breadcrumbs'][] = array(
                'text' => $this->language->get('text_list'),
                'href' => $data['list_link'],
            );

            $data['search_link'] = $this->url->link($this->module_folder.'/leads', $this->admin_token, 'SSL');
        }


        //  Form links
        $data['add_link'] = $this->url->link($this->module_folder.'/add&table='.$table, $this->admin_token, 'SSL');
        $data['edit_link'] = $this->url->link($this->module_folder.'/edit&table='.$table, $this->admin_token, 'SSL');
        $data['delete_link'] = $this->url->link($this->module_folder.'/delete&table='.$table, $this->admin_token, 'SSL');

		if (isset($this->request->get['sort'])) {
			$sort = $this->request->get['sort'];
		} else {
			$sort = 'id';
		}

		if (isset($this->request->get['order'])) {
			$order = $this->request->get['order'];
		} else {
			$order = 'DESC';
		}

		if (isset($this->request->get['page'])) {
			$page = $this->request->get['page'];
		} else {
			$page = 1;
		}

        if ($order == 'ASC') {
            $url = '&order=DESC';
        } else {
            $url = '&order=ASC';
        }


        /*
        |--------------------------------------------------------------------------
        | Первичный контакт
        |--------------------------------------------------------------------------
        |
        */
        $filter_data = array(
//            'filter_since' => $filter_since,
//            'filter_before' => $filter_before,
            'filter_status' => 1,
        );

        $data['sum_1_leads'] = $this->model('getSumLeads',$filter_data);
        $data['count_1_leads'] = $this->model('getCountLeads',$filter_data);

        /*
        |--------------------------------------------------------------------------
        | Переговоры
        |--------------------------------------------------------------------------
        |
        */

        $filter_data = array(
//            'filter_since' => $filter_since,
//            'filter_before' => $filter_before,
            'filter_status' => 2,
        );

        $data['sum_2_leads'] = $this->model('getSumLeads',$filter_data);
        $data['count_2_leads'] = $this->model('getCountLeads',$filter_data);

        /*
        |--------------------------------------------------------------------------
        | Принимают решение
        |--------------------------------------------------------------------------
        |
        */

        $filter_data = array(
//            'filter_since' => $filter_since,
//            'filter_before' => $filter_before,
            'filter_status' => 3,
        );

        $data['sum_3_leads'] = $this->model('getSumLeads',$filter_data);
        $data['count_3_leads'] = $this->model('getCountLeads',$filter_data);

        /*
        |--------------------------------------------------------------------------
        | Успешно и реализовано
        |--------------------------------------------------------------------------
        |
        */

        $filter_data = array(
//            'filter_since' => $filter_since,
//            'filter_before' => $filter_before,
            'filter_status' => 4,
        );

        $data['sum_4_leads'] = $this->model('getSumLeads',$filter_data);
        $data['count_4_leads'] = $this->model('getCountLeads',$filter_data);

        /*
        |--------------------------------------------------------------------------
        | Закрыто и нереализовано
        |--------------------------------------------------------------------------
        |
        */

        $filter_data = array(
//            'filter_since' => $filter_since,
//            'filter_before' => $filter_before,
            'filter_status' => 5,
        );

        $data['sum_5_leads'] = $this->model('getSumLeads',$filter_data);
        $data['count_5_leads'] = $this->model('getCountLeads',$filter_data);
        $data['currency'] = $this->config->get('config_currency');


        ##  Вывод колонок
        $data['columns'] = array();
		$columns = $this->model('getColumns', $table);
        if (is_array($columns)) {
            foreach ($columns as $key => $column) {
                if (isset($column)) {

                    $data['columns'][$key]['name'] = $column;
                    $data['columns'][$key]['search'] = isset($this->request->post['search'][$column]) ? $this->request->post['search'][$column] : '';
                    $data['columns'][$key]['sort_links'] = $this->url->link($this->module_folder, $this->admin_token . '&sort='.$column . $url, true);
                    $data['columns'][$key]['translate'] = $this->language->get('column_'.$column) ? $this->language->get('column_'.$column) : $column;

                }
            }
            #   Доп колонки
            //$data['columns'][] = 'edit';
        }





        ##  Поиск
        $search = false;
        if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
            if (isset($this->request->post['search'])) {
                $search = $this->request->post['search'];
            }
        }

        ##  Подстановки поиска
        $data['customer'] = isset($this->request->post['customer']) ? $this->request->post['customer'] : false;
        $data['user'] = isset($this->request->post['user']) ? $this->request->post['user'] : false;
        $data['user_group'] = isset($this->request->post['user_group']) ? $this->request->post['user_group'] : false;
        $data['status_search'] = isset($this->request->post['status_search']) ? $this->request->post['status_search'] : false;
        $data['type_search'] = isset($this->request->post['type_search']) ? $this->request->post['type_search'] : false;


        ##  Фильтр
        $filter_data = array(
            'search'          => $search,
            'table'           => $table,
            'sort'            => $sort,
            'order'           => $order,
            'start'           => ($page - 1) * $this->config->get('config_limit_admin'),
            'limit'           => $this->config->get('config_limit_admin')
        );



        ##  Вывод значений
        $data['items'] = array();
        $results = $this->model('getItems',$filter_data);

		foreach ($results as $item_key => $result) {
            foreach ($columns as $key => $column) {
                if (isset($column)) {

                    if ($column == 'date_added') {
                        $data['items'][$item_key][$column] = date("d.m.Y", strtotime($result[$column]));
                    }   elseif ($column == 'currency_id') {
                        $data['items'][$item_key][$column] = $this->model('getCurrencyName', $result[$column]);
                    }   elseif ($column == 'amount') {
                        $data['items'][$item_key][$column] = $this->currency->format($result[$column], $this->config->get('config_currency'));
                    }    elseif ($column == 'type') {
                        $data['items'][$item_key][$column] = $this->model('getCrmType', $result[$column]);
                    }    elseif ($column == 'customer_id') {
                        $data['items'][$item_key][$column] = $this->model('getCustomerName', $result[$column]);
                    }    elseif ($column == 'user_id') {
                        $data['items'][$item_key][$column] = $this->model('getUserName', $result[$column]);
                    }   elseif ($column == 'user_group_id') {
                        $data['items'][$item_key][$column] = $this->model('getUserGroupName', $result[$column]);
                    } else {
                        $data['items'][$item_key][$column] = $result[$column];
                        $data['items'][$item_key]['edit'] = isset($result['id']) ? $this->url->link($this->module_folder.'/edit&table='.$table, $this->admin_token . '&id=' . $result['id']) : '#';
                    }

                }
            }
		}

		if (isset($this->request->post['selected'])) {
			$data['selected'] = (array)$this->request->post['selected'];
		} else {
			$data['selected'] = array();
		}


        ##  Фильтр
        $filter_data = array(
            'search'          => $search,
            'table'           => $table,
//            'sort'            => $sort,
//            'order'           => $order,
//            'start'           => ($page - 1) * $this->config->get('config_limit_admin'),
//            'limit'           => $this->config->get('config_limit_admin')
        );

        $total_items = $this->model('getTotalItemsCount', $filter_data);

        $pagination = new Pagination();
        $pagination->total = $total_items;
        $pagination->page = $page;
        $pagination->limit = $this->config->get('config_limit_admin'); $pagination->url = $this->url->link($pagination_module, $this->paginate_params  . '&page={page}', true);
        $data['pagination'] = $pagination->render();
        $data['results'] = sprintf($this->language->get('text_pagination'), ($total_items) ? (($page - 1) * $this->config->get('config_limit_admin')) + 1 : 0, ((($page - 1) * $this->config->get('config_limit_admin')) > ($total_items - $this->config->get('config_limit_admin'))) ? $total_items : ((($page - 1) * $this->config->get('config_limit_admin')) + $this->config->get('config_limit_admin')), $total_items, ceil($total_items / $this->config->get('config_limit_admin')));

        $data['sort'] = $sort;
        $data['order'] = $order;



        if (version_compare(VERSION, '2.3') >= 0) {
            $this->response->setOutput($this->load->view($this->module_folder.'/list', $data));
        } else {
            $this->response->setOutput($this->load->view($this->module_folder.'/list.tpl', $data));
        }

	}

	protected function getForm($table=false)
    {
        if (!$table) $table = $this->module_name;

        $data = $this->load_module_data();
        $data['table'] = $table;

        //  Form links
        $data['add_link'] = $this->url->link($this->module_folder.'/add&table='.$table, $this->admin_token, 'SSL');
        $data['edit_link'] = $this->url->link($this->module_folder.'/edit&table='.$table, $this->admin_token, 'SSL');

        if ($table == 'crmplan_tasks') {
            $data['heading_title'] = $this->language->get('heading_title_3');
            $data['breadcrumbs'][] = array(
                'text' => $this->language->get('text_tasks'),
                'href' => $data['tasks_link'],
            );
        } elseif ($table == 'crmplan_costs') {
            $data['heading_title'] = $this->language->get('heading_title_4');
            $data['text_status_4'] = $this->language->get('text_status_success');
            $data['breadcrumbs'][] = array(
                'text' => $this->language->get('text_costs'),
                'href' => $data['costs_link'],
            );
        } else {
            $data['heading_title'] = $this->language->get('heading_title_1');
            $data['text_status_4'] = $this->language->get('text_status_success');
            $data['breadcrumbs'][] = array(
                'text' => $this->language->get('text_list'),
                'href' => $data['list_link'],
            );
        }

        $data['breadcrumbs'][] = array(
            'text' => isset($this->request->get['id']) ? $this->language->get('text_edit') : $this->language->get('text_add'),
            'href' => $this->url->link($this->module_folder, $this->admin_token)
        );

        if (!isset($this->request->get['id'])) {
            $data['action'] = $this->url->link($this->module_folder.'/add&table='.$table, $this->admin_token , true);
        } else {
            $data['action'] = $this->url->link($this->module_folder.'/edit&table='.$table, $this->admin_token . '&id=' . $this->request->get['id'] , true);
        }

		if (isset($this->request->get['id']) && ($this->request->server['REQUEST_METHOD'] != 'POST')) {
			$item_info = $this->model('getItem', array('id' => $this->request->get['id'] , 'table' => $table));
		}  else {
		    $item_info = array();
        }

        //  Пользовательские типы заданий
        if (isset($data['config']['crmplan_tasks']['type'])) {
            $data['types'] = explode(',', $data['config']['crmplan_tasks']['type']);
        } else {
            $data['types'] = array();
        }


		$data['token'] = $this->session->data['token'];


		//  Tab-history
        $data['histories'] = false;
        if (isset($this->request->get['id'])) {
            $results_history = $this->model('getHistoryLead', $this->request->get['id']);
            foreach ($results_history as $history) {
                $data['histories'][] = array(
                    'comment' => $history['comment'],
                    'id' => $history['id'],
                    'created_at' => $history['created_at'],
                    'user_name' => $this->model('getUserName', $history['user_id'])
                );
            }
        } else {
            $data['histories'] = false;
        }


		//  Tab-customer
        $data['customer_id'] = false;
        $data['customer_info'] = false;
		$data['customer_name'] = false;

		##  Вывод значений
        $data['columns'] = array();
		$columns = $this->model('getColumns',$table);
		if ($columns) {
            foreach ($columns as $key => $column) {
                if ($column == 'customer_id' && isset($this->request->get['id'])) {
                    $data['customer_info'] = $this->model('getCustomerInfo', $item_info[$column]);
                    $data['customer_name'] = $this->model('getCustomerName', $item_info[$column]);
                    $data['customer_id'] = $item_info[$column];
                }
                $data['columns'][$key]['name'] = $column;
                $data['columns'][$key]['value'] = isset($item_info[$column]) ? $item_info[$column] : '';
                $data['columns'][$key]['translate'] = $this->language->get('column_'.$column) ? $this->language->get('column_'.$column) : $column;
		    }
        }


        #   Картинка
        if (isset($item_info['image'])) {
            if (isset($this->request->post['image']) && is_file(DIR_IMAGE . $this->request->post['image'])) {
                $data['thumb'] = $this->model_tool_image->resize($this->request->post['image'], 100, 100);
            } elseif (!empty($item_info) && is_file(DIR_IMAGE . $item_info['image'])) {
                $data['thumb'] = $this->model_tool_image->resize($item_info['image'], 100, 100);
            } else {
                $data['thumb'] = $this->model_tool_image->resize('no_image.png', 100, 100);
            }
        } else {
            $data['thumb'] = $this->model_tool_image->resize('no_image.png', 100, 100);
        }

        $data['placeholder'] = $this->model_tool_image->resize('no_image.png', 100, 100);

        if (version_compare(VERSION, '2.3') >= 0) {
            $this->response->setOutput($this->load->view($this->module_folder.'/form', $data));
        } else {
            $this->response->setOutput($this->load->view($this->module_folder.'/form.tpl', $data));
        }

	}



	## НАСТРОЙКИ
    ####################################################################

    public function settings(){

        $data = $this->load_module_data();


        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('text_settings'),
            'href' => $data['settings_link'],
        );

        $this->load->model('setting/setting');

        if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
            $setData = array(
                $this->module_name => $this->request->post
            );
            $this->model_setting_setting->editSetting($this->module_name, $setData);
            $this->session->data['success'] = $this->language->get('text_success');
            $this->response->redirect($this->url->link($this->module_folder.'/settings', $this->admin_token, 'SSL'));
        }

        ##  Вывод колонок
        $data['columns'] = array();

        $columns = $this->model('getColumns');
        if (is_array($columns)) {
            foreach ($columns as $key => $column) {
                if (isset($column)) {
                    if ($column != 'id') {
                        $data['columns'][$key]['name'] = $column;
                        $data['columns'][$key]['translate'] = $this->language->get('column_'.$column) ? $this->language->get('column_'.$column) : $column;
                    }
                }
            }
            #   Доп колонки
            //$data['columns'][] = 'edit';
        }


        ##  Вывод колонок crmplan_tasks
        $data['columns_tasks'] = array();

        $columns = $this->model('getColumns', 'crmplan_tasks');

        if (is_array($columns)) {
            foreach ($columns as $key => $column) {
                if (isset($column)) {
                    if ($column != 'id') {
                        $data['columns_tasks'][$key]['name'] = $column;
                        $data['columns_tasks'][$key]['translate'] = $this->language->get('column_'.$column) ? $this->language->get('column_'.$column) : $column;
                    }
                }
            }
            #   Доп колонки
            //$data['columns'][] = 'edit';
        }

        ##  Вывод колонок crmplan_costs
        $data['columns_costs'] = array();

        $columns = $this->model('getColumns', 'crmplan_costs');

        if (is_array($columns)) {
            foreach ($columns as $key => $column) {
                if (isset($column)) {
                    if ($column != 'id') {
                        $data['columns_costs'][$key]['name'] = $column;
                        $data['columns_costs'][$key]['translate'] = $this->language->get('column_'.$column) ? $this->language->get('column_'.$column) : $column;
                    }
                }
            }
            #   Доп колонки
            //$data['columns'][] = 'edit';
        }


        $data['action'] = $this->url->link($this->module_folder.'/settings', $this->admin_token, 'SSL');

        if (version_compare(VERSION, '2.3') >= 0) {
            $this->response->setOutput($this->load->view($this->module_folder.'/settings', $data));
        } else {
            $this->response->setOutput($this->load->view($this->module_folder.'/settings.tpl', $data));
        }

    }
	protected function validateForm()
    {
		if (!$this->user->hasPermission('modify', $this->module_folder)) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

		if ($this->error && !isset($this->error['warning'])) {
			$this->error['warning'] = $this->language->get('error_warning');
		}

		return !$this->error;
	}


    ##############################################################################
    public function model($method,$params=array()) {
        $this->load->model($this->module_folder);
        $model_folder = explode('/',$this->module_folder);
        $model_folder = 'model_'.implode('_',$model_folder);
        $model = $this->registry->get($model_folder);
        return $model->$method($params);
    }






    ##############################################################################
    ## MODULE METHODS
    ##############################################################################
    public function checkStatus() {
        $json = array();
        if ($this->request->server['REQUEST_METHOD'] == 'POST' && $this->validateForm()) {
            if (isset($this->request->post['status'])) {
                $update = $this->model('edit',$this->request->post);
                if ($update) {
                    $json['success'] = 'Обновлено';
                }
            }
        } else {
            $json['error'] = $this->error['warning'];
        }
        $this->response->setOutput(json_encode($json));

    }

    public function addComment() {
        $json = array();
        if ($this->request->server['REQUEST_METHOD'] == 'POST' && $this->validateForm()) {
            if (isset($this->request->post['comment']) && isset($this->request->post['lead_id'])) {
                $add = $this->model('addComment',$this->request->post);
                if ($add) {
                    $json['success'] = 'Добавлено';
                    $json['lead_history'] = '';

                    $lead_history = $this->model('getHistoryLead',$this->request->post['lead_id']);

                    foreach ($lead_history as $history) {
                        $json['lead_history'] .= '<tr>';
                        $json['lead_history'] .= '<td class="text-left">'.$history['comment'].'</td>';
                        $json['lead_history'] .= '<td class="text-left">'.$this->model('getUserName', $history['user_id']).'</td>';
                        $json['lead_history'] .= '<td class="text-left">'.$history['created_at'].'</td>';
                        $json['lead_history'] .= '<td class="text-right"><a onclick="deleteHistory('.$history['id'].')" class="btn btn-danger"><i class="fa fa-trash"></i></a> </td>';
                        $json['lead_history'] .= '</tr>';
                     }
                }
            }
        } else {
            $json['error'] = $this->error['warning'];
        }
        $this->response->setOutput(json_encode($json));

    }

    public function deleteHistory() {
        $json = array();
        if ($this->request->server['REQUEST_METHOD'] == 'POST' && $this->validateForm()) {
            if (isset($this->request->post['id'])) {
                $delete = $this->model('deleteHistory',$this->request->post);
                if ($delete) {
                    $json['success'] = 'Удалено';
                    $json['lead_history'] = '';

                    $lead_history = $this->model('getHistoryLead',$this->request->post['lead_id']);

                    foreach ($lead_history as $history) {
                        $json['lead_history'] .= '<tr>';
                        $json['lead_history'] .= '<td class="text-left">'.$history['comment'].'</td>';
                        $json['lead_history'] .= '<td class="text-left">'.$this->model('getUserName', $history['user_id']).'</td>';
                        $json['lead_history'] .= '<td class="text-left">'.$history['created_at'].'</td>';
                        $json['lead_history'] .= '<td class="text-right"><a onclick="deleteHistory('.$history['id'].')" class="btn btn-danger"><i class="fa fa-trash"></i></a> </td>';
                        $json['lead_history'] .= '</tr>';
                    }
                }
            }
        } else {
            $json['error'] = $this->error['warning'];
        }
        $this->response->setOutput(json_encode($json));

    }

    public function autocomplete() {
        $json = array();

        if (isset($this->request->get['search']) && isset($this->request->get['type'])) {

            if (isset($this->request->get['search'])) {
                $search = $this->request->get['search'];
            } else {
                $search = '';
            }


            $filter_data = array(
                'search'  => $search,
                'start'        => 0,
                'limit'        => 5
            );

            switch ($this->request->get['type']) {
                case 'user':
                    $results = $this->model('getUsers', $filter_data);
                    foreach ($results as $result) {
                        $json[] = array(
                            'id'       => $result['user_id'],
                            'name'              => strip_tags(html_entity_decode($result['firstname'] . ' ' .$result['lastname'], ENT_QUOTES, 'UTF-8')),
                        );
                    }
                    break;
                case 'user_group':
                    $results = $this->model('getUserGroups', $filter_data);
                    foreach ($results as $result) {
                        $json[] = array(
                            'id'       => $result['user_group_id'],
                            'name'              => strip_tags(html_entity_decode($result['name'], ENT_QUOTES, 'UTF-8')),
                        );
                    }
                    break;

                case 'status':
                    $results = $this->model('getStatus', $filter_data);
                    foreach ($results as $key => $result) {
                        $json[] = array(
                            'id'       => $result['id'],
                            'name'              => strip_tags(html_entity_decode($result['name'], ENT_QUOTES, 'UTF-8')),
                        );
                    }
                    break;


                case 'type':
                    $results = $this->model('getType', $filter_data);
                    foreach ($results as $key => $result) {
                        $json[] = array(
                            'id'       => $result['id'],
                            'name'              => strip_tags(html_entity_decode($result['name'], ENT_QUOTES, 'UTF-8')),
                        );
                    }
                    break;

                default:
                    // code...
                    break;
            }



        }

        $sort_order = array();

        foreach ($json as $key => $value) {
            $sort_order[$key] = $value['name'];
        }

        array_multisort($sort_order, SORT_ASC, $json);

        $this->response->addHeader('Content-Type: application/json');
        $this->response->setOutput(json_encode($json));
    }








}

?>