<div class='margin-steps-insight'>
<div class="col-lg-12">
    <h2 class="heading-xxl">Search Product</h2>
    <h3 class="heading-m"></h3>
    
    
    <ol class="ol-circle">
        <li>
            Add the product to your cart and continue browsing by clicking one or two related products
        </li>
        <li>
            <p class="mbxl">
                Make sure you check the picture and ASIN of the product for review.
            </p> 
            <p class="list-full-width text-center">
                <img src="{{ cdn_asset('offer_images')}}/{{@$images[0]->image_path}}" class="product-image">
            </p>
        </li>
        <li>
            
           
            
            <p class="mbl">
            Paste the ASIN of this product below
                <i title="How to find an ASIN?" data-toggle="tooltip" class="fa fa-info-circle text-primary cursor-pointer find-asin"></i>
            </p> 
            
            
            <div class="list-full-width">
                <div class="input-group">
                    <div id='div_error' class="">
                        <label for="asin" class="control-label" style="display: none;"></label> 
                        <input type="text" id="asin" name="asin" placeholder="ASIN" autocomplete="on" class="form-control" value="{{@$users_offer_purchase_check_asins->product_asin}}"   {{ !empty(@$users_offer_purchase_check_asins) ? "readonly" : "" }} > <!---->
                        <p id='p_error' class="help-block no-mt no-mb hide">The asin field is required.</p>
                    </div>
                    <span class="input-group-btn vertical-align-top adjust_button_step3">
                        <button  class="chkbtn btn btn-primary"   {{ !empty(@$users_offer_purchase_check_asins) ? "disabled" : "" }} id='checkasin'>Check ASIN</button>
                    </span>
                </div>
                
                <div class="text-center"><button class="btn btn-help mtl find-asin" style='border: 1px solid'>
                            How to find<br>
                            an ASIN
                        </button>
                </div>
                
               
                
                
                @if((!empty(@$users_offer_purchase_check_asins)))
                    <div class="mtxl">
                        <div class="alert alert-success no-mb">
                            <button type="button" data-dismiss="alert" aria-label="Close" class="close">
                                <span aria-hidden="true">×</span></button> <strong>Well done!</strong> The ASIN is correct.
                        </div>
                    </div>
              	@endif	
              	
                
                <div id="panel_temporary"></div>
            </div>
        </li> 
    </ol>
</div>


<div style="clear:both;margin-top:15px"></div>
<div class="col-lg-12">
       <div class="pull-left">
           <button class="btn btn-default prev" >Previous</button>
      </div> 
      
      
      
      @if((!empty(@$users_offer_purchase_check_asins)))
          <div  class="pull-right" id='step3_button'>
              <button class="btn btn-primary next_move" >Next</button>
          </div>
      @else
      <div  class="pull-right hide" id='tempbutton3'>
            <button class="btn btn-primary next_move" >Next</button>
       </div>
      @endif
      

      
      
      
</div>
<div style="clear:both;margin-bottom:15px"></div>

</div>



<script>
var loading;

$(document).on("click", "#checkasin", function()
{
   var asin =  $('#asin').val();
   
   if(asin == "")
   {
       $('#div_error').addClass('has-error');
       $('#p_error').removeClass('hide').addClass('show');
       return false;
   }
   
   
   $.ajax({

		url: "{{route('checkasin')}}",
		type: 'POST',
		data: {"_token":$('#token').val(),offer_id:"{{@$offerdetails[0]->id}}",product_id:"{{@$offerdetails[0]->product_id}}",asin:asin},
		dataType: 'json',
		beforeSend: function() {
    					
    
    			loading = $("body").waitMe({
    				effect: 'timer',
    				text: 'Checking ASIN........',
    				bg: 'rgba(255,255,255,0.90)',
    				color: '#555'
    			}); 
    				
    	},
		success: function(data)
		{

		   loading.waitMe('hide');
		    if(data.result == 'success')
		    {
		      
		      //location.reload();
		      
		      $('#panel_temporary').empty().append(
		          '<div class="mtxl">'
               +  '<div class="alert alert-success no-mb">'
               +           '<button type="button" data-dismiss="alert" aria-label="Close" class="close">'
               +                '<span aria-hidden="true">×</span></button> <strong>Well done!</strong> The ASIN is correct.'
               +      '</div>'
               +  '</div>');
               
               
                $('#div_error').removeClass('has-error');
                $('#p_error').removeClass('show').addClass('hide');
                $('#tempbutton3').removeClass('hide').addClass('show');
                
                
                $('#asin').attr("readonly", 'readonly');
                $('.chkbtn').attr("disabled", 'disabled');
                
                
               
                $('.3rd').addClass('done');
               
               swal({
					  title: 'Well done! The ASIN is correct',
					  text:  "",
					  type: 'success',
					}).then(function (result) {
					
					var step = 3;
					var steps2 = $(".step-wizard2 ul li").length;
					 setClasses2(step, steps2 - 1);
                      Step(step);
				
				})
             
             
             
		    }
		    else
		    {
		        
		     
		        
		        
		          $('#div_error').addClass('has-error');
                  $('#p_error').removeClass('hide').addClass('show').html('ASIN is not correct');
                  
                  
                   $('html, body').animate({
                    scrollTop: $("#div_error").offset().top
                }, 500);
                
		    }
		},
	    error: function (jqXHR, textStatus, errorThrown)
        {
			loading.waitMe('hide');
            alert('Error adding / submiting data');
        }
		
	});



});
</script>


<script type="text/javascript">
$( ".find-asin" ).click(function() {
  	var options = { backdrop : 'static'}
	$('#myModalfind-asin').modal(options);
});
</script>



<!-- Modal -->
<div id="myModalfind-asin" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">How to find an ASIN of a product?</h4>
      </div>
      <div class="modal-body">

             <ol class="ol-circle">
                            
                    <li>
                        <p class="mbxl">Find "ASIN" in url</p>
                    </li>
                    
                    <div class="panel panel-default">
                        <div id="collapse-create-list-desktop" class="panel-collapse collapse in">
                            <div class="panel-body">
                                 <img src="{{ asset('public/help_images/find-asin-1.png')}}" class="mtl width-100">
                            </div>
                        </div>
                    </div>
                    
                    <li>
                        <p class="mbxl">Find "ASIN" in product description</p>
                    </li>
                 
                    
                      <div class="panel panel-default">
                        <div id="collapse-create-list-desktop" class="panel-collapse collapse in">
                            <div class="panel-body">
                                 <img src="{{ asset('public/help_images/find-asin-2.png')}}" class="mtl width-100">
                            </div>
                        </div>
                    </div>
        
             </ol>  
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>

