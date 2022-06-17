<?php
class Financial extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if (!isset($this->session->userdata['logged_in'])) {
            redirect('');
        }
        
    }

    // Display  Dashboard
    public function index()
    {
        $today=date('Y-m-d H:i:s');
        if($today >=date('Y-04-01'))
        {
            $start_date=date('Y-04-01');
            $end_date=date('Y-03-31',strtotime("+1 Years"));
        }
        else{
            $start_date=date('Y-04-01',strtotime("-1 Years"));
            $end_date=date('Y-03-31');
        }
        $companydetail=$this->Queries->getRecord('select * from '.TBL_COMPANY_MANAGEMENT.' where isdelete=0');
        foreach($companydetail as $data)
        {
            
            $res1=$this->Queries->getSingleRecord('select * from '.TBL_FINANCIAL_YEAR.' where isdelete=0 and company_id='.$data->id.' and start_date>="'.$start_date.'"');
        

            if($res1==null)
            {
               
            $ms_value=80;
            if($today >=date('Y-04-01'))
            {
                $name=date('Y')."-".date('y',strtotime("+1 Years"));
            }
            else{
                $name=date('Y',strtotime("-1 Years"))."-".date('y');
            }
            $companyname='FinancialYear-'.$name;
            $form_data = array(
                            'name' => $name,
                            'company_id'=> $data->id,
                            'company_name' => $companyname,
                            'ms_value'=>$ms_value,
                            'start_date' => $start_date,
                            'end_date'=>$end_date,
                            'created_by' => $this->session->userdata['logged_in']['userid'],
                            'updated_by' => $this->session->userdata['logged_in']['userid'],
                            'updated_on' => $today
                        );
        
                    $this->Queries->addRecord(TBL_FINANCIAL_YEAR, $form_data);
            }
        }
        $current_date=date('Y-m-d');
        $query='select * from '.TBL_FINANCIAL_YEAR.' where isdelete=0 AND date(end_date)>="'.$current_date.'"';
        $res=$this->Queries->getSingleRecord($query);
        $params['current_year']=$res->id;
    
        $userinfo=$this->Queries->getSingleRecord('select * from '.TBL_USERINFO.' where isdelete=0 AND id='.$this->session->userdata['logged_in']['userid']);
        if($userinfo->user_type==1)
        {
            $query = "select * from ".TBL_FINANCIAL_YEAR. " where isdelete=0";
        }
        
        $params['finlist']=$this->Queries->get_tab_list2($query,'id','company_name');
        $this->load->view('Financial',$params);
        
    }
    public function add()
    {
        $this->form_validation->set_rules('finid', 'FinancialYear', 'required');
        if ($this->form_validation->run()) {
            $finid= StringRepair($this->input->post('finid'));

            $companydetail=$this->Queries->getSingleRecord('select * from '.TBL_FINANCIAL_YEAR.' where isdelete=0 and id='.$finid);
            
                    $data=array(
                                    'id'=>$companydetail->id,
                                    'companyid'=>$companydetail->company_id,
                                    'name'=>$companydetail->name,
                                    'ms_value'=>$companydetail->ms_value,
                                    'start_date'=>$companydetail->start_date,
                                    'end_date'=>$companydetail->end_date,
                                );
                $this->session->set_userdata('financial_year',$data);
        }
        redirect('Dashboard', 'refresh');
    }
}
?>