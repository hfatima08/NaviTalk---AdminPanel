<!-- ====== Admin Login Page Extending Index File ====== -->

@extends('layout.index');
@section('content');

<!-- Login form -->
<form class="login" action="{{url('/process')}}" name="form" method="post">
    @csrf    

    <!-- display error message -->
    @if(Session::get(('message')))
    <div class="alert alert-danger">
    <p>{{Session::get('message')}}</p>
    </div>
    @endif

    <!-- display success message -->
    @if(Session::get(('success')))
    <div class="alert alert-success">
    <p>{{Session::get('success')}}</p>
    </div>
    @endif

    <!-- Form Layout -->
        <h2 id="heading2">Login</h2>
        <input type="text" placeholder="Username" id="username" name="username">
        <input type="password" placeholder="Password" id="password" name="password">
        <button>Login</button>
        
      </form>  
     
     
@endsection


