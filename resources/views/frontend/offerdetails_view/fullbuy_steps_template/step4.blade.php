<div class='margin-steps-insight'>  
<div class="col-lg-12">
  <h2 class="heading-xxl">Share Your Idea List</h2>
  <h3 class="heading-m"></h3>
  <form id='step4_data'  name='step4_data' >
        @csrf
        <ol class="ol-circle">
            <li>
                Go back to your list and make sure you satisfy the following:
                    <div class="checkbox">
                        <div class="checkbox">
                             <input type="checkbox" id="idealist_name" name="idealist_name" class="no-ml" value=1 > 
                             <label for="idealist_name" class="control-label mll pls">The Idea List is called Ideas - {{$offerdetails[0]->fullbuy_keyword}}</label> <!---->
                        </div> 
                        <div class="checkbox">
                            <input type="checkbox" id="is_idealist" name="is_idealist" value=1 class="no-ml" required {{ !empty(@$users_offer_purchase_4rt_steps->is_idealist) ? "checked" : "" }} > 
                            <label for="is_idealist" class="control-label mll pls">I’m sure the link I share is a direct or shortened link to my Idea List, and not to a Wishlist</label> <!---->
                        </div> 
                        <div class="checkbox">
                            <input type="checkbox" id="idealist_product_count" value=1 name="idealist_product_count" class="no-ml" required {{ !empty(@$users_offer_purchase_4rt_steps->idealist_product_count) ? "checked" : "" }}> 
                            <label for="idealist_product_count" class="control-label mll pls">My Idea List contains at least 4 products, including ASIN <u> {{$offerdetails[0]->product_id}} </u> </label> <!---->
                        </div> 
                        <div class="checkbox">
                            <input type="checkbox" id="idealist_public" value=1 name="idealist_public" class="no-ml" required {{ !empty(@$users_offer_purchase_4rt_steps->idealist_public) ? "checked" : "" }}> 
                            <label for="idealist_public" class="control-label mll pls">My Idea List is public (not all customers are able to change the setting from private to public)</label> <!---->
                        </div>
                    </div>
            </li> 
            <li class="mbm">
                <p> Paste your idea list URL below: </p> 
                <div class="list-full-width">
                    <div class="mbl mtxl">
                        <div>
                            <div class="">
                                <label for="url" class="control-label" style="display: none;"></label> 
                                <input type="text" id="url" name="url"  value="{{@$users_offer_purchase_4rt_steps->url}}"  {{ !empty(@$users_offer_purchase_4rt_steps->url) ? "readonly" : "" }}  placeholder="Idea List URL" autocomplete="on" class="form-control"> <!---->
                            </div>
                         </div>
                     </div> 
                    <div class="text-center">
                            <button class="btn btn-help hidden-sm hidden-md hidden-lg">How to share<br>my Idea List</button>
                    </div>
                </div>
            </li>
        </ol>
   </form>
</div> 

<div style="clear:both;margin-top:15px"></div>
<div class="col-lg-12">
       <div class="pull-left">
           <button class="btn btn-default prev" >Previous</button>
      </div> 
      
        @if((empty(@$users_offer_purchase_4rt_steps)))
        
            <div class="pull-right">
                  <button type="submit" form="step4_data" value="Submit" class="submit btn btn-primary" >Submit</button>
            </div>
            
            <div  class="pull-right hide" id='tempbutton4'>
                 <button class="btn btn-primary next_move" >Next</button>
            </div>
            
        @elseif((!empty(@$users_offer_purchase_4rt_steps)))
          <div  class="pull-right">
              <button class="btn btn-primary next_move" >Next</button>
          </div>
       @endif
       
       
   
 
</div>
<div style="clear:both;margin-bottom:15px"></div>

</div>

<script>
var loading;
$("#step4_data").on("submit", submit_step4); 
function submit_step4(event)
{
    event.preventDefault();
    var formData = new FormData(this);
    
    formData.append('offer_id',"{{$offerdetails[0]->id}}");
    formData.append('product_id',"{{$offerdetails[0]->product_id}}");
    
     $.ajaxSetup({
				  headers: {
					  'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
				  }
			  });

     // save data template
        $.ajax({
    		url 	: "{{ route('submit_step4')}}",
    		type	: "POST",
    		data	: formData,
    		processData: false,
		    contentType: false,
    		beforeSend: function() {
    					
    
    			loading = $("body").waitMe({
    				effect: 'timer',
    				text: 'Submiting ideal list data........',
    				bg: 'rgba(255,255,255,0.90)',
    				color: '#555'
    			}); 
    				
    		},
            success: function(data)
            {
 
    	    	loading.waitMe('hide');
    	    	
    	        $('#url').attr("readonly", 'readonly');
    	    	$('.4rt').addClass('done');
    	    	$('.submit').addClass('hide');
    	    	$('#tempbutton4').removeClass('hide').addClass('show');
    	    	
    	    	
    	    	swal({
					  title: 'Submitted Succesfully',
					  text:  "",
					  type: 'success',
					}).then(function (result) {
					
					var step = 4;
					var steps2 = $(".step-wizard2 ul li").length;
					 setClasses2(step, steps2 - 1);
                      Step(step);
				
				})
    	    	
    	    	
                ///location.reload();
              //alert(data);
    
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
    			loading.waitMe('hide');
                alert('Error adding / submiting data');
            }
        });
    
}
</script>
