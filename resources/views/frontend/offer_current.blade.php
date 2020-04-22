@extends('frontend.layouts.main')

@section('content')
<style>

@font-face{font-family:'Amazon Ember';src:url(https://m.media-amazon.com/images/G/01/AUIClients/AmazonUIFont-amazonember_rg-cc7ebaa05a2cd3b02c0929ac0475a44ab30b7efa._V2_.woff2) format("woff2"),url(https://m.media-amazon.com/images/G/01/AUIClients/AmazonUIFont-amazonember_rg-8a9db402d8966ae93717c348b9ab0bd08703a7a7._V2_.woff) format("woff")}@font-face{font-family:'Amazon Ember';font-style:italic;src:url(https://m.media-amazon.com/images/G/01/AUIClients/AmazonUIFont-amazonember_rgit-9cc1bb64eb270135f1adf3a4881c2ee5e7c37be5._V2_.woff2) format("woff2"),url(https://m.media-amazon.com/images/G/01/AUIClients/AmazonUIFont-amazonember_rgit-a4dc98d644ff2aedd41da3da462f09ffce86eafb._V2_.woff) format("woff")}@font-face{font-family:'Amazon Ember';font-weight:700;src:url(https://m.media-amazon.com/images/G/01/AUIClients/AmazonUIFont-amazonember_bd-46b91bda68161c14e554a779643ef4957431987b._V2_.woff2) format("woff2"),url(https://m.media-amazon.com/images/G/01/AUIClients/AmazonUIFont-amazonember_bd-b605252f87b8b3df5ae206596dac0938fc5888bc._V2_.woff) format("woff")}@font-face{font-family:'Amazon Ember';font-style:italic;font-weight:700;src:url(https://m.media-amazon.com/images/G/01/AUIClients/AmazonUIFont-amazonember_bdit-80ff7aba37dd1ff5a6b90233a19e3a780a96dc2f._V2_.woff2) format("woff2"),url(https://m.media-amazon.com/images/G/01/AUIClients/AmazonUIFont-amazonember_bdit-57598ce426a612be5a1d15eee08252668fca5e7a._V2_.woff) format("woff")}.a-ember body{font-family:"Amazon Ember",Arial,sans-serif}.a-ember .a-text-quote{font-family:"Amazon Ember",Arial,sans-serif}

.STRIKETHROUGH {
    text-decoration: line-through;
    color: #bfbcbc;
}

.active_button
{
	background-color: #dcdada;
    color: #333;
    border-color: #a7a4a4;
	font-weight: bold;
	
	
}
.notactive {
    background-color: #fffefe;
    color: #0c0c0c;
    border-color: #ddd;
}

.custom_box
{
		border: 1px solid #abaaaa;
	      border-radius: 1px !important;
}

.create_box_accepted
{

	
	border: 1px solid #bbb2b2;
    border-radius: 1px !important;
	margin:30px;
	padding:20px;
}



.hover_active {
    background-color: #ddd;
}

.img2 {
    width: 120px !important; 	
}

.img3 {
    width: 50px !important; 	
}
.description {
    color: #444;
    font-size: 15px !important;
	margin-left:22px;
	margin-top:5px;
}
.create_box
{
	padding-top:1px;
	padding-bottom:15px;
	padding-right:5px;
	padding-left:5px;
	border-bottom: 1px solid #d8d4d4;
	margin:30px;
}

.create_box:first-child {
	/*border-top: 1px solid #d8d4d4;*/
	padding-top:5px;
}

.tile-bar
{
	font-weight:bold;
	font-size:22px;
}

.title
{
	font-weight:bold;
	font-size:20px;
}


.product_details
{
	font-size:12px;
	color: #4a4141;
	letter-spacing: 0.05em;
	line-height: 20px;
	font-family: "Amazon Ember",Arial,sans-serif !important; 
}


.a-size-large {
   
}

.a-size-large 
{
    
}


.a-color-secondary {
    color: #555!important;
}

.a-ember body {
    font-family: "Amazon Ember",Arial,sans-serif;
}

</style>

<style>



.s-inline {
    display: inline;
}
.s-inline {
    display: inline;
}


</style>




<style>


.campaign_name
{
	font-family: "Amazon Ember",Arial,sans-serif !important;
	font-weight: 501!important;
	font-size: 19px!important;
    line-height: 1.3!important;
	display: inline;
	
}

.campaign_name_current
{
	font-family: "Amazon Ember",Arial,sans-serif !important;
	font-weight: 501!important;
	font-size: 19px!important;
    line-height: 1.3!important;
	display: inline;
	color: #555!important;
	
}



.product_name_2
{
	font-family: "Amazon Ember",Arial,sans-serif !important;
	font-weight: 400!important;
	font-size: 22px!important;
	line-height: 1.255!important;
	display: inline;
	color: #555!important;
}

.product_price_2
{
	font-family: "Amazon Ember",Arial,sans-serif !important;
	font-weight: 400!important;
	font-size: 18px!important;
	line-height: 1.255!important;
	display: inline;
	color: #B12704!important
	
}


.product_details_2
{
	font-family: "Amazon Ember",Arial,sans-serif !important;
	font-weight: 400!important;
	font-size: 13px!important;
	line-height: 1.255!important;
	display: inline;
	color: #555!important
}

</style>



<style>
.summary_prod
{
	font-size:15px;
	color: #4a4141;
	line-height: 25px;
}

.product_name
{
	font-size:17px;
	font-weight:normal;
	font-weight: 400!important;
}

.STRIKETHROUGH 
{
    text-decoration: line-through;
	color: #a0a0a0; 
}

.jumbotronText 
{
    color: #73879C;
    font-family: "Helvetica Neue",Roboto,Arial,"Droid Sans",sans-serif;
    font-size: 14px;
    font-weight: 400;
    line-height: 1.471;
}

.product_information
{
	font-size: 13px;
}

.line
 {
    border-bottom: 2px solid #f4f4f4;
    display: block;
    padding: 10px;
    position: relative;
}


th.ui-widget-header {
    font-size: 9pt !important;
    font-family: Verdana, Arial, Sans-Serif !important;
}
</style>





<style>

@keyframes placeHolderShimmer
{
    0%{
        background-position: -468px 0
    }
    100%{
        background-position: 468px 0
    }
}
.animated-background {
    animation-duration: 1s;
    animation-fill-mode: forwards;
    animation-iteration-count: infinite;
    animation-name: placeHolderShimmer;
    animation-timing-function: linear;
    background: #f6f7f8;
    background: linear-gradient(to right, #eeeeee 8%, #dddddd 18%, #eeeeee 33%);
    background-size: 800px 104px;
    height: 96px;
    position: relative;
}

.animated-text {
    animation-duration: 1s;
    animation-fill-mode: forwards;
    animation-iteration-count: infinite;
    animation-name: placeHolderShimmer;
    animation-timing-function: linear;
    background: #f6f7f8;
    background: linear-gradient(to right, #eeeeee 8%, #dddddd 18%, #eeeeee 33%);
    background-size: 800px 104px;
    height: 13px;
    position: relative;
	width:310px;
}
.animated-button
{
	animation-duration: 1s;
    animation-fill-mode: forwards;
    animation-iteration-count: infinite;
    animation-name: placeHolderShimmer;
    animation-timing-function: linear;
    background: #f6f7f8;
    background: linear-gradient(to right, #eeeeee 8%, #dddddd 18%, #eeeeee 33%);
    background-size: 800px 104px;
    height: 30px;
    position: relative;
	width:75px;
}


.current_deals
 {
    padding-left: 12px;
    padding-bottom: 2px;
    padding-top: 4px;
    background: #e0138e;
	margin-bottom:5px;
	color:#fff;
    border: solid 1px #cec7c7;
  
}

.current_body
 {
    padding-left: 12px;
    padding-bottom: 2px;
    padding-top: 4px;
  
}

.featured_deals
 {
    padding-left: 12px;
    padding-bottom: 2px;
    padding-top: 4px;
    background: #3c8dbc;
	color:#fff;
    border: solid 1px #cec7c7;
  
}


.featured_body
 {
    padding-left: 6px;
    padding-bottom: 2px;
    padding-top: 4px;
  
}
</style>

<div>
	<div class="current_deals">
		<div class="row">
			<div class="col-md-8">
				<h4><i>Your Current Active Deals</i></h4>			
			</div>
			<div class="col-md-4">
				<h4><i>Next Actions</i></h4>	
			</div>
		</div>
	</div>
	<div class='current_body'>
	
		<div>
			<div class="row">
					<div class="col-md-8">
						<div class="row">
							<div class="col-md-2">
								<img class="img3  img-responsive" src="http://localhost/azmproject/public/offer_images/default_product.jpg" alt="user image">
							</div>
							<div class="col-md-10">
								<h5 class='text_c' >My sample Product  <a style='font-size:14px' href='#'>view details</a></h5> 
							</div>
						</div>	
					</div>
					<div class="col-md-2">
					<h6 class='text_c'>Buy Product on June 2,2019</h6>
					</div>
					<div class="col-md-2">
						<div class='pull-right button_c'><span class="label label-success" style='font-size:12px'>Active</span></div>
					</div>
			</div>
			<div style="border-bottom:1px solid #d9dde2;margin-top:10px;margin-bottom:10px"></div>
		</div>
		
		<div>
			<div class="row">
					<div class="col-md-8">
						<div class="row">
							<div class="col-md-2">
								<img class="img3  img-responsive" src="http://localhost/azmproject/public/offer_images/qZek6ll5kt.jpeg" alt="user image">
							</div>
							<div class="col-md-10">
								<h5 class='text_c' >Sample Product 123 <a style='font-size:14px' href='#'>view details</a></h5> 
							</div>
						</div>	
					</div>
					<div class="col-md-2">
					<h6 class='text_c'>Buy Product on May 26, 2019</h6>
					</div>
					<div class="col-md-2">
						<div class='pull-right button_c'><span class="label label-success" style='font-size:12px'>Active</span></div>
					</div>
			</div>
			<div style="border-bottom:1px solid #d9dde2;margin-top:10px;margin-bottom:10px"></div>
		</div>
		
		<div>
			<div class="row">
					<div class="col-md-8">
						<div class="row">
							<div class="col-md-2">
								<img class="img3  img-responsive" src="http://localhost/azmproject/public/offer_images/Ha9Z0yK72G.jpeg" alt="user image">
							</div>
							<div class="col-md-10">
								<h5 class='text_c' >Title of products <a style='font-size:14px' href='#'>view details</a></h5> 
							</div>
						</div>	
					</div>
					<div class="col-md-2">
					<h6 class='text_c'>Leave Review <br>on Purchase Experience</h6>
					</div>
					<div class="col-md-2">
						<div class='pull-right button_c'><span class="label label-success" style='font-size:12px'>Active</span></div>
					</div>
			</div>
			<div style="border-bottom:1px solid #d9dde2;margin-top:10px;margin-bottom:10px"></div>
		</div>
	
	</div>
	
</div>


<style>
.text_c {
  display: inline-block;
  vertical-align: middle;
  line-height: normal;
  margin-top:10px;
}

.button_c
{
	margin-top:10px;
	margin-right:10px;
}

.chat-box-main {
  max-height: 100px;
   max-height: 100px;
 

}

	
.fixphoto
{
	max-height: 100px;

   overflow: hidden;

}

.fix_text
{
	max-height: 10px;
   overflow: hidden;
}

.photo_fix
{
	max-height: 120px;
	min-height: 120px;
	height : 120px;
	overflow: hidden;
	background-color:none;
	margin-bottom:5px;
}

.text_fix
{

	min-height: 75px;
	max-height: 75px;
	height : 75px;
	overflow: hidden;
	background-color:none;
	margin-bottom:8px;
}


span.text_fix_mod {
	font-size: 11px !important;
	padding-left: 3px !important;
	padding-right: 3px !important;
   line-height: 1% !important;
}



.title_fix
{

	min-height: 55px;
	max-height: 55px;
	background-color:none;
	overflow : hidden;
	margin-bottom:8px;
}
span.title_fix_mod {
	font-weight:bold;
	font-size: 14px !important;
	padding-left: 3px !important;
	padding-right: 3px !important;
   line-height: 1.5% !important;

}




</style>

<br>
<div>
<div class="featured_deals">
	<div class="row">
		<div class="col-md-12">
			<h4><i>Featured Review Deals</i></h4>			
		</div>
	</div>
</div>
<div class='featured_body'>
<div class="row">



<div class="col-md-2">
	<div class="fancybox thumbnail">
	<div class='photo_fix'><img class="img-responsive" alt="" src="http://localhost/intouch/public/canvas/photo_storage/photostorage/KkhVu1rX.jpg? 0.22691392164727642"></div>
	<div class='title_fix'><span class='title_fix_mod'> {{ str_limit('Kunwari product test 12/2 test kunwari product S/M/L test to sawa', 55) }}  </span></div>
	<span class='product_price'><span style='color:red;font-size:12px' class='STRIKETHROUGH'>$15.00</span> $12.00</span><br><br>
	<a href="{{asset('campaign/getdata/insight/productdetails/41')}}" style="width:100%" class="btn btn-default btn-flat">View Details</a>		
	</div>
</div>


<div class="col-md-2">
	<div class="fancybox thumbnail">
	<div class='photo_fix'><img class="img-responsive" alt="" src="http://localhost/azmproject/public/offer_images/e5lNEpTyjT.png"></div>
	<div class='title_fix'><span class='title_fix_mod'>kulang ang message </span></div>
	<span class='product_price'><span style='color:red;font-size:12px' class='STRIKETHROUGH'>$15.00</span> $12.00</span><br><br>
	<a href="http://localhost/intouch/public/showviewimage/KkhVu1rX" style="width:100%" class="btn btn-default btn-flat">View Details</a>	
	</div>
</div>


<div class="col-md-2">
	<div class="fancybox thumbnail">
	<div class='photo_fix'><img class="img-responsive" alt="" src="http://localhost/azmproject/public/offer_images/qZek6ll5kt.jpeg"></div>
	<div class='title_fix'><span class='title_fix_mod'>kulang ang messagesss SML TEXT TEXT TEXT </span></div>
	<span class='product_price'><span style='color:red;font-size:12px' class='STRIKETHROUGH'>$15.00</span> $12.00</span><br><br>
	<a href="http://localhost/intouch/public/showviewimage/KkhVu1rX" style="width:100%" class="btn btn-default btn-flat">View Details</a>	
	</div>
</div>


<div class="col-md-2">
	<div class="fancybox thumbnail">
	<div class='photo_fix'><img class="img-responsive" alt="" src="http://localhost/intouch/public/canvas/photo_storage/photostorage/KkhVu1rX.jpg? 0.22691392164727642"></div>
	<div class='title_fix'><span class='title_fix_mod'>Cult Sample test 123/ SML available 45 products </span></div>
	<span class='product_price'><span style='color:red;font-size:12px' class='STRIKETHROUGH'>$15.00</span> $12.00</span><br><br>
	<a href="http://localhost/intouch/public/showviewimage/KkhVu1rX" style="width:100%" class="btn btn-default btn-flat">View Details</a>	
	</div>
</div>





<!--
<div class="col-md-2 chat-box-main " style="margin-bottom:10px;max-height:325px">
	<div class="fancybox thumbnail">
		<img class="img-responsive fixphoto" alt="" src="http://localhost/azmproject/public/offer_images/Ha9Z0yK72G.jpeg"><br>
		<div  style="margin-top:-15px">
		<span class='product_name2'>Kunwari product test</span><br>
		<span class='fix_text'>A product description is the marketing copy that explains </span><br>
		<span class='product_price'><span style='color:red;font-size:12px' class='STRIKETHROUGH'>$15.00</span> $12.00</span><br><br>
		<a href="http://localhost/intouch/public/showviewimage/KkhVu1rX" style="width:100%" class="btn btn-default btn-flat">View Details</a>
		</div>
	</div>
</div>

<div class="col-md-2 chat-box-main " style="margin-bottom:10px;min-height:325px">
	<div class="fancybox thumbnail">
		<img class="img-responsive fixphoto" alt="" src="http://localhost/intouch/public/canvas/photo_storage/photostorage/KkhVu1rX.jpg? 0.22691392164727642"><br>
		<div  style="margin-top:-15px">
		<span class='product_name2'>Product Name Here</span><br>
		<span class='product_desc2 fix_text'>A product description is the marketing copy that explains what a product is and why it's worth purchasing.</span><br>
		<span class='product_price'><span style='color:red;font-size:12px' class='STRIKETHROUGH'>$15.00</span> $12.00</span><br><br>
		<a href="http://localhost/intouch/public/showviewimage/KkhVu1rX" style="width:100%" class="btn btn-default btn-flat">View Details</a>
		</div>
	</div>
</div>

<div class="col-md-2 chat-box-main " style="margin-bottom:10px;min-height:325px">
	<div class="fancybox thumbnail">
		<img class="img-responsive fixphoto" alt="" src="http://localhost/azmproject/public/offer_images/qZek6ll5kt.jpeg"><br>
		<div  style="margin-top:-15px">
		<span class='product_name2'>Product Name Here</span><br>
		<span class='product_desc2 fix_text'>A product description is the marketing copy that explains what a product is and why it's worth purchasing.</span><br>
		<span class='product_price'><span style='color:red;font-size:12px' class='STRIKETHROUGH'>$15.00</span> $12.00</span><br><br>
		<a href="http://localhost/intouch/public/showviewimage/KkhVu1rX" style="width:100%" class="btn btn-default btn-flat">View Details</a>
		</div>
	</div>
</div>

<div class="col-md-2 chat-box-main " style="margin-bottom:10px;min-height:325px">
	<div class="fancybox thumbnail">
		<img class="img-responsive fixphoto" alt="" src="http://localhost/intouch/public/canvas/photo_storage/photostorage/KkhVu1rX.jpg? 0.22691392164727642"><br>
		<div  style="margin-top:-15px">
		<span class='product_name2'>Product Name Here</span><br>
		<span class='product_desc2 fix_text'>A product description is the marketing copy that explains what a product is and why it's worth purchasing.</span><br>
		<span class='product_price'><span style='color:red;font-size:12px' class='STRIKETHROUGH'>$15.00</span> $12.00</span><br><br>
		<a href="http://localhost/intouch/public/showviewimage/KkhVu1rX" style="width:100%" class="btn btn-default btn-flat">View Details</a>
		</div>
	</div>
</div>

<div class="col-md-2 chat-box-main " style="margin-bottom:10px">
	<div class="fancybox thumbnail">
		<img class="img-responsive fixphoto" alt="" src="http://localhost/azmproject/public/offer_images/e5lNEpTyjT.png"><br>
		<div  style="margin-top:-15px">
		<span class='product_name2'>Product Name Here</span><br>
		<span class='product_desc2 fix_text'>A product description is the marketing copy that explains what a product is and why it's worth purchasing.</span><br>
		<span class='product_price'><span style='color:red;font-size:12px' class='STRIKETHROUGH'>$15.00</span> $12.00</span><br><br>
		<a href="http://localhost/intouch/public/showviewimage/KkhVu1rX" style="width:100%" class="btn btn-default btn-flat">View Details</a>
		</div>
	</div>
</div>
-->




<style>
.product_desc2
{
	font-size:11px !important;
	padding-left:3px !important;
	padding-right:3px !important;
	 line-height: 1.2;
}
.product_name2
{
	font-size:14px !important;
	padding-left:3px !important;
	padding-right:3px !important;
	 line-height: 1.2;
	 font-weight:bold;
}
</style>


</div>

</div>

</div>



<br>
@if(@$user_countoffer > 0)
	
<div class="box box-widget custom_box">
	<div class="box-header with-border">
		<div class='row'>
		
		
	
			<div class="col-lg-12">
				<div class="pull-right">
					<span style='display:inline;margin-right:30px'>
						<span style='margin-top:-10px;padding-right:10px'>Filter By</span>	
						<div class="btn-group dropdown">
							  <a href="javascript:void(0);" class="btn btn-default btn-flat maindropdown" data-toggle="dropdown" aria-expanded="false">All Listing</a>
							   <button type="button" class="btn btn-default btn-flat dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
								<span class="caret"></span>
							  </button>
							
							<ul id='group_category' class="dropdown-menu" role="menu">
							
								<li><a id="" href="javascript:void(0);" class='hover_active'>All Category</a></li>
								<li><a id="Clothing,Shoes & Accessories" href="javascript:void(0);">Clothing,Shoes & Accessories</a></li>
								<li><a id="Toys & Games" href="javascript:void(0);">Toys & Games</a></li>
								<li><a id="Garden & Outdoors" href="javascript:void(0);">Garden & Outdoors</a></li>
								<li><a id="Tools,Home & Improvement" href="javascript:void(0);">Tools,Home & Improvement</a></li>
								<li><a id="Health & Household" href="javascript:void(0);">Health & Household</a></li>
								<li><a id="Baby Care" href="javascript:void(0);">Baby Care</a></li>
								<li><a id="Sports & Outdoors" href="javascript:void(0);">Sports & Outdoors</a></li>
								
							</ul>
						  
						
						 </div> 
					</span>
					
								
					<span style='display:inline'>
						<span style='margin-top:-10px;padding-right:10px'>Sort By</span>	
						<div class="btn-group dropdown">
							  <a href="javascript:void(0);" class="btn btn-default btn-flat maindropdown" data-toggle="dropdown" aria-expanded="false">All Listing</a>
							   <button type="button" class="btn btn-default btn-flat dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
								<span class="caret"></span>
							  </button>
								
									 <ul id='campaign_ss' class="dropdown-menu" role="menu">
										<li><a id="" href="javascript:void(0);" class='hover_active'>All Listing</a></li>
										<li class="divider"></li>
										<li><a id="insight campaign" href="javascript:void(0);">Insight Campaign</a></li>
										<li><a id="fullbuy campaign" href="javascript:void(0);">Fullbuy Campaign</a></li>
										<li class="divider"></li>
										<li><a id="addtocart campaign" href="javascript:void(0);">Add To Cart Campaign</a></li>
										<li><a id="compare campaign" href="javascript:void(0);">Compare Campaign</a></li>
									  </ul>
							
						 </div> 
					</span>
				
				</div>
					
			</div>
		</div>
		
	</div>
	  
	 <div class="box-body">
	  
	  
	@if(@$campaign_offer > 0)

		<div id='accepted_offer'>
			<div style='margin-left:35px;color:#7f7f80'>
				<h3>Accepted Offer</h3>			
			</div>
			<div id='AcceptedofferData'></div>
			<div class="line"></div>
		</div>
		
	@endif	
		
		<div style='margin-left:35px;margin-top:40px;color:#7f7f80'>
			<h3>Current Offer</h3>
		</div>
		<div id='offerData'></div>
	  </div>
	  <!-- /.box-body -->


  
	  
</div>


@else

<div class='row'>
	<div class="col-lg-12">
		<div class="jumbotron jumbotronText" >
			<div class="container">
				<h1 class="display-4"> Hello, {{Auth::user()->name}} </h1>
				<p class="lead"> 
					Thank you for subscribing to our site, 
					at the moment, you have no campaign yet. 
					we will be notified when there is ready.
				</p>
			</div>
		</div>
	</div>
</div>

@endif



<div id="sheduleinfo" class="modal fade" role="dialog">
      <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Schedule Details</h4>
          </div>
          <div class="modal-body" id="showinfo">
				LOADING Schedule. . . . . . . . . 
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          </div>
        </div>

      </div>
 </div>
<!-- /.content -->


 

<script>
$("#campaign_ss.dropdown-menu li a").click(function()
{
  var selText = $(this).text();
  var id = $(this).attr("id");
  
  $(this).parents('.dropdown').find('.maindropdown').empty().html(selText);
  $('#campaign_ss.dropdown-menu li a').removeClass('hover_active');
  $(this).addClass('hover_active');
  GetOfferData(); // call GetOfferData


});


$("#group_category.dropdown-menu li a").click(function()
{
  var selText = $(this).text();
  var id = $(this).attr("id");
   
 $(this).parents('.dropdown').find('.maindropdown').empty().html(selText);
  $('#group_category.dropdown-menu li a').removeClass('hover_active');
  $(this).addClass('hover_active');
  GetOfferData(); // call GetOfferData 


});

</script>





<script id="current-template" type="text/template">

<div class="create_box">
		<div class="row">
		
			<div class="col-md-3">	
				<div class="animated-background"></div>
			</div>

			<div class="col-md-9">
			
				<div class="row title_header">
					<div class="col-lg-8">
						<div id='title' class='animated-text'></div>
					</div>
					<div class="col-lg-4">
						<span class="pull-right">
							<button  class="animated-button"></button>&nbsp;&nbsp;&nbsp;
							<button  class="animated-button"></button>
						</span>
					</div>
				</div>
				
				<div class="row product_details">
					<div class="col-md-8">
						<div class="product_price">
							<div id='product_name' class='animated-text'></div><br>
							<div id='product_price' class='animated-text'></div><br>
							<div id='discount' class='animated-text'></div><br>
						</div>
						<div class="product_information">
							<div id='start_date' class='animated-text'></div><br>
						</div>
						<div class="rotator_link">
							<div id='link' class='animated-text'></div><br>
						</div>
						<div class="product_information">
							<div id='product_review' class='animated-text'></div><br>
							<div id='interest' class='animated-text'></div><br>
						</div>
					</div>
					<div class="col-md-4"></div>
				</div>
			
			</div>
							
		</div>
</div>

<div class="create_box">
		<div class="row">
		
			<div class="col-md-3">	
				<div class="animated-background"></div>
			</div>

			<div class="col-md-9">
			
				<div class="row title_header">
					<div class="col-lg-8">
						<div id='title' class='animated-text'></div>
					</div>
					<div class="col-lg-4">
						<span class="pull-right">
							<button  class="animated-button"></button>&nbsp;&nbsp;&nbsp;
							<button  class="animated-button"></button>
						</span>
					</div>
				</div>
				
				<div class="row product_details">
					<div class="col-md-8">
						<div class="product_price">
							<div id='product_name' class='animated-text'></div><br>
							<div id='product_price' class='animated-text'></div><br>
							<div id='discount' class='animated-text'></div><br>
						</div>
						<div class="product_information">
							<div id='start_date' class='animated-text'></div><br>
						</div>
						<div class="rotator_link">
							<div id='link' class='animated-text'></div><br>
						</div>
						<div class="product_information">
							<div id='product_review' class='animated-text'></div><br>
							<div id='interest' class='animated-text'></div><br>
						</div>
					</div>
					<div class="col-md-4"></div>
				</div>
			
			</div>
							
		</div>
</div>

</script>






<script>

GetOfferData();

function GetOfferData()
{
	
	var htmlData = '';	
	var menudata = $("#campaign_ss.dropdown-menu li a.hover_active").attr("id");
	var group_category = $("#group_category.dropdown-menu li a.hover_active").attr("id");
	
	if(menudata == '')
	{
		var label = 'All Campaign'
	}
	else
	{
		var label = menudata.capitalize();
	}
	
	$("#display_selected").empty().html(label);
	
	$.ajax({

		"url": "{{asset('campaign/getdata/currentoffer')}}",
		"type": 'GET',
		data: {'menudata':menudata,"_token":$('#token').val(),'group_category':group_category},	
		beforeSend: function() 
		{			
				
				var current = $('#current-template').html();
				$("#offerData").empty().html(current);	

				
		},	
		success: function(details)
		{
			
			if(details.length > 0 ) 
			{
				
				
				$.each(details, function( index, value ) 
				{
					
					 htmlData += currentOfferTemplate(value.campaign_data,value.image_path,value.schedule_offer);
					
				
				});
				
			}
			else
			{
				
		
				htmlData += '<div class="col-lg-12">';
				htmlData += '<div class="col-lg-12">';
				htmlData += '<div class="bg-gray color-palette">';
				htmlData += '<h3 class="text-muted well well-sm no-shadow" style="margin-top:20px;margin-bottom:20px;padding:70px">';
				htmlData += '<center><i class="fa fa-fw fa-ban"></i> No Available Details for '+label+' </center>';
				htmlData +='</h3>';
				htmlData +='</div>';
				htmlData +='</div>';
				htmlData +='</div>';
			
			}
		
			 
			$("#offerData").empty().hide().append(htmlData).animate({ opacity: "show" }, "slow");
			
	
		},
		error: function (jqXHR, exception) 
		{
				var msg = '';
				if (jqXHR.status === 0) {
					msg = 'Not connect.\n Verify Network.';
				} else if (jqXHR.status == 404) {
					msg = 'Requested page not found. [404]';
				} else if (jqXHR.status == 500) {
					msg = 'Internal Server Error [500].';
				} else if (exception === 'parsererror') {
					msg = 'Requested JSON parse failed.';
				} else if (exception === 'timeout') {
					msg = 'Time out error.';
				} else if (exception === 'abort') {
					msg = 'Ajax request aborted.';
				} 
				else if (jqXHR.status == 401) {
					msg = jqXHR.responseText;
				} 
				else {
					msg = 'Uncaught Error.\n' + jqXHR.responseText;
				}
			   
				alert(msg);
		},
		
	});
}

String.prototype.capitalize = function() {
    return this.charAt(0).toUpperCase() + this.slice(1);
}
</script>








<script>
function loadCarousel(value,image)
{
	var carousel = '';
	carousel +=	'<div id="carousel-example-generic_'+value.id+'" class="carousel slide" data-ride="carousel">';
	carousel += '<ol class="carousel-indicators">';
		$.each( image, function( key, imagedata ) {
			var classdata = ((key == 0) ? 'active' : '');
			carousel += '<li data-target="#carousel-example-generic_'+value.id+'" data-slide-to="'+key+'" class="'+classdata+'"  ></li>';
		});
	carousel += '</ol>'
						
	carousel +=  '<div class="carousel-inner">'
	
	
	$.each( image, function( key, imagedata ) {
		
		var classdata = ((key == 0) ? 'active' : '');
		var image_path = imagedata.image_path;
		var image_route = "{{ asset('offer_images')}}/"+image_path;
		
		carousel +=  '<div class="item '+classdata+'">';
		carousel +=  '<img src="'+image_route+'" alt="First slide">';
		carousel +=  '<div class="carousel-caption">';
		carousel +=  '</div>';
		carousel +=  '</div>';
		
	});
	
				

	carousel += '</div>';
				
				
	carousel += '<a class="left carousel-control" href="#carousel-example-generic_'+value.id+'" data-slide="prev">';
	carousel += '<span class="fa fa-angle-left"></span>';
	carousel += '</a>';	
	carousel += '<a class="right carousel-control" href="#carousel-example-generic_'+value.id+'" data-slide="next">';
	carousel += '<span class="fa fa-angle-right"></span>';
	carousel += '</a>';
    carousel += '</div>';

	return carousel;
	
}
</script>



<script id="default-template" type="text/template">
<div class="create_box_accepted" >
			<div class="row">
			
				<div class="col-md-2">
				
					<div class="animated-background"></div>
			
				</div>
				
				<div class="col-md-10" style="padding-left:20px">
					
					<div class="row title_header">
						<div class="col-lg-12">
							<div id='title' class='animated-text'></div><br>
						</div>
					</div>
					
					<div class="row product_details">
						<div class="col-md-5" style="background-color:">
							<div class="product_price">
								<div id='product_name' class='animated-text'></div><br>
								<div id='product_price' class='animated-text'></div><br>
								<div id='discount' class='animated-text'></div><br>
							</div>
							<div class="product_information">
								<div id='product_info' class='animated-text'></div><br>
							</div>
						</div>	
						<div class="col-md-7 pull-left" style="background-color:">	
							<div class="product_information">
								<div id='product_info' class='animated-text'></div><br>
							</div>
							<div class="product_information">
								<div id='product_info' class='animated-text'></div><br>
								<div id='product_info' class='animated-text'></div><br>
							</div>
						</div>
					</div>
				</div>
			</div>
</div>

<div class="create_box_accepted" >
			<div class="row">
			
				<div class="col-md-2">
				
					<div class="animated-background"></div>
			
				</div>
				
				<div class="col-md-10" style="padding-left:20px">
					
					<div class="row title_header">
						<div class="col-lg-12">
							<div id='title' class='animated-text'></div><br>
						</div>
					</div>
					
					<div class="row product_details">
						<div class="col-md-5" style="background-color:">
							<div class="product_price">
								<div id='product_name' class='animated-text'></div><br>
								<div id='product_price' class='animated-text'></div><br>
								<div id='discount' class='animated-text'></div><br>
							</div>
							<div class="product_information">
								<div id='product_info' class='animated-text'></div><br>
							</div>
						</div>	
						<div class="col-md-7 pull-left" style="background-color:">	
							<div class="product_information">
								<div id='product_info' class='animated-text'></div><br>
							</div>
							<div class="product_information">
								<div id='product_info' class='animated-text'></div><br>
								<div id='product_info' class='animated-text'></div><br>
							</div>
						</div>
					</div>
				</div>
			</div>
</div>
</script>


<script>

AcceptedOffer();

function AcceptedOffer()
{
	
	var htmlData2 = '';	
	var menudata = $("#campaign_ss.dropdown-menu li a.hover_active").attr("id");	
	var group_category = $("#group_category.dropdown-menu li a.hover_active").attr("id");
	

	if(menudata == '')
	{
		var label = 'All Campaign'
	}
	else
	{
		//var res = menudata.split(" ");
		//var label = res[0].capitalize() + ' ' + res[1].capitalize();
		var label = menudata.capitalize();
	}
	
	$("#display_selected").empty().html(label);
	
	$.ajax({

		"url": "{{asset('campaign/getdata/acceptedoffer')}}",
		"type": 'GET',
		data: {'menudata':menudata,"_token":$('#token').val(),'group_category':group_category},	
		beforeSend: function() 
		{			
				
				var templatexx = $('#default-template').html();
				$("#AcceptedofferData").empty().html(templatexx);						
		},	
		success: function(details)
		{
			
		if(details.length > 0 ) {
			
			$.each(details, function( index, value ) 
			{
				
				htmlData2 += AcceptedTemplate(value.campaign_data,value.image_path);
				
			});
			
			$("#AcceptedofferData").empty().hide().append(htmlData2).animate({ opacity: "show" }, "slow");
			
		}
		else
		{
			
			/*
			htmlData2 +=	'<div class="row">';
			htmlData2 += '<div class="col-lg-12">';
			htmlData2 += '<div class="bg-gray color-palette">';
			htmlData2 += '<h3 class="text-muted well well-sm no-shadow" style="margin-top:20px;margin-bottom:20px;padding:70px">';
			htmlData2 += '<center><i class="fa fa-fw fa-ban"></i> No Available Details for '+label+' </center>';
			htmlData2 +='</h3>';
			htmlData2 +='</div>';
			htmlData2 +='</div>';
			htmlData2 +='</div>'; 
			*/
			
			//$("#accepted_offer").css('display','none');
			
		}
		
			 
			
			
	
		},
		error: function (jqXHR, exception) 
		{
				var msg = '';
				if (jqXHR.status === 0) {
					msg = 'Not connect.\n Verify Network.';
				} else if (jqXHR.status == 404) {
					msg = 'Requested page not found. [404]';
				} else if (jqXHR.status == 500) {
					msg = 'Internal Server Error [500].';
				} else if (exception === 'parsererror') {
					msg = 'Requested JSON parse failed.';
				} else if (exception === 'timeout') {
					msg = 'Time out error.';
				} else if (exception === 'abort') {
					msg = 'Ajax request aborted.';
				} 
				else if (jqXHR.status == 401) {
					msg = jqXHR.responseText;
				} 
				else {
					msg = 'Uncaught Error.\n' + jqXHR.responseText;
				}
			   
				alert(msg);
		},
		
	});
}

String.prototype.capitalize = function() {
    return this.charAt(0).toUpperCase() + this.slice(1);
}
</script>




<script>
function AcceptedTemplate(value,image)
{
	var image_path = '';
	var imageDiv = '';
	var Status_msg ="";
	var discount_html= "";
	
	JSDate.Init(value.start_date);
	start_date = JSDate.HumanDate(); // Convert Timestamp as 
	
	if(image.length != 0)
	{
		//imageDiv = loadCarousel(value,image);
		//image_path = "default_product.jpg";
		image_path = image[0].image_path;
		var image_route = "{{ asset('offer_images')}}/"+image_path;
		imageDiv =	'<img class="img2 img-bordered-sm img-responsive" src="'+image_route+'" alt="user image">';
	}
	else
	{
		image_path = "default_product.jpg";
		var image_route = "{{ asset('offer_images')}}/"+image_path;
		imageDiv =	'<img class="img2 img-bordered-sm img-responsive" src="'+image_route+'" alt="user image">';
	}

	/*** if user accept the offer -> table name schedule_confirm_users have data **/
	if(value.user_product_id!= null)
	{
		var user_price = parseFloat(value.user_product_price).toFixed(2);
		var user_discount = value.user_product_discount;
		
		if (user_discount != "") 
		{
			
			
			if(value.user_product_discount_label == "Percentage")
			{
				var discount_percent = parseFloat(user_discount) / 100;
				var discount_price = user_price * parseFloat(discount_percent).toFixed(2);
				var final_price = user_price - parseFloat(discount_price).toFixed(2);
			}
			else if(value.user_product_discount_label == "Dollar")
			{
				var discounted_price_dallor = (parseFloat(user_price).toFixed(2) - parseFloat(user_discount).toFixed(2));
				var final_price =  parseFloat(discounted_price_dallor).toFixed(2);
			}
			
			
		}
		else
		{
			
			var final_price = value.user_product_price;
		}
		
		
		if (Number(user_discount) != 0) 
		{
			var original_price = parseFloat(user_price).toFixed(2);
			discount_html +=	 '<span> Was <span class="STRIKETHROUGH">$'+original_price+'</span></span><br>';
			
			if(value.user_product_discount_label == "Percentage")
			{
				discount_html +=	 '<span style="color:red"> Discount: '+Number(user_discount)+'%off</span><br>';
			}
			else if(value.user_product_discount_label == "Dollar")
			{
				discount_html +=	 '<span style="color:red"> Discount: $'+user_discount+'</span><br>';
			}
		
		}
	}	
	
	
	var rotator_link = "";
	if(value.rotator_link != "")
	{
		 rotator_link = '<i class="fa fa-fw fa-globe"></i>&nbsp;&nbsp; <a href="'+value.rotator_link+'" target="_blank">'+value.rotator_link+'</a><br>';
	}
	
	var	 prod_review_link = "";
	if(value.prod_review_link != "")
	{
		prod_review_link = '<b>Product review Link:</b>&nbsp;&nbsp; <a href="'+value.prod_review_link+'" target="_blank">'+value.prod_review_link+'</a><br>';
	}
	
	var group_interest = "";
	if(value.group_interest != "")
	{
		 group_interest = '<b>Group & Interest:</b> &nbsp;&nbsp;'+value.group_interest+'</span><br>';
	}
	
	var product_brand = "";
	if(value.product_brand != "")
	{
		 product_brand = '<b>Brand:</b> &nbsp;&nbsp;'+value.product_brand+'</span><br>';
	}
	
	
	var template = 
	`<div class="create_box_accepted" id="${value.id}">
		<div class="row">
		
			<div class="col-md-2">
				${imageDiv}
			</div>
			
			<div class="col-md-10" style="padding-left:1px">
				
				<div class='row'>
					<div class="col-lg-12">
						<!--<a href="${value.link}" ><p class="pull-left tile-bar"></p></a><br> -->
						<a class="campaign_name"  href="${value.link}">${value.Title}</a>
					</div>
				</div>
				
				<div class="row title_product_name">
					<div class="col-lg-12">
							<span  class="product_name_2" >${value.product_name}</span>
					</div>
				</div>
				
				<div class="row product_details">
				
					<div class="col-md-5">
						<div class="product_price">
							<span class="product_details_2">Price: <span class='product_price_2'>$${final_price}</span></span><br>
							<div class='product_details_2'>${discount_html}</div>
						</div>
						
					</div>	
				
					<div class="col-md-4 pull-left">	
						<!--
						<div class="product_information">
							${rotator_link}
						</div>
						<div class="product_information">
							${prod_review_link}
							${group_interest}
						</div>
						-->
						<div class="product_details_2">
							<span>Status:</span>   <span class="label label-success" style='font-size:11px'>${value.offer_status}</span> <br>
						</div>
						<div class="product_details_2">
							<span>Active Date:</span><br>
							<span>${start_date} ${value.start_time}</span><br>
						</div>
						
					</div>
					
					<div class="col-md-3 pull-left">
						<br>
						<div class="product_details_2">
							<span>Expired Date:</span><br>
							<span>${start_date} ${value.start_time}</span><br>
						</div>
					</div>
					
				</div>
			
			</div>
	
		</div>
	</div>`
	return template;
}
</script>


<script>
function currentOfferTemplate(value,image,schedule_offer)
{
	var image_path = '';
	var imageDiv = '';
	var Status_msg ="";
	var discount_html= "";
	
	
	JSDate.Init(value.start_date);
	start_date = JSDate.HumanDate(); // Convert Timestamp as 

	if(image.length != 0)
	{
		//imageDiv = loadCarousel(value,image);
		//image_path = "default_product.jpg";
		image_path = image[0].image_path;
		var image_route = "{{ asset('offer_images')}}/"+image_path;
		imageDiv =	'<img class="img2 img-bordered-sm img-responsive" src="'+image_route+'" alt="user image">';
	}
	else
	{
		image_path = "default_product.jpg";
		var image_route = "{{ asset('offer_images')}}/"+image_path;
		imageDiv =	'<img class="img2 img-bordered-sm img-responsive" src="'+image_route+'" alt="user image">';
	} 
	

	/*** if user accept the offer -> table name schedule_confirm_users have data **/
	if(schedule_offer != null)
	{
		var user_price = parseFloat(schedule_offer.product_price).toFixed(2);
		var user_discount = schedule_offer.product_discount;
		
		if (user_discount != "") 
		{
			
			
			if(schedule_offer.product_discount_label == "Percentage")
			{
				var discount_percent = parseFloat(user_discount) / 100;
				var discount_price = user_price * parseFloat(discount_percent).toFixed(2);
				var final_price = user_price - parseFloat(discount_price).toFixed(2);
			}
			else if(schedule_offer.product_discount_label == "Dollar")
			{
				var discounted_price_dallor = (parseFloat(user_price).toFixed(2) - parseFloat(user_discount).toFixed(2));
				var final_price =  parseFloat(discounted_price_dallor).toFixed(2);
			}
			
			
		}
		else
		{
			
			var final_price = schedule_offer.product_price;
		}
		
		
		if (Number(user_discount) != 0  ) 
		{
			var original_price = parseFloat(user_price).toFixed(2);
			discount_html +=	 '<span> Was <span class="STRIKETHROUGH">$'+original_price+'</span></span><br>';
			
			if(schedule_offer.product_discount_label == "Percentage")
			{
				discount_html +=	 '<span style="color:red"> Discount: '+Number(user_discount)+'%off</span><br>';
			}
			else if(schedule_offer.product_discount_label == "Dollar")
			{
				discount_html +=	 '<span style="color:red"> Discount: $'+user_discount+'</span><br>';
			}
		
		}
		
	
	
	}
	else 
	{
		
		var new_price = value.new_product_price;
		var new_discount = value.new_product_discount;
		var original_price = parseFloat(new_price).toFixed(2);
		
		
		if (new_discount != "") 
		{
			
			if(value.new_product_discount_label == "Percentage")
			{
				var discount_percent = parseFloat(new_discount) / 100;
				var discount_price = new_price * parseFloat(discount_percent).toFixed(2);
				var final_price = new_price - parseFloat(discount_price).toFixed(2);
			}
			else if(value.new_product_discount_label == "Dollar")
			{
				var discounted_price_dollor = (parseFloat(new_price).toFixed(2) - parseFloat(new_discount).toFixed(2));
				var final_price =  parseFloat(discounted_price_dollor).toFixed(2);
			}
			
		
		
		}
		else
		{
			var final_price = new_price;
		}
		
		
	
		if (Number(new_discount) != 0 ) 
		{
			
			discount_html +=	'<span> Was <span class="STRIKETHROUGH">$'+original_price+'</span></span><br>';
			
			if(value.new_product_discount_label == "Percentage")
			{
				discount_html +=	 '<span style="color:red"> Discount: '+Number(new_discount)+'%off</span><br>';
			}
			else if(value.new_product_discount_label == "Dollar")
			{
				discount_html +=	 '<span style="color:red"> Discount: $'+new_discount+'</span><br>';
			}
			
		}
	
	}
	
	
	var rotator_link = "";
	if(value.rotator_link != "")
	{
		 rotator_link = '<i class="fa fa-fw fa-globe"></i>&nbsp;&nbsp; <a href="'+value.rotator_link+'" target="_blank">'+value.rotator_link+'</a><br>';
	}
	
	var	 prod_review_link = "";
	if(value.prod_review_link != "")
	{
			 prod_review_link = '<b>Product review Link:</b>&nbsp;&nbsp; <a href="'+value.prod_review_link+'" target="_blank">'+value.prod_review_link+'</a><br>';
	}
	
	
	var group_interest = "";
	if(value.group_interest != "")
	{
		 group_interest = '<b>Group & Interest:</b> &nbsp;&nbsp;'+value.group_interest+'</span><br>';
	}
	
	
	/*
	var product_brand = "";
	if(value.product_brand != "")
	{
		 product_brand = '<b>Brand:</b> &nbsp;&nbsp;'+value.product_brand+'</span><br>';
	}
	*/
	
	
	
	var status_msg = "";
	if(schedule_offer === 'object' ||  schedule_offer != null)
	{
		status_msg = schedule_offer.status_message;
	}
	
	
	
	var action_button = ""
	if(schedule_offer == null || schedule_offer == "")
	{
		var  action_button = '<button  onclick="accept('+value.id+')" type="button" class="btn  btn-success btn-flat">Accept</button>&nbsp;&nbsp;&nbsp;';
	}
	else if(schedule_offer != null && schedule_offer.button_action == "enabled_continue")
	{
		var  action_button ='<button  onclick="continue_process('+value.id+','+schedule_offer.id+')" type="button" class="btn  btn-primary btn-flat">Continue</button>&nbsp;&nbsp;&nbsp;';					
	}
	else if(schedule_offer.button_action == "disabled_continue")
	{
		var  action_button ='<button  disabled onclick="continue_process('+value.id+','+schedule_offer.id+')" type="button" class="btn  btn-primary btn-flat">Continue</button>&nbsp;&nbsp;&nbsp;';	
	}
	
	
	var template = 
   `<div class="create_box" id="${value.id}">
		<div class="row">
		
			<div class="col-md-2">	
				${imageDiv}
			</div>

			

			<div class="col-md-6">
			
			
				<div class="row">
					<div class="col-lg-8">
						<p class="campaign_name_current">${value.Title}</p><br>
					</div>
				</div>
				
				<div class="row">
					<div class="col-lg-8">
							<span class="product_name_2">${value.product_name}</span>
					</div>
				</div>
				
				
				<div class="row product_details" >
					<div class="col-md-6">
						<div class="product_price ">
							<span class="product_details_2">Price:<span class='product_price_2'>$${final_price}</span></span><br>
							<div class='product_details_2'>${discount_html}</div>
						</div>
						
				

						
					</div>
					
					
					
					<div class="col-md-6"> 
						<span class="pull-right">
							<div class="product_details_2">
								<span>Status:</span>   <span class="label label-success" style='font-size:11px'>${value.offer_status}</span> <br>
							</div>
							<div class="product_details_2">
								<span>Active Date:</span><br>
								<span>${start_date} ${value.start_time}</span><br>
							</div>
						</span>	
					</div>
					
				
					
					
					
				</div>
			
			</div>
			
			<div class="col-md-4"> 
	
				<span class="pull-right">
					${action_button}
					<button onclick="deny('${value.id}')" type="button" class="btn btn-danger btn-flat">Deny</button>
				</span>
				
				<br>
				<br>
				<span class="pull-right">
				${status_msg}
				</span>
				
		
			</div>
			
			
		
			
			
							
		</div>
	</div>`
			
			
	return template;
	
}
</script>



<!-- modal -->
<div id="offer_schedule" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content  -->
        <div class="modal-content">
		
			  <div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title"><span id='ordertitle'></span></h4>
			  </div>
		  
		 
			  <div class="modal-body">

				<div class='row' style="max-height:450px;overflow-y: scroll;">
					 
						<table id='campaign_schedule'  class="table table-bordered" width="100%" >
				
						<thead align="center">
						<tr>
							<th></th>
							<th width='30%'>Schedule Date</th>
							<th width='20%'>Slot</th>
							<th>Availble Time</th>
						</tr>
						</thead>
						
						<tbody ></tbody>
						</table>

					  
				</div>
			
			  </div>
			  
			  
			<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					<button id='getdata' type="button"  class="btn btn-primary" >Save</button>
			</div>
			  
        </div>
    </div>
</div>



<!-- modal -->
<div id="fullcalendar_sched" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content  -->
        <div class="modal-content">
		
			  <div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title"><span id='ordertitle'></span></h4>
			  </div>
		  
		 
			  <div class="modal-body">
			
					<center>
						  <!-- THE CALENDAR -->
						  <div id="start_date"></div>
						   
					</center>
					
					<input id='date_holder' type='hidden' />	
					<input id='offer_id_x' type='hidden' />	
					
					<input id='idx' type='hidden' />	
					<input id='get' type='hidden' />	
					
				
					
			  </div>
			  
			  
			<div class="modal-footer">
				<span id='youselect' style='float:left'></span>
			
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					<button id='getdata' type="button"  class="btn btn-primary" >Save</button>
			</div>
			  
        </div>
    </div>
</div>


<script>
Array.prototype.contains = function ( needle ) 
{ 
	for (i in this) 
	{
       if (this[i] == needle) return true;
	}
	return false;
}
</script>




<script>



function getCampaignofferschedule(offer_id,idx='',get='')
{

	
	$('#start_date').datepicker("destroy");
	$('#date_holder').val('');
	$('#youselect').empty();

	
	var container = $("#campaign_schedule > tbody");
	var table ="";
	var dt =[];
	var select ="";
	var timex = [];

	

	$.ajax({

		url: "{{route('getCampaignofferschedule')}}",
		type: 'POST',
		data: {offer_id:offer_id,"_token":$('#token').val()},
		dataType: 'json',
		beforeSend: function() {
					
				
					loading = $("body").waitMe({
						effect: 'timer',
						text: 'Get Schedule........',
						bg: 'rgba(255,255,255,0.90)',
						color: '#555'
					}); 
				
		},	
		success: function(result)
		{
			
			loading.waitMe('hide');
				
			var dtx = [];
			var timex = [];
			var time_available = [];
			if(result.data.length > 0)
			{
			
				$.each( result.data, function( key, value ) {
					 
					/* appnt_date = new Date(value.date);		
					JSDate.Init(appnt_date);
					return_date = JSDate.HumanDate(); // Convert Timestamp as 
					table += "<tr>";
					table += "<td><input type='radio'  name='select_sched'  data-date="+value.id_date+"  data-offer_id ="+id+"  data-idx="+idx+" data-get="+get+"   /></td>";
					table += "<td>"+return_date+"</td>";
					table += "<td>"+value.value+"</td>";
					var dtx = Selectloop(value.time,value.id_date);
					table += "<td><div>"+dtx+"</div></td>";
					
					
					table +="</tr>";
					dt = [];
					 */
					 
					 //dtx.push(Selectloop(value.time,value.id_date,value.date));
					 
					$.each(value.time, function( key, data )
					{
		
						if(data.status == "available")
						{
							
							if(timex.contains(value.date)) 
							{ } 
							else{ timex.push(value.date); time_available.push(data.schedule_time);   }
							
							
							
						

						}
						
					});
					 
					 
					 
				}); 
			}
			
			
			console.log(timex + "available na  sched");
			 var count = 0;
			$("#start_date").datepicker({
				
				
				numberOfMonths: 2 ,
				beforeShowDay: function(date) { 

				
				
				dmy = ('0' + (date.getMonth()+1)).slice(-2) + '/' + ('0' + date.getDate()).slice(-2) + '/' +  date.getFullYear();
					if ($.inArray(dmy, timex) != -1) {
						return [true, "","Available"]; 
						count++;
					} else{
						return [false,"","unAvailable"]; 
						
					}
					
					console.log('count' + count  + 'ito yun');
					
				},
				 onSelect: function()
				 {
					var selected = $(this).val();
					//alert(selected);
					$('#date_holder').val(selected+' 00:00:00');
					$('#offer_id_x').val(offer_id);
					
					$('#idx').val(idx);
					$('#get').val(get);
					
					$('#count').val(count);
					
					$('#youselect').empty().html('your chosen  date '+ selected);
					
					
				
				}
				
				
			});
			
				

			var options = { backdrop : 'static'}
			$('#fullcalendar_sched').modal(options);			

	
					
			console.log(timex)
			/* 
			else
			{
				table+= "<tr><td colspan='4'><center>No more Available Schedule</center></td><tr>";
			} */
			
			//container.empty().html(table);
		
		},

		error: function(error){ 
			loading.waitMe('hide');
			console.log(error);

		}
		
	});
	

	return false;
	
}


function isInArray(value, array) {
  return array.indexOf(value) > -1;
}


function Selectloop(time,date_id,date)
{
	
	

	
	$.each(time, function( key, data ){
		
		//timex.push(data.schedule_time);
		
		if(data.status == "available")
		{
			
			if(timex.contains(date)) 
			{ } 
			else{ timex.push(date);}
			
		}
		
	});
	
	var  cleanArray = timex.filter(function () { return true });
	
	console.log(cleanArray);
	return cleanArray;
	
	/* var select2 = '';
	select2 += "<select name='selectdate_sched' class='form-control' disabled id="+date+">";
		$.each(time, function( key, data ) {
			//console.log(data.schedule_time);
			
			
			if(data.status == "taken")
			{
				select2 += "<option value="+data.schedule_time+"  disabled class='STRIKETHROUGH' >"+data.schedule_time+" - not available </option>";
			}
			else if(data.status == "lapsed")
			{
				select2 += "<option value="+data.schedule_time+"  disabled class='STRIKETHROUGH' >"+data.schedule_time+" - not available </option>";
			}
			else
			{
				select2 += "<option value="+data.schedule_time+">"+data.schedule_time+"</option>";
			}
			
		});
		select2 += "</select>";
		
		return select2; */
	
}

$(document).on('click', '[name="select_sched"]', function () {
 
	var id = $(this).attr('data-date');
	
	$('[name="selectdate_sched"]').attr('disabled', 'disabled');
	
		
	if(id)
	{

		$("select#"+id+".form-control").removeAttr("disabled");
	}
	
 
});


$(document).on('click', '[id="getdata"]', function () {
 
 /*
	var radioValue = $("input[name='select_sched']:checked").attr('data-date');
	var offer_id = $("input[name='select_sched']:checked").attr('data-offer_id');
	
	var idx = $("input[name='select_sched']:checked").attr('data-idx');
	var get = $("input[name='select_sched']:checked").attr('data-get');
	
	var select_schdule = $("select#"+radioValue+" option:selected").text();
*/

	var select_schdule  = $("#date_holder").val();
	var offer_id  = $("#offer_id_x").val();
	
	
	var idx  = $("#idx").val();
	var get  = $("#get").val();
	
	
	
	
	if(select_schdule == "")
	{
		swal({
						  title: 'Select schedule first',
						  text:  "",
						  type: 'warning',
		});
		return false;
	}
	
	var html = "";

	
	
	$.ajax({

		url: "{{route('getDateConfirm2')}}",
		type: 'POST',
		data: {offer_id:offer_id,"_token":$('#token').val(),select_schdule:select_schdule},
		dataType: 'json',
		beforeSend: function() {
					
				
					loading = $("body").waitMe({
						effect: 'timer',
						text: 'Saving Schedule........',
						bg: 'rgba(255,255,255,0.90)',
						color: '#555'
					}); 
				
		},	
		success: function(data)
		{
			
			$('#fullcalendar_sched').modal('hide');	
			$('#offer_schedule').modal('hide');
			
			if(data.result == "exist")
			{
				loading.waitMe('hide');

				$("#sheduleinfo").modal("show");
				appnt_startx = new Date(data.data.schedDate+ " " +data.data.schedtime);		
				JSDate.Init(appnt_startx);
				human_date = JSDate.HumanDate(); // Convert Timestamp as 
				html += "Your schedule to continue this offer  will be on <br>";
				html += human_date;
				$("#showinfo").empty();
				$("#showinfo").empty().append(html);
				console.log(data);
				
			}
			else if(data.result == "save")
			{
				
				
				
				loading.waitMe('hide');
				
			
					 swal({
					  title: 'Congratulations',
					  text:  "you get this offer",
					  type: 'success',
					}).then(function (result) {
						
						/* 
						$("#sheduleinfo").modal("show");
						appnt_startx = new Date(data.data.schedDate+ " " +data.data.schedtime);		
						JSDate.Init(appnt_startx);
						human_date = JSDate.HumanDateTime(); // Convert Timestamp as 
						html += "Your schedule to continue this offer  will be on <br>";
						html += human_date;
						$("#showinfo").empty();
						$("#showinfo").empty().append(html);
						console.log(data); 
						*/
						
						var activities = {'task':'accept_offer', 'campaign_id':offer_id };
						SaveUserActivities(activities);
						
						GetOfferData();
							
					}); 
					
					//get  other schedule 
					if(get == "getothershed"){
						update_schedule(idx,offer_id);	
					}
			}
			else if(data.result == "no_schedule_available")
			{
				
					swal({
						  title: 'No Schedule Available',
						  text:  "",
						  type: 'warning',
					});
					
					loading.waitMe('hide');
			}
			
		
		},

		error: function(error){ 
			loading.waitMe('hide');
			console.log(error);
		}
		
	});

	return false;	
			
	
});
</script>





<script>
var loading ="";
function accept(id)
{



	
	$('#youselect').empty();
	getCampaignofferschedule(id);

	return false; 
	
	
	
	$.ajax({

		url: "{{route('getDateConfirm')}}",
		type: 'POST',
		data: {offer_id:id,"_token":$('#token').val()},
		dataType: 'json',
		beforeSend: function() {
					
				
					loading = $("body").waitMe({
						effect: 'timer',
						text: 'Get Schedule........',
						bg: 'rgba(255,255,255,0.90)',
						color: '#555'
					}); 
				
		},	
		success: function(data)
		{
			
			var html = "";
			if(data.result == "get_other_date")
			{
				accept(id);
				
			}
			else if(data.result == "get_other_shedule")
			{
				accept(id);
				
			}
			else if(data.result == "exist")
			{
				loading.waitMe('hide');

				$("#sheduleinfo").modal("show");
				appnt_startx = new Date(data.data.schedDate+ " " +data.data.schedtime);		
				JSDate.Init(appnt_startx);
				human_date = JSDate.HumanDate(); // Convert Timestamp as 
				html += "Your schedule to continue this offer  will be on <br>";
				html += human_date;
				$("#showinfo").empty();
				$("#showinfo").empty().append(html);
				console.log(data);
				
			}
			else if(data.result == "save")
			{
				
				loading.waitMe('hide');
				
			
					 swal({
					  title: 'Congratulations',
					  text:  "you get this offer",
					  type: 'success',
					}).then(function (result) {
						
						
						$("#sheduleinfo").modal("show");
						appnt_startx = new Date(data.data.schedDate+ " " +data.data.schedtime);		
						JSDate.Init(appnt_startx);
						human_date = JSDate.HumanDateTime(); // Convert Timestamp as 
						html += "Your schedule to continue this offer  will be on <br>";
						html += human_date;
						$("#showinfo").empty();
						$("#showinfo").empty().append(html);
						console.log(data);
						
						var activities = {'task':'accept_offer', 'campaign_id':id };
						SaveUserActivities(activities);
						
						GetOfferData();
							
					}); 
				
			}
			else if(data.result == "no_schedule_available")
			{
				
					swal({
						  title: 'No Schedule Available',
						  text:  "",
						  type: 'warning',
					});
					
					loading.waitMe('hide');
			}
			
		
		},

		error: function(error){
			
			loading.waitMe('hide');
			console.log(error);

		}
		
	});
	

	return false;
	
	
}
</script>

<script>
function continue_process(id,sched_id)
{

	$.ajax({

		url: "{{route('getDateConfirm')}}",
		type: 'POST',
		data: {offer_id:id,"_token":$('#token').val()},
		dataType: 'json',
		beforeSend: function() {
					
				
					loading = $("body").waitMe({
						effect: 'timer',
						text: 'Checking Schedule........',
						bg: 'rgba(255,255,255,0.90)',
						color: '#555'
					}); 
				
		},	
		success: function(data)
		{
			var html = "";
			
			var datenew = data.data.schedDate+ " " +data.data.schedtime;
			var otherdate = new Date(datenew);
			var today = new Date();
			var Available = (today  >= otherdate);
			
					
			//check if the date offer is availble on the schedule date
			if(Available == true)
			{	
				
		
		
					$.ajax({
							url : "{{asset('continue/accept/offer')}}",
							type: 'POST',
							data: {offer_id:id,sched_id:sched_id,"_token":$('#token').val()},
							success: function(response)
							{
									console.log(response);
									
							if(response == 'success') //if success close modal and reload student table
							{
								
								var activities = {'task':'continue_offer', 'campaign_id':id };
								SaveUserActivities(activities);
								
								   loading.waitMe('hide');
								   
									swal({
									  title: 'Offer Accepted',
									  text:  "",
									  type: 'success',
									}).then(function (result) {
									 
										window.location.href = "{{asset('/dashboard')}}";
									  
									});
								
							}
									
						
							},
							error: function (jqXHR, textStatus, errorThrown)
							{
								loading.waitMe('hide');
							}
					}); 
				
				return false;
			}
				
			
			if(data.result == "exist")
			{
				loading.waitMe('hide');
				$("#sheduleinfo").modal("show");
				appnt_startx = new Date(data.data.schedDate+ " " +data.data.schedtime);		
				JSDate.Init(appnt_startx);
				human_date = JSDate.HumanDateTime(); // Convert Timestamp as 
				html += "Your schedule to continue this offer  will be on <br>";
				html += human_date;
				$("#showinfo").empty();
				$("#showinfo").empty().append(html);
				console.log(data);
				
			}
			
		
			
		},

		error: function(error){ 
			loading.waitMe('hide');
			console.log(error);

		}
		
	});
	
}
</script>

<script>


function getothershed(id,offer_id)
{

	//var options = { backdrop : 'static'}
	//$('#offer_schedule').modal(options);
	
	$('#youselect').empty();
	var get = "getothershed";
	getCampaignofferschedule(offer_id,id,get);
	
	
	
	
	return false;

	$.ajax({

		url: "{{route('getDateConfirm')}}",
		type: 'POST',
		data: {offer_id:offer_id,"_token":$('#token').val()},
		dataType: 'json',
		beforeSend: function() {
					
				
					loading = $("body").waitMe({
						effect: 'timer',
						text: 'Checking Schedule........',
						bg: 'rgba(255,255,255,0.90)',
						color: '#555'
					}); 
				
		},	
		success: function(data)
		{
			loading.waitMe('hide');
			var html = "";
			if(data.result == "get_other_date")
			{
				getothershed(id,offer_id);
				
			}
			else if(data.result == "get_other_shedule")
			{
				getothershed(id,offer_id);
				
			}
			else if(data.result == "exist")
			{
				loading.waitMe('hide');

				$("#sheduleinfo").modal("show");
				appnt_startx = new Date(data.data.schedDate+ " " +data.data.schedtime);		
				JSDate.Init(appnt_startx);
				human_date = JSDate.HumanDate(); // Convert Timestamp as 
				html += "Your schedule to continue this offer  will be on <br>";
				html += human_date;
				$("#showinfo").empty();
				$("#showinfo").empty().append(html);
				console.log(data);
				
			}
			else if(data.result == "save")
			{
				
				loading.waitMe('hide');
				
			
					 swal({
					  title: 'Congratulations',
					  text:  "you get another schedule for this campaign",
					  type: 'success',
					}).then(function (result) {
						
						
						$("#sheduleinfo").modal("show");
						appnt_startx = new Date(data.data.schedDate+ " " +data.data.schedtime);		
						JSDate.Init(appnt_startx);
						human_date = JSDate.HumanDateTime(); // Convert Timestamp as 
						html += "Your schedule to continue this offer  will be on <br>";
						html += human_date;
						$("#showinfo").empty();
						$("#showinfo").empty().append(html);
						console.log(data);
						
						var activities = {'task':'accept_offer', 'campaign_id':id };
						SaveUserActivities(activities);
						
						GetOfferData();
							
					}); 
					
				update_schedule(id,offer_id);	
				
			}
			else if(data.result == "no_schedule_available")
			{
				
					swal({
						  title: 'No Schedule Available',
						  text:  "",
						  type: 'warning',
					});
					
					GetOfferData();
			}
		
			
		},
		error: function(error){ 
			loading.waitMe('hide');
			console.log(error);

		}
		
	});


}

</script>


<script>
function update_schedule(id,offer_id)
{
	$.ajax({
		url: "{{route('update_new_schedule')}}",
		type: 'POST',
		data: {offer_id:offer_id,id:id,"_token":$('#token').val()},
		success: function(response)
		{
					
	
		},
		error: function (jqXHR, textStatus, errorThrown)
		{
			loading.waitMe('hide');
		}
	});
	
}
</script>


<script>
function js_yyyy_mm_dd_hh_mm_ss()
{
  now = new Date();
  year = "" + now.getFullYear();
  month = "" + (now.getMonth() + 1); if (month.length == 1) { month = "0" + month; }
  day = "" + now.getDate(); if (day.length == 1) { day = "0" + day; }
  hour = "" + now.getHours(); if (hour.length == 1) { hour = "0" + hour; }
  minute = "" + now.getMinutes(); if (minute.length == 1) { minute = "0" + minute; }
  second = "" + now.getSeconds(); if (second.length == 1) { second = "0" + second; }
  return year + "-" + month + "-" + day + " " + hour + ":" + minute + ":" + second;
}

function deny(id)
{
	$.ajax({
			url : "{{asset('deny')}}/"+id,
			success: function(response)
			{
					console.log(response);
					
					
					swal({
					  title: 'Offer Cancel',
					  text:  "",
					  type: 'success',
					}).then(function (result) {
					 
						window.location.href = "{{asset('/dashboard')}}";
					  
					});
	
				
			},
			error: function (jqXHR, textStatus, errorThrown)
			{
			
			}
	});

}
</script>



<script>
function SaveUserActivities(activities)
{
	
	$.ajax({
		
	   url: "{{asset('SaveUserActivities')}}",
	   type: 'POST',
	   data: {"_token":$('#token').val(),activities:activities},
		success: function(response)
		{
				
			
		},
		error: function (jqXHR, textStatus, errorThrown)
		{
		
		}
		
	});

	
}

</script>

<script>
check_archive_acceptoffer_duedate()
function check_archive_acceptoffer_duedate()
{
	
	$.ajax({
		
	   url: "{{asset('check/offer_accept/duedate')}}",
	   type: 'GET',
	   data: {"_token":$('#token').val()},
		success: function(response)
		{
				
			console.log(response);
		},
		error: function (jqXHR, textStatus, errorThrown)
		{
		
		}
		
		
		
	});
	
}

// -----------------------------
// JS DATE PARSING LIBRARY
// github.com/marvicrm/JSDate
// -----------------------------
var JSDate = {
			
			Init: function(date)
			{
			
				date = new Date(date);
				
				month_str = this.GetMonth(date.getMonth());
				month_int = this.PutZero(date.getMonth());
				day = this.PutZero(date.getDate());
				hour = this.GetHours(date.getHours());
				minutes = this.PutZero(date.getMinutes());
				seconds = this.PutZero(date.getSeconds());
				ampm = this.GetAmPm(date.getHours());
				year = date.getFullYear();

				this.human_date_and_time = month_str+' '+day+', '+year+' '+hour+':'+minutes+' '+ampm;
				this.human_date = month_str+' '+day+', '+year;
				this.timestamp = year+'-'+month_int+'-'+day+' '+hour+':'+minutes+':'+seconds;
				
				
				
				
			},
			GetMonth: function(num)
			{
				month_name = ["January",
							  "February",
							  "March",
							  "April",
							  "May",
							  "June",									  
							  "July", 
							  "August",
							  "September",
							  "October",
							  "November",
							  "December"];
				
				return month_name[num]; 
			},
			GetHours: function(hour)
			{
				if(hour>12)
				{	
					if(hour<=9)
					{
						hour = hour - 2;
						hour = hour.toString();
						hour = hour[1];
						hour = "0" + hour;
					}
	
				} 
				return hour;
			},
			PutZero: function(value)
			{
				if(value<=9)
				{
					value = "0"+value;
				}
				return value;
			},
			GetAmPm: function(hour)
			{
				return (hour>12?'PM':'AM');
			},
			TimeStamp()
			{
				return this.timestamp;
			},
			HumanDate()
			{
				return this.human_date;
			},
			HumanDateTime()
			{
				return this.human_date_and_time;
			}
			
			
}


</script>

@endsection