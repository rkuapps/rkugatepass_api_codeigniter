<?php 
      

  $managePage = " Change Password"; 

  $userid=$this->session->userdata['logged_in']['userid'];
1
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <?php 
   $this->load->view('Includes/head');
    ?>
  </head>

  <body>
    <?php 
     $this->load->view('Includes/leftpanel');
     $this->load->view('Includes/header');
    ?>  


    <!-- ########## START: MAIN PANEL ########## -->
    <div class="br-mainpanel">
      <?php 
       // breadcrumb($sitepath,$currentPage,$subpage,$sublink);
       
      ?>

      <div class="pd-x-15 pd-t-15">
      
        <h4 class="tx-gray-800 mg-b-5"><?=$managePage?></h4>
        <p class="mg-b-0"></p>
      </div>

      <div class="br-pagebody">
      
        <div class="br-section-wrapper pd-t-15">
          <?php echo form_open('Auth/change_password', ['name' => 'frm1', 'id'=>'userform', 'enctype' => 'multipart/form-data', 'class' => 'stdform']); ?>
        <div class="form-layout ">
            <div class="row mg-b-25">
          <?php 
            
            editbox('6','password','Old Password','old','Enter Old Password','','','required');
            echo "<div class='col-md-6'></div>";
            editbox('6','password','New Password','new','Enter New Password','','','pattern="^.{6}.*$" required');
            echo "<div class='col-md-6'></div>";
            editbox('6','password','Cofirm Password','new_confirm','Enter Confirm Password','','','pattern="^.{6}.*$" required');
          ?>
            </div><!-- row -->
            <input type="hidden" name="user_id" value="<?=$userid?>" id="user_id"  />
      <p><?php echo form_submit(['value'=>'Change Password','name'=>'submit','id'=>'submit','class'=>'btn btn-primary']);?></p>

          </div><!-- form-layout -->
          <?php form_close(); ?>

        </div>

      </div>

      <?php
        $this->load->view('Includes/footer');
      ?>
    </div><!-- br-mainpanel -->
    

<?php 

$this->load->view('Includes/footerscript');
?>

<script>
$('#userform').submit(function(e) {

   var user_type=$('#user_type').val();
   if(user_type==0)
   {
    e.preventDefault();
    
    swal({
                        title: "Error",
                        text: "Select Role",
                        type: "error",
                        confirmButtonClass: "btn-danger"
                    });
            
   }
});   
</script>
  </body>
</html>
