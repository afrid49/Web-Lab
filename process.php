<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Registration information</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background:rgb(255, 255, 255);
      padding: 20px;
    }
    .receipt {
      background: #fff;
      border: 1px solid #ccc;
      padding: 30px;
      max-width: 500px;
      margin: 0 auto;
      box-shadow: 0 0 10px rgb(37, 16, 119);
    }
    .receipt h2 {
      text-align: center;
      margin-bottom: 20px;
      color:rgb(47, 0, 255);
    }
    .receipt p {
      font-size: 16px;
      margin: 8px 0;
    }
    .label {
      font-weight: bold;
    }
    button {
      margin-top: 20px;
      padding: 10px 20px;
      background: #28a745;
      color: white;
      border: none;
      border-radius: 5px;
      cursor: pointer;
      display: block;
      margin-left: auto;
      margin-right: auto;
    }
  </style>
</head>
<body>
<div class="receipt">
  <h2>Registration information</h2>
  <p><span class="label">Name:</span> <?php echo htmlspecialchars($_POST['name']); ?></p>
  <p><span class="label">Email:</span> <?php echo htmlspecialchars($_POST['email']); ?></p>
  <p><span class="label">Gender:</span> <?php echo htmlspecialchars($_POST['gender']); ?></p>
  <p><span class="label">Country:</span> <?php echo htmlspecialchars($_POST['country']); ?></p>
  <p><span class="label">Date of Birth:</span> <?php echo htmlspecialchars($_POST['dob']); ?></p>
</div>
<div><button type="submit">Confirm</button></div>
</body>
</html>
