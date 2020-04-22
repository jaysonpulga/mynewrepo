<style>
.padding
{
	padding:40px;

}
.img_desc {
    width: 400px !important; 	
}
.tile-bar
{
	font-weight:bold;
	font-size:24px;
}
.title
{
	font-weight:bold;
	font-size:23px;
}


.product_details
{
	font-size:15px;
	color: #4a4141;
	letter-spacing: 0.05em;
	line-height: 25px;
}


.summary_prod
{
	font-size:15px;
	color: #4a4141;
	line-height: 25px;
}

.product_name
{
	font-size:20px;
	font-weight:bold;
}
.description_p{
    color: #1d1b1b;
    font-size: 15px !important;
	margin-left:22px;
	margin-top:5px;
}
</style>

<div class="row" >
<div class='padding'>

		<div class="col-md-5">
			<img class="img_desc img-bordered-sm img-responsive" src="{{ asset('offer_images')}}/{{$offerdetails[0]->product_photo}}" alt="user image">
		</div>

		<div class="col-md-7">
		
		
			<div class="row">
				<div class="col-lg-12">
						<p class="pull-left tile-bar">{{$offerdetails[0]->Title}}</p>
				</div>
			</div>	
			
			
			<div class="row product_details">
				<div class="col-md-12">
					<span class="product_name"><i class="fa fa-fw fa-cube"></i>&nbsp; {{$offerdetails[0]->product_name}}  </span><br>
					<span><i class="fa fa-fw fa-tags"></i>&nbsp;&nbsp;  {{$offerdetails[0]->product_price}}  </span><br>
					
					<span><i class="fa fa-fw fa-calendar"></i>&nbsp;&nbsp; {{$offerdetails[0]->start_date}}  </span><br>
					<span><i class="fa fa-fw fa-clock-o"></i>&nbsp;&nbsp;  {{$offerdetails[0]->start_time}}  </span><br>
					<span style="color:red"> Discount: $  {{$offerdetails[0]->product_discount}}  </span><br>
					<span><i class="fa fa-fw fa-globe"></i>&nbsp;&nbsp;<a href="" target="_blank"> {{$offerdetails[0]->rotator_link}} </a></span><br>
				</div>
			</div>
			<br>
			
			<div class="row product_details">
				<div class="col-md-12">
					<span class="glyphicon glyphicon-info-sign"></span><br>
					
				<div class="description_p">
								
			
					
					@if($offerdetails[0]->prod_review_link != "")
						
						<span><b>Product Review Page</b><br><a href="{{$offerdetails[0]->prod_review_link}}" target="_blank">{{$offerdetails[0]->prod_review_link}}</a></span><br>
										
					@endif
					
					@if($offerdetails[0]->product_brand != "")
						
					<span><b>Brand</b><br><span> {{$offerdetails[0]->product_brand}}</span</span><br>
										
					@endif
					
					
					@if($offerdetails[0]->shipping_carrier != "")
						
					<span><b>Shipping Carrier</b> <br><span> {{$offerdetails[0]->shipping_carrier}}</span></span><br>
										
					@endif
				
				
					
				</div>
				</div>
			</div>
			<br>
			
			
			@if($offerdetails[0]->product_description != "")
						
				<div class="row product_details">
					<div class="col-lg-12">
						<span class="glyphicon glyphicon-briefcase"></span> <b>Product Description</b><br>
						<div class="description_p">{{ strip_tags($offerdetails[0]->product_description) }}</div>
					</div>	
				</div>
				<br>
								
			@endif
			
		
			
			
			<div class="row product_details">
				<div class="col-lg-12">
						<i class="fa fa-fw fa-pencil-square-o"></i> <b>Summary</b> <br>
						<div class="description_p">{{ strip_tags($offerdetails[0]->Summary) }}</div>
				</div>	
			</div>
			
			
			<br>
			<div class="row product_details">
				<div class="col-lg-12">
						<i class="fa fa-fw fa-server"></i> <b>Detail & Instruction</b> <br>
						<div class="description_p">{{ strip_tags($offerdetails[0]->detail_instruction) }}</div>
				</div>	
			</div>



		</div>
				
					
		<br>	
			
		<!-- button row -->
		<!--
		<div class="marginpadding pull-right">
			<div class="col-lg-12">
				<div class="btn-group mr-2 sw-btn-group" role="group">
					<button   class="btn btn-default sw-btn-next " type="button">Next >></button>&nbsp;&nbsp;
				</div>
			</div>	
		</div>
		-->
		<!-- /button row -->
				
					

</div><!--end padding-->
</div>





<script type="text/javascript">
$(document).ready(function(){

$('#secondstep').addClass('done');

});
</script>