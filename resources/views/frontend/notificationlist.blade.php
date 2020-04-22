@extends('frontend.layouts.main')

@section('content')

<style>
.custom_box
{
		border: 1px solid #abaaaa;
	      border-radius: 1px !important;
}


.div
{
	padding : 8px;
	margin  : 8px;
	border-bottom : 1px solid #b3aeae;
	
}


#make > a
{
  background-color: red !important; 
 
}

div.div a:hover 
{
  background-color: yellow;
}

#images_div .user-image {
    width: 45px;
    height: 45px;
    border-radius: 1%;
	border: 1px solid #afa9a9;
    margin-right: 5px;
    margin-top: -2px;
}

.div11 #icon_div 
{
 font-size:30px;
  margin-top: -2px;
}

.contain2
{
  display: flex;
  flex-wrap: nowrap;
}

.div11
{
	 display: flex;
	margin-right:8px;
}

.div22
{
 display: flex;

}


.div22 > span
{
	
	width: 100%;
	font-size :15px;

}


.div22 > strong > span
{
	
	width: 100%;
	font-size :15px;


}
</style>




<!-- Main content -->
<section class="content">
<!-- Main row -->
<div class="row">



<!-- Main Box-->
	<div class="box box-widget custom_box">
		<div class="box-header with-border">
		  <h3 class="box-title">
			<span class="box-title2" style="padding-right:20px"><i class="fa fa-fw fa-bell"></i>Your Notification</span>
		  </h3>	
		</div>
		
		<!-- /.box-header -->
		<div class="box-body">
		

		
			<div class="col-lg-12">
			
				@foreach($notifications as $data)
					<div class='div'>
					<div id='make'>
						<a href="{{$data['url']}}" id="offer_details" data-offer_id="{{$data['offer_id']}}" data-user_id="{{$data['user_id']}}" data-notif_read="{{$data['notif_read']}}">
							<div class="contain2">
								<div class="div11">{!! $data['icon'] !!}</div>
								<div class="div22"><span>{{$data['notif_message']}} {{$data['Title']}}</span></div>
							</div>
						</a>
					</div>	
					</div>
				 @endforeach
								
			
			</div>
	
		
			
			
		</div>
		<!-- /.box-body -->
    </div>
	
		  
</div>
<!-- /.row (main row) -->
</section>



@endsection
