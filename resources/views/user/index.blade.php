@extends('admin')
@section('content')

			<!-- MAIN CONTENT -->
			<div id="content">


<div class="row">
@include('include.message')
@include('include.warning')
<div class="alert alert-block alert-success">
	<a class="close" data-dismiss="alert" href="#">×</a>
	<h4 class="alert-heading"><i class="fa fa-check-square-o"></i> User Page!</h4>
	<p>
		Create user and attach to an Mda
	</p>
</div>

<!-- widget grid -->
<section id="widget-grid" class="">


	<!-- START ROW -->

	<div class="row">

		<!-- NEW COL START -->
		<article class="col-sm-12 col-md-12 col-lg-6">
			
			<!-- Widget ID (each widget will need unique ID)-->
			<div class="jarviswidget" id="wid-id-1" data-widget-editbutton="false" data-widget-custombutton="false">
				<!-- widget options:
					usage: <div class="jarviswidget" id="wid-id-0" data-widget-editbutton="false">
					
					data-widget-colorbutton="false"	
					data-widget-editbutton="false"
					data-widget-togglebutton="false"
					data-widget-deletebutton="false"
					data-widget-fullscreenbutton="false"
					data-widget-custombutton="false"
					data-widget-collapsed="true" 
					data-widget-sortable="false"
					
				-->
				<header>
					<span class="widget-icon"> <i class="fa fa-edit"></i> </span>
					<h2>User Page</h2>				
					
				</header>

				<!-- widget div-->
				<div>
					
					<!-- widget edit box -->
					<div class="jarviswidget-editbox">
						<!-- This area used as dropdown edit box -->
						
					</div>
					<!-- end widget edit box -->
					
					<!-- widget content -->
					
				<section id="widget-grid" class="">
				
					<!-- row -->
					<div class="row">
				
						<!-- NEW WIDGET START -->
						<article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
				
							<!-- Widget ID (each widget will need unique ID)-->
							<div class="jarviswidget jarviswidget-color-darken" id="wid-id-0" data-widget-editbutton="false">
								<!-- widget options:
								usage: <div class="jarviswidget" id="wid-id-0" data-widget-editbutton="false">
				
								data-widget-colorbutton="false"
								data-widget-editbutton="false"
								data-widget-togglebutton="false"
								data-widget-deletebutton="false"
								data-widget-fullscreenbutton="false"
								data-widget-custombutton="false"
								data-widget-collapsed="true"
								data-widget-sortable="false"
				
								-->

								<!-- widget div-->

				
										<table id="dt_basic" class="table table-striped table-bordered table-hover" width="100%">
											<thead>			                
												<tr>
													<th data-hide="phone">ID</th>
													<th data-hide="phone,tablet"><i class="fa fa-fw fa-map-marker txt-color-blue hidden-md hidden-sm hidden-xs"></i> Name</th>
													<th data-hide="phone,tablet"><i class="fa fa-fw fa-map-marker txt-color-blue hidden-md hidden-sm hidden-xs"></i> User</th>
													<th data-hide="phone,tablet">Description</th>
													<th data-hide="phone,tablet">Action</th>
													
													
												
												</tr>
											</thead>
											<tbody>
												<tr>
													<td>1</td>
													<td>Fogo</td>
													<td>Fogo</td>
													<td>Et Rutrum Non Associates</td>
													<td> </td>
													
												</tr>
												<tr>
													<td>2</td>
													<td>Machelen</td>
													<td>Machelen</td>
													<td>Nam Ac Inc.</td>
													<td> </td>
												</tr>
															
											</tbody>
										</table>

								
					
				</div>
				<!-- end widget div -->
				
			</div>
			<!-- end widget -->
			
			<!-- Widget ID (each widget will need unique ID)-->
			
			<!-- end widget -->				

			<!-- Widget ID (each widget will need unique ID)-->
			<div class="jarviswidget" id="wid-id-7" data-widget-editbutton="false" data-widget-custombutton="false">
				<!-- widget options:
					usage: <div class="jarviswidget" id="wid-id-0" data-widget-editbutton="false">
					
					data-widget-colorbutton="false"	
					data-widget-editbutton="false"
					data-widget-togglebutton="false"
					data-widget-deletebutton="false"
					data-widget-fullscreenbutton="false"
					data-widget-custombutton="false"
					data-widget-collapsed="true" 
					data-widget-sortable="false"
					
				-->
			<!-- widget div-->
			<!-- end widget div -->
				
			</div>
			<!-- end widget -->	

		</article>
		<!-- END COL -->

		<!-- NEW COL START -->
		<article class="col-sm-12 col-md-12 col-lg-6">
			
			<!-- Widget ID (each widget will need unique ID)-->
			<div class="jarviswidget" id="wid-id-4" data-widget-editbutton="false" data-widget-custombutton="false">
				<!-- widget options:
					usage: <div class="jarviswidget" id="wid-id-0" data-widget-editbutton="false">
					
					data-widget-colorbutton="false"	
					data-widget-editbutton="false"
					data-widget-togglebutton="false"
					data-widget-deletebutton="false"
					data-widget-fullscreenbutton="false"
					data-widget-custombutton="false"
					data-widget-collapsed="true" 
					data-widget-sortable="false"
					
				-->
			

				<!-- widget div-->
				<div>
					
					<!-- widget edit box -->
					<div class="jarviswidget-editbox">
						<!-- This area used as dropdown edit box -->
						
					</div>
					<!-- end widget edit box -->
					
					<!-- widget content -->
					<div class="widget-body no-padding">
						
						<form  action="/users" class="smart-form" method="POST">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">
							<header>
								User form
							</header>

							<fieldset>
								<section>
									<label class="input"> <i class="icon-append fa fa-user"></i>
										<input type="text" name="name" placeholder="Name">
										<b class="tooltip tooltip-bottom-right">Enter Username</b> </label>
								</section>
								
								<section>
										<label class="input"> <i class="icon-append fa fa-envelope-o"></i>
											<input type="email" name="email" placeholder="E-mail">
											<b class="tooltip tooltip-bottom-right">Enter a Valid Email</b>
										</label>
									</section>
								
								<section>
										<label class="select">
											<select name="igr_id">
												<option value="0" selected="" disabled="">IGR</option>
												@if($igrs)
												@foreach($igrs as $igr)
												<option value="{{$igr->id}}">{{$igr->state_name}}</option>
												@endforeach
												@else
												<option value="1">No IGR</option>
												@endif
											</select> <b class="tooltip tooltip-bottom-right">Select An IGR</b></label>
									</section>
									
									<section>
									<label class="input"> <i class="icon-append fa fa-lock"></i>
										<input type="password" name="password" placeholder="Password" id="password">
										<b class="tooltip tooltip-bottom-right">Enter your password</b> </label>
								</section>
									
								<section>
									<label class="input"> <i class="icon-append fa fa-lock"></i>
										<input type="password" name="passwordConfirm" placeholder="Confirm password">
										<b class="tooltip tooltip-bottom-right">Confirm password</b> </label>
								</section>
									
								<section>
										<label class="select">
											<select name="role[]">
												<option value="0" selected="" disabled="">Role</option>
												@if($roles)
												@foreach($roles as $role)
												<option value="{{$role->id}}">{{$role->name}}</option>
												@endforeach
												@else
												<option value="1">No Role</option>
												@endif
											</select></label>
									</section>

							
							</fieldset>

							
							<footer>
								<button type="submit" class="btn btn-primary">
									Create
								</button>
							</footer>
						</form>						
						
					</div>
					<!-- end widget content -->
					
				</div>
				<!-- end widget div -->
				
			</div>
			<!-- end widget -->
			
			<!-- Widget ID (each widget will need unique ID)-->
			<!-- end widget -->
				
			
			<!-- Widget ID (each widget will need unique ID)-->
			<!-- end widget -->								


		</article>
		<!-- END COL -->		

	</div>

	<!-- END ROW -->

</section>
<!-- end widget grid -->


<!-- Modal -->
<!--<div class="modal fade" id="myModal" tabindex="-1" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
					&times;
				</button>
				<h4 class="modal-title">
					<img src="img/logo.png" width="150" alt="SmartAdmin">
				</h4>
			</div>
			<div class="modal-body no-padding">

				<form id="login-form" class="smart-form">

							<fieldset>
								<section>
									<div class="row">
										<label class="label col col-2">Username</label>
										<div class="col col-10">
											<label class="input"> <i class="icon-append fa fa-user"></i>
												<input type="email" name="email">
											</label>
										</div>
									</div>
								</section>

								<section>
									<div class="row">
										<label class="label col col-2">Password</label>
										<div class="col col-10">
											<label class="input"> <i class="icon-append fa fa-lock"></i>
												<input type="password" name="password">
											</label>
											<div class="note">
												<a href="javascript:void(0)">Forgot password?</a>
											</div>
										</div>
									</div>
								</section>

								<section>
									<div class="row">
										<div class="col col-2"></div>
										<div class="col col-10">
											<label class="checkbox">
												<input type="checkbox" name="remember" checked="">
												<i></i>Keep me logged in</label>
										</div>
									</div>
								</section>
							</fieldset>
							
							<footer>
								<button type="submit" class="btn btn-primary">
									Sign in
								</button>
								<button type="button" class="btn btn-default" data-dismiss="modal">
									Cancel
								</button>

							</footer>
						</form>						
						

			</div>

		</div><!-- /.modal-content --
	</div><!-- /.modal-dialog --
</div><!-- /.modal --


			</div>-->
			<!-- END MAIN CONTENT -->

@stop