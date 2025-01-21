<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>

{{-- <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script> --}}
<style>
    .container{
        display: flex;
        justify-content: center;
        align-items: center;
        padding-top: 50px;
        padding-bottom: 50px;
    }
    .error{
        color:red;
    }
</style>
</head>

<body>
    <div id="alertDiv">

    </div>  

    <div class="container">
        <section class="vh-100" style="background-color: #eee;">
            <div class="container h-100">
              <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-lg-12 col-xl-11">
                  <div class="card text-black" style="border-radius: 25px;">
                    <div class="card-body p-md-5">
                      <div class="row justify-content-center">
                        <div class="col-md-10 col-lg-6 col-xl-5 order-2 order-lg-1">
          
                          <p class="text-center h1 fw-bold mb-5 mx-1 mx-md-4 mt-4">Sign up</p>
          
                          <form id="register-form" class="mx-1 mx-md-4" >
                            @csrf
                            <div class="d-flex flex-row align-items-center mb-4">
                              <i class="fas fa-user fa-lg me-3 fa-fw"></i>
                              <div data-mdb-input-init class="form-outline flex-fill mb-0">
                                  <label class="form-label" for="name">Name</label>
                                <input type="text" id="name" name="name" class="form-control" required />
                              </div>
                            </div>
          
                            <div class="d-flex flex-row align-items-center mb-4">
                              <i class="fas fa-envelope fa-lg me-3 fa-fw"></i>
                              <div data-mdb-input-init class="form-outline flex-fill mb-0">
                                  <label class="form-label" for="email">Email</label>
                                <input type="email" id="email" name="email" class="form-control" required />
                              </div>
                            </div>
          
                            <div class="d-flex flex-row align-items-center mb-4">
                              <i class="fas fa-lock fa-lg me-3 fa-fw"></i>
                              <div data-mdb-input-init class="form-outline flex-fill mb-0">
                                  <label class="form-label" for="password">Password</label>
                                <input type="password" name="password" id="password" class="form-control" required />
                              </div>
                            </div>
          
                            <div class="d-flex flex-row align-items-center mb-4">
                              <i class="fas fa-key fa-lg me-3 fa-fw"></i>
                              <div data-mdb-input-init class="form-outline flex-fill mb-0">
                                  <label class="form-label" for="rpassword">Repeat your password</label>
                                <input type="password" id="rpassword" name="rpassword" class="form-control" required />
                              </div>
                            </div>
          
                      
          
                            <div class="d-flex justify-content-center mx-4 mb-3 mb-lg-4">
                              <button id="submitUser" type="submit" class="btn btn-primary btn-lg">Register</button>
                            </div>
          
                          </form>
          
                        </div>
                        <div class="col-md-10 col-lg-6 col-xl-7 d-flex align-items-center order-1 order-lg-2">
          
                          <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-registration/draw1.webp"
                            class="img-fluid" alt="Sample image">
          
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </section>
    </div>
    {{-- <div class="alert alert-warning alert-dismissible fade show" role="alert">
        <strong>Holy guacamole!</strong> You should check in on some of those fields below.
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div> --}}
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.20.0/dist/jquery.validate.min.js"></script>
<script src="https://malsup.github.io/jquery.form.js"></script>

<script>
 
 var rules = {
    name: {
        required: true,
    },
    email: {
        required: true,
        email: true
    },
    password: {
        required: true
    },
    rpassword: {
        required: true,
        equalTo: "#password"
    }
};

var msg = {
    name: {
        required: "Enter your name",
    },
    email: {
        required: "Enter your email",
        email: "Enter a valid email"
    },
    password: {
        required: "Enter your password"
    },
    rpassword: {
        required: "Re-enter your password",
        equalTo: "Passwords do not match"
    }
};

$("#register-form").validate({
     rules:rules,
     messages:msg,
     errorPlacement: function(error, element) {
         error.insertAfter(element);
     },
     submitHandler:function(form){
        // form.preventDefault();
         $("#register-form").ajaxSubmit({
             url:"{{url('register/create')}}",
             type:"POST",
             dataType:"json",
             clearForm:false,
             cache:false,
             success:function(res){
                //  alert(res.message);
                customAlert('success',res.message);
                //  console.log(res);
                $("#alertDiv").fadeOut(5000);
             },
             error:function(res){
                 console.log(res);
             }
         });
     }

 
});

function customAlert(type,msg){

    var data = `<div class="alert alert-`+type+`  alert-dismissible fade show" role="alert">
    <strong>`+msg+`</strong>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
    </div>`;

    $("#alertDiv").html(data);
}


</script>