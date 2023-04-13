<?php
// Turn off error reporting to avoid exposing sensitive information to users
error_reporting(0);

// Retrieve the total amount from the cookie, casting it to an integer to prevent SQL injection
$Total = (int)$_COOKIE["Total"];

// Require the database connection script
require "myconnect.php";

// If the "Checkout" button has been clicked
if (isset($_POST["check"])) {

  // Initialize an empty array to store validation errors
  $errors = [];

  // Retrieve the name, serial number, and pin code from the form data
  $name = $_POST["name"];
  $sery = $_POST["pswd"];
  $pincode = $_POST["code"];

  // Query the database to check if the user exists
  $q = "SELECT Name FROM user_pay WHERE Name='$name';";
  $result = $conn->query($q);
  $row = mysqli_num_rows($result);

  // If the user doesn't exist, add an error message to the $errors array
  if (!$row) {
    $errors["name"] = "User does not exist";
  }

  // If the user exists, query the database to check if the serial number is correct
  if (!$errors["name"]) {
    $q = "SELECT sery FROM user_pay WHERE Name='$name';";
    $result = $conn->query($q);
    $row = mysqli_fetch_assoc($result);

    // If the serial number is incorrect, add an error message to the $errors array
    if ($row["sery"] != $sery) {
      $errors["sery"] = "Wrong serial number";
    }
  }

  // If the user exists and the serial number is correct, query the database to check if the pin code is correct
  if (!$errors["name"] && !$errors["sery"]) {
    $q = "SELECT pincode FROM user_pay WHERE Name='$name';";
    $result = $conn->query($q);
    $row = mysqli_fetch_assoc($result);

    // If the pin code is incorrect, add an error message to the $errors array
    if ($row["pincode"] != $pincode) {
      $errors["pincode"] = "Wrong pin code";
    }
  }

  // If there are no errors so far, query the database to check if the user has enough money
  if (!$errors) {
    $q = "SELECT sodu FROM user_pay WHERE Name='$name';";
    $result = $conn->query($q);
    $row = mysqli_fetch_assoc($result);
    $sodu = (int)$row["sodu"];
    $Total = (int)$Total;

    // If the user doesn't have enough money, add an error message to the $errors array
    if ($sodu < $Total) {
      $errors["sodu"] = "You don't have enough money";
    } else {
      // If the user has enough money, update the database and redirect to the index page with a success message
      $q = "UPDATE user_pay SET sodu=sodu-$Total WHERE Name='$name';";
      $result = $conn->query($q);
      echo "<script>alert('Thank you for your payment'); window.location='index.php?pay=1';</script>";
      exit;
    }
  }
}
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
        <input type="name" class="form-control" id="name" placeholder="name" name="name" value="<?php echo $_POST["name"] ?>" required>
        <small style="color:red;">
          <?php if (isset($_POST["check"])) :
            echo $errors['name'];
          endif;
          ?>
        </small>
      </div>
      <div class="mb-3">
        <label for="pwd">Serial Number:</label>
        <input type="password" class="form-control" id="pwd" placeholder="Serial Number" name="pswd" value="<?php echo $_POST["pswd"] ?>" required>
        <small style="color:red;">
          <?php if (isset($_POST["check"])) :
            echo $errors['sery'];
          endif;
          ?>
        </small>
      </div>
      <div class="mb-3">
        <label for="pwd">Pin Code:</label>
        <input type="password" class="form-control" id="pwd" placeholder="Pin Code" name="code" value="<?php echo $_POST["code"] ?>" required>
        <small style="color:red;">
          <?php if (isset($_POST["check"])) :
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
      <p class="text-title">Total: <?php echo "$ " . number_format($Total, 2); ?></p>
      <?php if (isset($_POST['check']) and $errors["sodu"]) : ?>
        <p style="color:red;">
          <?php echo $errors["sodu"] ?>
        </p>
        <a href="index.php">minus</a>
      <?php endif; ?>
      <button type="submit" class="btn btn-primary" name="check">Checkout</button>
    </form>
    <style>
      input {
        width: 100px;
      }
    </style>
  </div>
</body>

</html>