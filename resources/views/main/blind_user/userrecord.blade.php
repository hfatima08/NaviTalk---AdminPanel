<!-- ====== Blind User Record Layout Extending Admin Panel Layout ====== -->
@extends('layout.admin')

<!-- Title name -->
@section('title')
NaviTalk - Blind User Record
@endsection

@section('menu')

<!-- Side bar Page Links  -->
<li class="sidebar-item ">
                            <a href="{{route('dashboard')}}" class='sidebar-link'>
                                <i class="bi bi-grid-fill"></i>
                                <span>Dashboard</span>
                            </a>
                        </li>
                        <li class="sidebar-item active">
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

                        <li class="sidebar-item">
                            <a href="{{route('all')}}" class='sidebar-link'>
                                <i class="bi bi-people"></i>
                                <span>All Users Record</span>
                            </a>
                        </li>   

@endsection

<!-- Record Table -->
@section('admincontent')

<div class="container box">
<div class="page-heading">
     <h3>Blind User Record</h3>
            </div>
            <br>

  <!-- button to add new user -->
<button class="btn btn-primary btn-lg" data-bs-toggle="modal" data-bs-target="#editmodal" style="float:right;margin-bottom:10px;font-size:17px" onclick="fillText()"><i class="fa fa-plus" aria-hidden="true"></i>
Add New User</button>

  <!-- table -->
<table class="table table-hover table-bordered table-striped" style="text-align:center">
<thead>
<tr>
<th>User Id</th>
<th>User Name</th>
<th>User Email</th>
<th>Code</th>
<th >Actions</th>
</tr>
</thead>

<tbody id='UserData'>
</tbody>

</table>
</div>

<!-- Table End -->

<!-- Add/Edit User Modal -->
<div class="modal fade" id="editmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="heading">Edit User</h5>
        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

<div class="modal-body">

<div class="form-group">
<Label>User Name</Label>
<input type="text" name="name" id="name" placeholder="Enter User Name" class="form-control">
</div>

<div class="form-group">
<Label>Email</Label>
<input type="email" name="mail" id="mail" placeholder="Enter Email" class="form-control">
</div>

<div class="form-group">
<Label>Code</Label>
<input type="text" name="code" id="code" placeholder="Enter a 6-digit code" class="form-control" size="6">
</div>
      </div>
      <div class="modal-footer">
        <button id="editbtn" type="button" class="btn btn-primary" onclick="update()">Update</button>
        <button id="addbtn" type="button" class="btn btn-primary" onclick="Add()">Save</button>
      </div>
    </div>
  </div>
</div>
<!-- Model End -->

@endsection


@push('script')

<!-- Show blind user record from firebase -->

<!-- Fetch data function -->
function SelectAllData(){
    user=0;
    blindNum=1;

    document.getElementById('UserData').innerHTML="";

    firebase.database().ref('Users').once('value',function(snapshot){
        snapshot.forEach(function(childSnapshot){
            var role = childSnapshot.val().role;
             
            if(role=="Blind User"){
                var id = childSnapshot.key;
                var name = childSnapshot.val().userName;
                var mail = childSnapshot.val().mail;
                var code = childSnapshot.val().code;
                AddItemsToTable(id,name,mail,code);
            }
    });
            });
}

<!-- call function to fetch data on window load -->
window.onload=SelectAllData;

var userlist=[];
var user=0 ;
var blindNum;

<!-- Show fetched data in table -->
function AddItemsToTable(id,name,mail,code){
    var tbody = document.getElementById('UserData');
    var trow = document.createElement('tr');
   var td1 = document.createElement('td');
    td1.setAttribute("id","uid");
    var td2 = document.createElement('td');
    var td3 = document.createElement('td');
    var td4 = document.createElement('td');
    var td5 = document.createElement('td');
    userlist.push([id,name,mail,code]);

    td1.innerHTML="Blind"+blindNum;
    td2.innerHTML=name;
    td3.innerHTML=mail;
    td4.innerHTML=code;
    td5.innerHTML=++user;
    trow.appendChild(td1);
    trow.appendChild(td2);
    trow.appendChild(td3);
    trow.appendChild(td4);

    blindNum++;
    
    var ControlDiv = document.createElement("div");
    ControlDiv.innerHTML= '<button class="btn btn-success" type="button" data-bs-toggle="modal" data-bs-target="#editmodal" onclick="fillText('+user+')">Edit</button>'
    ControlDiv.innerHTML += '<button class="btn btn-danger" type="button"  style="margin:10px" onclick="deluser('+user+')">Delete</button>'
    
    tbody.appendChild(trow);
    trow.appendChild(ControlDiv);

} 

<!-- get data from modal text feilds -->
var modName = document.getElementById('name');
var modMail = document.getElementById('mail');
var modCode = document.getElementById('code');

<!-- modal button and heading -->
var edit = document.getElementById('editbtn');
var add = document.getElementById('addbtn');
var heading = document.getElementById('heading');

var id;
var codeList=[];

<!-- Fill modal text feilds  -->
function fillText(uid){
    if(uid==null){
      <!-- empty text feilds for add user modal -->
        modName.value="";
        modCode.value="";
        modMail.value="";
        edit.style.display='none';
        add.style.display='inline-block';
        heading.innerHTML="Add User"
    }else{
      <!-- fill text feild with selected user data to edit -->
    --uid;
    id = userlist[uid][0]
    firebase.database().ref('Users/' + id ).once("value", snap => {
        modName.value=snap.val().userName;
        modMail.value=snap.val().mail;
        modCode.value=snap.val().code;
        add.style.display='none';
        heading.innerHTML="Edit User"
        edit.style.display='inline-block';
    });
}
}

<!-- === Add new user to firebase function === -->
function Add(){
  <!-- validations -->
   if(modName.value=="" || modMail.value=="" || modCode.value==0){
    swal({
  title: "Error!",
  text: "Fill each feild!",
  icon: "warning",
  buttons: true,
  dangerMode: true,
});
   }
   else if(modCode.value.length!=6){
    swal({
  title: "Error!",
  text: "Enter a 6-digit code!",
  icon: "warning",
  buttons: true,
  dangerMode: true,
});
   }
   else if(!validateEmail(modMail.value)) {
            swal({
        title: "Error!",
        text: "Enter a valid email address!",
        icon: "warning",
        buttons: true,
        dangerMode: true,
        });      
} 
<!-- add user code -->
   else{
var myRef = firebase.database().ref("Users").push();
  var key = myRef.key;
  codeList.push(modCode.value);
  var newData={
            userId:key,
            userName: modName.value,
            mail: modMail.value,
            role:"Blind User",
            code:codeList,
   }
   <!-- on success alert -->
   myRef.set(newData).then(() => {
    swal({
  title: "Added Successfully",
  text: "Your record was added!",
  icon: "success",
  button: "OK",
}).then((value) => {
            location.reload(true); <!-- <refresh page -->
            SelectAllData(); 
            $("#editmodal").modal('hide');
});
 <!-- error alert -->
}).catch((error) => {
    swal({
  title: "Error!",
  text: "Your Record was not added!",
  icon: "warning",
  buttons: true,
  dangerMode: true,
});
            });
   }
} <!-- ===  End Add new user function === -->

<!-- === Update user to firebase function === -->
function update(){

  <!-- validations -->
    if(modName.value=="" || modMail.value=="" || modCode.value==0){
    swal({
  title: "Error!",
  text: "Fill each feild!",
  icon: "warning",
  buttons: true,
  dangerMode: true,
});
   }
   else if(modCode.value.length!=6){
    swal({
  title: "Error!",
  text: "Enter a 6-digit code!",
  icon: "warning",
  buttons: true,
  dangerMode: true,
});
   }
   else if(!validateEmail(modMail.value)) {
            swal({
        title: "Error!",
        text: "Enter a valid email address!",
        icon: "warning",
        buttons: true,
        dangerMode: true,
        });      
} 

<!-- update user code -->
   else{
    codeList.push(modCode.value);
    firebase.database().ref('Users/' + id ).update(
        {
            userName: modName.value,
            mail:modMail.value,
            code:codeList
        },
    <!-- error alert -->
        (error) =>{
            if(error){
                swal({
        title: "Error!",
        text: "Your record was not updated!",
        icon: "warning",
        buttons: true,
        dangerMode: true,
        });    
            } 
       
    <!-- success alert -->
            else{
                swal({
                    title: "Updated Successfully",
                    text: "Your record was updated!",
                    icon: "success",
                    button: "OK",
                    }).then((value) => {
                                location.reload(true);
                                SelectAllData();
                                    $("#editmodal").modal('hide');
                    });
            }
        })
    }
} <!-- === End update user function === -->


<!-- === Delete user from firebase function === -->
function deluser(uid){

  <!-- confirmation alert -->
    swal({
  title: "Are you sure?",
  text: "Once deleted, you will not be able to recover this record!",
  icon: "warning",
  buttons: true,
  dangerMode: true,
}).then((willDelete) => {

  <!-- delete user code -->
  if (willDelete) {
      --uid;
    id = userlist[uid][0];
    firebase.database().ref('Users/' + id ).remove().then(
        function(){
            swal("Your record has been deleted!", {
            icon: "success",
        }).then((value)=>{
                location.reload(true);
            SelectAllData();
            });
        }
    )
   
  } else {
    swal("Your record is not deleted!");
  }
});
} <!-- === End delete user function === -->

<!-- email validation function -->
function validateEmail(email) {
        let res = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
        return res.test(email);
      }
      
@endpush
