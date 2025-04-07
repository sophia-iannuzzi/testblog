<?php
include("connectionvar.php");
include("queries.php");
if (isset($_POST['registerbutton'])) {
    $fname = mysqli_real_escape_string($conn,$_POST['fname']);
    $lname = mysqli_real_escape_string($conn,$_POST['lname']);
    $username = mysqli_real_escape_string($conn,$_POST['username']);
    $pwd = mysqli_real_escape_string($conn, $_POST['pwd']);
    $hashpwd = password_hash($pwd, PASSWORD_DEFAULT);
    if (!empty($hashpwd) and !empty($fname)) {
        if($username==$pwd) {
            $msg = "Username and password cannot be the same";
        } else {
            while ($row = mysqli_fetch_array($userlist)) {
                if ($username == $row['username']) {
                   $msg ='username taken';
                    break;
                }
            }
            if (!isset($msg)) {
                $query = "INSERT INTO `user` (`statususer`, `fname`, `lname`, `username`, `hash`,`level_id`) value ('1', '$fname', '$lname', '$username', '$hashpwd', '1')";
                mysqli_query($conn, $query);
                $monthid = date('n');
                $year = date('Y');
                $msg = $monthid;
                $query = "SELECT * FROM `registerchart`";
                $result = mysqli_query($conn, $query);
                while($rows = mysqli_fetch_array($result)) {
                    if($monthid==$rows['month_id'] and $year==$rows['year']) {
                        $query = "UPDATE registerchart SET registercount = registercount + 1 WHERE month_id='$monthid' AND year='$year'";
                        mysqli_query($conn, $query);
                        $msg = "register";
                        break;
                    }
                }
                if (!isset($msg)) {
                    $query = "INSERT INTO `registerchart` (`month_id`, `year`, `registercount`) VALUE ('$monthid', '$year', '1')";
                    mysqli_query($conn, $query);
                }
                $msg = 'registered';
            }
        }
    } else {
        $msg = 'please fill in all fields';
    }
}
if (isset($_POST['loginpage'])) {
    header("Location:bloglogin.php");
    exit();
}
?> 

<!doctype html>
<html lang="en" data-bs-theme="auto">
  <head>
    <script src="assets/js/color-modes.js"></script>
    <link href="assets/dist/css/bootstrap.min.css" rel="stylesheet">

<meta name="theme-color" content="#712cf9">
    <style>
        .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
        }

        @media (min-width: 768px) {
        .bd-placeholder-img-lg {
            font-size: 3.5rem;
        }
        }

        .b-example-divider {
        width: 100%;
        height: 3rem;
        background-color: rgba(0, 0, 0, .1);
        border: solid rgba(0, 0, 0, .15);
        border-width: 1px 0;
        box-shadow: inset 0 .5em 1.5em rgba(0, 0, 0, .1), inset 0 .125em .5em rgba(0, 0, 0, .15);
        }

        .b-example-vr {
        flex-shrink: 0;
        width: 1.5rem;
        height: 100vh;
        }

        .bi {
        vertical-align: -.125em;
        fill: currentColor;
        }

        .nav-scroller {
        position: relative;
        z-index: 2;
        height: 2.75rem;
        overflow-y: hidden;
        }

        .nav-scroller .nav {
        display: flex;
        flex-wrap: nowrap;
        padding-bottom: 1rem;
        margin-top: -1px;
        overflow-x: auto;
        text-align: center;
        white-space: nowrap;
        -webkit-overflow-scrolling: touch;
        }

        .btn-bd-primary {
        --bd-violet-bg: #712cf9;
        --bd-violet-rgb: 112.520718, 44.062154, 249.437846;

        --bs-btn-font-weight: 600;
        --bs-btn-color: var(--bs-white);
        --bs-btn-bg: var(--bd-violet-bg);
        --bs-btn-border-color: var(--bd-violet-bg);
        --bs-btn-hover-color: var(--bs-white);
        --bs-btn-hover-bg: #6528e0;
        --bs-btn-hover-border-color: #6528e0;
        --bs-btn-focus-shadow-rgb: var(--bd-violet-rgb);
        --bs-btn-active-color: var(--bs-btn-hover-color);
        --bs-btn-active-bg: #5a23c8;
        --bs-btn-active-border-color: #5a23c8;
        }

        .bd-mode-toggle {
        z-index: 1500;
        }

        .bd-mode-toggle .bi {
        width: 1em;
        height: 1em;
        }

        .bd-mode-toggle .dropdown-menu .active .bi {
        display: block !important;
        }
    </style>
    <link href="sign-in.css" rel="stylesheet">
</head>

<div class = 'row'>
    <div class="col-xl-2 mx-auto" style="width: 100px"></div>
        <div class="col-xl-8 mx-5 my-5" style="width: 300px">
            <main class="form-signin w-100 m-auto">
                    <h1 class="h4 mb-4 fw-normal">Register to <em>Farming Love!</em></h1>
                    <p> 
                    <?php 
                    if(!empty($msg)) {
                        echo "$msg";
                    } 
                    ?> </p>

                    <form method = 'POST' action = "<?php echo $_SERVER['PHP_SELF'];?>">

                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="floatingInput" placeholder="Firt name" name = 'fname'>
                            <label for="floatingInput">First Name</label>
                        </div>

                        
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="floatingInput" placeholder="Last Name" name = 'lname'>
                            <label for="floatingInput">Last Name</label>
                        </div>

                        
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="floatingInput" placeholder="Username" name = 'username'>
                            <label for="floatingInput">Username</label>
                        </div>

                        <div class="form-floating mb-3">
                        <input type="password" class="form-control" id="floatingPassword" placeholder="Password" name = 'pwd'>
                        <label for="floatingPassword">Password</label>
                        </div>

                        <button class="btn btn-primary w-100 py-2" type="submit" name = 'registerbutton'>Register</button>


                        <a href="bloglogin.php">Login Instead</a>
                        |
                        <a href="index.php">Visit as Guest</a>

                </form>
            </main>
        </div>
    <div class="col-xl-2 mx-auto" style="width: 100px"></div>
</div> 


<script defer src="assets/dist/js/bootstrap.bundle.min.js" integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq"></script>

    </body>
</html>
