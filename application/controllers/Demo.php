<?php
class Demo extends CI_Controller
{
    public function updatequotation()
    {
        $quotation=$this->Queries->getRecord('select * from '.TBL_QUOTATION);
        foreach($quotation as $post)
        {
            $quot = explode('-', $post->quotationno);
            $qut = explode('/', $quot[1]);
            $formdata=array(
                'qutid'=>$qut[1]
            );
            $this->Queries->updateRecord(TBL_QUOTATION,$formdata,$post->id);
        }
    }
}
?>