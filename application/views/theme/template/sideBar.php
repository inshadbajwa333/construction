<div class="vertical-menu">

		<!-- LOGO -->
		<div class="navbar-brand-box">
			<a href="index.html" class="logo logo-dark">
				<span class="logo-sm">
					<h3>The S2R APP</h3>
				</span>
				<span class="logo-lg">
                <h3>The S2R APP</h3>
				</span>
			</a>

			<a href="index.html" class="logo logo-light">
				<span class="logo-sm">
                <h3>The S2R APP</h3>
				</span>
				<span class="logo-lg">
                <h3>The S2R APP</h3>
				</span>
			</a>
		</div>

		<button type="button" class="btn btn-sm px-3 font-size-16 header-item waves-effect vertical-menu-btn">
			<i class="fa fa-fw fa-bars"></i>
		</button>

		<div data-simplebar class="sidebar-menu-scroll">

			<!--- Sidemenu -->
			<div id="sidebar-menu">
				<!-- Left Menu Start -->
				<ul class="metismenu list-unstyled" id="side-menu">
					<li class="menu-title">General</li>

					<li>
						<a href="<?=base_url()?>dashboard">
							<i class="uil-home-alt"></i>
							<span>Dashboard</span>
						</a>
					</li>

					

					<li class="menu-title">Apps</li>


					<li>
						<a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="uil uil-users-alt"></i>
							<span>Staff</span>
						</a>
						<ul class="sub-menu" aria-expanded="false">
							<li><a href="<?=base_url()?>add-staff">Add New</a></li>
							<li><a href="<?=base_url()?>staff">All Staff</a></li>
							<li><a href="<?=base_url()?>roles">All Roles</a></li>
						</ul>
					</li>
                    <li>
						<a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="uil uil-list-ul"></i>
							<span>Menu</span>
						</a>
						<ul class="sub-menu" aria-expanded="false">
							<li><a href="<?=base_url()?>dish-categories">Categories</a></li>
							<li><a href="<?=base_url()?>sub-categories">Sub Categories</a></li>
                            <li><a href="<?=base_url()?>dish-types">Dish Types</a></li>
                            <li><a href="<?=base_url()?>dish-sizes">Dish Sizes</a></li>
						</ul>
					</li>
                    <li>
						<a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="uil uil-shop"></i>
							<span>Restaurants</span>
						</a>
						<ul class="sub-menu" aria-expanded="false">
						<li><a href="<?=base_url()?>add-restaurant">Add Restaurant</a></li>
							<li><a href="<?=base_url()?>restaurants">All Restaurants</a></li>
							<li><a href="<?=base_url()?>map-view">Restaurants On Map</a></li>
						</ul>
					</li>
                    <li>
						<a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="uil uil-restaurant"></i>
							<span>Best Selling</span>
						</a>
						<ul class="sub-menu" aria-expanded="false">
							<li><a href="<?=base_url()?>best-selling-restn">Best Selling Restaurants</a></li>
							<li><a href="<?=base_url()?>best-selling-dishes">Best Selling Dishes</a></li>
							<li><a href="<?=base_url()?>best-selling-rider">Best Selling Riders</a></li>
						</ul>
					</li>
                    <li>
						<a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="uil uil-shopping-cart-alt"></i>
							<span>Orders</span>
						</a>
						<ul class="sub-menu" aria-expanded="false">
							<li><a href="<?=base_url()?>all-orders">All Orders</a></li>
							<li><a href="<?=base_url()?>rest-orders">Rest Orders</a></li>
							
						</ul>
					</li>
                    <li>
						<a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="uil uil-users-alt"></i>
							<span>Users</span>
						</a>
						<ul class="sub-menu" aria-expanded="false">
							<li><a href="<?=base_url()?>users">All Users</a></li>
                            <li><a href="<?=base_url()?>map-view-users">Users on map</a></li>
                            
						</ul>
					</li>
                    <li>
						<a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="uil uil-users-alt"></i>
							<span>Riders</span>
						</a>
						<ul class="sub-menu" aria-expanded="false">
                        <li><a href="<?=base_url()?>add-rider">Add New</a></li>
							<li><a href="<?=base_url()?>riders">All Riders</a></li>
                            <li><a href="<?=base_url()?>map-view-users">Riders on map</a></li>
                            
						</ul>
					</li>
                    <li>
						<a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="uil uil-bill"></i>
							<span>Accounts</span>
						</a>
						<ul class="sub-menu" aria-expanded="false">
							<li><a href="<?=base_url()?>accounts">Stats</a></li>
						</ul>
					</li>
                    <li>
						<a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="uil uil-star"></i>
							<span>Reviews</span>
						</a>
						<ul class="sub-menu" aria-expanded="false">
							<li><a href="<?=base_url()?>all-reviews">All Reviews</a></li>
						</ul>
					</li>
                    <li>
						<a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="uil uil-file-graph"></i>
							<span>Enquiries</span>
						</a>
						<ul class="sub-menu" aria-expanded="false">
							<li><a href="<?=base_url()?>feedbacks">All FeedBacks</a></li>
                            <li><a href="<?=base_url()?>request-on-map">Requested Area</a></li>
						</ul>
					</li>
					<li>
						<a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="uil uil-star"></i>
							<span>Activities</span>
						</a>
						<ul class="sub-menu" aria-expanded="false">
							<li><a href="<?=base_url()?>all-activities">All Activities</a></li>
						</ul>
					</li>
					<li>
						<a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="uil uil-corner-down-left"></i>
							<span>Off-Duty Requests</span>
						</a>
						<ul class="sub-menu" aria-expanded="false">
						<li><a href="<?=base_url()?>new-requests">New Requests</a></li>
							<li><a href="<?=base_url()?>all-requests">All Requests</a></li>
						</ul>
					</li>
					<li>
						<a href="javascript: void(0);" class=" waves-effect">
                        <i class="uil uil-sign-out-alt"></i>
							<span>Sign Out</span>
						</a>
					</li>
				</ul>
			</div>
			<!-- Sidebar -->
		</div>
		</div>