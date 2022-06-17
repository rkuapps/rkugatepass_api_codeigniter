<?php
class Inventory extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model(Inventory_model);
		if (!isset($this->session->userdata['logged_in'])) {
			redirect('');
		}
		
    }

    /************************************** Display All Purchase Order **************************************/
    public function index()
	{
		$params = array();
		$searchtxt = array();
		$params['inventoryitemlist'] = $this->Inventory_model->getItem($searchtxt);
		$this->load->view('Inventory/index',$params);
	}
	/**************************************** Display All Inventory Entry *******************************************/
	public function log($id)
	{
		$params = array();
		$params['id']=$id;
		$searchtxt = array();
		$query='select * from '.TBL_CUSTOMER_ITEM.' where isdelete=0 and id='.$id;
		$params['items']=$this->Queries->getSingleRecord($query);
		$query="select * from ".TBL_INVENTORY." where isdelete=0 and item_id=".$id." order by id desc";
		$params['inventorylog'] =$this->Queries->getRecord($query);
		$this->load->view('Inventory/log',$params);
	}

	
}
?>