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
  <form action="">
    <div class="mb-3 mt-3">
      <label for="email">Name:</label>
      <input type="name" class="form-control" id="name" placeholder="name" name="name">
    </div>
    <div class="mb-3">
      <label for="pwd">Serial Number:</label>
      <input type="password" class="form-control" id="pwd" placeholder="Serial Number" name="pswd">
    </div>
	<div class="mb-3">
      <label for="pwd">Pin Code:</label>
      <input type="password" class="form-control" id="pwd" placeholder="Pin Code" name="pswd">
    </div>
    <div class="form-check mb-3">
      <label class="form-check-label">
        <input class="form-check-input" type="checkbox" name="remember"> Remember me
      </label>
    </div>
    <button type="submit" class="btn btn-primary">Checkout</button>
  </form>
  <style>
	input{
		width: 100px;
	}
  </style>
</div>
</body>
</html>