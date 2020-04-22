@extends('frontend.layouts.main')

@section('content')
s
<div id="Newusermodal" class="modal fade" role="dialog">
      <div class="modal-dialog modal-lg">

        <!-- Modal content-->
        <div class="modal-content">

          <div class="modal-body">
          
			<h1>Congratulations!</h1>
			<p>You have successfully registered to {{ env('APP_NAME') }}  Remember to verify your account to complete your membership.</p>
			<p>Please check your email for a verification code</p>
		
	
		  
          </div>
		  
          <div class="modal-footer">
            <button type="button" id='continue' class="btn btn-default" >Continue >></button>
          </div>
        </div>

      </div>
 </div>






<script type="text/javascript">
$(document).ready(function(){


	var options = { backdrop : 'static'}
	$('#Newusermodal').modal(options);


});

var loading ="";


$( "#continue" ).click(function() {
	
	$('#Newusermodal').modal('hide');
	
	loading = $("body").waitMe({
						effect: 'win8_linear',
						text: 'Loading your file please wait ..............',
						bg: 'rgba(255,255,255,0.90)',
						color: '#555',
						fontSize:'30px'
					}); 
					
		setTimeout(function(){ 

				window.location.href = "{{asset('/dashboard')}}";
				

		}, 2000);
 
});
</script>




@endsection