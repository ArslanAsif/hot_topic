@extends('layouts.admin')

@section('content')
    <div>
        <h2><span class="fa fa-users"></span> All Users</h2>

        <div class="table-responsive">
            <table class="table table-bordered">
                <tr>
                    <th>Sr. #</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Member Since</th>
                    <th>Ban</th>
                </tr>

                @foreach($users as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->created_at }}</td>
                    <td>
                        @if(!$user->is_admin)
                        <a href="{{ url('/admin/user/ban/'.$user->id) }}" class="btn btn-sm btn-default"><span class="fa fa-eye"></span> @if($user->ban == 0) Ban @else Unban @endif</a>
                        @else
                            <p href="#">Admin</p>
                        @endif
                    </td>
                </tr>
                @endforeach
            </table>
        </div>
    </div>
@endsection