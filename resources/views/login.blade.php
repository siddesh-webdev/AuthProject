<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login Page</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
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
          
                          <p class="text-center h1 fw-bold mb-5 mx-1 mx-md-4 mt-4">Login</p>
          
                            <form id="login-form" class="mx-1 mx-md-4">
          
                            @csrf
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
                                <input type="password" id="password" name="password" class="form-control" />
                              </div>
                            </div>
                 
                            <div class="d-flex justify-content-center mx-4 mb-3 mb-lg-4">
                              <button id="loginsubmit"  type="submit" data-mdb-button-init data-mdb-ripple-init class="btn btn-primary btn-lg">Login</button>
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
  </body>
</html>
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.20.0/dist/jquery.validate.min.js"></script>
    <script src="https://malsup.github.io/jquery.form.js"></script>
    <script>
      // alert("hi");
        var vrule ={
          email:{ required :true,email :true },
          password:{required:true}
        }
      
        var msg = {
          email:{required:"Enter the email",email:"Enter valid email"},
          password:{required:"Enter the password"}
        }
      
        $("#login-form").validate({
            rules:vrule,
            messages:msg,
            errorPlacement: function(error, element) {
              error.insertAfter(element);
            },
            submitHandler:function(form){
              event.preventDefault();
              $("#login-form").ajaxSubmit({
                  url:"{{url('login/checkUser')}}",
                  type:"POST",
                  dataType:"json",
                  clearForm:false,
                  cache:false,
                  success:function(res){
                      if(res.success){
                        // customAlert('success',res.message);
                        window.location.href = res.redirectUrl;   
                      }else{ 
                        customAlert('warning',res.message);
                      }
                      $("#alertDiv").fadeOut(5000);
                  },
                  error:function(res){
                      console.log(res);
                  }
              });
              }
        });


      function customAlert(type,msg){
          $("#alertDiv").html('');
          var htmldata ='';
          if(type == 'success'){
            htmldata += `<a href="{{url('login')}}">Login here</a>`; 
          }
          // console.log(typeof(type));
          var data = `<div class="alert alert-`+type+`  alert-dismissible fade show" role="alert">
            <strong>`+msg+` `+htmldata+`</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
          </div>`;

          $("#alertDiv").html(data);
        }
  </script>
