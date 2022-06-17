<?php 

  $currentPage="Item Category";
  $PageBack=base_url()."Settings/ItemCategory/";
  $PageSave=base_url()."Settings/ItemCategory/save";
  $pageBack=base_url()."Settings/ItemCategory/";
  $operation = "Add";
  if ($id != "" and is_numeric($id)) {
    $operation = "Edit";  
    $val_category_name= StringRepair3($ItemCategory->category_name);
    $val_hsn_code= StringRepair3($ItemCategory->hsn_code);
    $val_description= StringRepair3($ItemCategory->description);
  }
  $managePage = $operation . " Item Category"; 
?>
<!DOCTYPE html>
<html>
<head>
    <?php
    $this->load->view('Includes/head');
    $this->load->view('Includes/tablecss');
    ?>
</head>
<body class="ecommerce-page sb-l-m">
    <div id="main">
        <?php $this->load->view('Includes/hadernav'); ?>
        <?php $this->load->view('Includes/sidebar'); ?>
        <section id="content_wrapper">
        <header id="topbar">
            <div class="topbar-left">
                <ol class="breadcrumb">
                    <span class="glyphicon glyphicon-globe mr10" style="font-size: 14px;"></span>
                    <li class="crumb-active">
                        <a href="<?=$pageBack?>">
                            <span>Item Category</span>
                        </a>
                    </li>
                </ol>
            </div>
        </header>
            <section id="content" class="table-layout animated fadeIn">
                <div class="tray tray-center">
                    <?php 
                     echo form_open($PageSave, ['name' => 'frm1', 'id' => 'ItemCategoryfrom', 'enctype' => 'multipart/form-data', 'class' => 'stdform']); 
                    ?>
                        <div class="panel">
                            <div class="panel-heading">
                                <span class="panel-title">
                                    <?php 
                                        echo $managePage;
                                    ?>
                                </span>
                            </div>
                             <input type="hidden" name="id" value="<?= $id; ?>">
                            <div class="panel-body">
                                <?php 
                                    editbox('6','Category Name','category_name','Enter Category Name',$val_category_name,'required');
                                    textareabox('12','Description','description','Enter Description',$val_description);
                                ?>
                            </div>
                            <div class="panel-footer">
                                <?php 
                                    Submitbutton($pageBack);
                                ?>
                            </div>
                        </div>
                    <?php 
                        echo form_close();
                    ?>
                </div>
            </section>
            <?php $this->load->view('Includes/footer'); ?>
        </section>
    </div>
    <?php
    $this->load->view('Includes/footerscript'); 
    $this->load->view('Includes/tablejs');
    ?>
<script type="text/javascript">
    jQuery(document).ready(function() {
        "use strict";
        Core.init();
        Demo.init();
        $(".select2-single").select2();
            $('.datetimepicker').datepicker({
                dateFormat: 'dd/mm/yy'
        });
$('#ItemCategoryfrom').submit(function(e){
    var countryid=$('#countryid').val();
    if(countryid==0)
    {
        iseditable
        alertbox('Error',"Select Country",'danger');
    }
});
});
    </script>
</body>
</html>