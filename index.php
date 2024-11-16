<?php
include "connection.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>sL Code Hub | Store | Login</title>
    <!-- style.css -->
    <link rel="stylesheet" href="style.css">
    <!-- bootstrap.css -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>

    <div class="container d-flex justify-content-center align-items-center min-vh-100">
        <div class="row border rounded-5 p-3 shadow box-area">

            <!-- left -->
            <dir class="col-md-6 rounded-4 d-flex justify-content-center align-items-center flex-column left-box " style="backdrop-filter: blur(20px);">
                <div class="featured-image mb-3">
                    <img src="img/b-img.png" class="img-fluid" style="width: 450px;">
                </div>

                <p class="text-black fs-2" style="font-family:'Courier New', Courier, monospace;
                font-weight:600;">sL Code <span style="color: red;">Hub</span>|store</p>

                <small class="text-black text-wrap text-center" style="width: 17rem; font-family:'Courier New', Courier, monospace;">
                    Join experienced Designers on this platform.</small>
            </dir>

            <!-- right -->

            <!-- signup box  -->
            <div class="col-md-6 right-box " id="signUp">
                <div class="row align-items-center">
                    <div class="header-text mb-4">
                        <a href="#" class="d-flex justify-content-center mb-4">
                            <img src="img/slcodehub.png" width="200">
                        </a>
                        <div class="text-center m5-5">
                            <h3 class="fw-bold">Create New Account</h3>
                            <p class="text-secondary">Get access to account</p>
                        </div>
                        <div class="col-12 d-none" id="msgDiv">
                            <div class="alert alert-danger" role="alert" id="msg"></div>
                        </div>
                        <div class="input-group mb-2">
                            <span class="input-group-text">
                                <ion-icon name="person-outline"></ion-icon>
                            </span>
                            <input type="text" class="form-control form-control-lg fs-6" placeholder="First Name" id="fname">
                        </div>
                        <div class="input-group mb-2">
                            <span class="input-group-text">
                                <ion-icon name="person-outline"></ion-icon>
                            </span>
                            <input type="text" class="form-control form-control-lg fs-6" placeholder="Last Name" id="lname">
                        </div>
                        <div class="input-group mb-2">
                            <span class="input-group-text">
                                <ion-icon name="call-outline"></ion-icon>
                            </span>
                            <input type="text" class="form-control form-control-lg fs-6" placeholder="Mobile" id="mobile">
                        </div>
                        <div class="input-group mb-2">
                            <span class="input-group-text">
                                <ion-icon name="mail-outline"></ion-icon>
                            </span>
                            <input type="email" class="form-control form-control-lg fs-6" placeholder="Email" id="email">
                        </div>
                        <div class="input-group mb-2">
                            <span class="input-group-text">
                                <ion-icon name="lock-closed-outline"></ion-icon>
                            </span>
                            <input type="password" class="form-control form-control-lg fs-6" placeholder="Password" id="password">
                        </div>
                        <div class="input-group mb-4">
                            <span class="input-group-text">
                                <ion-icon name="male-female-outline"></ion-icon>
                            </span>
                            <select class="form-control" id="gender">
                                <?php

                                $rs = Database::search("SELECT * FROM `gender`");
                                $num = $rs->num_rows;

                                for ($x = 0; $x < $num; $x++) {
                                    $data = $rs->fetch_assoc();
                                ?>

                                    <option value="<?php echo $data["id"]; ?>">
                                        <?php echo $data["gender"]; ?>
                                    </option>

                                <?php
                                }

                                ?>
                            </select>
                        </div>
                        <div class="input-group mb-3">
                            <button class="btn btn-lg btn-primary w-100 fs-6" onclick="signUp();">Sign Up</button>
                        </div>
                        <div class="row">
                            <small>I have account <a href="#" onclick="changeView();">Login</a></small>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Login Box -->
            <div class="col-md-6 right-box d-none" id="signIn">
                <div class="row align-items-center">
                    <div class="header-text mb-4">
                        <a href="#" class="d-flex justify-content-center mb-4">
                            <img src="img/slcodehub.png" width="200">
                        </a>
                        <div class="text-center mb-5">
                            <h3 class="fw-bold">Log In</h3>
                            <p class="text-secondary">We are happy to have you back.</p>
                        </div>
                        <div class="col-12 d-none" id="msgDiv2">
                            <div class="alert alert-danger" role="alert" id="msg2"></div>
                        </div>

                        <?php
                        $email = "";
                        $password = "";
                        if (isset($_COOKIE["email"])) {
                            $email = $_COOKIE["email"];
                        }
                        if (isset($_COOKIE["password"])) {
                            $password = $_COOKIE["password"];
                        }
                        ?>

                        <div class="input-group mb-2">
                            <span class="input-group-text">
                                <ion-icon name="mail-outline"></ion-icon>
                            </span>
                            <input type="email" class="form-control form-control-lg fs-6" placeholder="Email" id="email2" value="<?php echo $email; ?>" />
                        </div>
                        <div class="input-group mb-2">
                            <span class="input-group-text">
                                <ion-icon name="lock-closed-outline"></ion-icon>
                            </span>
                            <input type="password" class="form-control form-control-lg fs-6" placeholder="Password" id="password2" value="<?php echo $password; ?>" />
                        </div>

                        <div class="input-group mb-5 d-flex justify-content-between">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="rememberMe" />
                                <label class="form-check-label">Remember Me</label>
                            </div>
                            <div class="forgot">
                                <small><a href="#" onclick="forgotPassword();">Forgot Password?</a></small>
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <button class="btn btn-lg btn-primary w-100 fs-6" onclick="signIn();">Log In</button>
                        </div>
                        <div class="row">
                            <small>Don't have account? <a href="#" onclick="changeView();">Sign Up</a></small>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Forgot Password -->
            <div class="col-md-6 right-box d-none" id="FPassword">
                <div class="row align-items-center">
                    <div class="header-text mb-4">
                        <a href="#" class="d-flex justify-content-center mb-4">
                            <img src="img/slcodehub.png" width="200">
                        </a>
                        <div class="text-center mb-5">
                            <h3 class="fw-bold">Forgot Password</h3>
                        </div>
                        <div class="col-12 d-none" id="msgDiv3">
                            <div class="alert alert-danger" role="alert" id="msg3"></div>
                        </div>
                        <div class="input-group mb-2">
                            <span class="input-group-text">
                                <ion-icon name="lock-closed-outline"></ion-icon>
                            </span>
                            <input type="password" class="form-control form-control-lg fs-6" placeholder="New Password" id="np">
                        </div>
                        <div class="input-group mb-2">
                            <span class="input-group-text">
                                <ion-icon name="lock-closed-outline"></ion-icon>
                            </span>
                            <input type="password" class="form-control form-control-lg fs-6" placeholder="Re-type Password" id="rnp">
                        </div>
                        <div class="input-group mb-4">
                            <span class="input-group-text">
                                <ion-icon name="chatbox-ellipses-outline"></ion-icon>
                            </span>
                            <input type="text" class="form-control form-control-lg fs-6" placeholder="Verification Code" id="VCode">
                        </div>
                        <div class="input-group mb-3">
                            <button class="btn btn-lg btn-primary w-100 fs-6" onclick="resetPassword();">Reset</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Ionic -->
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <!-- bootstrap.js -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <!-- script.js -->
    <script src="script.js"></script>
</body>

</html>