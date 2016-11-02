@extends('layouts.admin')

@section('content')
    <div>
        <h2>
            @if(isset($topic))
                <span class="fa fa-pencil"></span> Edit Topic
            @else
                <span class="fa fa-pencil-square-o"></span> New Topic
            @endif
        </h2>

        <form method="post" action="@if(isset($topic)) {{ url('admin/topic/edit') }} @else {{ url('admin/topic/add') }} @endif">
            {{ csrf_field() }}
            <textarea name="title" class="form-control" rows="3" placeholder="Enter topic description"> @if(isset($topic)) {{$topic->title}} @endif</textarea>
            </br>
            <button class="btn btn-default" type="submit"><span class="fa fa-paper-plane"></span> Submit</button>
        </form>
    </div>
@endsection