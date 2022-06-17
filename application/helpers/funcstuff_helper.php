<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
function StringRepair($temptext)
{
    $temptext = trim($temptext);
    $temptext=str_replace("'","&#39;",$temptext);
    $temptext=str_replace("\"","&#34;",$temptext);
    return $temptext;
}
function StringRepair3($temptext)
{
    $temptext=trim($temptext);
    $temptext=str_replace("&#39;","'",$temptext);
    $temptext=str_replace("&#34;","\"",$temptext);
    return $temptext;
}
function PageConfig($baseurl,$total_records,$limit_per_page,$uriseg){
    $config = array();
    // get current page records
    $config['base_url'] = $baseurl;
    $config['total_rows'] = $total_records;
    $config['per_page'] = $limit_per_page;
    $config["uri_segment"] = $uriseg;
	$config["num_links"] = 10;

    $config['full_tag_open'] = '<ul class="pagination">';
    $config['full_tag_close'] = '</ul>';

    $config['first_link'] = '« First';
    $config['first_tag_open'] = '<li class="prev page">';
    $config['first_tag_close'] = '</li>';

    $config['last_link'] = 'Last »';
    $config['last_tag_open'] = '<li class="next page">';
    $config['last_tag_close'] = '</li>';

    $config['next_link'] = 'Next';
    $config['next_tag_open'] = '<li class="next page">';
    $config['next_tag_close'] = '</li>';

    $config['prev_link'] = 'Previous';
    $config['prev_tag_open'] = '<li class="prev page">';
    $config['prev_tag_close'] = '</li>';

    $config['cur_tag_open'] = '<li class="active"><a href="">';
    $config['cur_tag_close'] = '</a></li>';

    $config['num_tag_open'] = '<li class="page">';
    $config['num_tag_close'] = '</li>';

    return $config;
}
function Actdeact($act){
    $btnval = "";
    if($act == 1):
        $btnval = '<button class="btn btn-primary pt5 pb5 mn" type="button">Activated</button>';
    else :
        $btnval = '<button class="btn btn-danger pt5 pb5 mn" type="button">Deactivated</button>';
    endif;

    return $btnval;
}

function alertbox(){
    $CI = & get_instance();
    if ($CI->session->flashdata('error_msg')!=""):
        $msg =  $CI->session->flashdata('error_msg');
        $CI->session->set_flashdata('error_msg',"");
        echo '  <script>
         new PNotify({
                title:"Error",
                text:"'.trim($msg).'" ,
                shadow: true,
                opacity: 1,
                addclass: "stack_top_right",
                styling: "fontawesome",
                type:"danger",
                stack: {
                    "dir1": "down",
                    "dir2": "left",
                    "push": "top",
                    "spacing1": 5,
                    "spacing2": 5
                },
                width: "auto",
                delay: 1000
            });  </script>';
    endif;
    if ($CI->session->flashdata('success_msg')!=""):
        $msg =  $CI->session->flashdata('success_msg');
        $CI->session->set_flashdata('success_msg',"");
            echo '  <script>
         new PNotify({
                title:"Success",
                text:"'.$msg.'" ,
                shadow: true,
                opacity: 1,
                addclass: "stack_top_right",
                styling: "fontawesome",
                type:"success",
                stack: {
                    "dir1": "down",
                    "dir2": "left",
                    "push": "top",
                    "spacing1": 5,
                    "spacing2": 5
                },
                width: "auto",
                delay: 1000
            });  </script>';
    endif;
    if ($CI->session->flashdata('info_msg')!=""):
        $msg =  $CI->session->flashdata('info_msg');
        $CI->session->set_flashdata('info_msg',"");
        echo '  <script>
         new PNotify({
                title:"Error",
                text:"'.trim($msg).'" ,
                shadow: true,
                opacity: 1,
                addclass: "stack_top_right",
                styling: "fontawesome",
                type:"info",
                stack: {
                    "dir1": "down",
                    "dir2": "left",
                    "push": "top",
                    "spacing1": 5,
                    "spacing2": 5
                },
                width: "auto",
                delay: 1500
            });  </script>';
    endif;
}

// function alertbox(){
//     $CI = & get_instance();
//     if ($msg =  $CI->session->flashdata('error_msg')):
//         echo '  <script>
//          new PNotify({
//                 title:"Error",
//                 text:"'.trim($msg).'" ,
//                 shadow: true,
//                 opacity: 1,
//                 addclass: "stack_top_right",
//                 type:"danger",
//                 stack: {
//                     "dir1": "down",
//                     "dir2": "left",
//                     "push": "top",
//                     "spacing1": 10,
//                     "spacing2": 10
//                 },
//                 width: "290px",
//                 delay: 1500
//             });  </script>';
//     endif;
//     if ($msg = $CI->session->flashdata('success_msg')) :
//             echo '  <script>
//          new PNotify({
//                 title:"Success",
//                 text:"'.$msg.'" ,
//                 shadow: true,
//                 opacity: 1,
//                 addclass: "stack_top_right",
//                 type:"success",
//                 stack: {
//                     "dir1": "down",
//                     "dir2": "left",
//                     "push": "top",
//                     "spacing1": 10,
//                     "spacing2": 10
//                 },
//                 width: "290px",
//                 delay: 1500
//             });  </script>';
//     endif;
// }


function manageheader($managePage,$addPage,$addButton,$icon='',$exportPage="",$exportButton=""){
    $action="";
    if($icon==''){
        $icon="plus";
    }
    if($icon=='print'){
        $action="_blank";
    }
    echo '<header id="topbar">
                <div class="topbar-left">
                    <ol class="breadcrumb">
                        <li class="crumb-active"><a>'.$managePage.'</a></li>
                    </ol>
                </div>';
    if($addPage != "" && $addButton != "") {
        echo '<div class="topbar-right" >
        '.anchor($addPage, '<span class="fa fa-'.$icon.' pr5" ></span > '.$addButton,['class'=>'btn btn-primary btn-gradient btn-alt mn','target'=>$action]).'
        </div >';
    }
	if($exportPage != "" && $exportButton != "") {
		echo '<div class="topbar-right" >
        '.anchor($exportPage, '<span class="fa fa-plus pr5" ></span > '.$exportButton,['class'=>'btn btn-success btn-gradient btn-alt']).'
        </div >';
	}
       echo '</header>';
}
function noRecord($addPage=''){

    echo '<div class="panel-body">
                            <p>No Record(s) added yet.</p>';
                            if($addPage!=""){
                                echo '<a href="'.$addPage.'" class="btn btn-primary float-left btn-gradient btn-alt" style="margin-left:15px;" > <i class="font-icon font-icon-plus"></i> Add Record</a>';
                            }
                            
                        echo '</div>';

}
function labelbox($colname,$label,$value){
    echo '<div class="col-md-'.$colname.'">
              <fieldset class="form-group">
              <label class="form-label semibold">'.$label.'</label>
              <label class="form-control">'.$value.'</label>
              </fieldset>
            </div>';
}
function editbox($colname,$label,$fieldname,$placeholder,$value,$script=""){
    $isrequired=strpos($script,"required");
    if(is_numeric($isrequired))
    {
        $label.=" <b class='text-danger'>*</b>";
    }
    echo '<div class="col-md-'.$colname.'">
              <fieldset class="form-group">
              <label class="form-label semibold">'.$label.'</label>
              <input type="text" '.$script.' name="'.$fieldname.'" value="'.$value.'" id="'.$fieldname.'" placeholder ="'.$placeholder.'" class="form-control">
              </fieldset>
            </div>';
}
function gstnumberbox($colname,$label,$fieldname,$placeholder,$value,$script=""){
    $isrequired=strpos($script,"required");
    if(is_numeric($isrequired))
    {
        $label.=" <b class='text-danger'>*</b>";
    }
    echo '<div class="col-md-'.$colname.'">
              <fieldset class="form-group">
              <label class="form-label semibold">'.$label.'</label>
              <input type="text" '.$script.' name="'.$fieldname.'" value="'.$value.'" id="'.$fieldname.'" placeholder ="'.$placeholder.'" class="form-control" pattern="^[0-9]{2}[A-Z]{5}[0-9]{4}[A-Z]{1}[1-9A-Z]{1}Z[0-9A-Z]{1}$">
              </fieldset>
            </div>';
}
function numberbox($colname,$label,$fieldname,$placeholder,$value,$script=""){
    $isrequired=strpos($script,"required");
    if(is_numeric($isrequired))
    {
        $label.=" <b class='text-danger'>*</b>";
    }
    echo '<div class="col-md-'.$colname.'">
              <fieldset class="form-group">
              <label class="form-label semibold">'.$label.'</label>
              <input type="number" '.$script.' name="'.$fieldname.'" value="'.$value.'" id="'.$fieldname.'" placeholder ="'.$placeholder.'" class="form-control">
              </fieldset>
            </div>';
}
function phonebox($colname,$label,$fieldname,$placeholder,$value,$script=""){
    $isrequired=strpos($script,"required");
    if(is_numeric($isrequired))
    {
        $label.=" <b class='text-danger'>*</b>";
    }
    echo '<div class="col-md-'.$colname.'">
              <fieldset class="form-group">
              <label class="form-label semibold">'.$label.'</label>
            
              <input type="tel" '.$script.' name="'.$fieldname.'" value="'.$value.'" id="'.$fieldname.'" placeholder ="'.$placeholder.'" class="form-control" pattern="[0-9]{10}">
              </fieldset>
            </div>';
}
function textareabox($colname,$label,$fieldname,$placeholder,$value,$script=''){
    $isrequired=strpos($script,"required");
    if(is_numeric($isrequired))
    {
        $label.=" <b class='text-danger'>*</b>";
    }
    echo '<div class="col-lg-'.$colname.'">
            <fieldset class="form-group">
                <label class="form-label semibold">'.$label.'</label>
            <textarea name="'.$fieldname.'"  id="'.$fieldname.'" placeholder="'.$placeholder.'" class="form-control" style="height:100px;" '.$script.' >'.$value.'</textarea>
            </fieldset>
            </div>';
}
function textareabox2($colname,$label,$fieldname,$placeholder,$value,$script=''){
    $isrequired=strpos($script,"required");
    if(is_numeric($isrequired))
    {
        $label.=" <b class='text-danger'>*</b>";
    }
    echo '<div class="col-lg-'.$colname.'">
            <fieldset class="form-group">
                <label class="form-label semibold">'.$label.'</label>
            <textarea name="'.$fieldname.'"  id="'.$fieldname.'" placeholder="'.$placeholder.'" class="form-control" style="height:115px;" '.$script.' >'.$value.'</textarea>
            </fieldset>
            </div>';
}
function emailbox($colname,$label,$fieldname,$placeholder,$value,$script=""){
    $isrequired=strpos($script,"required");
    if(is_numeric($isrequired))
    {
        $label.=" <b class='text-danger'>*</b>";
    }
    echo '<div class="col-md-'.$colname.'">
              <fieldset class="form-group">
              <label class="form-label semibold">'.$label.'</label>
              <input type="email"  '.$script.' name="'.$fieldname.'" value="'.$value.'" id="'.$fieldname.'" placeholder ="'.$placeholder.'" class="form-control">
              </fieldset>
            </div>';
}
function passwordbox($colname,$label,$fieldname,$placeholder,$value,$script=""){
   $isrequired=strpos($script,"required");
    if(is_numeric($isrequired))
    {
        $label.=" <b class='text-danger'>*</b>";
    }
    echo '<div class="col-md-'.$colname.'">
              <fieldset class="form-group">
              <label class="form-label semibold">'.$label.'</label>
               <input type="password"  '.$script.' name="'.$fieldname.'" value="'.$value.'" id="'.$fieldname.'" placeholder ="'.$placeholder.'" class="form-control">
              </fieldset>
            </div>';
}
function dropdownbox($colname,$label,$fieldname,$array,$value,$script=""){
    $isrequired=strpos($script,"required");
    if(is_numeric($isrequired))
    {
        $label.=" <b class='text-danger'>*</b>";
    }
    echo'<div class="col-md-'.$colname.'">
            <fieldset class="form-group">
                <label class="form-label semibold">'.$label.'</label>';
                $attributes = 'class="select2-single form-control" '.$script.' id="'.$fieldname.'"';
                echo form_dropdown($fieldname, $array, $value, $attributes);
    echo '</fieldset>
          </div>';
}
function multidropdownbox($colname,$label,$fieldname,$array,$value,$script=""){
    $isrequired=strpos($script,"required");
    if(is_numeric($isrequired))
    {
        $label.=" <b class='text-danger'>*</b>";
    }
    echo'<div class="col-md-'.$colname.'">
            <fieldset class="form-group">
                <label class="form-label semibold">'.$label.'</label>';
                $attributes = 'class="select2-single form-control" '.$script.' multiple="multiple" data-placeholder="- Select -" id="'.$fieldname.'"';
                echo form_dropdown($fieldname, $array, $value, $attributes);
    echo '</fieldset>
          </div>';
}
function datepicker($colname,$label,$fieldname,$placeholder,$value,$script=""){
       $isrequired=strpos($script,"required");
    if(is_numeric($isrequired))
    {
        $label.=" <b class='text-danger'>*</b>";
    }
        echo '<div class="col-md-'.$colname.'">
                            <fieldset class="form-group">
                                <label class="form-label">'.$label.'</label>
                                <div class="input-group date ">
                                    <input type="text" class="form-control datetimepicker" '.$script.' id="'.$fieldname.'" name="'.$fieldname.'" value="'.$value.'">
                                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                </div>
                            </fieldset>
                        </div>';
}
function timepicker($colname,$label,$fieldname,$placeholder,$value,$script=""){
        $isrequired=strpos($script,"required");
    if(is_numeric($isrequired))
    {
        $label.=" <b class='text-danger'>*</b>";
    }
        echo '<div class="col-md-'.$colname.'">
                            <fieldset class="form-group">
                                <label class="form-label">'.$label.'</label>
                                <div class="input-group date " style="width: 100%;">
                                    <input type="text" class="form-control timepicker" '.$script.' id="'.$fieldname.'" name="'.$fieldname.'" placeholder="'.$placeholder.'" value="'.$value.'">
                                </div>
                            </fieldset>
                        </div>';
}
function daterangepicker($colname,$label,$fieldname,$placeholder,$value,$script=""){
        echo '<div class="col-md-'.$colname.'">
                            <fieldset class="form-group">
                                <label class="form-label">'.$label.'</label>
                                <div class="input-group date ">
                                    <input type="text" class="form-control daterangepicker1" '.$script.' id="'.$fieldname.'" name="'.$fieldname.'" value="'.$value.'">
                                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                </div>
                            </fieldset>
                        </div>';
}
function checkbox($check,$label,$fieldname){
    $checked = "";
    if($check == 1){
        $checked = "checked";
    }

    echo 	'<div class="col-lg-12">
                <div class="checkbox-toggle">
                    <input  value="1" name="'.$fieldname.'" id="'.$fieldname.'"  '.$checked.' type="checkbox" >
                    <label for="'.$fieldname.'">'.$label.'</label>
                </div>
             </div>' ;

}
function uploadbox($colname,$label,$fieldname,$placeholder){
    echo '<div class="col-md-'.$colname.' admin-form">
                        <div class="section" >
                            <label class="field prepend-icon append-button file">
                                <span class="button btn-default">'.$label.'</span>
                                <input class="gui-file" name="'.$fieldname.'" id="'.$fieldname.'" onchange="document.getElementById(\''.$fieldname.'_1\').value = this.value;" type="file">
                                <input class="gui-input" id="'.$fieldname.'_1" placeholder="'.$placeholder.'" type="text">
                                <label class="field-icon">
                                    <i class="fa fa-upload"></i>
                                </label>
                            </label>
                        </div>
                        </div>';
}
function submitbutton($pageBack,$iseditable=0){
    $disabled='';
    if($iseditable)
    $disabled='disabled';
    echo '  <input type="submit" value="Save" class="btn btn-primary btn-sm" '.$disabled.'>
                                <a  href="'.$pageBack.'" class="btn btn-danger btn-sm" >Cancel</a>';
    
    }

function datalistbox($array,$id)
{

    echo "<datalist id='".$id."'>";
    
    foreach($array as $key=>$value)
    {
        echo '<option value="'.$value.'">';
    }
    echo "</datalist>";

}
function customData($arraydata,$cid){

    foreach($arraydata as $column => $value)
    {
        if($cid == $column){
            return $value;
        }
    }

}
      
       function check_role_assigned($module_name, $role_type)
       {
           $ci = &get_instance();
           $logged_in_role = $ci->session->logged_in['user_role'];
           $user_role = $ci->session->logged_in['user_type'];
           if ($user_role == '1') { //1 For Super Admin
               return 1;
           }
           $logged_in_role_arr = json_decode($logged_in_role);
           if (isset($logged_in_role_arr->{$module_name}) && isset($logged_in_role_arr->{$module_name}->{$role_type}) && $logged_in_role_arr->{$module_name}->{$role_type} == 1)
               return 1;
           else
               return 0;
       }

       function set_menu_item($menu)
       {
       
           if (check_role_assigned($menu['role'], 'view')) {
               if (isset($menu['submenu']) && count($menu['submenu'])) {
                   $str = '<li class="has-sub"><a href="javascript:;"><b class="caret caret-right pull-right"></b><i class="' . $menu['class'] . '"></i><span>' . $menu['name'] . '</span></a><ul class="sub-menu">';
       
                   foreach ($menu['submenu'] as $sub) {
                       $str .= set_menu_item($sub);
                   }
                   $str .= '</ul></li>';
               } else {
                   if ($menu['mtype'] == "headnavigation") {
                       $str = '<li class="nav-divider"></li>
                       <li class="nav-header">' . $menu['name'] . '</li>';
                   } else {
                       $str = '<li> <a href="' . base_url() . $menu['url'] . '"> <i class="' . $menu['class'] . '"></i> <span>' . $menu['name'] . '</span> </a>';
                       $str .= '</li>';
                   }
               }
       
               return $str;
           } else {
               return '';
           }
       }
       
    function set_menu_role($menu, $val_role_details)
    {
        $menu_slug = $menu->role;
        if (isset($menu->submenu) && count($menu->submenu)) {
            $checked_view = '';
            $checked_add = '';
            $checked_edit = '';
            $checked_delete = '';
            $checked_allocation = '';
            $checked_export = '';
            $checked_allrecord = '';
            $checked_executive = '';
            if (isset($val_role_details->{$menu_slug}->view)) {
                $checked_view = 'checked';
            }
            if (isset($val_role_details->{$menu_slug}->add)) {
                $checked_add = 'checked';
            }
            if (isset($val_role_details->{$menu_slug}->edit)) {
                $checked_edit = 'checked';
            }
            if (isset($val_role_details->{$menu_slug}->delete)) {
                $checked_delete = 'checked';
            }
            if (isset($val_role_details->{$menu_slug}->allocation)) {
                $checked_allocation = 'checked';
            }
            if (isset($val_role_details->{$menu_slug}->export)) {
                $checked_export = 'checked';
            }
            if (isset($val_role_details->{$menu_slug}->allrecord)) {
                $checked_allrecord = 'checked';
            }
            if (isset($val_role_details->{$menu_slug}->executive)) {
                $checked_executive = 'checked';
            }
    
            $str = ' <li>' . $menu->name . ' <label>';
            if (strpos($menu->role_type, 'view') !== false)
                $str .= '<input type="checkbox" name="role[' . $menu_slug . '][view]" value="1" ' . $checked_view . ' > View </label>';
            if (strpos($menu->role_type, 'add') !== false)
                $str .= '<label><input type="checkbox" name="role[' . $menu_slug . '][add]" value="1" ' . $checked_add . ' > Add </label>';
            if (strpos($menu->role_type, 'edit') !== false)
                $str .= '<label><input type="checkbox" name="role[' . $menu_slug . '][edit]" value="1" ' . $checked_edit . '> Edit </label>';
            if (strpos($menu->role_type, 'delete') !== false)
                $str .= '<label><input type="checkbox" name="role[' . $menu_slug . '][delete]" value="1" ' . $checked_delete . ' > Delete </label>';
            if (strpos($menu->role_type, 'allocation') !== false)
                $str .= '<label><input type="checkbox" name="role[' . $menu_slug . '][allocation]" value="1" ' . $checked_allocation . ' > Allocation </label>';
            if (strpos($menu->role_type, 'export') !== false)
                $str .= '<label><input type="checkbox" name="role[' . $menu_slug . '][export]" value="1" ' . $checked_export . ' > Export </label>';
            if (strpos($menu->role_type, 'allrecord') !== false)
                $str .= '<label><input type="checkbox" name="role[' . $menu_slug . '][allrecord]" value="1" ' . $checked_allrecord . ' > All Records </label>';
            if (strpos($menu->role_type, 'executive') !== false)
                $str .= '<label><input type="checkbox" name="role[' . $menu_slug . '][executive]" value="1" ' . $checked_executive . ' > As Executive </label>';
            $str .= '<ul>';
    
            foreach ($menu->submenu as $sub) {
                $str .= set_menu_role($sub, $val_role_details);
            }
            $str .= '</ul></li>';
        } else {
    
            $checked_view = '';
            $checked_add = '';
            $checked_edit = '';
            $checked_delete = '';
            $checked_allocation = '';
            $checked_export = '';
            $checked_allrecord = '';
            $checked_executive = '';
            if (isset($val_role_details->{$menu_slug}->view)) {
                $checked_view = 'checked';
            }
    
            if (isset($val_role_details->{$menu_slug}->add)) {
                $checked_add = 'checked';
            }
    
            if (isset($val_role_details->{$menu_slug}->edit)) {
                $checked_edit = 'checked';
            }
    
            if (isset($val_role_details->{$menu_slug}->delete)) {
                $checked_delete = 'checked';
            }
    
            if (isset($val_role_details->{$menu_slug}->allocation)) {
                $checked_allocation = 'checked';
            }
    
            if (isset($val_role_details->{$menu_slug}->export)) {
                $checked_export = 'checked';
            }
    
            if (isset($val_role_details->{$menu_slug}->allrecord)) {
                $checked_allrecord = 'checked';
            }
    
            if (isset($val_role_details->{$menu_slug}->executive)) {
                $checked_executive = 'checked';
            }
    
            $str = ' <li>' . $menu->name;
            if (strpos($menu->role_type, 'view') !== false)
                $str .= '
                <div class="switcher switcher-success">
                    <input name="role[' . $menu_slug . '][view]"  id="role[' . $menu_slug . '][view]"  value="1" type="checkbox" ' . $checked_view . ' >
                    <label for="role[' . $menu_slug . '][view]"></label>
                </div>';
            if (strpos($menu->role_type, 'add') !== false)
                $str .= ' <div class="switcher switcher-info">
                <input name="role[' . $menu_slug . '][add]"  id="role[' . $menu_slug . '][add]"  value="1" type="checkbox" ' . $checked_add . ' >
                <label for="role[' . $menu_slug . '][add]"></label>
            </div>
            ';
            if (strpos($menu->role_type, 'edit') !== false)
                $str .= ' <div class="switcher switcher-warning">
                <input name="role[' . $menu_slug . '][edit]"  id="role[' . $menu_slug . '][edit]"  value="1" type="checkbox" ' . $checked_edit . ' >
                <label for="role[' . $menu_slug . '][edit]"></label>
            </div>';
            if (strpos($menu->role_type, 'delete') !== false)
                $str .= ' <div class="switcher switcher-danger">
                <input name="role[' . $menu_slug . '][delete]"  id="role[' . $menu_slug . '][delete]"  value="1" type="checkbox" ' . $checked_delete . ' >
                <label for="role[' . $menu_slug . '][delete]"></label>
            </div>';
            if (strpos($menu->role_type, 'allocation') !== false)
                $str .= '<label><input type="checkbox" name="role[' . $menu_slug . '][allocation]" value="1" ' . $checked_allocation . ' > Allocation </label>';
            if (strpos($menu->role_type, 'export') !== false)
                $str .= '<label><input type="checkbox" name="role[' . $menu_slug . '][export]" value="1" ' . $checked_export . ' > Export </label>';
            if (strpos($menu->role_type, 'allrecord') !== false)
                $str .= '<label><input type="checkbox" name="role[' . $menu_slug . '][allrecord]" value="1" ' . $checked_allrecord . ' > All Record </label>';
            if (strpos($menu->role_type, 'executive') !== false)
                $str .= '<label><input type="checkbox" name="role[' . $menu_slug . '][executive]" value="1" ' . $checked_executive . ' > As Executive </label>';
        }
        return $str;
    }

function form_divider($label){
  echo '<div class="col-lg-12 admin-form theme-primary">
                                    <div class="section-divider mb30">
                                        <span class=" bg-white">'.$label.'</span>
                                    </div>
                                </div>';  
}

function get_total_hour($arr)
{
  $result = 0;

  $total_count = count($arr);
  $is_odd = $total_count % 2 ;
  
  if( $total_count == 1 ){
    $result = 0;
  }else{
    if( $is_odd == true ){
      $total_count = $total_count -1;
    }
    $total_hour = "00:00:00";
    for ($i=0; $i < $total_count; $i++){ 
      $start_index = $i;
      $end_index = $i+1;
      $a = new DateTime($arr[$start_index]);
      $b = new DateTime($arr[$end_index]);
      $interval = $a->diff($b);
      $diff = $interval->format("%H:%I:%S");
      $total_hour = sum_the_time($total_hour,$diff);
      $i++;
    }
    $result = date( "H:i:s" ,strtotime($total_hour)) ;
  }
  return $result;
}

function sum_the_time($time1, $time2) {
  $times = array($time1, $time2);
  $seconds = 0;
  foreach ($times as $time)
  {
    list($hour,$minute,$second) = explode(':', $time);
    $seconds += $hour*3600;
    $seconds += $minute*60;
    $seconds += $second;
  }
  $hours = floor($seconds/3600);
  $seconds -= $hours*3600;
  $minutes  = floor($seconds/60);
  $seconds -= $minutes*60;
  return "{$hours}:{$minutes}:{$seconds}";
}
function custom_amount_formatter($amount)
{
    // setlocale(LC_MONETARY, 'en_IN');
    // $amount = money_format('%!i', $amount);
    $explrestunits = "";
    $amount = sprintf("%0.2f",$amount);
    $amo = explode(".",$amount);
    $num = $amo[0];
    $decimal =  $amo[1];
    if (strlen($num) > 3) {
        $lastthree = substr($num, strlen($num) - 3, strlen($num));
        $restunits = substr($num, 0, strlen($num) - 3); // extracts the last three digits
        $restunits = (strlen($restunits) % 2 == 1) ? "0" . $restunits : $restunits; // explodes the remaining digits in 2's formats, adds a zero in the beginning to maintain the 2's grouping.
        $expunit = str_split($restunits, 2);
        for ($i = 0; $i < sizeof($expunit); $i++) {
            // creates each of the 2's group and adds a comma to the end
            if ($i == 0) {
                $explrestunits .= (int) $expunit[$i] . ","; // if is first value , convert into integer
            } else {
                $explrestunits .= $expunit[$i] . ",";
            }
        }
        $thecash = $explrestunits . $lastthree;
    } else {
        $thecash = $num;
    }
    $thecash = $thecash.".".$decimal;
    return $thecash; // writes the final format where $currency is the currency symbol.
}
function  getIndianCurrencyInWord($number){
    //$number = 190908100.25;
       $no = floor($number);
       $point = round($number - $no, 2) * 100;
       $hundred = null;
       $digits_1 = strlen($no);
       $i = 0;
       $str = array();
       $words = array('0' => '', '1' => 'One', '2' => 'Two',
        '3' => 'Three', '4' => 'Four', '5' => 'Five', '6' => 'Six',
        '7' => 'Seven', '8' => 'Eight', '9' => 'Nine',
        '10' => 'Ten', '11' => 'Eleven', '12' => 'Twelve',
        '13' => 'Thirteen', '14' => 'Fourteen',
        '15' => 'Fifteen', '16' => 'Sixteen', '17' => 'Seventeen',
        '18' => 'Eighteen', '19' =>'Nineteen', '20' => 'Twenty',
        '30' => 'Thirty', '40' => 'Forty', '50' => 'Fifty',
        '60' => 'Sixty', '70' => 'Seventy',
        '80' => 'Eighty', '90' => 'Ninety');
       $digits = array('', 'Hundred', 'Thousand', 'Lakh', 'Crore');
       while ($i < $digits_1) {
         $divider = ($i == 2) ? 10 : 100;
         $number = floor($no % $divider);
         $no = floor($no / $divider);
         $i += ($divider == 10) ? 1 : 2;
         if ($number) {
            $plural = (($counter = count($str)) && $number > 9) ? 's' : null;
            $hundred = ($counter == 1 && $str[0]) ? ' and ' : null;
            $str [] = ($number < 21) ? $words[$number] .
                " " . $digits[$counter] . $plural . " " . $hundred
                :
                $words[floor($number / 10) * 10]
                . " " . $words[$number % 10] . " "
                . $digits[$counter] . $plural . " " . $hundred;
         } else $str[] = null;
      }
      $str = array_reverse($str);
      $result = implode('', $str);
      $points = ($point) ?
        $words[$point / 10] . " " . 
              $words[$point = $point % 10] : '';
  
              $temp="";
              if($points!="" && $points!=0)
              {
                  $temp= "  And ".$points . " Paise";
              }
      return $result ." Rupees ".$temp." Only";
  }
?>
