<!-- ====== Volunteer Record Layout Extending Admin Panel Layout ====== -->

@extends('layout.admin')

<!-- Title name -->
@section('title')
NaviTalk - Volunteers Record
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

                        <li class="sidebar-item active">
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
     <h3>Volunteer Record</h3>
            </div>
            <br>

 <!-- button to add new user -->
 <button class="btn btn-primary btn-lg" data-bs-toggle="modal" data-bs-target="#editmodal" style="float:right;margin-bottom:10px;font-size:17px" onclick="fillText()"><i class="fa fa-plus" aria-hidden="true"></i>
        Add New Volunteer</button>

   <!-- table -->
<table class="table table-hover table-bordered table-striped" style="text-align:center">
<thead>
<tr>
<th>Volunteer Id</th>
<th>Volunteer Name</th>
<th>Volunteer Email</th>
<th>Blind User Code</th>
<th>Actions</th>
</tr>
</thead>

<tbody id='VolData'>

</tbody>

</table>
</div>
  <!-- Table End -->

<!-- Adir/Edit User Modal -->
<div class="modal fade" id="editmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="heading">Edit Volunteer</h5>
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

   <!-- Code list -->
    <div class="codeBlock">
      <div class="codeList">
      <div class="form-group">
<Label>Code</Label>
<input type="text" name="code" id="code" placeholder="Enter a 6-digit code" class="form-control" size="6">
</div> 

<div  id="Acode">
<div class="formHolder">

<!-- Hide/Show list button -->
          <div class="col">
            <button id="toggleBtn" type="button" class="btn btn-primary" >Hide List</button>
          </div>
        </div>
        <br>

        <!-- list holder -->
        <div class="listHolder">
          <h6 style="margin-left:20px">Assistance Code List</h6>
          <ul class="list" id="listcode">
     
          </ul>
        </div>
    
      </div>
    </div>
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

<!-- Show volunteer record from firebase -->

<!-- Fetch data function -->
function SelectAllData(){
    user=0;
    volnum=1;
    document.getElementById('VolData').innerHTML="";
    firebase.database().ref('Users').once('value',function(snapshot){
        snapshot.forEach(function(childSnapshot){
            var role = childSnapshot.val().role;
             
            if(role=="Volunteer"){
                var id = childSnapshot.key;
                var name = childSnapshot.val().userName;
                var mail = childSnapshot.val().mail;
                var code = childSnapshot.val().code;
                if(code==undefined){
                  code="undefined"
                }
             AddItemsToTable(id,name,mail,code);
            }
    });
            });
}

<!-- call function to fetch data on window load -->
window.onload=SelectAllData;

var userlist=[];
var user=0;
var volnum;
var codeList=[];

<!-- get code list holder -->
var listholder = document.getElementById('listcode');

<!-- Show fetched data in table -->
function AddItemsToTable(id,name,mail,code){
    var tbody = document.getElementById('VolData');
    var trow = document.createElement('tr');
    var td1 = document.createElement('td');
    var td2 = document.createElement('td');
    var td3 = document.createElement('td');
    var td4 = document.createElement('td');
    var td5 = document.createElement('td');
    userlist.push([id,name,mail,code]);

    td1.innerHTML="Vol"+volnum;
    td2.innerHTML=name;
   
    for(var i=0; i<code.length;i++){
      if(code[i]!="undefined"){
    td4.innerHTML+=code[i]+'<br>';
      }
    }

    td3.innerHTML=mail;
    td5.innerHTML=++user;
    trow.appendChild(td1);
    trow.appendChild(td2);
    trow.appendChild(td3);
    trow.appendChild(td4);

    volnum++;
    
    var ControlDiv = document.createElement("div");
    ControlDiv.innerHTML= '<button class="btn btn-success" type="button" data-bs-toggle="modal" data-bs-target="#editmodal" onclick="fillText('+user+')">Edit</button>'
    ControlDiv.innerHTML += '<button class="btn btn-danger" type="button"  style="margin:10px" onclick="deluser('+user+')">Delete</button>'
    
    tbody.appendChild(trow);
    trow.appendChild(ControlDiv);

} 

<!-- get data from modal text feilds -->
var modName = document.getElementById('name');
var modCode = document.getElementById('code');
var modMail = document.getElementById('mail');
var assistCode = document.getElementById('Acode');

<!-- modal button and heading -->
var edit = document.getElementById('editbtn');
var add = document.getElementById('addbtn');
var heading = document.getElementById('heading');

var id;

<!-- Fill modal text feilds  -->
function fillText(uid){
    if(uid==null){
        <!-- empty text feilds for add user modal -->
        modName.value="";
        modCode.value="";
        modMail.value="";
        edit.style.display='none';
        assistCode.style.display = 'none';
        add.style.display='inline-block';
        heading.innerHTML="Add Volunteer"
    }else{
       <!-- fill text feild with selected user data to edit -->   
    --uid;
    id = userlist[uid][0]
    firebase.database().ref('Users/' + id ).once("value", snap => {
        modName.value=snap.val().userName;
        modMail.value=snap.val().mail;
        listholder.innerHTML=" ";
        <!-- display assistance code list in modal -->
       for(var i=0;i<snap.val().code.length;i++){
        if(snap.val().code[i]!=undefined){
        codeList.push(snap.val().code[i]);
    listholder.innerHTML +='<li><span class="listName">'+snap.val().code[i]+'</span><a href="javascript:delItem(id,'+i+')" id="delItem" class=" remove" style="margin-left:70px"><i class="bi bi-trash"></i></a></li> ';    
  }
}

        add.style.display='none';
        assistCode.style.display = 'inline-block';
        heading.innerHTML="Edit Volunteer"
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
   else{
    <!-- check the assistance code entered of blind user -->
    checkcode();
   }
} <!-- ===  End Add new user function === -->

<!-- === check Update user details to firebase function === -->
function update(){
    <!-- validations -->
    if(modName.value=="" || modMail.value==""){
      swal({
  title: "Error!",
  text: "Fill each feild!",
  icon: "warning",
  buttons: true,
  dangerMode: true,
});
   }
   else if(modCode.value.length!=6 && modCode.value.length!=0){
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
   else {
    if(modCode.value.length!=0){
        var num = modCode.value;
    firebase.database().ref("Users").orderByChild("code/0").equalTo(num).once("value", function (snapshot) {
    if (snapshot.exists()) { 

    codeList.push(modCode.value); 
    updateUser(); 
  }else{
      swal({
        title: "Error!",
        text: "Entered code doesnot match any blind user!",
        icon: "warning",
        buttons: true,
        dangerMode: true,
        });   
  }
    });
}else{
    updateUser();
}
}} <!-- === End check update details function === -->

function updateUser(){
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
                  }}
    ); }
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

<!-- === Delete code from list function === -->
function delItem(volid,i){
   <!-- confirmation alert -->
  swal({
  title: "Are you sure?",
  text: "Once deleted, you will have to add the code again!",
  icon: "warning",
  buttons: true,
  dangerMode: true,
}).then((willDelete) => {
   <!-- Delete code -->
  if (willDelete) {
    firebase.database().ref('Users/' + volid+"/code/"+i ).remove().then(
        function(){
            swal("Code has been deleted!", {
            icon: "success",
        }).then((value)=>{
                location.reload(true);
            SelectAllData();
            });
        }
    )} else {
    swal("Code not deleted!");
  }
});
} <!-- === End delete code from list function === -->

<!-- === Check the assistance code entered of blind user function === -->
function checkcode(){
    var num = modCode.value;
 firebase.database().ref("Users").orderByChild("code/0").equalTo(num).once("value", function (snapshot) {
if (snapshot.exists()) { 
  var myRef = firebase.database().ref("Users").push();
  var key = myRef.key;
  codeList.push(modCode.value);

  var newData={
            userId:key,
            userName: modName.value,
            mail: modMail.value,
            role:"Volunteer",
            code:codeList,
   }

   <!-- on success add volunteer -->
   myRef.set(newData).then(() => {
    swal({
  title: "Added Successfully",
  text: "Your record was added!",
  icon: "success",
  button: "OK",
}).then((value) => {
            location.reload(true);
            SelectAllData();
                $("#editmodal").modal('hide');
});
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
  else{
    swal({
        title: "Error!",
        text: "Entered code doesnot match any blind user!",
        icon: "warning",
        buttons: true,
        dangerMode: true,
        });   
  }
    });
} <!-- === End check assistance code function === -->

<!-- email validation function -->
function validateEmail(email) {
        let res = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
        return res.test(email);
      }
      
@endpush