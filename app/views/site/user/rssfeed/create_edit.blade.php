@extends('admin/layouts/modal')

{{-- Content --}}
@section('content')
	<!-- Tabs -->
		<ul class="nav nav-tabs">
			<li class="active"><a href="#tab-general" data-toggle="tab">General</a></li>
		</ul>
	<!-- ./ tabs -->
	{{-- Edit RSS Feed Form --}}
	<form class="form-horizontal" method="post" action="" autocomplete="off">
		<!-- CSRF Token -->
		<input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
		<!-- ./ csrf token -->

		<!-- Tabs Content -->
		<div class="tab-content">
			<!-- General tab -->
			<div class="tab-pane active" id="tab-general">

				<!-- title -->
				<div class="form-group {{{ $errors->has('title') ? 'error' : '' }}}">
					<div class="col-md-12">
                        <label class="control-label" for="title">Title</label>
						<input type="text" class="form-control" name="title" value="{{{ Input::old('title', isset( $rssfeed ) ? $rssfeed->title : null ) }}}" />
						{{ $errors->first('title', '<span class="help-inline">:message</span>') }}
					</div>
				</div>
				<!-- ./ title -->

                <!-- url -->
                <div class="form-group {{{ $errors->has('url') ? 'error' : '' }}}">
                    <div class="col-md-12">
                        <label class="control-label" for="url">Url</label>
                        <input type="text" class="form-control" name="url" value="{{{ Input::old('url', isset( $rssfeed ) ? $rssfeed->url : null ) }}}" />
                        {{ $errors->first('url', '<span class="help-inline">:message</span>') }}
                    </div>
                </div>
                <!-- ./ url -->

			</div>
			<!-- ./ general tab -->
		</div>
		<!-- ./ tabs content -->

		<!-- Form Actions -->
		<div class="form-group">
			<div class="col-md-12">
				<element class="btn-cancel close_popup">Cancel</element>
				<button type="reset" class="btn btn-default">Reset</button>
				<button type="submit" class="btn btn-success">Update</button>
			</div>
		</div>
		<!-- ./ form actions -->
	</form>
@stop
