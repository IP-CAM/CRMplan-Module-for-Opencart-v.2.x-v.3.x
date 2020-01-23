<?php
class ModelSmartcoderCrmplan extends Model {

    private $module_name = 'crmplan';

    /**
     *  Таблицы
     */
    protected $table = 'crmplan';
    protected $table2 = 'crmplan_history';
    protected $table3 = 'crmplan_tasks';
    protected $table4 = 'crmplan_costs';

    /**
     *  Порядок показа колонок:
     *  Необходимо заполнить, если нужен порядок
     *  Если выводить все колонки - заккоменитировать содержимое
     */
    protected $order_columns = array(
        //'id', 'name', 'date_added'
        //'id','name',
    );

    ##	INSTALL TABLE
    ####################################################################

    public function install_table() {

        $sql = "CREATE TABLE `".DB_DATABASE."`.`".DB_PREFIX.$this->table."` ( 
                `id` INT AUTO_INCREMENT , 
                `name` VARCHAR(255) NULL , 
                `description` TEXT NULL , 
                `amount` decimal(15,0) NULL,
                `customer_id` int(11) NULL,
                `user_id` int(11) NULL,
		        `user_group_id` int(11) NULL,
                `status` int(1) NULL DEFAULT 1,
		        `created_at` DATE NULL , 
                PRIMARY KEY (`id`)) ENGINE = MyISAM;";
        $query = $this->db->query( $sql );
    }

    public function install_table2() {

        $sql = "CREATE TABLE `".DB_DATABASE."`.`".DB_PREFIX.$this->table2."` ( 
              `id` INT AUTO_INCREMENT , 
              `lead_id` int(11) DEFAULT NULL,
              `action` varchar(255) DEFAULT NULL,
              `comment` text,
              `user_id` int(11) DEFAULT NULL,
              `crm_company_id` int(11) DEFAULT NULL,
              `company_id` int(11) DEFAULT NULL,
              `customer_id` int(11) DEFAULT NULL,
              `affiliate_id` int(11) DEFAULT NULL,
              `name` varchar(255) DEFAULT NULL,
              `description` varchar(255) DEFAULT NULL,
              `amount` decimal(10,0) DEFAULT NULL,
              `status` int(11) DEFAULT NULL,
              `currency_id` int(11) DEFAULT NULL,
              `order_id` int(11) DEFAULT NULL,
              `creator_user_id` int(11) DEFAULT NULL,
              `created_at` datetime DEFAULT NULL,
              `updated_at` datetime DEFAULT NULL,
                PRIMARY KEY (`id`)) ENGINE = InnoDB;";
        $query = $this->db->query( $sql );
    }

    public function install_table3() {

        $sql = "CREATE TABLE `".DB_DATABASE."`.`".DB_PREFIX.$this->table3."` ( 
                `id` INT AUTO_INCREMENT , 
                `name` VARCHAR(255) NULL , 
                `description` TEXT NULL , 
                `user_id` int(11) NULL,
		        `user_group_id` int(11) NULL,
		        `type` int(11) NULL,
                `status` int(1) NULL DEFAULT 1,
		        `created_at` DATE NULL , 
                PRIMARY KEY (`id`)) ENGINE = MyISAM;";
        $query = $this->db->query( $sql );
    }

    public function install_table4() {

        $sql = "CREATE TABLE `".DB_DATABASE."`.`".DB_PREFIX.$this->table4."` ( 
                `id` INT AUTO_INCREMENT , 
                `name` VARCHAR(255) NULL , 
                `description` TEXT NULL , 
                `amount` decimal(15,0) NULL,
                `customer_id` int(11) NULL,
                `user_id` int(11) NULL,
		        `user_group_id` int(11) NULL,
                `status` int(1) NULL DEFAULT 1,
		        `created_at` DATE NULL , 
                PRIMARY KEY (`id`)) ENGINE = MyISAM;";
        $query = $this->db->query( $sql );
    }




    public function __construct( $registry ){
        parent::__construct( $registry );
        $this->checkInstall();
    }


    ##	CHECK TABLE
    ####################################################################
    public function checkInstall()
    {
        //  Install Table1
        $sql = " SHOW TABLES LIKE '" . DB_PREFIX . $this->table."'";
        $query = $this->db->query($sql);

        if (count($query->rows) <= 0) {
            $this->install_table();
        }

        //  Install Table2
        $sql = " SHOW TABLES LIKE '" . DB_PREFIX . $this->table2."'";
        $query = $this->db->query($sql);

        if (count($query->rows) <= 0) {
            $this->install_table2();
        }

        //  Install Table3
        $sql = " SHOW TABLES LIKE '" . DB_PREFIX . $this->table3."'";
        $query = $this->db->query($sql);

        if (count($query->rows) <= 0) {
            $this->install_table3();
        }

        //  Install Table4
        $sql = " SHOW TABLES LIKE '" . DB_PREFIX . $this->table4."'";
        $query = $this->db->query($sql);

        if (count($query->rows) <= 0) {
            $this->install_table4();
        }
    }

    ##	CHECK COLUMN
    ####################################################################
    public function checkColumn($column_name, $table = false)
    {

        if (!$table) {
            $table = $this->table;
        }

        $sql = "SELECT '".$column_name."' FROM information_schema.COLUMNS WHERE TABLE_SCHEMA='".DB_DATABASE."' AND TABLE_NAME='".DB_PREFIX.$table."' AND COLUMN_NAME='".$column_name."'";
        $query = $this->db->query($sql);

        if (isset($query->row[$column_name])) {
            $res= true;
        } else {
            $res= false;
        }

        return $res;

    }

    ##	GET COLUMNS
    ####################################################################
    public function getColumns($table = false){

        if (!$table) {
            $table = $this->table;
        }

        $this->checkInstall();

        $columns = array();

        $sql = "SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_NAME = '".DB_PREFIX.$table."' ";

        $query = $this->db->query($sql);


        if (isset($query->rows)) {
            foreach ($query->rows as $column) {
                if (isset($column['COLUMN_NAME'])) {
                    if ($this->order_columns) {
                        foreach ($this->order_columns as $item) {
                            if ($this->checkColumn($item)) {
                                if ($item == $column['COLUMN_NAME']) {
                                    $columns[] = $column['COLUMN_NAME'];
                                }
                            }
                        }
                    } else {
                        $columns[] = $column['COLUMN_NAME'];
                    }


                }
            }
        }

        return $columns;
    }

    public function add($data = array()){
        if(!empty($data)){

            if (!isset($data['table'])) {
                $table = $this->table;
            } else {
                $table = $data['table'];
            }


            $sql = "INSERT INTO ".DB_PREFIX.$table." SET ";

            $params = array();
            foreach( $data as $key => $value ){

                if ($this->checkColumn($key,$table)) {
                    $params[] = $key . " = '" . $this->db->escape($value) . "'";
                }
            }

            if ($this->checkColumn('date_added',$table)) {
                $params[] = 'date_added' . " = NOW()";
            }

            if ($this->checkColumn('created_at',$table)) {
                $params[] = 'created_at' . " = NOW()";
            }

            $sql .= implode(" , ",$params);

            $this->db->query( $sql );

            return true;


        }
        return false;
    }

    public function edit($data = array()){


        if((isset($this->request->get['id']) or isset($this->request->post['id']) ) && !empty($data)){

            if (!isset($data['table'])) {
                $table = $this->table;
            } else {
                $table = $data['table'];
            }

            if (isset($this->request->get['id'])) {
                $id = $this->request->get['id'];
            } elseif (isset($this->request->post['id'])) {
                $id = $this->request->post['id'];
            } else {
                return false;
            }

            $sql = "UPDATE ".DB_PREFIX.$table." SET ";

            $params = array();

            foreach( $data as $key => $value ){

                if ($this->checkColumn($key,$table)) {
                    $params[] = $key . " = '" . $this->db->escape($value) . "'";
                }
            }

            if (!$params) {
                return false;
            }

            $sql .= implode(" , ",$params);
            $sql .= " WHERE id = ".(int)$id;

            $this->db->query( $sql );
            return true;


        }
        return false;
    }



	public function delete($data = array('id' => false, 'table' => false)) {
        if (!$data['table']) {
            $table = $this->table;
        } else {
            $table = $data['table'];
        }

        $sql = "DELETE FROM " . DB_PREFIX . $table. " WHERE id = '" . (int)$data['id'] . "'";

		$this->db->query($sql);
	}

	public function getItem($data = array('id' => false, 'table' => false)) {

        if (!$data['table']) {
            $table = $this->table;
        } else {
            $table = $data['table'];
        }
        $sql = "SELECT DISTINCT * FROM " . DB_PREFIX . $table ." WHERE id = '" . (int)$data['id'] . "'";

		$query = $this->db->query($sql);

		return $query->row;
	}


	public function getItems($data = array()) {

        if (!isset($data['table'])) {
            $table = $this->table;
        } else {
            $table = $data['table'];
        }

        if ($this->order_columns && !isset($data['table'])) {
            $sql = "SELECT ".implode($this->order_columns,',')." FROM " . DB_PREFIX . $table;
        } else {
            $sql = "SELECT * FROM " . DB_PREFIX . $table;
        }

        $sql .= " WHERE id > 0";

        if (!empty($data['search'])) {
            foreach ($data['search'] as $key => $search) {
                if (!empty($search) or $search == 0) {
                    $sql .= " AND ".$key." LIKE '%" . $this->db->escape($search) . "%'";
                }
            }
        }

        if (!empty($data['filter_status'])) {
            $sql .= " AND status LIKE '" . $this->db->escape($data['filter_status']) . "%'";
        }

        if (!empty($data['filter_user_id'])) {
            $sql .= " AND user_id LIKE '" . $this->db->escape($data['filter_user_id']) . "%'";
        }

        if (!empty($data['filter_user_group_id'])) {
            $sql .= " AND user_group_id LIKE '" . $this->db->escape($data['filter_user_group_id']) . "%'";
        }

//        if (!empty($data['filter_type'])) {
//            $sql .= " AND type LIKE '" . $this->db->escape($data['filter_type']) . "%'";
//        }

        if (!empty($data['status_no_complite'])) {
            $sql .= " AND status != 4";
        }



        if (isset($data['sort'])) {
            $sql .= " ORDER BY " . $data['sort'];
        } else {
            $sql .= " ORDER BY id";
        }

        if (isset($data['order']) && ($data['order'] == 'DESC')) {
            $sql .= " DESC";
        } else {
            $sql .= " ASC";
        }

        if (isset($data['start']) || isset($data['limit'])) {
            if ($data['start'] < 0) {
                $data['start'] = 0;
            }

            if ($data['limit'] < 1) {
                $data['limit'] = 20;
            }

            $sql .= " LIMIT " . (int)$data['start'] . "," . (int)$data['limit'];
        }

        //var_dump($sql);die;

		$query = $this->db->query($sql);

		return $query->rows;
	}


	public function getTotalItemsCount($data = array()) {

        if (!isset($data['table'])) {
            $table = $this->table;
        } else {
            $table = $data['table'];
        }


        $sql = "SELECT COUNT(*) AS total FROM " . DB_PREFIX . $table;
        $sql .= " WHERE id > 0";

        if (!empty($data['search'])) {
            foreach ($data['search'] as $key => $search) {
                if (!empty($search) or $search == 0) {
                    $sql .= " AND ".$key." LIKE '%" . $this->db->escape($search) . "%'";
                }
            }
        }

		$query = $this->db->query($sql);

		return $query->row['total'];
	}



	///////////// MODULE METHODS

	//  Customer
    public function getCustomerInfo($customer_id) {

        if ($customer_id) {

            $sql = "SELECT c.*,cgd.name as group_name FROM " . DB_PREFIX . "customer c LEFT JOIN " . DB_PREFIX . "customer_group_description cgd ON (c.customer_group_id = cgd.customer_group_id) WHERE cgd.language_id = '" . (int)$this->config->get('config_language_id') . "'";

            $query = $this->db->query($sql);
            if (isset($query->row)) {
                $result = $query->row;
            } else {
                $result = false;
            }
        } else {
            $result = false;
        }

        return $result;
    }

    public function getCustomerName($customer_id) {

        if ($customer_id) {
            $name = '';
            $query = $this->db->query("SELECT * FROM " . DB_PREFIX ."customer WHERE customer_id = '".(int)$customer_id ."'");

            if (isset($query->row['firstname'])) {
                if (!empty($query->row['firstname'])) {
                    $name .= $query->row['firstname'];
                }
            }

            if (isset($query->row['lastname'])) {
                if (!empty($query->row['lastname'])) {
                    $name .= ' '.$query->row['lastname'];
                }
            }

        } else {
            $name = '';
        }


        return $name;
    }

    public function getUserName($user_id) {

        if ($user_id) {
            $name = '';
            $query = $this->db->query("SELECT * FROM " . DB_PREFIX ."user WHERE user_id = '".(int)$user_id ."'");

            if (isset($query->row['firstname'])) {
                if (!empty($query->row['firstname'])) {
                    $name .= $query->row['firstname'];
                }
            }

            if (isset($query->row['lastname'])) {
                if (!empty($query->row['lastname'])) {
                    $name .= ' '.$query->row['lastname'];
                }
            }

        } else {
            $name = '';
        }


        return $name;
    }

    public function getUserGroupName($user_group_id) {

        if ($user_group_id) {
            $name = '';
            $query = $this->db->query("SELECT * FROM " . DB_PREFIX ."user_group WHERE user_group_id = '".(int)$user_group_id ."'");

            if (isset($query->row['name'])) {
                if (!empty($query->row['name'])) {
                    $name .= $query->row['name'];
                }
            }

        } else {
            $name = '';
        }


        return $name;
    }

    public function getCurrencyName($currency_id) {

        if ($currency_id) {
            $name = '';
            $query = $this->db->query("SELECT * FROM " . DB_PREFIX ."currency WHERE currency_id = '".(int)$currency_id ."'");

            if (isset($query->row['code'])) {
                if (!empty($query->row['code'])) {
                    $name .= $query->row['code'];
                }
            }

        } else {
            $name = '';
        }


        return $name;
    }

    public function getCrmType($type_value, $name=false) {

        #	USER CONFIG
        $this->load->model('setting/setting');
        $config = $this->model_setting_setting->getSetting($this->module_name);

        $module_config = array();
        if (isset($config[$this->module_name]['config'])) {
            $module_config = $config[$this->module_name]['config'];
        }

        $type=array();


        if (isset($module_config['crmplan_tasks']['type'])) {
            $type = explode(',' , $module_config['crmplan_tasks']['type']);
            $name = isset($type[$type_value]) ? $type[$type_value] : '';
        }

//        echo "<pre>";
//        print_r($type);die;

        return $name;
    }

    public function getHistoryLead($lead_id) {
        $query = $this->db->query("SELECT * FROM " . DB_PREFIX . $this->table2." WHERE lead_id = '".(int)$lead_id ."' ORDER BY CREATED_AT DESC");
        return $query->rows;

    }

    public function addComment($data = array()){
        $sql = "INSERT INTO " . DB_PREFIX . $this->table2." SET 
            comment = '".$this->db->escape($data['comment'])."',
            created_at = NOW(),
            user_id = '".(int)$this->user->getId()."',
            lead_id = '".(int)$data['lead_id']."'
        ";
        return $query = $this->db->query($sql);


    }

    public function deleteHistory($data = array()){
        return $this->db->query("DELETE FROM " . DB_PREFIX . $this->table2. " WHERE id = '" . (int)$data['id'] . "'");
    }

    //////////////  DASHBOARD
    ///

    public function getSumLeads($data = array()) {
        $sql = "SELECT SUM(amount) as total FROM " . DB_PREFIX . $this->table;

        $sql .= " WHERE id > 0";

        if (!empty($data['filter_status'])) {
            $sql .= " AND status LIKE '" . $this->db->escape($data['filter_status']) . "%'";
        }

        if (!empty($data['filter_user_id'])) {
            $sql .= " AND user_id LIKE '" . $this->db->escape($data['filter_user_id']) . "%'";
        }

        if (!empty($data['filter_user_group_id'])) {
            $sql .= " AND user_group_id LIKE '" . $this->db->escape($data['filter_user_group_id']) . "%'";
        }

        if (!empty($data['filter_since'])) {
            $sql .= " AND DATE(created_at) >= '".$this->db->escape($data['filter_since'])."'";
        }

        if (!empty($data['filter_before'])) {
            $sql .= " AND DATE(created_at) <= '".$this->db->escape($data['filter_before'])."'";
        }
//
//        if (!empty($data['filter_currency'])) {
//            $sql .= " AND currency_id LIKE '" . $this->db->escape($data['filter_currency']) . "%'";
//        } else {
//            $sql .= " AND currency_id LIKE '" . $this->db->escape($this->config->get('config_currency')) . "%'";
//        }

        $query = $this->db->query($sql);

        $sum = !empty($query->row['total']) ? $query->row['total'] : 0;

        return $sum;



    }

    public function getCountLeads($data = array()) {
        $sql = "SELECT COUNT(id) as total FROM " . DB_PREFIX . $this->table;

        $sql .= " WHERE id > 0";

        if (!empty($data['filter_status'])) {
            $sql .= " AND status LIKE '" . $this->db->escape($data['filter_status']) . "%'";
        }

        if (!empty($data['filter_user_id'])) {
            $sql .= " AND user_id LIKE '" . $this->db->escape($data['filter_user_id']) . "%'";
        }

        if (!empty($data['filter_user_group_id'])) {
            $sql .= " AND user_group_id LIKE '" . $this->db->escape($data['filter_user_group_id']) . "%'";
        }

        if (!empty($data['filter_since'])) {
            $sql .= " AND DATE(created_at) >= '".$this->db->escape($data['filter_since'])."'";
        }

        if (!empty($data['filter_before'])) {
            $sql .= " AND DATE(created_at) <= '".$this->db->escape($data['filter_before'])."'";
        }

        $query = $this->db->query($sql);

        return $query->row['total'];



    }

    public function getTotalCustomers($data = array()) {
        $sql = "SELECT COUNT(customer_id) as total FROM " . DB_PREFIX . "customer";

        $sql .= " WHERE customer_id > 0";

        if (!empty($data['filter_since'])) {
            $sql .= " AND DATE(date_added) >= '".$this->db->escape($data['filter_since'])."'";
        }

        if (!empty($data['filter_before'])) {
            $sql .= " AND DATE(date_added) <= '".$this->db->escape($data['filter_before'])."'";
        }


        $query = $this->db->query($sql);

        return $query->row['total'];
    }

    public function getTotalLeads($data = array()) {
        $sql = "SELECT COUNT(id) as total FROM " . DB_PREFIX . $this->table;

        $sql .= " WHERE id > 0";

        if (!empty($data['filter_since'])) {
            $sql .= " AND DATE(created_at) >= '".$this->db->escape($data['filter_since'])."'";
        }

        if (!empty($data['filter_before'])) {
            $sql .= " AND DATE(created_at) <= '".$this->db->escape($data['filter_before'])."'";
        }


        $query = $this->db->query($sql);

        return $query->row['total'];
    }

    public function getTotalCosts($data = array()) {
        $sql = "SELECT COUNT(id) as total FROM " . DB_PREFIX . $this->table4;

        $sql .= " WHERE id > 0";

        if (!empty($data['filter_since'])) {
            $sql .= " AND DATE(created_at) >= '".$this->db->escape($data['filter_since'])."'";
        }

        if (!empty($data['filter_before'])) {
            $sql .= " AND DATE(created_at) <= '".$this->db->escape($data['filter_before'])."'";
        }


        $query = $this->db->query($sql);

        return $query->row['total'];
    }

    public function getTotalSumLeads($data = array()) {
        $sql = "SELECT SUM(amount) as total FROM " . DB_PREFIX . $this->table;

        $sql .= " WHERE id > 0";

        if (!empty($data['filter_since'])) {
            $sql .= " AND DATE(created_at) >= '".$this->db->escape($data['filter_since'])."'";
        }

        if (!empty($data['filter_before'])) {
            $sql .= " AND DATE(created_at) <= '".$this->db->escape($data['filter_before'])."'";
        }


        $query = $this->db->query($sql);

        return $query->row['total'];
    }



    public function getTotalSumCosts($data = array()) {
        $sql = "SELECT SUM(amount) as total FROM " . DB_PREFIX . $this->table4;

        $sql .= " WHERE id > 0";

        if (!empty($data['filter_since'])) {
            $sql .= " AND DATE(created_at) >= '".$this->db->escape($data['filter_since'])."'";
        }

        if (!empty($data['filter_before'])) {
            $sql .= " AND DATE(created_at) <= '".$this->db->escape($data['filter_before'])."'";
        }


        $query = $this->db->query($sql);

        return $query->row['total'];
    }

    public function getTotalProfit($data = array()) {
        $sql = "SELECT SUM(amount) as total FROM " . DB_PREFIX . $this->table;

        $sql .= " WHERE id > 0";

        if (!empty($data['filter_since'])) {
            $sql .= " AND DATE(created_at) >= '".$this->db->escape($data['filter_since'])."'";
        }

        if (!empty($data['filter_before'])) {
            $sql .= " AND DATE(created_at) <= '".$this->db->escape($data['filter_before'])."'";
        }


        $query = $this->db->query($sql);

        $result1 = $query->row['total'];


        $sql = "SELECT SUM(amount) as total FROM " . DB_PREFIX . $this->table4;

        $sql .= " WHERE id > 0";

        if (!empty($data['filter_since'])) {
            $sql .= " AND DATE(created_at) >= '".$this->db->escape($data['filter_since'])."'";
        }

        if (!empty($data['filter_before'])) {
            $sql .= " AND DATE(created_at) <= '".$this->db->escape($data['filter_before'])."'";
        }


        $query = $this->db->query($sql);

        $result2 = $query->row['total'];

        $result = $result1 - $result2;

        return $result;
    }

    public function getTopCustomers() {
        $sql = "SELECT cus.customer_id, cus.firstname, cus.lastname, (SELECT SUM(amount) FROM " .DB_PREFIX . $this->table ." WHERE customer_id = cus.customer_id) as amount, (SELECT count(id) FROM " .DB_PREFIX . $this->table ." WHERE customer_id = cus.customer_id) as count FROM " .DB_PREFIX ."customer cus ORDER BY amount DESC LIMIT 10 ";
        $query = $this->db->query($sql);
        return $query->rows;
    }

    public function getTopUsers() {
        $sql = "SELECT usr.user_id, usr.firstname, usr.lastname, (SELECT SUM(amount) FROM " .DB_PREFIX . $this->table ." WHERE user_id = usr.user_id) as amount, (SELECT count(id) FROM " .DB_PREFIX . $this->table ." WHERE user_id = usr.user_id) as count FROM " .DB_PREFIX ."user usr ORDER BY amount DESC LIMIT 10 ";
        $query = $this->db->query($sql);
        return $query->rows;
    }

    public function getSummLeadsOnCurrentMonth($day)
    {
        $sql = "SELECT SUM(amount) as total FROM " . DB_PREFIX . $this->table;

        $sql .= " WHERE id > 0";

        $sql .= " AND DAY(created_at) = ". $day;
        $sql .= " AND MONTH(created_at) = ". date('m');
        $sql .= " AND YEAR(created_at) = ". date('Y');

        $query = $this->db->query($sql);

        return $query->row['total'];
    }

    public function getSummCostsOnCurrentMonth($day)
    {
        $sql = "SELECT SUM(amount) as total FROM " . DB_PREFIX . $this->table4;

        $sql .= " WHERE id > 0";

        $sql .= " AND DAY(created_at) = ". $day;
        $sql .= " AND MONTH(created_at) = ". date('m');
        $sql .= " AND YEAR(created_at) = ". date('Y');

        $query = $this->db->query($sql);

        return $query->row['total'];
    }

    public function getSummOnLastMonth($day)
    {
        $year = date('Y');
        $month = date('m');

        if ($month == 1) {
            $year = $year - 1;
            $month = 12;
        } else {
            $month = $month - 1;
        }

        $sql = "SELECT SUM(amount) as total FROM " . DB_PREFIX . $this->table;

        $sql .= " WHERE id > 0";

        $sql .= " AND DAY(created_at) = ". $day;
        $sql .= " AND MONTH(created_at) = ". $month;
        $sql .= " AND YEAR(created_at) = ". $year;

        $query = $this->db->query($sql);

        return $query->row['total'];
    }

    /// Autocomplete
    ///

    public function getUsers($data=array()) {

        $sql = "SELECT * FROM " . DB_PREFIX . "user ";

        $sql .= " WHERE user_id > 0";

        if (!empty($data['search'])) {

            //$sql .= " AND name LIKE '" . $this->db->escape($data['search']) . "%'";
            $sql .= " AND CONCAT(firstname, ' ', lastname) LIKE '%" . $this->db->escape($data['search']) . "%'";

        }

        if (isset($data['start']) || isset($data['limit'])) {
            if ($data['start'] < 0) {
                $data['start'] = 0;
            }

            if ($data['limit'] < 1) {
                $data['limit'] = 20;
            }

            $sql .= " LIMIT " . (int)$data['start'] . "," . (int)$data['limit'];
        }

        $query = $this->db->query($sql);

        return $query->rows;
    }

    public function getUserGroups($data=array()) {

        $sql = "SELECT * FROM " . DB_PREFIX . "user_group ";

        $sql .= " WHERE user_group_id > 0";

        if (!empty($data['search'])) {
            $sql .= " AND name LIKE '%" . $this->db->escape($data['search']) . "%'";
        }

        if (isset($data['start']) || isset($data['limit'])) {
            if ($data['start'] < 0) {
                $data['start'] = 0;
            }

            if ($data['limit'] < 1) {
                $data['limit'] = 20;
            }

            $sql .= " LIMIT " . (int)$data['start'] . "," . (int)$data['limit'];
        }

        $query = $this->db->query($sql);

        return $query->rows;
    }

    public function getStatus($data=array()) {


        $this->load->language('smartcoder/crmplan');
        $status_array = array(
            '1' => $this->language->get('text_status_1'),
            '2' => $this->language->get('text_status_2'),
            '3' => $this->language->get('text_status_3'),
            '4' => $this->language->get('text_status_4'),
            '5' => $this->language->get('text_status_5'),
            '6' => $this->language->get('text_status_6'),
        );

        $status_arr = array();
        foreach ($status_array as $key => $status) {
            $status_arr[] = array(
                'id' => $key,
                'name' => $status,
            );
        }

        return $status_arr;

    }

    public function getType($data=array()) {


        $this->load->language('smartcoder/crmplan');
        $status_array = array(
            '1' => $this->language->get('text_status_1'),
            '2' => $this->language->get('text_status_2'),
            '3' => $this->language->get('text_status_3'),
            '4' => $this->language->get('text_status_4'),
            '5' => $this->language->get('text_status_5'),
            '6' => $this->language->get('text_status_6'),
        );

        #	USER CONFIG
        $this->load->model('setting/setting');
        $config = $this->model_setting_setting->getSetting($this->module_name);

        $module_config = array();
        if (isset($config[$this->module_name]['config'])) {
            $module_config = $config[$this->module_name]['config'];
        }

        $type_array =array();

        if (isset($module_config['crmplan_tasks']['type'])) {
            $type_array = explode(',' , $module_config['crmplan_tasks']['type']);
        }

        $status_arr = array();
        foreach ($type_array as $key => $status) {
            $status_arr[] = array(
                'id' => $key,
                'name' => $status,
            );
        }

        return $status_arr;

    }



}

?>