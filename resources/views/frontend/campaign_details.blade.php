@extends('frontend.layouts.main')

@section('content')
<section class="content">
    {{ @$img }}
    <div class="col-md-3">
			  <div class="box custom_box">
				<div class="box-header with-border">
				  <h3 class="box-title">User Settings</h3>

				  <div class="box-tools">
					<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
					</button>
				  </div>
				</div>
				<div class="box-body no-padding">
				  <ul class="nav nav-pills nav-stacked">
				   <li>
						<a href="{{asset('user/profile')}}"> Edit your profile </a>
					</li>
					<li>
						<a href="{{asset('user/avatar')}}"> Upload your avatar </a>
					</li>
					<li > 
						<a href="{{asset('user/changepassword')}}"> Change your password</a>
					</li>
					<li> 
						<a href="{{asset('user/update/interest')}}"> Your product interest</a>
					</li>
					<li class='active'> 
						<a href="{{asset('user/mywallet')}}"> My Wallet</a>
					</li>
					<li> 
						<a href="{{asset('user/mypoints')}}"> My Points</a>
					</li>
				  </ul>
				</div>
			  </div>
		</div>
		    <div class="col-md-4">
            <section class="invoice" style="margin: 5px 10px 5px 10px;">
                <!-- title row -->
                <div class="row">
                    <div class="col-xs-12">
                        <h2 class="page-header">
                            {{ $product_info[0]->product_name }}
                        </h2>
                    </div>
                </div>
                <div class="row invoice-info">
                </div>
                <div class="row">
                    <div class="col-xs-12">
                        <img class="img-responsive" src="{{$img_url.'/'.$product_info[0]->image_path}}" style=" margin: 0 auto;width: auto;  max-height: 300px;">
                    </div>
                    <div class="col-xs-12">
                        <div class="table-responsive">
                            <table class="table" style="margin-bottom:0;">
                                <tbody>
                                <tr>
                                    <th>Campaign:</th>
                                    <td>{{ $product_info[0]->title }}</td>
                                </tr>
                                <tr>
                                    <th>Price:</th>
                                    <td>$ {{ $product_info[0]->amount }}</td>
                                </tr>
                                <tr>
                                    <th>Claimed:</th>
                                    <td>
                                       <small class="label bg-green">Claimed ({{$product_info[0]->sched_date}})</small>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Description:</th>
                                    <td>
                                        {{strip_tags($product_info[0]->product_description)}}
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </section>
            <!-- Widget: user widget style 1 -->

            <!-- /.widget-user -->
        </div>
        
        <div class="col-md-5">
            <section class="invoice"style="margin: 5px 10px 5px 10px;">
                <!-- title row -->
                <div class="row">
                    <div class="col-xs-12">
                        <h2 class="page-header">
                            Your Earnings on this campaign
                        </h2>
                    </div>
                    <!-- /.col -->
                </div>
                <!-- info row -->
                <div class="row">
                    <div class="col-xs-12">
                        <h4>
                            Product Cashback: $ {{ $product_info[0]->amount }}
                        </h4>
                    </div>
                </div>
                <!-- /.row -->
                <!-- Table row -->
                <div class="row">
                    <div class="col-xs-12">
                            <h4>
                                Incentive: {{@$product_info[0]->earn_points}} Points
                                <small>After the product is shipped.</small>
                            </h4>
                        </div>
                </div>
                <div class="row">
                </div>
            </section>
            @if($product_info[0]->status == 'paid')
            <section class="invoice" style="margin: 5px 10px 5px 10px;">
                    <div class="row">
                        <div class="col-xs-12">
                            <h2 class="page-header">
                                PayOut Details
                            </h2>
                            <ul class="timeline">
                                    <li>
                                <!-- timeline icon -->
                                <i class="fa fa-check bg-blue"></i>
                                <div class="timeline-item">
                                    <h3 class="timeline-header">Paid</h3>
                                    <div class="timeline-body">
                                        Your payout has been paid to paypal account with payout sender batch id: <b> {{$product_info[0]->sender_batch_id}}</b>
                                        <br>
                                        <br>
                                        Used email for the payout:<br>
                                        <b>{{$product_info[0]->paypal_account}}</b>
                                        <br>
                                    </div>
                                </div>
                            </li>
                            </ul>
                        </div>
                    </div>
                </section>
                @endif
                <section class="invoice" style="margin: 5px 10px 5px 10px;">
                    <div class="row">
                        <div class="col-xs-12">
                            <h2 class="page-header">
                                Current Status
                            </h2>
                            <ul class="timeline">
                                    <li>
                                <!-- timeline icon -->
                                <i class="fa fa-check bg-blue"></i>
                                <div class="timeline-item">
                                    <h3 class="timeline-header">Order Item Details</h3>
                                    <div class="timeline-body">
                                        <ul style="padding:0;">
                                           <li>Order Item Status : {{ $product_info[0]->remarks }}</li>
                                           <li>Order ASIN : {{ $product_info[0]->product_id }}</li>
                                           <li>Order Item Price : ${{ $product_info[0]->product_price }}</li>
                                           <small>The Order Item Price will be the price you have paid( minus applied discounts and added with paid taxes on this item). You will get this amount as cashback.</small><br>
                                           <small>Order Item Discount: {{ $product_info[0]->product_discount }} {{ ($product_info[0]->product_discount_label == 'Percentage') ? '%':'off'}}</small>
                                        </ul>
                                    </div>
                                </div>
                            </li>
                            </ul>
                        </div>
                    </div>
                </section>
                <section class="invoice" style="margin: 5px 10px 5px 10px;">
                    <div class="col-xs-12">
                        <h2 class="page-header">
                            Cashback &amp; PayOut Status
                        </h2>
                    </div>
                    <div class="row">
                            <div class="col-xs-12">
                                <p>
                                    <button type="button" class="btn btn-info" data-toggle="modal" data-target="#modal-status-timeline">
                                           View Actual Status
                                    </button>
                                    <br>
                                </p>
                            </div>
                        </div>
                </section>
        </div>
        <div class="modal fade" id="modal-status-timeline" style="display: none;">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                            <h4 class="modal-title">Status </h4>
                    </div>
                    <div class="modal-body">
                        <ul class="timeline">
                            <li class="time-label">
                                <span>
                                    {{ date('F j, Y, g:i a',strtotime($product_info[0]->transaction_date)) }}
                                </span>
                            </li>
                            <li>
                                <!-- timeline icon -->
                                <i class="fa fa-envelope bg-blue"></i>
                                <div class="timeline-item">
                                    <span class="time"><i class="fa fa-clock-o"></i> {{ date('h:i:s',strtotime($product_info[0]->transaction_date)) }}</span>
                            
                                    <h3 class="timeline-header">
                                        Order Id Submitted By- {{$product_info[0]->name}} {{$product_info[0]->lastname}}
                                    </h3>
                            
                                    <div class="timeline-body">
                                        <ul>
                                           <li>Order Status : Checked</li>
                                           <li>Order Id : {{($product_info[0]->order_number == '') ? $product_info[0]->amazon_order_number:$product_info[0]->order_number}} </li>
                                           <!--<li>Order Details: {{$product_info[0]->statusWithDetails}}</li>-->
                                        </ul>
                                    </div>
                                </div>
                            </li>
                            <li class="time-label">
                                <span>
                                    {{ date('F j, Y, g:i a',strtotime($product_info[0]->created_at)) }}
                                </span>
                            </li>
                            <li>
                                <!-- timeline icon -->
                                <i class="fa fa-envelope bg-blue"></i>
                                <div class="timeline-item">
                                    <span class="time"><i class="fa fa-clock-o"></i> {{ date('h:i:s',strtotime($product_info[0]->created_at)) }}</span>
                            
                                    <h3 class="timeline-header">
                                        Order Details
                                    </h3>
                            
                                    <div class="timeline-body">
                                        <ul>
                                           <li>Order Purchased Date : {{ date('Y-m-d H:i:s',strtotime($product_info[0]->transaction_date)) }}</li>
                                           <li>Order Status : {{ $product_info[0]->remarks }}</li>
                                           <li>Order Sales Channel : Amazon.com</li>
                                        </ul>
                                    </div>
                                </div>
                            </li>
                            <li class="time-label">
                                <span>
                                    {{ date('F j, Y, g:i a',strtotime($product_info[0]->created_at)) }}
                                </span>
                            </li>
                            <li>
                                <!-- timeline icon -->
                                <i class="fa fa-envelope bg-blue"></i>
                                <div class="timeline-item">
                                    <span class="time"><i class="fa fa-clock-o"></i> {{ date('h:i:s',strtotime($product_info[0]->created_at)) }}</span>
                            
                                    <h3 class="timeline-header">
                                        Order Item Details
                                    </h3>
                            
                                    <div class="timeline-body">
                                        <ul>
                                           <li>Order Item Status : {{ $product_info[0]->remarks }}</li>
                                           <li>Order ASIN : {{ $product_info[0]->product_id }}</li>
                                           <li>Order Item Price : ${{ $product_info[0]->product_price }}</li>
                                           <small>The Order Item Price will be the price you have paid( minus applied discounts and added with paid taxes on this item). You will get this amount as cashback.</small><br>
                                           <small>Order Item Discount: {{ $product_info[0]->product_discount }} {{ ($product_info[0]->product_discount_label == 'Percentage') ? '%':'off'}}</small>
                                        </ul>
                                    </div>
                                </div>
                            </li>
                            @if($product_info[0]->status == 'paid')
                            <li class="time-label">
                                <span>
                                    {{ date('F j, Y, g:i a',strtotime($product_info[0]->payout_processed_date)) }}
                                </span>
                            </li>
                            <li>
                                <!-- timeline icon -->
                                <i class="fa fa-envelope bg-blue"></i>
                                <div class="timeline-item">
                                    <span class="time"><i class="fa fa-clock-o"></i> {{ date('h:i:s',strtotime($product_info[0]->payout_processed_date)) }}</span>
                            
                                    <h3 class="timeline-header">
                                        Bought from Seller - {{$product_info[0]->seller_name}} 
                                    </h3>
                            
                                    <div class="timeline-body">
                                   <ul>
                                       <li>Sender Batch ID : {{$product_info[0]->sender_batch_id}}</li>
                                       <li>Sender Item ID : {{$product_info[0]->sender_item_id}} </li>
                                       <li>CashBack Price: $ {{$product_info[0]->amount}}</li>
                                       <li>Label Details: {{$product_info[0]->pay_method}}</li>
                                   </ul>
                                    </div>
                                </div>
                            </li>
                            @endif
                        </ul>
                        </div>
                    </div>
                </div>
            </div>
</section>
@endsection