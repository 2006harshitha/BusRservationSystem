<?php

$host = "localhost";  // your DB host

$user = "root";       // your DB username

$pass = "";           // your DB password

$dbname = "bus"; // your DB name
$conn = new mysqli($host, $user, $pass, $dbname);



// Check connection

if ($conn->connect_error) {

  die("Connection failed: " . $conn->connect_error);

}



// Get form data

$name = $_POST['name'];

$email = $_POST['email'];

$phone = $_POST['phone'];

$password = $_POST['password'];

$gender = $_POST['gender'];

$age = $_POST['age'];



// SQL insert

$sql = "INSERT INTO users (name, email, phone, password, gender, age) 

        VALUES ('$name', '$email', '$phone', '$password', '$gender', $age)";



if ($conn->query($sql) === TRUE) {

  echo "

    <html>

    <head>

      <title>Signup Success</title>

      <meta http-equiv='refresh' content='5;url=page.php' />

      <style>

        body {

          display: flex;

          justify-content: center;

          align-items: center;

          height: 100vh;

          font-family: sans-serif;

          background-color: #f0f8ff;

        }

        .success {

          text-align: center;

          background: #d4edda;

          color: #155724;

          padding: 30px;

          border: 1px solid #c3e6cb;

          border-radius: 12px;

          box-shadow: 0 4px 8px rgba(0,0,0,0.1);

        }

      </style>

    </head>

    <body>

      <div class='success'>

        <h2>Signup Successful!</h2>

        <p>This window will close automatically in 4 seconds...</p>

      </div>

      <script>

        setTimeout(() => window.close(), 4000);

      </script>

    </body>

    </html>

  ";

} else {

  echo "Error: " . $sql . "<br>" . $conn->error;

}



$conn->close();

?>