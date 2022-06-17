<!DOCTYPE html>
<html>
<head>
<title><?=SITETITLE?></title>


<style>
.clearfix {
    clear:both;
}

body
{
        margin: 0 auto;
    font-family: "Roboto", "Helvetica Neue", Arial, sans-serif;
    font-size: 0.875rem;
    font-weight: normal;
    line-height: 1.5;
    width:100%;
    
}
table
{
    width:100%;

}
table,td,th{
    
    border-spacing:0px;
    border: 1px solid #eee;
}
td,th{
    padding:6px;
}
    .heading
    {
        position: relative;
    height: 40px;
    line-height: 36px;
    background: #fafafa;
    color: #666;
    font-size: 13px;
    font-weight: 600;
    border: 1px solid #e5e5e5;
    padding:0 10px;
    }
    .body{
        position: relative;
    border: 1px solid #e5e5e5;
    height:130px;
    padding:10px;
    font-size: 0.775rem;
    }



.text-right{
    text-align:right;
}
</style>
</head>
<body>
                <table style="border:none;">
                <tr>
                    <td style="border:none;width:30%;">
                        <div class="heading">Customer : </div>
                         <div class="body">
                            <strong ><?=$customerorder->customer_name?></strong><br>
                            <?=nl2br($customerorder->address)?><br>
                          </div>
                          </td>
                                        
                          <td style="border:none;width:30%;">
                        <div class="heading">Consignee : </div>
                         <div class="body">
                            <strong ><?=$customerorder->customer_name?></strong><br>
                            <?=nl2br($customerorder->address)?><br>
                          </div>
                          </td>
                          <td style="border:none;width:30%;">
                        <div class="heading">Order  Details: </div>
                         <div class="body">
                                                <b>ETD :</b> <?=$customerorder->estimated_time_of_delivery?> <br/>
                                            
                                                <b>ETA :</b> <?=$customerorder->estimated_time_of_arrival?> <br/>
                                            
                                                <b>Terms Of Delivery :</b> <?=$customerorder->terms_of_delivery?><br/>
											
                                                <b>Total Amount :</b> <?=$customerorder->total_amount?> <b> <?=$customerorder->symbol?></b><br/>
                                        
                          </div>
                          </td>
                
                </tr>
               <tr>
               <td style="border:none;width:33%;">
                    <div>
                    <h3>ORDER NO. <?=$customerorder->orderno?></h3>
                    </div>
                    </td>
                    <td style="border:none;width:33%;">
                    </td>
                    <td style="border:none;width:33%;text-align:right;">
                    <div>
                    <?php 
                                $date=date_create_from_format('Y-m-d',$customerorder->order_date);
                                $date=date_format($date,'d/m/Y');
                            ?>
                                <h3>Date: <?=$date?></h3>
                    </div>
                    </td>
                    </tr>
                    </table>
                    <table >
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Item</th>
                                            <th>Description</th>
                                            <th>Qty</th>
                                            <th>Rate</th>
                                            <th class="pr10 text-right">Price</th>
                                            <!-- <th>Price In INR</th> -->
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php 
                                        $i=0;
                                        $totalamt=0;
                                        $totalqty=0;
                                    foreach($subOrderList as $post): 
                                    $totalamt+=$post->extended_price;
                                    $totalqty+=$post->qty;
                                    ?>
                                        <tr>
                                            <td><b><?=++$i?></b></td>
                                            <td><?=$post->item_name?>   </td>
                                            <td><?=$post->description?></td>
                                            <td class="pr10 text-right"><?=(float)$post->qty?></td>
                                            <td class="pr10 text-right"><?=(float)$post->amount." ".$post->symbol?></td>
                                            <td class="pr10 text-right"><?=(float)$post->extended_price." ".$post->symbol?></td>
                                        </tr>
                                        <?php endforeach;?>
                                    </tbody>
                                    <tfoot>
                                    <tr>
                                    <th class="text-right" colspan=3>Total</th>
                                    <th><?=(float)$totalqty?></th>
                                    <th></th>
                                    <th class="text-right"><?=(float)$totalamt." ".$post->symbol?></th>
                                    </tr>
                                    </tfoot>
                                </table>
                                    

</body>

</html>