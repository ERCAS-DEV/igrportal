@extends('admin')
@section('content')
<div id="ribbon">

	<span class="ribbon-button-alignment"> 
		<span id="refresh" class="btn btn-ribbon" data-action="resetWidgets" data-title="refresh"  rel="tooltip" data-placement="bottom" data-original-title="<i class='text-warning fa fa-warning'></i> Warning! This will reset all your widget settings." data-html="true">
			<i class="fa fa-refresh"></i>
		</span> 
	</span>

	<!-- breadcrumb -->
	<ol class="breadcrumb">
		<li>Access Control</li><li>User</li>
	</ol>
	<!-- end breadcrumb -->

	<!-- You can also add more buttons to the
	ribbon for further usability

	Example below:

	<span class="ribbon-button-alignment pull-right">
	<span id="search" class="btn btn-ribbon hidden-xs" data-title="search"><i class="fa-grid"></i> Change Grid</span>
	<span id="add" class="btn btn-ribbon hidden-xs" data-title="add"><i class="fa-plus"></i> Add</span>
	<span id="search" class="btn btn-ribbon" data-title="search"><i class="fa-search"></i> <span class="hidden-mobile">Search</span></span>
</span> -->

</div>
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
				<article class="col-sm-12 col-md-8 col-lg-8">

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

							<table id="datatable_tabletools" class="table table-striped table-bordered table-hover" width="100%">
								<thead>
									<tr>
										<th data-hide="phone">Name</th>
										<th data-class="expand">Email</th>
										<th>Role</th>
										<th data-hide="phone,tablet">Role Discription</th>
										<th data-hide="phone">Action</th>

									</tr>
								</thead>
								<tbody>
								@if($users)
								@foreach($users as $user)
									<tr>
										<td>{{$user->name}}</td>
										<td>{{$user->email}}</td>
									<td>
									@foreach($user->roles as $role)
									{{$role->name}}
									@endforeach
									</td>
									<td>
									@foreach($user->roles as $role)
									{{$role->description}}
									@endforeach
									</td>
										<td> <a href="#" class="btn btn-default btn-sm" data-toggle="tooltip" title="Edit"><span class="glyphicon glyphicon-edit"></span></a> &nbsp;&nbsp;<a href="/users/{{$user->id}}" class="btn btn-default btn-sm" onclick="confirm_alert()" data-toggle="tooltip" title="Delete"><span class="glyphicon glyphicon-trash"></span></a></td>
									</tr>
									@endforeach
								@endif
								</tbody>
							</table>
							<!-- pagination -->

							
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
		<article class="col-sm-12 col-md-4 col-lg-4">
			
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
											<select name="igr_id" id="igr">
												<option value="0" selected="">Select IGR</option>
												@if(isset($igrs))
												@foreach($igrs as $igr)
												<option value="{{$igr->id}}">{{$igr->state_name}}</option>
												@endforeach
												@else
												<option value="1">No IGR</option>
												@endif
											</select> <b class="tooltip tooltip-bottom-right">Select An IGR</b></label>
										</section>

										<section>
											<label class="select">
												<select name="mda_id" id="mda">
													<option value="0" selected="">Select MDA/LGA</option>
												</select> 
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
														<select name="role[]" id="user_seclect" multiple="multiple">
															@if(isset($roles))
															@foreach($roles as $role)
															<option value="{{$role->id}}">{{$role->name}}</option>
															@endforeach
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

<!-- END MAIN CONTENT -->
</div>
</div>
</article>
</div>
</section>
</div>
</div>

@stop
@push('scripts')
<script type="text/javascript">
	$("#user_seclect").select2({
	  tags: true,
	  placeholder: "Select Role",
	});

	$("#igr").select2({
	  placeholder: "Select IGR",
	});

	$("#mda").select2({
	  placeholder: "Select MDA/LGA",
	});
</script>
<script>

    $('#igr').change(function(){
        $.get("{{ url('/list_mda')}}", 
        { option: $(this).val() }, 
        function(data) {
            $('#mda').empty(); 
            $.each(data, function(key, element) {
                $('#mda').append("<option value='" + key +"'>" + element + "</option>");
            });
        });
    });

</script>
<script type="text/javascript">
function confirm_alert() {

   	var x = confirm("Are you sure you want to delete?");
	if (x) {
		return true;
	}else {

		event.preventDefault();
		return false;
	}
}
</script>
@endpush