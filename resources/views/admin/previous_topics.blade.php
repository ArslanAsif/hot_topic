@extends('layouts.admin')

@section('content')
    <div>
        <h2><span class="fa fa-calendar"></span> Previous Topics</h2>

        <div class="table-responsive">
            <table class="table table-bordered">
                <tr>
                    <th>Sr.#</th>
                    <th>Topic</th>
                    <th>Submitted On</th>
                    <th></th>
                </tr>

                @foreach($topics as $topic)
                <tr>
                    <td>{{ $topic->id }}</td>
                    <td>{{ $topic->title }}</td>
                    <td>{{ $topic->created_at }}</td>
                    <td><a href="{{ url('/admin/topic/view/'.$topic->id) }}" class="btn btn-sm btn-default"><span class="fa fa-eye"></span> View</a></td>
                </tr>
                @endforeach
            </table>
        </div>
    </div>
@endsection