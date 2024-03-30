@extends('layouts.app')
@section('content')

    <div class="container">
        <h1> Index Admin</h1>
        <div class="row">
            <div class="col-lg-12 margin-tb">        
                <div class="pull-right">
                    <a class="btn btn-success" href="{{ route('admin.create') }}"> Create New user</a>
                </div>
                <div class="pull-right">
                    <a class="btn btn-primary" href="{{ route('admin.filter') }}"> filter</a>
                </div>
                <form action="{{route('admin.filter.search')}}" method="GET">
                    @csrf
                    <div class="pull-right">
                        <input type="text" name="q">
                        <input type="submit">
                    </div>
    
                </form>
                
            </div>
        </div>
        
        @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <p>{{ $message }}</p>
            </div>
        @endif
         
        <table class="table table-bordered">
            <tr>
                <th>No</th>
                <th>Name</th>
                <th>Email</th>
                <th>Password</th>
                <th>Type</th>
                <th width="280px">Action</th>
            </tr>
            @php
                $i=1;
            @endphp
            @foreach ($users as $user)
            <tr>
                
                <td>{{ $i++}}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->password }}</td>
                
                <td>{{ $user->is_admin }}</td>
                <td>
                    <form action="{{ route('admin.delete',$user->id) }}" method="POST">
         
                        
          
                        <a class="btn btn-primary" href="{{ route('admin.edit',$user->id) }}">Edit</a>
         
                        @csrf
                        @method('DELETE')                  
                            <button type="submit" class="btn btn-danger">Delete</button>                  
                    </form>
                </td>
            </tr>
            @endforeach
        </table>
        

    </div>
    
    
    
    @endsection