<!-- ====== Blind User and Volunteer Hierarchy Layout Extending Admin Panel Layout ====== -->

@extends('layout.admin')

<!-- Title name -->
@section('title')
NaviTalk - User Record
@endsection

@section('menu')

<!-- Side bar Page Links  -->
<li class="sidebar-item ">
<a href="{{route('dashboard')}}" class='sidebar-link'>
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

                        <li class="sidebar-item">
                            <a href="{{route('volunteer')}}" class='sidebar-link'>
                                <i class="bi bi-person-lines-fill"></i>
                                <span>Volunteer Record</span>
                            </a>
                        </li>

                        <li class="sidebar-item active">
                            <a href="{{route('all')}}" class='sidebar-link'>
                                <i class="bi bi-people"></i>
                                <span>All Users Record</span>
                            </a>
                        </li>

@endsection

<!-- Main Content -->
@section('admincontent')

<div class="container box">
<div class="page-heading">
     <h3>User Record</h3>
     <h6>Blind User(s) & Their Volunteer(s)</h6>
            </div>
            <br>
        <!-- blind user and thier volunteer accordion -->
<div class="accordion accordion-flush" id="accordionFlushExample">

 </div>
</div>

@endsection


@push('script')

<!-- Show blind user(s) and their volunteer(s) from firebase -->

<!-- Fetch data function -->
function SelectAllData(){
    firebase.database().ref('Users').orderByChild("role").equalTo("Blind User").once('value',function(snapshot){
        snapshot.forEach((data) => {

var bcode;
var i=1;

var body = document.getElementById('accordionFlushExample');
    var div1 = document.createElement('div');
     div1.className ="accordion-item";

     var h6 = document.createElement('h6');

    var h2 = document.createElement('h2');
    h6.className ="accordion-body";
    h6.style.cssText = 'margin-bottom:-20px';

    h2.className ="accordion-header";
    h2.setAttribute("id","flush-headingOne");

    var p = document.createElement('p');
    p.className ="accordion-body";

    <!-- display blind user name on front, accordion item -->
    h2.innerHTML='<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">'+data.val().userName+'</button>';
  
    h6.innerHTML="Volunteer(s):"

    bcode=data.val().code;

<!-- get users by  role volunteer and match code with blind user code -->
    firebase.database().ref("Users").orderByChild("role").equalTo("Volunteer").on('value', function(snapshot){
        if(snapshot.exists()){
     var div2 = document.createElement('div');
    div2.className ="accordion-collapse collapse";
   div2.setAttribute("id","flush-collapseOne");
   div2.setAttribute("aria-labelledby","flush-headingOne");
   div2.setAttribute("data-bs-parent","#accordionFlushExample");

        snapshot.forEach((data) => {
        <!-- match code of volunteer and blind user -->
        for(var i=0;i<=data.val().code.length;i++){
            if(data.val().code[i]==bcode[0]){

        <!-- display volunteer name in accordion body -->
      p.innerHTML+= '- \t <b>Name:</b> '+data.val().userName+' <br> <b>Email:</b> '+data.val().mail;
            }
    }
});
}else{
    p.innerHTL="no volunteers";
}

  div2.appendChild(h6);
  div2.appendChild(p);
    div1.appendChild(div2);

});

div1.appendChild(h2);
body.appendChild(div1);

    });
 });
} <!-- function end --> -->

<!-- call function to fetch data on window load -->
window.onload=SelectAllData;
 
@endpush


