<?php
ini_set('display_errors', 'Off');
$Total =(int)$_COOKIE["Total"];
require "myconnect.php";

if(isset($_POST["check"])):
  $errors =[];
  $name=$_POST["name"];
  $sery=$_POST["pswd"];
  $pincode=$_POST["code"];
  $q = "select Name from user_pay where Name='$name';";
  $result =$conn->query($q);
  $row = mysqli_num_rows($result);
  if(!$row):
      $errors["name"]="user doesn't esits";
  endif;
  if(!$errors["name"]):
    $q = "select sery from user_pay where Name='$name';";
    $result =$conn->query($q);
    $row = mysqli_fetch_assoc($result);
    if($row["sery"]!=$sery):
      $errors["sery"]="Wrong Serial Number";
    endif;
  endif;
  if(!$errors["name"]):
      $q = "select pincode from user_pay where Name='$name';";
      $result =$conn->query($q);
      $row = mysqli_fetch_assoc($result);
      if($row["pincode"]!==$pincode):
        $errors["pincode"]="Wrong pincode";
      endif;
  endif;
  if(!$errors):
    $q = "select sodu from user_pay where Name='A quang';";
    $result =$conn->query($q);
    $row = mysqli_fetch_assoc($result);
    $sodu =(int)$row["sodu"];
    $Total=(int)$Total;
    if($sodu<$Total):
      $errors["sodu"]="You haven't enough Money";
    else:
      echo "<script> alert('Thank you for your paid'); window.location='index.php?pay=1';</script>";
    endif;

  endif;
endif;
?>





<!DOCTYPE html>
<html lang="en">
<head>
  <title>Checkout</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>

<div class="container mt-3">
  <h2>Checkout</h2>
   <form action="" method="post" class="col-md-4">
    <div class="mb-3 mt-3">
      <label for="email">Name:</label>
      <input type="name" class="form-control" id="name" placeholder="name" name="name" value="<?php echo $_POST["name"]?>" required>
      <small style="color:red;">
        <?php if(isset($_POST["check"])):
                echo $errors['name'];  
              endif;   
        ?>
      </small>
    </div>
    <div class="mb-3">
      <label for="pwd">Serial Number:</label>
      <input type="password" class="form-control" id="pwd" placeholder="Serial Number" name="pswd" value="<?php echo $_POST["pswd"]?>"  required>
      <small style="color:red;">
        <?php if(isset($_POST["check"])):
                echo $errors['sery'];  
              endif;   
        ?>
      </small>
    </div>
	<div class="mb-3">
      <label for="pwd">Pin Code:</label>
      <input type="password" class="form-control" id="pwd" placeholder="Pin Code" name="code" value="<?php echo $_POST["code"]?>"  required>
      <small style="color:red;">
        <?php if(isset($_POST["check"])):
                echo $errors['pincode'];  
              endif;   
        ?>
      </small>
    </div>
    <div class="form-check mb-3">
      <label class="form-check-label">
        <input class="form-check-input" type="checkbox" name="remember"> Remember me
      </label>
    </div>
    <p class="text-title">Total: <?php  echo "$ " . number_format($Total, 2); ?></p>
    <?php if(isset($_POST['check']) and $errors["sodu"]):?>
    <p style="color:red;">
    <?php echo $errors["sodu"] ?>
    </p>
    <a href="index.php">minus</a>
    <?php endif;?>
    <button type="submit" class="btn btn-primary" name="check">Checkout</button>
  </form>
  <style>
	input{
		width: 100px;
	}
  </style>
</div>
</body>
</html>