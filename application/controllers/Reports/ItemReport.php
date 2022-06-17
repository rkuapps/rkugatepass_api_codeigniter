<?php
class ItemReport extends CI_Controller
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

        if (!check_role_assigned('item_report', 'view')) {
            redirect('forbidden');
        }

        $search = $this->input->post();

        if ($search['customerid'] != "" && $search['customerid'] != 0) {
            $searchtxt['customerid'] = StringRepair($search['customerid']);
        }
        $params['search'] = $searchtxt;
        $query = "select * from " . TBL_CUSTOMER . " where isdelete=0";
        $params['customerlist'] = $this->Queries->get_tab_list($query, 'id', 'customer_name');
        $params['itemreport'] = $this->REPORT->getItemReport($searchtxt);
        $this->load->view('Reports/ItemReport/index', $params);
    }
}
