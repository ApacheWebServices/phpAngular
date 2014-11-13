@extends('admin.layouts.modal')

{{-- Content --}}
@section('content')

    {{-- Delete RSS Feed Form --}}
    <form id="deleteForm" class="form-horizontal" method="post" action="@if (isset($rssfeed)){{ URL::to('rssfeed/' . $rssfeed->id . '/delete') }}@endif" autocomplete="off">
        <!-- CSRF Token -->
        <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
        <input type="hidden" name="id" value="{{ $rssfeed->id }}" />
        <!-- ./ csrf token -->

        <!-- Form Actions -->
        <div class="form-group">
            <div class="controls">
                <element class="btn-cancel close_popup">Cancel</element>
                <button type="submit" class="btn btn-danger ">Delete</button>
            </div>
        </div>
        <!-- ./ form actions -->
    </form>
@stop