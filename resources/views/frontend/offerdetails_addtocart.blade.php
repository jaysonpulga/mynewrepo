@extends('frontend.layouts.main')

@section('content')

 <!-- Include Bootstrap CSS -->


<link href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.6.5/sweetalert2.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.6.5/sweetalert2.js"></script>


<style>
.user-block img {
    width: 185px !important; 
    height: 185px !important; 
    float: left;
}
.user-block .description {
    color: #999;
    font-size: 15px !important;
	margin-left:180px;
	margin-top:5px;
}
.create_box
{
	padding-top:10px;
	padding-bottom:10px;
	padding-right:60px;
	padding-left:60px;
}
.tile-bar
{
	font-weight:bold;
	font-size:22px;
}



.box-title2
{
	font-weight:bold;
	font-size:24px;
}


</style>

<style>
.hidebutton
{
	display: none !important;
}

.showbutton
{
	display: inline !important;
}
.marginpadding
{
	clear:both;
	padding-top:25px !important;
}
</style>
	
<!-- Main content -->
<div class="content">

	<div class="row">
		<div class="box box-default">
				<div class="box-header with-border">
					<div class="col-lg-12">
					
					
					  <span class="box-title2" style="padding-right:20px" ><i class="fa fa-fw fa-list-alt"></i>Offer Details</span>					  					
					  
					  <div class="pull-right" style='margin-left:5px;margin-right:5px'>	
						<a href="{{asset('/dashboard')}}"  class="btn btn-default" style="margin-right:5px"><i class="fa fa-fw fa-mail-reply"></i>Return Dashboard</a> 
						<button  id='canceloffer' onclick="Cancel_request({{$offerdetails[0]->id}})" type="button" class="btn btn-danger btn-flat pull-right hidebutton"><i class="fa fa-fw fa-calendar-times-o"></i> Cancel offer Request </button>
						
						
						<div id='incomplete' class="bg-orange-active color-palette pull-right hidebutton" style="padding: 6px 12px ; border-radius"><span><i class="fa fa-fw fa-warning"></i> incomplete</span></div>
						
						
						<div id='processing' class="bg-orange-active color-palette pull-right hidebutton" style="padding: 6px 12px ; border-radius"><span><i class="fa fa-fw fa-clone"></i> processing</span></div>
						
						<div id='completed'  class="bg-light-blue-active color-palette pull-right hidebutton" style="padding: 6px 12px; border-radius"><span><i class="fa fa-fw fa-calendar-check-o"></i> completed</span></div>
						
						<div id='review'  class="bg-light-blue-active color-palette pull-right hidebutton" style="padding: 6px 12px; border-radius"><span><i class="fa fa-fw fa-calendar-check-o"></i> for review</span></div>
						
						
						
					  </div>
					 				
					</div>
				</div>
				
				
				<div id="smartwizard">
				 
					<ul>
						<li id='fristsetp'><a href="#step-1"><i class="fa fa-fw fa-clipboard"></i> Product Details</a></li>
					</ul>
					
					
					 <div>
						<div id="step-1" class="">
							 @include('frontend.offerdetails_view.addtocart_productdetails')
						</div>	
					</div>
				
				 
				</div>
					
		</div>
	</div>
</div>
<!-- /.content -->



<script type="text/javascript">
$(document).ready(function(){
	
	$('#smartwizard').smartWizard({
			selected: 0,
			theme: 'arrows',
			transitionEffect:'fade',
			toolbarSettings: {
				toolbarPosition: 'bottom', // none, top, bottom, both
				toolbarButtonPosition: 'left', // left, right
				showNextButton: false, // show/hide a Next button
				showPreviousButton: false, // show/hide a Previous button
			},
	});


checkifcomplete();		 
});
</script>


<script type="text/javascript">

function checkifcomplete()
{
	
	
		$.ajax({
		url: "{{route('checkifcomplete')}}",
		type: 'GET',
		data: {offer_id:"{{$offerdetails[0]->id}}","_token":$('#token').val()},
		dataType: 'json',
		success: function(data)
		{
				console.log(data.length);
				if(data.length > 0)
				{
					
					
					
					if(data[0].status === "processing")
					{
						
						$("#processing").removeClass('hidebutton').addClass('showbutton');
						$("#incomplete").removeClass('showbutton').addClass('hidebutton');
						$("#completed").removeClass('showbutton').addClass('hidebutton');
						$("#review").removeClass('showbutton').addClass('hidebutton');
					}
					if(data[0].status === "inc")
					{
						
						$("#incomplete").removeClass('hidebutton').addClass('showbutton');
						$("#processing").removeClass('showbutton').addClass('hidebutton');
						$("#completed").removeClass('showbutton').addClass('hidebutton');
						$("#review").removeClass('showbutton').addClass('hidebutton');
						
					}
					else if(data[0].status === "completed")
					{
						$("#completed").removeClass('hidebutton').addClass('showbutton');
						$("#processing").removeClass('showbutton').addClass('hidebutton');
						$("#incomplete").removeClass('showbutton').addClass('hidebutton');
						$("#review").removeClass('showbutton').addClass('hidebutton');
					}
					else if(data[0].status === "review")
					{
						$("#review").removeClass('hidebutton').addClass('showbutton');
						$("#completed").removeClass('showbutton').addClass('hidebutton');
						$("#processing").removeClass('showbutton').addClass('hidebutton');
						$("#incomplete").removeClass('showbutton').addClass('hidebutton');
					}
					
					
				}
				else
				{
					$("#canceloffer").removeClass('hidebutton').addClass('showbutton');
				}
			
		},
		error: function(error){ 
			console.log(error);
		}

	});
	 
}
</script>





<script type="text/javascript"> 
function Cancel_request(id)
{
	swal({	
	
		title: 'Cancel Request',
		text: 'would you like to cancel this offer? ',
		type: 'question',
		showCancelButton: true,					
		cancelButtonText: "Stay this page",	
		confirmButtonText: 'Yes, I am sure',	
		}).then(function(){
			
			
		
			
			$.ajax({
					url: "{{route('canceloffer')}}",
					type: 'POST',
					data: {offerid:id,"_token":$('#token').val()},
					dataType: 'json',
					success: function(data)
					{

						if(data.success == "success")
						{
							
							
							swal({
								  title: 'Request Canceled',
								  text:  "",
								  type: 'success',
								}).then(function (result) {
								 
									window.location.href = "{{asset('dashboard')}}";
								  
								});
				
						}
						
					},
					error: function(error){ 
						promptAjaxMessage(error.result, error.message);
						console.log(error);
					}

				});
					
				
			
		},function(dismiss) {
		window.location.reload();
	});
}
</script>
@endsection
