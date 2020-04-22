<style>
    .disabled_this:hover{
        cursor:default;
        background-color:transparent !important;
    }
    .disabled_this{
        background-color:transparent !important;
        display:none !important;
    }
    .disabled_this:active{
        background-color:transparent !important;
    }
</style>
<header class="main-header"><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <nav class="navbar navbar-static-top">
      <div class="container">
        <div class="navbar-header">
          <a href="{{asset('dashboard')}}" class="navbar-brand"><b>{{ env('APP_NAME') }}</b></a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
		
        <div class="collapse navbar-collapse pull-left" id="navbar-collapse"></div>
		
		
        <!-- /.navbar-collapse -->
        <!-- Navbar Right Menu -->
        <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
            
     
            
		@if(Auth::user()->verification_status != 0 )
		<li class="messages-menu">
            <a href="javascript:void(0)" class="compare_btn disabled_this">
              <i class="fa fa-fw fa-balance-scale"></i> Compare product <span class="compare_count_badge label label-warning">0</span>
            </a>
             <script>
            //     $(document).ready(function(){
            //         $('html,body').animate({
            //                 scrollTop: $(".compare_deals").offset().top},
            //                 'slow');
            //         var url = window.location.href;
            //         if(url != '{{asset("dashboard")}}'){
            //             $('.compare_btn').attr('href',"{{asset("dashboard")}}");
            //             $('.compare_btn').addClass('compare_auto');
            //             // $('html,body').animate({
            //             // scrollTop: $(".compare_deals").offset().top},
            //             // 'slow');
            //         }else{
            //             $('.compare_btn').removeClass('compare_auto');
            //         }
            //         $(document).on('click','compare_auto',function(){
            //             $(document).ready(function(){
            //                 $('html,body').animate({
            //                 scrollTop: $(".compare_deals").offset().top},
            //                 'slow');
            //             })
            //         })
            //     })
            </script>
          </li>
          <li class="messages-menu">
            <a href="{{asset('user/gig')}}" class="gig_btn">
              <i class="fa fa-gamepad" aria-hidden="true"></i> Gig product
            </a>
          </li>
          <script>
              $(document).ready(function(){
                  $.ajax({
                      url:"{{asset('user/gig_count')}}",
                      type:"GET",
                      headers:{"X-CSRF-TOKEN":$('meta[name="_token"]').attr('content')},
                      success:function(data){
                          if(data.count > 0){
                			    $('.gig_btn').append('<span class="gig_count_badge label label-warning">'+data.count+'</span>');
                			}
                		    else{
                		        $('.gig_count_badge').remove();
                		    }
                      }
                  })
                  $.ajax({
                      url:"{{asset('campaign/getdata/compare_offer')}}",
                      type:"GET",
                      headers:{"X-CSRF-TOKEN":$('meta[name="_token"]').attr('content')},
                      success:function(data){
                          var compare_count = 0;
                          $.each(data, function( index, value ) {
                              if(value.campaign_data.campaign_type == 'compare campaign')
            					{
            					    compare_count++;
            					}
                          })
                          if(compare_count > 0){
                			    $('.compare_btn').removeClass('disabled_this');
                			    $('.compare_count_badge').text(compare_count);
                			}
                      }
                  })
              })
          </script>
		   <!-- Messages: style can be found in dropdown.less-->
          <li class="messages-menu">
            <a href="{{asset('user/daily_thresholds')}}">
              <i class="fa fa-fw fa-thumbs-up"></i>Votes <span class="vote_counts_badge label label-warning"></span>
              <script>
                  $(document).ready(function(){
                      $.ajax({
                          url:'{{asset('user/avail_votes')}}',
                          type:'get',
                          data:{data:'vote_counts'},
                          success:function(data){
                              if(data > 0){
                                  $('.vote_counts_badge').text(data);
                              }
                          }
                      })
                  })
              </script>
              <!--<span class="label label-success">4</span>-->
            </a>
          </li>
          <li class="messages-menu">
            <a href="{{asset('user/mypoints')}}">
              <i class="fa fa-fw fa-gg"></i>Points <span class="points_badge label label-success" style="position:static !important;">0</span>
              
              <!--<span class="label label-success">4</span>-->
            </a>
          </li>
          <script>
                  $(document).ready(function(){
                      $.ajax({
                          url:'{{asset('user/mypoints')}}',
                          type:'get',
                          data:{data:'points_counts'},
                          success:function(data){
                              if(data > 0){
                                  $('.points_badge').text(data);
                              }
                          }
                      })
                  })
              </script>
	      <!-- Activity -->
		  <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
			 <i class="fa fa-fw fa-tasks"></i>
			  <span class="caret"></span></a>
              <ul class="dropdown-menu">
			   <li><a href="{{route('activity')}}"><i class="fa fa-fw fa-align-justify"></i> Activity</a></li>
			    <li class="divider"></li>
                <li><a href="{{route('archived')}}"><i class="fa fa-fw fa-archive"></i> Archived</a></li>
                <li><a href="{{route('completedoffer')}}"><i class="fa fa-fw fa-list-alt"></i> Completed Offer</a></li>
              </ul>
           </li>
		   @endif
		  
           <!-- User Account Menu -->
            <li class="dropdown user user-menu">
              <!-- Menu Toggle Button -->
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
			  
                <!-- The user image in the navbar-->  
                @if(empty(Auth::user()->avatar))         
                     <img src="{{ asset('public/azmproject_images/avatar/person-placeholder.jpg')}}" class="user-image" alt="User Image">       
                @else
                    <img src="{{ asset('public/azmproject_images/avatar/')}}/{{Auth::user()->avatar}}" class="user-image" alt="User Image"> 
                @endif
                
                <!-- hidden-xs hides the username on small devices so only the image appears. -->
                <span class="hidden-xs">{{Auth::user()->name}} {{Auth::user()->lastname}}</span>
				
              </a>
			  
              <ul class="dropdown-menu">
			  
                <!-- The user image in the menu -->
                <li class="user-header">
                    @if(empty(Auth::user()->avatar))         
                           <img src="{{ asset('public/azmproject_images/avatar/person-placeholder.jpg')}}" class="img-circle" alt="User Image">
                    @else
                           <img src="{{ asset('public/azmproject_images/avatar/')}}/{{Auth::user()->avatar}}" class="img-circle" alt="User Image"> 
                    @endif
                  <p>
                    {{Auth::user()->name}} {{Auth::user()->lastname}}
                  </p>
                </li>
    
                <!-- Menu Footer-->
                <li class="user-footer">
					<div class="pull-left">
						<a href="{{asset('user/profile')}}" class="btn btn-default btn-flat">Profile</a>
					</div>
                    <div class="pull-right">
					   <a class="btn btn-default btn-flat" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Sign out</a>
					   <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">@csrf</form>
					</div>
                </li>
				
				
              </ul>
			  
            </li>
          </ul>
        </div>
        <!-- /.navbar-custom-menu -->
		
      </div>
      <!-- /.container-fluid -->
    </nav>
</header>