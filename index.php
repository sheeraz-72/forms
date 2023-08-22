<?php 
$emailerror = "";
$passerror = "";
$img = "";
$success = "";



if(isset($_POST['submit']))
{
  $email = $_POST['email'];
  $pass = $_POST['pass'];

 
  if(empty($email))
  {
    $emailerror = "please Enter Your Email...";
  }
  elseif(empty($pass))
  {
    $passerror = "please Enter Your Password...";

  }
  elseif($_FILES['file']['error'] != 0)
  {
    $img = "Select Image";
  }
  else
  {
    $image_name = $_FILES['file']['name'];
    $tmp_name = $_FILES['file']['tmp_name'];
    $end      = explode('.',$image_name);
    $ext  = strtolower(end($end));
    $allowed_ext = ["jpg","jpeg","png"];
    if(in_array($ext,$allowed_ext))
    {
      $new_name =  rand('10000','9999999999').'pragrammer'.microtime(). $image_name;
      $upload_folder = "./images/". $new_name;

      if(move_uploaded_file($tmp_name,$upload_folder))
      {
        $success = "submitted";
      }
    }
    else
    {
      echo "invalid image";
    }
  }
}
?>




<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
  </head>
  <body>

   <div class="row col-6 m-auto border border-secondary p-3">
        <form id="frm" action="<?php echo $_SERVER['PHP_SELF']?>" method="post" enctype="multipart/form-data">
            <legend>Registration Form</legend>
            <div class="mb-3">
                <p class="text-danger"><?php echo $emailerror?></p>
              <label for="exampleInputEmail1" class="form-label">Email address</label>
              <input type="text" class="form-control" name="email"  aria-describedby="emailHelp">
              <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
            </div>

            <div class="mb-3">
                <p  class="text-danger"><?php echo $passerror ?></p>
              <label for="exampleInputPassword1" class="form-label">Password</label>
              <input type="password" class="form-control" name="pass">
            </div>
            <div class="mb-3">
                <p  class="text-danger"><?php echo $img ?></p>
              <label for="exampleInputPassword1" class="form-label">Select Image</label>
              <input type="file"  class="form-control" name="file">
            </div>
            <p id="succes" class="text-info"><?php echo $success ?></p>

            <button type="submit" name="submit" class="btn btn-primary">Submit</button>
          </form>
    </div>

    <h1><?php echo $email ?></h1>
    <h1><?php echo $pass ?></h1>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
  </body>
</html>