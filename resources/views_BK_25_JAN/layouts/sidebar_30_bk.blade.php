<!-- begin:: Aside -->
				<button class="kt-aside-close " id="kt_aside_close_btn"><i class="la la-close"></i></button>
				<div class="kt-aside  kt-aside--fixed  kt-grid__item kt-grid kt-grid--desktop kt-grid--hor-desktop" id="kt_aside">

					<!-- begin:: Aside -->
					<div class="kt-aside__brand kt-grid__item  " id="kt_aside_brand">
						<div class="kt-aside__brand-logo">
							<a href="index.html">
								<img alt="Logo" STYLE="width:100px" src="{{ asset('assetsadmin/media/logos/u2-marine-logo-1.png') }}" />
							</a>
						</div>
					</div>

					<!-- end:: Aside -->

					<!-- begin:: Aside Menu -->
					<div class="kt-aside-menu-wrapper kt-grid__item kt-grid__item--fluid" id="kt_aside_menu_wrapper">
						<div id="kt_aside_menu" class="kt-aside-menu  kt-aside-menu--dropdown " data-ktmenu-vertical="1" data-ktmenu-dropdown="1" data-ktmenu-scroll="0">
							<ul class="kt-menu__nav ">
							<?php  							
							$routeName = Route::currentRouteName();							
							$userType= Auth::user()->user_type;
							if(strtoupper($userType) == 'ADMIN'){
							?>
							
							<li class="kt-menu__item kt-menu__item--active" aria-haspopup="true">
								<a href="{{ route('pages.index') }}"  class="kt-menu__link ">
									<i class="kt-menu__link-icon flaticon-users-1"></i>
									<span class="kt-menu__link-text">pages</span></a>										
							</li>
							
							<li class="kt-menu__item kt-menu__item--active" aria-haspopup="true">
								<a href="{{ route('questionlist') }}"  class="kt-menu__link ">
									<i class="kt-menu__link-icon flaticon-users-1"></i>
									<span class="kt-menu__link-text">questionlist</span></a>										
							</li>
							
							<li class="kt-menu__item kt-menu__item--active" aria-haspopup="true">
								<a href="{{ route('userslist') }}"  class="kt-menu__link ">
									<i class="kt-menu__link-icon flaticon-users-1"></i>
									<span class="kt-menu__link-text">Users</span></a>										
							</li>
							
							<li class="kt-menu__item kt-menu__item--active" aria-haspopup="true">
								<a href="{{ route('courselist') }}"  class="kt-menu__link ">
									<i class="kt-menu__link-icon flaticon-users-1"></i>
									<span class="kt-menu__link-text">Courses</span></a>										
							</li>
							
							<li class="kt-menu__item kt-menu__item--active" aria-haspopup="true">
								<a href="{{ route('booklist') }}"  class="kt-menu__link ">
									<i class="kt-menu__link-icon flaticon-users-1"></i>
									<span class="kt-menu__link-text">Books</span></a>										
							</li>	
							<li class="kt-menu__item kt-menu__item--active" aria-haspopup="true">
								<a href="{{ route('couponlist') }}"  class="kt-menu__link ">
									<i class="kt-menu__link-icon flaticon-users-1"></i>
									<span class="kt-menu__link-text">Coupons</span></a>										
							</li>
							<?php }elseif(strtoupper($userType) == 'CANDIDATE'){ ?>
							
							<?php }elseif(strtoupper($userType) == 'COMPANY'){ ?>
							
							<?php }elseif(strtoupper($userType) == 'TRAINER'){ ?>
							
							<?php } ?>
							</ul>
						</div>
					</div>

					<!-- end:: Aside Menu -->
				</div>