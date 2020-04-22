@extends('frontend.layouts.main')

@section('content')


<!--// div secondpanel -->
	@include('frontend.layouts.secondpanel')  
<!--  ~end secondpanel -->

<!--// div how does work modal -->
	@include('frontend.offer_dashboard.howdoeswork')  
<!--  ~end how does work modal -->



@if((@$current_offer > 0) || (@$featured_offer > 0 ))
	
<div>@include('frontend.offer_dashboard.current_active_deals')</div>

<div>@include('frontend.offer_dashboard.featured_review_deals')</div>

<div>@include('frontend.offer_dashboard.compare_deals')</div>

@else
<div class='row'>
	<div class="col-lg-12">
		<div class="jumbotron jumbotronText" >
			<div class="container">
				<h1 class="display-4"> Hello, {{Auth::user()->name}} </h1>
				<p class="lead"> 
				    We will send you new offers soon!
				</p>
			</div>
		</div>
	</div>
</div>
@endif	


<div id="messagemodal" class="modal fade" role="dialog">
	  <div class="modal-dialog">
		<!-- Modal content-->
		<div class="modal-content">
		  <div class="modal-header">
			<button type="button" class="close" data-dismiss="modal">&times;</button>
			<h4 class="modal-title"></h4>
		  </div>
		  
		
		  <div class="modal-body">
			
			<div class="box-body">
			
                <div class="form-group" >
                  <label for="main_account_id" class="col-sm-3 control-label">Message </label>
                  <div class="col-sm-9">
                    <input type="text"   class="form-control" id="messageval" name="messageval">
                  </div>				  
                </div>
			
        
            </div>
		  
		  </div>
		  <div class="modal-footer">
			<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			<button type="button" class="btn btn-success btn-primary  btn-flat" id="submitmessagexx">Save</button>
		  </div>
		 
		</div>
	  </div>
 </div>
<!-- /.content -->

<script type="text/javascript">
$(document).on('click', '.showmodalmessage', function(e){
e.preventDefault(); 

var options = { backdrop : 'static'}
$('#messagemodal').modal(options);  

   
});
</script>




@endsection