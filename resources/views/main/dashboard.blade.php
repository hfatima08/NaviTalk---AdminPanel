<!-- ====== Admin Dashboard Layout Extending Admin Panel Layout ====== -->

@extends('layout.admin')

<!-- Title name -->
@section('title')
NaviTalk - Admin Dashboard
@endsection

@section('menu')

<!-- Side bar Page Links  -->
<li class="sidebar-item active">
<a href="{{route('dashboard')}}" class='sidebar-link active'>
                                <i class="bi bi-grid-fill"></i>
                                <span>Dashboard</span>
                            </a>
                        </li>
                        <li class="sidebar-item ">
                            <a href="{{route('users')}}" class='sidebar-link'>
                                <i class="bi bi-person-circle"></i>
                                <span>Blind User Record</span>
                            </a>
                        </li>

                        <li class="sidebar-item ">
                            <a href="{{route('volunteer')}}" class='sidebar-link'>
                                <i class="bi bi-person-lines-fill"></i>
                                <span>Volunteer Record</span>
                            </a>
                        </li>

                        <li class="sidebar-item">
                            <a href="{{route('all')}}" class='sidebar-link'>
                                <i class="bi bi-people"></i>
                                <span>All Users Record</span>
                            </a>
                        </li>
</li>

@endsection

<!-- Main Content -->
@section('admincontent')

<div class="page-heading ">
     <h3>Dashboard</h3>
            </div>
            <br>
           
            <div class="page-content ">
                <section class="row box1">
                    <div class="col-12 col-lg-9">
                        <div class="row">
                            <div class="col-12 col-lg-1 col-md-1"></div>
                            <div class="col-12 col-lg-4 col-md-4">
                                <div class="card">
                                    <div class="card-body py-4 px-5">
                                        <div class="row">
                                            
                                            <div class="col-md-4">
                                                <div class="stats-icon purple">
                                                    <i class="iconly-boldShow"></i>
                                                </div>
                                            </div>

                                            <!-- show number of blind users -->
                                            <div class="col-md-8">
                                                <h6 class="text-muted font-semibold">Number of Blind Users</h6>
                                                <h6 class="font-extrabold mb-0" id="bcount">0</h6>
                                            </div>
                                       
                                            </div>
                                        </div>
                                    </div>
                                </div>
                           
                            <div class="col-12 col-lg-1 col-md-2"></div>
                            <div class="col-12 col-lg-4 col-md-4">
                                <div class="card">
                                    <div class="card-body py-4 px-5">
                                        <div class="row">
                                           
                                            <div class="col-md-4">
                                                <div class="stats-icon green">
                                                    <i class="iconly-boldProfile"></i>
                                                </div>
                                            </div>
                                              <!-- show number of volunteers -->
                                            <div class="col-md-8">
                                                <h6 class="text-muted font-semibold">Number of Volunteers</h6>
                                                <h6 class="font-extrabold mb-0" id="vcount">0</h6>
                                            </div>
                                        </div>
                                        </div>
                                    </div>
                                </div>
                            
                            <div class="col-12 col-lg-1 col-md-1"></div>
                         
                        </div>
                     
                    </div>

                    <!--  Admin card -->
                  <div class="col-12 col-lg-3">
                        <div class="card">
                            <div class="card-body py-4 px-5">
                                <div class="d-flex align-items-center">
                                    <div class="avatar avatar-xl">
                                        <img src="{{URL::to('assets/img/2.jpg')}}" alt="Face 1">
                                    </div>
                                    <div class="ms-3 name">
                                        <h5 class="font-bold">{{Session::get('user')}}</h5>
                                        <h6 class="text-muted mb-0">@admin</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                  
                        </div>

                        <div class="container">

@endsection

@push('script')

<!-- count blind users and volunteers from firebase data  -->

<!-- count user function call -->
countUsers();
    
var blindCount = 0;
var volCount = 0;

<!-- counter user function -->
function countUsers(){

<!-- get blind user data -->
    firebase.database().ref('Users').orderByChild("role").equalTo("Blind User").once('value',function(snapshot){
        snapshot.forEach((data) => {
            blindCount ++;
            document.getElementById('bcount').innerHTML=blindCount;
        });
    });

<!-- get volunteer data -->
    firebase.database().ref('Users').orderByChild("role").equalTo("Volunteer").once('value',function(snapshot){
        snapshot.forEach((data) => {
            volCount++;
            document.getElementById('vcount').innerHTML=volCount;
        });
    });

    } 
    <!-- function end -->
    
@endpush