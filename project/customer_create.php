<!DOCTYPE HTML>
<html>
<head>
    <title>PDO - Create a Record - PHP CRUD Tutorial</title>
    <!-- Latest compiled and minified Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/yourcode.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <!-- CSS only -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
</head>
<body>
    
<nav class="navbar navbar-expand-lg navbar-dark bg-dark" style="margin-bottom: 20px;">
<div class="container-fluid">
<div class="navbar">
  <a class="navbar-brand" href="#">Eshop</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav">
      <li class="nav-item ">
        <a class="nav-link" href="home.html">Home</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="product_create.php">Create Product</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="product_read.php">Read Product</a>
      </li>
      <li class="nav-item">
        <a class="nav-link active" href="#">Create Customer<span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Contact Us</a>
      </li>
    </ul>
  </div>
  </div>
 </div>
</nav>

    <!-- container -->
    <div class="container">
        <div class="page-header">
            <h1>Create Customer</h1>
        </div>
      
        <?php
            if ($_POST) {
                $Username = $_POST['Username'];
                $login_password = $_POST['login_password'];
                $comfirm_password = $_POST['comfirm_password'];
                $First_name = $_POST['First_name'];
                $Last_name = $_POST['Last_name'];
                $Gender = $_POST['Gender'];
                $Date_of_birth = $_POST['Date_of_birth'];
                $Account_status = $_POST['Account_status'];
                $Registration = $_POST['Registration'];

                // include database connection

                include 'config/database.php';

                if ($Username == "" || $login_password == "" ||$comfirm_password== "" || $First_name == "" || $Last_name == "" || $Date_of_birth == "" || $Gender == "" || $Account_status == "" ||$Registration == "" ) {
                    echo "<div class='alert alert-danger'>Please fill in all the blank!</div>";
                } 
                else if(strlen($Username)<6 && strpos($Username)!==FALSE){
                        echo "<div class='alert alert-danger'>Username must be at least 6 characters & not space is allowed.</div>";
                    }else{
                        $uppercase = preg_match('@[A-Z]@', $login_password);
                        $lowercase = preg_match('@[a-z]@', $login_password);
                        $number    = preg_match('@[0-9]@', $login_password);
                        $specialChars = preg_match('@[^\w]@', $login_password);

                    if(!$uppercase || !$lowercase || !$number || !$specialChars || strlen($login_password) < 8) {
                        echo "<div class='alert alert-danger'>Password should be at least 8 characters in length and should include at least one upper case letter, one number, and one special character.</div>";
                    }

                    else if ($login_password !== $comfirm_password){
                        echo "<div class='alert alert-danger'>Password and comfirm password should be match!</div>";
                    }

                    if(time() < strtotime('+18 years', strtotime($Date_of_birth))) {
                        echo "<div class='alert alert-danger'>Customer is under 18 years old. </div>";
                    }

                    else{
                       try {
                        // insert query
                        $query = "INSERT INTO customers SET Username=:Username, login_password=:login_password,comfirm_password=:comfirm_password, First_name=:First_name, Last_name=:Last_name, Gender=:Gender, Date_of_birth=:Date_of_birth, Registration=:Registration,Account_status=:Account_status";
                        // prepare query for execution
                        $stmt = $con->prepare($query);
                        // bind the parameters
                        $stmt->bindParam(':Username', $Username);
                        $stmt->bindParam(':password', $login_password);
                        $stmt->bindParam(':comfirm_password', $comfirm_password);
                        $stmt->bindParam(':First_name', $First_name);
                        $stmt->bindParam(':Last_name', $Last_name);
                        $stmt->bindParam(':Gender', $Gender);
                        $stmt->bindParam(':Date_of_birth', $Date_of_birth);
                        $stmt->bindParam(':Account_status', $Account_status);
                        $register_date = date('Y-m-d H:i:s'); // get the current date and time
                        $stmt->bindParam(':Registration', $Registration);
                        // Execute the query
                        if ($stmt->execute()) {
                            echo "<div class='alert alert-success'>Record was saved.</div>";
                        } else {
                            echo "<div class='alert alert-danger'>Unable to save record.</div>";
                        }
                    }
                    // show error
                    catch (PDOException $exception) {
                        die('ERROR: ' . $exception->getMessage());
                    }
                }  
                    }
                                       

            }  
                           

            ?>

            <!-- html form here where the product information will be entered -->

            <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="POST">
                <table class='table table-hover table-responsive table-bordered'>
                    <tr>
                        <td>Username</td>
                        <td><input type='text' name='Username' class='form-control' /></td>
                    </tr>
                    <tr>
                        <td>Password</td>
                        <td><input type='password' name='login_password' class='form-control' /></td>
                    </tr>
                    <tr>

                    <tr>
                        <td>Comfirm Password</td>
                        <td><input type='password' name='comfirm_password' class='form-control' /></td>
                    </tr>
                    <tr>

                        <td>First_name</td>
                        <td><input type='text' name='First_name' class='form-control' /></td>
                    </tr>
                    <tr>
                        <td>Last_name</td>
                        <td><input type='text' name='Last_name' class='form-control' /></td>
                    </tr>
                    <tr>
                        <td>Gender</td>
                        <td>
                        <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" value="female" name="Gender">
                                <label class="form-check-label" for="flexRadioDefault1">
                                    Female
                                </label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" value="male" name="Gender">
                                <label class="form-check-label" for="flexRadioDefault2">
                                    Male
                                </label>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>Date of birth</td>
                        <td><input type="date" name="Date_of_birth" class='form-control'></td>
                    </tr>
                    <tr>
                        <td>Registration Date&Time</td>
                        <td><input type="datetime-local" name="Registration" class='form-control'></td>
                    </tr>
                    <tr>
                        <td>Account status</td>
                        <td>
                        <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" value="active" name="Account_status">
                                <label class="form-check-label" for="flexRadioDefault1">
                                    Active
                                </label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" value="closed" name="Account_status">
                                <label class="form-check-label" for="flexRadioDefault2">
                                    Closed
                                </label>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>
                            <input type='submit' value='Save' class='btn btn-primary' />
                            <a href='index.php' class='btn btn-danger'>View Customer</a>
                        </td>
                    </tr>
                </table>
            </form>


        </div>
    <!-- end .container -->  
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
</body>
</html>
