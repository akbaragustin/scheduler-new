<body class="no-skin">
		<div id="navbar" class="navbar navbar-default ace-save-state newnavbar">
			<div class="navbar-container ace-save-state" id="navbar-container">
				<button type="button" class="navbar-toggle menu-toggler pull-left" id="menu-toggler" data-target="#sidebar">
					<span class="sr-only">Toggle sidebar</span>

					<span class="icon-bar"></span>

					<span class="icon-bar"></span>

					<span class="icon-bar"></span>
				</button>

				<div class="navbar-header pull-left">
					<a href="index.html" class="navbar-brand">
						<small>
							<i class="fa fa-leaf"></i>
							Puskim PU
						</small>
					</a>
				</div>

								<?php
								$username =Session::get('auth');


								 ?>
				<div class="navbar-buttons navbar-header pull-right" role="navigation">
					<ul class="nav ace-nav">


						<li class="light-blue dropdown-modal">
							<a data-toggle="dropdown" href="#" class="dropdown-toggle">
								<img class="nav-user-photo" src="{{ URL::asset('') }}assets/images/favicon/k.png" alt="Jason's Photo" />
								<span class="user-info">
									<small>Welcome</small>
									{{$username['username']}}
								</span>

								<i class="ace-icon fa fa-caret-down"></i>
							</a>

							<ul class="user-menu dropdown-menu-right dropdown-menu dropdown-yellow dropdown-caret dropdown-close">


								<li>
									<a href="{{url(route('Editusers.index'))}}">
										<i class="ace-icon fa fa-user"></i>
										Profile
									</a>
								</li>

								<li class="divider"></li>

								<li>
									<a href="{{url('/logout')}}">
										<i class="ace-icon fa fa-power-off"></i>
										Logout
									</a>
								</li>
							</ul>
						</li>
					</ul>
				</div>
			</div><!-- /.navbar-container -->
		</div>
