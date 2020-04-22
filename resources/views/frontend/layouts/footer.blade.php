<footer class="main-footer">
	<div class="container">
        
        <!--    
	   <a href="{{route('completedoffer')}}" style="font-size:14px;font-weight:bold">Completed Offers</a> |
		<a href="#" style="font-size:14px;font-weight:bold">Customer Support</a>
	    -->
	    
	    <a href="{{asset('Terms-and-Condition')}}" target="_blank" style="font-size:14px;font-weight:bold">Terms and Condition</a> |
		<a href="{{asset('privacy-policy')}}" target="_blank" style="font-size:14px;font-weight:bold">Privacy Policy</a>
	    
	</div>
</footer>
<script defer>
                $(document).ready(function(){
                    
                    if(sessionStorage.getItem("new") == 'test'){
                        console.log(sessionStorage.getItem("new"))
                        var check = $('html,body').find('.compare_deals');
                        var interval = setInterval(function(){
                            if(check.length > 0){
                                $('html,body').animate({
                                scrollTop: $(".compare_deals").offset().top},
                                'slow',function(){
                                    console.log('happen')
                                    setTimeout(function(){
                                        clearInterval(interval);
                                    },1000)
                                });
                                
                            }
                        },1000);
                    }
                    
                    var url = window.location.href;
                    if(url != '{{asset("dashboard")}}'){
                        $('.compare_btn').attr('href',"{{asset("dashboard")}}");
                        $('.compare_btn').addClass('compare_auto');
                        // $('html,body').animate({
                        // scrollTop: $(".compare_deals").offset().top},
                        // 'slow');
                    }else{
                        sessionStorage.clear();
                        $('.compare_btn').removeClass('compare_auto');
                    }
                })
            </script>
			



<script type="text/javascript">
$(document).on('click', '#submitmessagexx', function(e){
e.preventDefault(); 
var ws = new WebSocket("ws://localhost:8081/");
var id = 2;
		ws.onopen = function (id) {
			// Websocket is connected
			console.log("Websocket connected");
			
			var msg = $("#messageval").val();
			var array = {'id':1,'message':msg}
			

			var s = JSON.stringify(array)
			ws.send(s);
			console.log("Message sent");
			
			//ws.close();
		};
		ws.onmessage = function (event) {
			// Message received
			
			var s = JSON.parse( event.data);

			console.log("Message received = " + s.id + ' == '+   s.message   );
			
		};
		ws.onclose = function () {
			// websocket is closed.
			console.log("Connection closed");
		};

   
});
</script>
		