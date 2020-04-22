<div class="box custom_box">
				<div class="box-header with-border">
				  <h3 class="box-title">User Settings</h3>

				  <div class="box-tools">
					<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
					</button>
				  </div>
				</div>
				<div class="box-body no-padding">
				  <ul class="nav nav-pills nav-stacked">

				   <li class="{{ (@$menu == "profile")       ? "active" : "" }}">
						<a href="{{asset('user/profile')}}"> Your profile </a>
					</li>
					
					<li class="{{ (@$menu == "avatar")       ? "active" : "" }}">
						<a href="{{asset('user/avatar')}}"> Upload your avatar </a>
					</li>
					
					<li class="{{ (@$menu == "password")       ? "active" : "" }}"> 
						<a href="{{asset('user/changepassword')}}"> Change your password</a>
					</li>
					
					<li class="{{ (@$menu == "interest")       ? "active" : "" }}"> 
						<a href="{{asset('user/update/interest')}}"> Your product interest</a>
					</li>
					
					<li class="{{ (@$menu == "wallet")       ? "active" : "" }}"> 
						<a href="{{asset('user/mywallet')}}"> My Wallet</a>
					</li>
					<li class="{{ (@$menu == "points")       ? "active" : "" }}"> 
						<a href="{{asset('user/mypoints')}}"> My Points</a>
					</li>
					
					<!--<li > -->
					<!--	<a href="{{asset('user/mypoints')}}"> My Points</a>-->
					<!--</li>-->
					
				  </ul>
				</div>
				<!-- /.box-body -->
			  </div>