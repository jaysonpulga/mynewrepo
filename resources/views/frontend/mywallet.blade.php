@extends('frontend.layouts.main')

@section('content')
<style>
.tab-content{
    margin-top:10px;
}
.custom_box
{
		border: 1px solid #abaaaa;
	      border-radius: 1px !important;
}
.name_overflow{
 width:300px !important;
overflow:hidden !important;
text-overflow:ellipsis !important;
}



.row_ul {
  display: flex;
  flex-direction: row;
  flex-wrap: wrap;
  width: 100%;
}

.column_li {
  display: flex;
  flex-direction: column;
  flex-basis: 100%;
  flex: 1;
}
</style>
<section class="content">
    <!-- Main content -->
    <section class="row">
		<div class="row">
		    <div class="col-md-3">
			  @php
	           $menu = 'wallet'
	           @endphp
	           @include('frontend.layouts.profile_menu')
		</div>
       <div class="col-md-9">
        <div class='row'>
	        <div class="col-md-12 col-sm-12 col-xs-12" >
        		<div class="box box-primary">
        				<div class="box-header with-border">
        				  <i class="fa fa-fw fa-briefcase"></i><h3 class="box-title">Wallet</h3>
        				</div>
        				 
        				<div class="box-body">
        					
        					<div class="row text-center">
        					
        							<div class="col-md-12">
        
        								<h5 class="my-3">Current Balance</h5>
        								<h1 class="my-3 display-4">
        									<span class="text-success"> $<?php echo  number_format(@$wallet_amount, 2, '.', ' ') ; ?>  </span>
        								</h1>
        							</div>
        					</div>
        				</div>
        		</div>
        	</div>
	    </div>
    	<div class='row'>
    	        <div class="col-md-12 col-sm-12 col-xs-12" >
            		<div class="box box-primary">
            				<div class="box-header with-border">
            				  My Campaign
            				</div>
            				<div class="box-body">
            				    <ul class="nav nav-tabs responsive-tabs row_ul">
        							<li class="nav-item column_li active">
        								<a aria-expanded="true" href="#tab_1" class="nav-link active" id="next-check-tab" data-toggle="tab" role="tab" aria-controls="home" aria-selected="true">
        								Cashback Campaign  
        								</a>
        							</li>
        							<li class="nav-item column_li">
        								<a aria-expanded="false" href="#tab_2" class="nav-link" id="coming-tab" data-toggle="tab" role="tab" aria-controls="profile" aria-selected="false">Paid Campaign</a>
        							</li>
        						</ul>
            				    <div class="tab-content">
							    <div class="tab-pane active" id="tab_1">
								<div>
									<div class="table-responsive-define">
										<table id="unpaid-campaign" class="table no-margin">
                                <thead>
                                    <tr>
                                    <th>Product</th>
                                    <th>Amount</th>
                                    <th>Remarks</th>
                                    <th>Claimed At</th>
                                    <th>Payment Status</th>
                                    <th>Status</th>
                                    </tr>
                                </thead>
            

                            <tbody>
            </tbody></table>
									</div>
								</div>	
							</div>
							<div class="tab-pane" id="tab_2">
							    <div style="margin:15px;">
                                    <label class="radio-inline"><input type="radio" class="product" name="optradio" checked="">By Product</label>
                                    <label class="radio-inline"><input type="radio" class="batchid" name="optradio">By Batch ID</label>
							    </div>
								<div>
									<div class="table-responsive-define">
    									<table id="paid-campaign" class="table no-margin">
                                            <thead>
                                                <tr>
                                                <th>Batch ID</th>
                                                <th>Status</th>
                                                <th>Total Amount</th>
                                                <th>Count</th>
                                                <th>Process Date</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            </tbody>
                                        </table>
									</div>
								</div>		
							</div>  
						</div>
            			</div>
            		</div>
            	</div>
    	    </div>
    	    <div class='row'>
    	   <div class="col-md-12 col-sm-12 col-xs-12" >
                <div class="box box-primary">
            		<div class="box-header with-border">
            			Transfered Points
            				</div>
            				<div class="box-body">
            				    <ul class="nav nav-tabs responsive-tabs row_ul">
        							<li class="nav-item column_li active">
        								<a aria-expanded="true" href="#tab_3" class="nav-link active" id="next-check-tab" data-toggle="tab" role="tab" aria-controls="home" aria-selected="true">
        								Transaction Successfull 
        								</a>
        							</li>
        							<li class="nav-item column_li">
        								<a aria-expanded="false" href="#tab_4" class="nav-link" id="coming-tab" data-toggle="tab" role="tab" aria-controls="profile" aria-selected="false">Paid Points</a>
        							</li>
        						</ul>
            				    <div class="tab-content">
							<div class="tab-pane active" id="tab_3">
								<div>
									<div class="table-responsive-define">
                                        <table id="transac-success" class="table no-margin">
                                            <thead>
                                                <tr>
                                                    <th>Transaction ID</th>
                                                    <th>Converted Points</th>
                                                    <th>Converted Amount</th>
                                                    <th>Date Converted</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            </tbody>
                                        </table>
									</div>
								</div>	
							</div>
							<div class="tab-pane" id="tab_4">
								<div>
									<div class="table-responsive-define">
										<table id="paid_points" class="table no-margin">
                                            <thead>
                                                <tr>
                                                    <th>Batch ID</th>
                                                    <th>Status</th>
                                                    <th>Total Amount</th>
                                                    <th>Count</th>
                                                    <th>Process Date</th>
                                                    </tr>
                                            </thead>
                                            <tbody>
                                            </tbody>
                                        </table>
									</div>
								</div>		
							</div>  
						</div>
            		</div>
            	</div>
            </div>
    	</div>
    	<style>
    	    td.overflow_prod{
    	        max-width: 250px !important;
    	         white-space: nowrap;
                  overflow: hidden;
                  text-overflow: ellipsis;
    	    }
    	</style>
    <script>
        $(document).ready(function(){
            load_paid_campaign(2);
            $('.batchid').click(function(){
                  load_paid_campaign(1);
              });
              $('.product').click(function(){
                  load_paid_campaign(2);
              });
           var table = $('#unpaid-campaign').DataTable({
               "order": [[ 0, "desc" ]],
            "iTotalRecords": "0",
            "ajax": {
              "url": "{{asset('user/unpaid_campaign')}}",
              "dataSrc": function(json){                
                if(json.data == null){
                  return [];
                }
                console.log(json.data)
                return json.data;
              }
            },
            "bDestroy": true,
              "columns": [
            {'data':'image',"width":'25%'},
            {'data':'amount',render:function(data){
                return '$'+data;
            }},
            {'data':'pay_method',render:function(data){
                return data.replace("_"," ");
            }},
            {"data":'claimed_at'},
            {'data':'status'},
            {'data': 'id',render:function(data){
                return '<a href="https://reviewers.club/vip_beta/user/campaign_details/'+data+'" class="btn btn-sm btn-info btn-flat pull-left loading">Campaign Details</a>';
                // return '<a href="#"class="btn btn-sm btn-info btn-flat pull-left loading">Campaign Details</a>';
            }},
          ]
           }); 
           function load_paid_campaign(type){
               //type 1 = by product , type 2 = by batch id
                var paid_table = $('#paid-campaign').DataTable();
                paid_table.clear().draw(); 
                paid_table.destroy();
               if(type == 1){
                   var theadData = '';
                    theadData += '<thead>';
                    theadData += '<tr>';
                    theadData += '<th>Batch ID</th>';
                    theadData += '<th>Status</th>';
                    theadData += '<th>Total Amount</th>';
                    theadData += '<th>Count</th>';
                    theadData += '<th>Process Date</th>';
                    theadData += '</tr>';
                    theadData += '</thead>';
                    theadData += '<tbody>';     
                    theadData += '</tbody>';
                    $('#paid-campaign').html(theadData);
                   var paid_table =$('#paid-campaign').DataTable({
                      "order": [[ 0, "desc" ]],
                    "iTotalRecords": "0",
                    "ajax": {
                      "url": "{{asset('user/paid_campaign')}}",
                      "dataSrc": function(json){                
                        if(json.data == null){
                          return [];
                        }
                        console.log(json.data)
                        return json.data;
                      }
                    },
                    "bDestroy": true,
                      "columns": [
                    {'data':'sender_batch_id',render:function(data){
                        return '<a href="javascript:void(0)">'+data+'</a>';
                    }}, 
                    {"data":'status'},
                    {'data':'total',render:function(data){
                        return '$'+data;
                    }},
                    {'data':'count'},
                    {'data': 'process_date'},
                  ],"fnRowCallback": function( nRow, aData, iDisplayIndex, iDisplayIndexFull){
                      $('td:eq(0)',nRow).attr("id",aData['sender_batch_id']);
                      $('td:eq(0)',nRow).addClass('paid-campaign-batch-id');
                  }
                   });
               }else if(type == 2){
                   var theadData = '';
                    theadData += '<thead>';
                    theadData += '<tr>';
                    theadData += '<th>Product</th>';
                    theadData += '<th>Amount</th>';
                    theadData += '<th>Remarks</th>';
                    theadData += '<th>Claimed At</th>';
                    theadData += '<th>Payment Status</th>';
                    theadData += '<th>Status</th>';
                    theadData += '</tr>';
                    theadData += '</thead>';
                    theadData += '<tbody>';     
                    theadData += '</tbody>';
                    $('#paid-campaign').html(theadData);
                    var paid_table =$('#paid-campaign').DataTable({
                       "order": [[ 0, "desc" ]],
                    "iTotalRecords": "0",
                    "ajax": {
                      "url": "{{asset('user/paid_campaign_product')}}",
                      "dataSrc": function(json){                
                        if(json.data == null){
                          return [];
                        }
                        console.log(json.data)
                        return json.data;
                      }
                    },
                    "bDestroy": true,
                      "columns": [
                    {'data':'image',"width":'281px','className':'overflow_prod'},
                    {"data":'amount',render:function(data){
                        return '$'+data;
                    }},
                    {'data':'pay_method',render:function(data){
                        return data.replace('_',' ');
                    }},
                    {"data":'claimed_at'},
                    {'data':'status'},
                    {'data': 'id',render:function(data){
                        // return '<a href="https://reviewers.club/vip_beta/user/campaign_details/'+data+'" class="btn btn-sm btn-info btn-flat pull-left loading">Campaign Details</a>';
                        return '<a href="{{asset("user/campaign_details")}}/'+data+'"class="btn btn-sm btn-info btn-flat pull-left loading">Campaign Details</a>';
                    }},
                  ]
                   });
               }
               $('#paid-campaign tbody').on('click','td.paid-campaign-batch-id',function(){
                    var tr = $(this).closest('tr');
                    var identity = $(this).attr('id');
                     var row = paid_table.row( tr );
                    if ( row.child.isShown() ) {
                      // This row is already open - close it
                      $('div.slider', row.child()).slideUp( function () {
                          row.child.hide();
                          tr.removeClass('shown');
                      } );
                    }else{
                            row.child( paid_campaign_format(row.data()), 'no-padding' ).show();
                            tr.addClass('shown');
                            $('div.slider', row.child()).slideDown();
                    }
           });
           } 
           
           function paid_campaign_format(data){
               htmlData = '';
                htmlData += '<div class="slider" style="padding-left: 30px;padding-right:30px;">';
                htmlData += '<table id="paid-campign-list-table" class="table " style="width:100%">   ';     
                htmlData += ' <thead>';
                htmlData += ' <tr>';
                htmlData += ' <th>Product</th>';
                htmlData += ' <th>Remarks</th>';
                htmlData += ' <th>Claimed At</th>';
                htmlData += ' <th>Payment Status</th>';
                htmlData += ' <th>Status</th>';
                $.each(data.product_details,function(index, value){
                    console.log('this is the '+ value)
                    htmlData += '  <tr>';
                    htmlData += '<td class="name_overflow" style="max-width:250px !important;white-space: nowrap;overflow:hidden;text-overflow: ellipsis;"><a href="https://reviewers.club/vip_beta/user/campaign_details/'+value.id+'">'+value.product+'</a></td>';
                    htmlData += '<td>'+value.pay_method.replace('_',' ')+'</td>';
                    htmlData += '<td>'+value.claimed_at+'</td>';
                    htmlData += '<td>'+value.payment_status+'</td>';
                    htmlData += '<td style="width:139px;padding:8px;"><a href="https://reviewers.club/vip_beta/user/campaign_details/'+value.id+'" class="btn btn-info">Campaign Details</a></td>';
                    htmlData += '  </tr>';
                });
                htmlData += ' </tr>';
                htmlData += ' </thead>';
                htmlData += '  <tbody>';
                htmlData += '</tbody>';
                htmlData += ' </table>';
                htmlData += '</div>';    
                return htmlData;
           }
        });
    </script>
    <script>
       $(document).ready(function(){
           
           var table1 = $('#transac-success').DataTable({
               "order": [[ 0, "desc" ]],
                "iTotalRecords": "0",
                "ajax": {
                  "url": "{{asset('user/transac_success')}}",
                  "dataSrc": function(json){
                      console.log(json)
                    if(json.data == null){
                      return [];
                    }
                    return json.data;
                  }
                },
                "bDestroy": true,
                  "columns": [ 
                {"data":'transfer_id',render:function(data){
                    return '<a href="javascript:void(0)" class="transfer_id">'+data+'</a>';
                }},
                {'data':'converted_points'},
                {'data': 'amount_converted',render:function(data){
                    return '$'+data;
                }},
                {'data':'date_converted'}
              ]
           });
           var table2 = $('#paid_points').DataTable({
               "order": [[ 0, "desc" ]],
                "iTotalRecords": "0",
                "ajax": {
                  "url": "{{asset('user/paid_points')}}",
                  "dataSrc": function(json){
                      console.log(json)
                    if(json.data == null){
                      return [];
                    }
                    return json.data;
                  }
                },
                "bDestroy": true,
                  "columns": [ 
                {"data":'batch_id',render:function(data){
                    return '<a href="javascript:void(0)" class="transfer_id">'+data+'</a>';
                }},
                {'data':'status'},
                {'data': 'amount_converted',render:function(data){
                    return '$'+data;
                }},
                {'data':'count'},
                {'data':'process_date'}
              ]
           });
           $('#transac-success tbody').on('click','td a.transfer_id',function(){
                var tr = $(this).closest('tr');
                var row = table1.row( tr );
                if ( row.child.isShown() ) {
                    // This row is already open - close it
                    row.child.hide();
                    tr.removeClass('shown');
                }
                else {
                    // Open this row
                    row.child( transac_success(row.data()) ).show();
                    tr.addClass('shown');
                }
           })
           $('#paid_points tbody').on('click','td a.transfer_id',function(){
                var tr = $(this).closest('tr');
                var row = table2.row( tr );
                if ( row.child.isShown() ) {
                    // This row is already open - close it
                    row.child.hide();
                    tr.removeClass('shown');
                }
                else {
                    // Open this row
                    row.child( transac_success(row.data()) ).show();
                    tr.addClass('shown');
                }
           })
           function transac_success(data){
                var html = '';
                html+= '<div style="padding:10px 20px 5px 20px;">';
                html+= '<table class="table">';
                html+= '    <thead>';
                html+= '        <tr>';
                html+= '            <th>Remarks</th>';
                html+= '            <th>Points</th>';
                html+= '            <th>Date Claimed</th>';
                html+= '        </tr>';
                html+= '    </thead>';
                html+= '    <tbody>';
                console.log(data)
                var count =0 ;
                $.each(data.converted_details,function(index,value){
                    count++;
                html+= '    <tr>';
                html+= '        <td>'+value.transaction_label+'</td>';
                html+= '        <td>'+value.points+'</td>';
                html+= '        <td>'+value.date_claimed+'</td>';
                html+= '    </tr>';
                })
                
                html+= '    </tbody>';
                html+= '</table>';
                html+= '</div>';
                return html;
           }
       })
    </script>
    </div>
		</div>
</section>
</section> 
	   
	

@endsection

