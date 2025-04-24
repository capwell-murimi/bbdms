<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(isset($_POST['submit'])){
    $fullname = $_POST['fullname'];
    $mobile = $_POST['mobileno'];
    $email = $_POST['emailid'];
    $age = $_POST['age'];
    $gender = $_POST['gender'];
    $bloodgroup = $_POST['bloodgroup'];
    $address = $_POST['address'];
    $message = $_POST['message'];
    $password = md5($_POST['password']);
    $status = 1;

    $ret = "SELECT EmailId FROM tblblooddonars WHERE EmailId = :email";
    $query = $dbh->prepare($ret);
    $query->bindParam(':email', $email, PDO::PARAM_STR);
    $query->execute();
    $result = $query->fetchAll(PDO::FETCH_OBJ);

    if($query -> rowCount() == 0){
        $sql = "INSERT INTO tblblooddonars(Fullname,Mobilenumber,EmailID,Age,Gender,Bloodgroup,Address,Message,Status,Password) 
        VALUES(:fullname,:mobile,:email,:age,:gender,:bloodgroup,:address,:message,:status,:password)";

        $query = $dbh->prepare($sql);
        $query->bindParam(':fullname',$fullname,PDO::PARAM_STR);
        $query->bindParam(':mobile', $mobile, PDO::PARAM_STR);
        $query->bindParam(':email', $email, PDO::PARAM_STR);
        $query->bindParam(':age', $age, PDO::PARAM_STR);
        $query->bindParam(':gender', $gender, PDO::PARAM_STR);
        $query->bindParam(':bloodgroup', $bloodgroup, PDO::PARAM_STR);
        $query->bindParam(':address', $address, PDO::PARAM_STR);
        $query->bindParam(':message', $message, PDO::PARAM_STR);
        $query->bindParam(':status', $status, PDO::PARAM_STR);
        $query->bindParam(':password', $password, PDO::PARAM_STR);

        $query->execute();
        $lastInsertId = $dbh->lastInsertId();

        if($lastInsertId){
            echo "<script>alert('You have signrd up successfully');</script>";
        }
        else{
            echo "<script>alert('Something terrible happened. Jaribu tena');</script>";
        }
    }
    else{
        echo "<script>alert('Email already exists');</script>";
    }
    
}
?>

<!DOCTYPE html>
<html lang="zxx">
<head>
    <title>Sign up</title>

    <!-- Include SweetAlert CSS and JS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>

    <script>
        addEventListener('load', function(){
            setTimeout(hideURLbar, 0);
        }, false);

        function hideURLbar(){
            window.scrollTo(0, 1);
        }

        // Example checkPass function
        function checkPass() {
            // Example validation: Check if passwords match
            var password = document.forms["signup"]["password"].value;
            var confirmPassword = document.forms["signup"]["confirm_password"].value;

            if (password !== confirmPassword) {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Passwords do not match!'
                });
                return false; // Prevent form submission
            }

            // Additional validation checks can be added here

            return true; // Allow form submission
        }
    </script>
    <!--// Meta tag Keywords -->

    <!-- Custom-Files -->
    <link rel="stylesheet" href="css/bootstrap.css">
    <!-- Bootstrap-Core-CSS -->
    <link rel="stylesheet" href="css/style.css" type="text/css" media="all" />
    <!-- Style-CSS -->
    <link rel="stylesheet" href="css/fontawesome-all.css">
    <!-- Font-Awesome-Icons-CSS -->
    <!-- //Custom-Files -->

    <!-- Web-Fonts -->
    <link href="//fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i&amp;subset=cyrillic,cyrillic-ext,greek,greek-ext,latin-ext,vietnamese"
        rel="stylesheet">
    <link href="//fonts.googleapis.com/css?family=Roboto+Condensed:300,300i,400,400i,700,700i&amp;subset=cyrillic,cyrillic-ext,greek,greek-ext,latin-ext,vietnamese"
        rel="stylesheet">
    <!-- //Web-Fonts -->

    <style>
        .form-container {
            background-color: #f8f9fa;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .form-container h5 {
            font-size: 24px;
            margin-bottom: 20px;
        }
        .form-container .form-group label {
            font-weight: bold;
        }
        .form-container .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }
        .form-container .btn-primary:hover {
            background-color: #0056b3;
            border-color: #004085;
        }
        .form-container p {
            margin-top: 20px;
        }
    </style>
</head>

<!--body of sign up-->
<body>
    <?php include('includes/header.php');?>

    <div class="inner-banner-w3ls">
        <div class="container">
        </div>
        <!-- //banner 2 -->
    </div>

    <div class="breadcrumb-agile">
        <div aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="index.php">Home</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">Signup</li>
            </ol>
        </div>
    </div>
    
    <section class="about py-5">
        <div class="container py-xl-5 py-lg-3">
            <div class="login px-4 mx-auto mw-100 form-container">
                <h5 class="text-center mb-4">Register Now</h5>
                <form action="#" method="post" name="signup" onsubmit="return checkPass();">
                    <div class="form-group">
                        <label for="fullname">Full Name</label>
                        <input type="text" class="form-control" name="fullname" id="fullname" placeholder="Full Name">
                    </div>
                    <div class="form-group">
                        <label for="mobileno">Mobile Number</label>
                        <input type="text" class="form-control" name="mobileno" id="mobileno" required="true" placeholder="Mobile Number" maxlength="10" pattern="[0-9]+">
                    </div>
                    <div class="form-group">
                        <label for="emailid">Email Id</label>
                        <input type="email" name="emailid" class="form-control" placeholder="Email Id">
                    </div>
                    <div class="form-group">
                        <label for="age">Age</label>
                        <input type="text" class="form-control" name="age" id="age" placeholder="Age" required="">
                    </div>
                    <div class="form-group">
                        <label for="gender">Gender</label>
                        <select name="gender" class="form-control" required>
                            <option value="">Select</option>
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="bloodgroup">Blood Group</label>
                        <select name="bloodgroup" class="form-control" required>
                            <?php
                                $sql = "SELECT * FROM tblbloodgroup";
                                $query = $dbh->prepare($sql);
                                $query->execute();

                                $results = $query->fetchAll(PDO::FETCH_OBJ);
                                $cnt = 1;
                                if($query -> rowCount() > 0){
                                    foreach($results as $result){
                                        ?>
                                            <option value="<?php echo htmlentities($result->BloodGroup);?>"><?php echo htmlentities($result->BloodGroup);?></option>
                                        <?php
                                    }
                                }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="address">Address</label>
                        <input type="text" class="form-control" name="address" id="address" required="true" placeholder="Address">
                    </div>
                    <div class="form-group">
                        <label for="message">Message</label>
                        <textarea class="form-control" name="message" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" name="password" id="password" required="">
                    </div>
                    <div class="form-group">
                        <label for="confirm_password">Confirm Password</label>
                        <input type="password" class="form-control" name="confirm_password" id="confirm_password" required="">
                    </div>
                    <button type="submit" class="btn btn-primary submit mb-4" name="submit">Register</button>
                    <p class="text-center">Already registered? <a href="login.php">Login</a></p>
                </form>
            </div>
        </div>
    </section>

    <?php include('includes/footer.php');?>

    <!-- Js files -->
    <!-- JavaScript -->
    <script src="js/jquery-2.2.3.min.js"></script>
    <!-- Default-JavaScript-File -->

    <!-- banner slider -->
    <script src="js/responsiveslides.min.js"></script>
    <script>
        $(function () {
            $("#slider4").responsiveSlides({
                auto: true,
                pager: true,
                nav: true,
                speed: 1000,
                namespace: "callbacks",
                before: function () {
                    $('.events').append("<li>before event fired.</li>");
                },
                after: function () {
                    $('.events').append("<li>after event fired.</li>");
                }
            });
        });
    </script>
    <!-- //banner slider -->

    <!-- fixed navigation -->
    <script src="js/fixed-nav.js"></script>
    <!-- //fixed navigation -->

    <!-- smooth scrolling -->
    <script src="js/SmoothScroll.min.js"></script>
    <!-- move-top -->
    <script src="js/move-top.js"></script>
    <!-- easing -->
    <script src="js/easing.js"></script>
    <!--  necessary snippets for few javascript files -->
    <script src="js/medic.js"></script>

    <script src="js/bootstrap.js"></script>
    <!-- Necessary-JavaScript-File-For-Bootstrap -->

    <!-- //Js files -->
</body>
</html>