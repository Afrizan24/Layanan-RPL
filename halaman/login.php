<?php
session_start();

// Check if the user is already logged in
if (isset($_SESSION['username'])) {
    header("Location: ../beranda.php"); // Redirect to a different page
    exit();
}
if (isset($_SESSION['error'])) {
    echo "<script>alert('" . $_SESSION['error'] . "');</script>";
    unset($_SESSION['error']); // Clear the error message after displaying
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Ngeluh Mulu Pantek</title>
    <link rel="stylesheet" href="../css/bootstrap-grid.min.css">
    <link rel="stylesheet" href="../src/style.css">
</head>

<body>
    <div class="wrapper">
        <div class="container main">
            <div class="row">
                <div class="col-md-6 side-image">           
                    <!-------------      image     -------------> 
                    <img src="../src/img/Polnes.png" alt="">        
                </div>
                <div class="col-md-6 right">           
                    <div class="input-box">   
                       <header>LoginKan Dulu Le</header>
                       <form action="../proses_mhs/login_user.php" method="POST">
                           <div class="input-field">
                                <input type="text" class="input" id="email" name="username" required="" autocomplete="off">
                                <label for="email">Username</label> 
                            </div> 
                           <div class="input-field">
                                <input type="password" class="input" id="pass" name="password" required="">
                                <label for="pass">Password</label>
                            </div> 
                           <div class="input-field">
                                <input type="submit" class="submit" value="Login Le">
                           </div> 
                       </form>
                       <div class="signin">
                        <span>Belom Punya Akun Le? <a href="register.html">Register in Dulu Sini Le</a></span>
                       </div>
                    </div>  
                </div>
            </div>
        </div>
    </div>
</body>

<script src="../js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</html>
