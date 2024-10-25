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
                    
                    <img src="src/img/Polnes.png" alt="">
                    
                    
                </div>
                <div class="col-md-6 right">
                    
                <div class="input-box">
    <header>Register Dulu Le</header>
    <div class="input-field">
        <form action="../proses_mhs/register.php" method="POST">
            <input type="text" class="input" id="username" name="username" required="" autocomplete="off">
            <label for="username">Username</label> 
        </div> 
        <div class="input-field">
            <input type="password" class="input" id="password" name="password" required="">
            <label for="password">Password</label>
        </div> 
        <div class="input-field">
            <input type="submit" class="submit" value="Register Le">
        </div> 
    </form>
    <div class="signin">
        <span>Sudah Punya Akun Le? <a href="login.php">Log in Dulu Sini Le</a></span>
    </div>
</div>

                </div>
            </div>
        </div>
    </div>
</body>


<script src="js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</html>