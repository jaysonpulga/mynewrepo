@extends('frontend.layouts.main')
@section('content')
<!-- Include Bootstrap CSS -->
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


.contentarea { width:100%; padding:10px; display:none}
.contentarea.active { display:block}

.box {
  
    border-radius: 0px !important;
	border-top: 2px solid #d2d6de !important;
	padding-right: 1px !important;
	padding-left: 1px !important;
	
  
}


.disabled {
    pointer-events:none; //This makes it not clickable
    opacity:0.6;         //This grays it out to look disabled
}

.content-header2 {
    position: relative;
    padding-top: 15px;
}

.ppoc-clock {

    font-size: 22px !important;
}
</style>


<div class="row">
	<div class="col-sm-12">	
    	<div class="content-header2">
            <ol class="breadcrumb" id='breadcrumb'>
              <li><a href="{{asset('dashboard')}}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            </ol>
        </div>
	</div>
</div>

<div id="content">
<section class="row">


<div class="col-md-12">
	<div class="col-md-12">
		@include('frontend.offer_instruction.amazonsurvey')
	</div>
</div>

</section>	 
</div>




@endsection