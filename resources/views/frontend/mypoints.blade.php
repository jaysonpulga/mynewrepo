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
.mal p{
    font-size:12px;
}
.mal h4{
    font-size:16px;
}
</style>
<section class="content">
    <!-- Main content -->
    <section class="row">
        <div class="row">
            <div class="col-md-3">
	
			  @php
	           $menu = 'points'
	           @endphp
	           @include('frontend.layouts.profile_menu')
			
		</div>
		<div tabindex="-1" role="dialog" class="modal fade" id="transfer_guide">
		    <div class="modal-dialog modal-lg">
		        <div class="modal-content" style="border-radius:6px;">
		            <div class="modal-header">
		                <div>
		                    <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true">×</span>
		                    </button> 
		                    <h4 class="modal-title"style="font-family: 'Raleway',sans-serif;color:rgb(99, 107, 111);font-weight:500;">
                                Transfer my points
                            </h4>
                        </div>
                    </div>
                    <div class="modal-body" style="font-family: 'Raleway',sans-serif;color:rgb(99, 107, 111);">
                        <div class="mal" style="padding:15px;">
                            <div>
                                <h4 class="text-bold">
                                    Can I only payout points when I have 2500 points gathered?
                                </h4>
                                <p>
                                    <strong>Answer:</strong> When you reach 2500 points, we will transfer your cash into your account.
                                </p>
                                <p>
                                    However, you can do it for any amount of points. Whenever the point value
                                    is below 2500, we will deduct 50 points as transaction fee and we will use your
                                    preferred payout method  to send you a digital check. Above 2500 points,
                                    transaction is free.
                                </p>
                            </div>
                            <div class="mtxl">
                                <h4 class="text-bold">
                                    What is the value of each earned point?
                                </h4>
                                <p>
                                    <strong>Answer:</strong> With all actions you take in the PPOC system, you can earn points.
                                    Points gathered means cash you can get paid out to your account.
                                </p>
                                <p class="text-bold text-right">
                                    100 points = $1.00
                                </p>
                            </div>
                            <div class="mtxxl"style="margin-top:20px;">
                                <div class="mbs">
                                    <div class="pull-left mls" style="margin-bottom:5px;">
                                        Current points
                                    </div>
                                    <div class="pull-right mrs">
                                        {{ $points_amount == null ? '0': '0' }}
                                    </div>
                                    <div class="clearfix">
                                        
                                    </div>
                                </div>
                                <!--<div class="mbs">-->
                                <!--    <div class="pull-left mls" style="margin-bottom:5px;">-->
                                <!--        Minimum Points Withdrawal-->
                                <!--    </div>-->
                                <!--    <div class="pull-right mrs">-->
                                <!--        500-->
                                <!--    </div>-->
                                <!--    <div class="clearfix">-->
                                        
                                <!--    </div>-->
                                <!--</div>-->
                                <div class="bb pbs" style="border-bottom:1px solid rgb(99, 107, 111);padding-bottom:5px;">
                                    <div class="pull-left mls">
                                    Transaction fee
                                    </div>
                                    <div class="pull-right mrs">
                                        50
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="mtm text-bold" style="margin-top:10px;margin-bottom:10px;">
                                    <div class="pull-right mrs">
                                        Points to account:
                                        <span class="pll">-50</span>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                            </div> <!----> 
                            <div class="alert alert-success alert-dismissible">
                                <button type="button" data-dismiss="alert" aria-hidden="true" class="close">×</button> 
                                We will proceed the payment of the points via Paypal.
                                <h4 style="margin-top:10px;"><i class="icon fa fa-warning"></i> Whooho!</h4>
                                Minimum Points Withdrawal is 500
                            </div>
                        </div>
                    </div> <!----> 
                    <div class="modal-footer">
                        <span class="d-inline-block" tabindex="0" data-toggle="tooltip" title="Minimum Points required is 500 ">
                          <!--<button class="btn btn-primary" style="pointer-events: none;" type="button" disabled>Disabled button</button>-->
                        @if(@$points_amount >= 500)
                        <button class="btn bg-purple pull-right loading btn-transfer_mypoints" data-toggle="tooltip" title="Minimum Points required is 500!">Transfer my points</button> <!---->
                        @else
                        <!--<button style="pointer-events: none;" type="button" class="btn bg-purple loading" disabled>Transfer my points</button>-->
                        <button class="btn btn-primary" style="pointer-events: none;" type="button" disabled>Transfer my points</button>
                        @endif
                        </span>
                    </div>
                </div>
            </div>
        </div>
       <div class="col-md-9">
        <div class='row'>
	        <div class="col-md-12 col-sm-12 col-xs-12" >
        		<div class="box box-primary">
        			<div class="box-header with-border">
        			    <i class="fa fa-fw fa-briefcase"></i><h3 class="box-title">My Points</h3>
        			</div>
        			<div class="box-body">
        				<div class="row text-center">
        					<div class="col-md-12">
                                <h5 class="my-3">Claimed Points</h5>
        						<h1 class="my-3 display-4">
        							<span class="text-success">{{ (@$points_amount > 0) ? $points_amount : 0}}</span>
        						</h1>
        						
        						<button class="btn btn-info btn-transfer_points">Transfer Points</button>
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
            			My Points
            			</div>
            				<div class="box-body">
            				    <ul class="nav nav-tabs responsive-tabs row_ul">
        							<li class="nav-item column_li active">
        								<a aria-expanded="true" href="#tab_1" class="nav-link active" id="next-check-tab" data-toggle="tab" role="tab" aria-controls="home" aria-selected="true">
        								Available Points  
        								</a>
        							</li>
        							<li class="nav-item column_li">
        								<a aria-expanded="false" href="#tab_2" class="nav-link" id="coming-tab" data-toggle="tab" role="tab" aria-controls="profile" aria-selected="false">Transfered Points</a>
        							</li>
        						</ul>
            				    <div class="tab-content">
        							<div class="tab-pane active" id="tab_1">
        								<div>
        									<div class="table-responsive-define">
        										<table id="avail-points" class="table">
                                                    <thead>
                                                        <tr>
                                                            <th>Remarks</th>
                                                            <th>Points</th>
                                                            <th>Status</th>
                                                            <th>Date Claimed</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                    </tbody>
                                                </table>
        									</div>
        								</div>	
        							</div>
							<div class="tab-pane" id="tab_2">
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
						</div>
            		</div>
            	</div>
            </div>
    	</div>
    	<script>
		    $(document).ready(function(){
			    $('.btn-transfer_points').click(function(){
				    $('#transfer_guide').modal('show');
				 })
			})
		</script>
    	<script>
    	    $(document).ready(function(){
    	        $('.btn-transfer_mypoints').click(function(){
    	            var mypoints = {{(@$points_amount > 0) ? $points_amount : 0}};
    	            if(mypoints >= 500){
    	                swal({
        	                type:'warning',
        	                title:'Are you sure?',
        	                text:'Do you want to continue?',
        	                showCancelButton: true,
                            confirmButtonText: 'Yes',
                            cancelButtonText: 'No'
    	                }).then(function(isConfirm){
    	                    $('#transfer_guide').modal('hide');
    	                    $.ajax({
    	                    url:"{{asset('user/transfer_points')}}",
    	                    type:"POST",
    	                    headers:{'X-CSRF-TOKEN':$('meta[name="_token"]').attr('content')},
    	                    data:{mypoints:mypoints},
    	                    success:function(data){
    	                        swal({
    	                            type:'success',
    	                            title:'',
    	                            text:'Your time is worth money! Your points are melted down to real money. It usually takes 1 to 2 business days before you have the money in your bank account.'
    	                        }).then(function(){
    	                            location.reload();
    	                        })
    	                    },
    	                    error:function(){
    	                        swal({
    	                            type:'error',
    	                            title:'',
    	                            text:'Failed to Convert Points'
    	                        })
    	                    }
    	                })
    	            })
    	            }else{
    	                swal({
    	                    type:'error',
    	                    title:'',
    	                    text:'Minimum Required points is 500'
    	                })
    	            }
    	        })
    	    })
    	</script>
    <script>
       $(document).ready(function(){
           var table = $('#avail-points').DataTable({
               "order": [[ 0, "desc" ]],
                "iTotalRecords": "0",
                "ajax": {
                  "url": "{{asset('user/avail_points')}}",
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
                {"data":'transaction_label'},
                {'data':'points'},
                {'data':'status',render:function(data){
                    return 'Claimed';
                }},
                {'data': 'date_claimed'},
              ]
           });
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
                    row.child( format(row.data()) ).show();
                    tr.addClass('shown');
                }
           })
           function format(data){
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

