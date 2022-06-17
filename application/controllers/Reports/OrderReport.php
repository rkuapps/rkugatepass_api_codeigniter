<?php
class OrderReport extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        if (!isset($this->session->userdata['logged_in'])) {
            redirect('');
        }
        $this->load->model('Report_model', 'REPORT');
    }

    public function index()
    {
        $params = array();
        $searchtxt = array();

        if (!check_role_assigned('order_report', 'view')) {
            redirect('forbidden');
        }
        $searchtxt['start_date'] = date('Y-m-01');
        $searchtxt['end_date'] = date('Y-m-t');
        $search = $this->input->post();

        if ($search['start_date'] != "" && $search['start_date'] != "") {
            $searchtxt['start_date'] = date_create_from_format('d/m/Y', $search['start_date']);
            $searchtxt['start_date'] = date_format($searchtxt['start_date'], 'Y-m-d');
        }
        if ($search['end_date'] != "" && $search['end_date'] != "") {
            $searchtxt['end_date'] = date_create_from_format('d/m/Y', $search['end_date']);
            $searchtxt['end_date'] = date_format($searchtxt['end_date'], 'Y-m-d');
        }
        if ($search['customerid'] != "" && $search['customerid'] != 0) {
            $searchtxt['customerid'] = StringRepair($search['customerid']);
        }
        $params['search'] = $search;

        $query = "select * from " . TBL_CUSTOMER . " where isdelete=0";
        $params['customerlist'] = $this->Queries->get_tab_list($query, 'id', 'customer_name');
        $params['OrderReport'] = $this->REPORT->getOrderReport($searchtxt);
        $this->load->view('Reports/OrderReport/index', $params);
    }
}
