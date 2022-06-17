<?php
class Profile extends CI_Controller
{    public function __construct()
    {
        parent::__construct();
        if (!isset($this->session->userdata['logged_in'])) {
            redirect('');
        }
    }    
	
	public function index()
    {        $userid=$this->session->userdata['logged_in']['userid'];
        
        $userdata=$this->Queries->getSingleRecord('select * from '.TBL_USERINFO." where isdelete=0 and id=".$userid);
        $this->load->view('Auth/profile',['userdata'=>$userdata]);
     
    }    
	
	public function save()
 	{
 		$this->form_validation->set_rules('user_email','Email','required');
 		$this->form_validation->set_rules('user_mob','Mobile No','required');
 		if($this->form_validation->run())
 		{ 			
 			$data= $this->input->post();
 			$user_fullname = StringRepair($data['user_fullname']);
 			$user_email = StringRepair($data['user_email']);
 			$user_mob = StringRepair($data['user_mob']);
 			$userdata = $this->session->userdata['logged_in'];
 			$today = date('Y-m-d H:i:s');            
            $updated_by = $this->session->userdata['logged_in']['userid'];
 			$id = $userdata['userid'];
 			if($id!="" && $id!=0)
 			{
 				/*------------------------ User Profile Upload --------------------------- */
 				$config['upload_path']= './uploads/';
	            $config['allowed_types'] = 'gif|jpg|png|jpeg';
	            $this->load->library('upload', $config);
	            $user_image = "";            
	            if (!$this->upload->do_upload('user_image'))
	            {
	                $this->session->set_flashdata('success_msg', $this->upload->display_errors());
	            }
	            else
	            {
	               $data1 = array('upload_data' => $this->upload->data());
	                $user_image =  "uploads/".$data1["upload_data"]["file_name"];
	            }
	            if($user_image != ""){
                    $form_data = array(
                        'user_image'=>$user_image
                    );
                    $this->Queries->updateRecord(TBL_USERINFO, $form_data, $id);
                }
                /*------------------------ End User Profile Upload --------------------------- */
 				$form_data = array(
 					'user_fullname'=>$user_fullname,
 					'user_email'=>$user_email,
 					'user_mob'=>$user_mob,
 					'created_by'=>$updated_by,
                    'updated_by'=>$updated_by,
                    'updated_on'=>$today
 				);
 				$this->Queries->updateRecord(TBL_USERINFO,$form_data,$id);
                 
                 $this->session->userdata['logged_in']['user_fullname']=$user_fullname;
                 if($user_image!=""){
                $this->session->userdata['logged_in']['user_image']=$user_image;
                 }                 
 			}
 			else
 			{
 				$this->session->set_flashdata('error_msg','No Record Found...');
 				return redirect('Profile');
 			}
 		}
 		else
 		{
 			$this->session->set_flashdata('error_msg','Failed to Edit User Data ...	');
 			return redirect('Profile');
 		}
 		$this->session->set_flashdata('success_msg','Profile Updated Successfully');
 		return redirect('Profile');
 	}
    
}
