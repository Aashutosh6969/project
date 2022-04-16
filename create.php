<?php

require_once "config.php";

//Define variables and initialize with empty values
$first_name = $last_name = $email = $password ="";
$first_name_err = $last_name_err = $email_err = $password_err="";


if ($_SERVER['REQUEST_METHOD'] == "POST") {
    //Validate first name
    $input_first_name = trim($_POST["first_name"]);
    if (empty($input_first_name)) {
        $first_name_err = "Please enter a first name";
        echo "Please enter a first name.";
    } elseif (!filter_var($input_first_name, FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => "/^[a-zA-Z\s]+$/")))) {
        $first_name_err = "Please enter a valid first name";
        echo "Please enter a valid first name";
    } else {
        $first_name = $input_first_name;
    }

    //Validate last name
    $input_last_name = trim($_POST["last_name"]);
    if (empty($input_last_name)) {
        $last_name_err = "Please enter a last name";
        echo "Please enter a last name.";
    } elseif (!filter_var($input_last_name, FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => "/^[a-zA-Z\s]+$/")))) {
        $last_name_err = "Please enter a valid last name";
        echo "Please enter a valid last name";

    } else {
        $last_name = $input_last_name;
    }
    //Validation of email
    $input_email = trim($_POST["email"]);
    if (empty($input_email)) {
        $email_err = "Please enter a email";
        echo "Please enter a email";
    } else {
        $email = $input_email;
    }
    //Validation of password
    $input_password = trim($_POST["password"]);
    if (empty($input_password)) {
        $email_err = "Please enter your password";
        echo "Please enter your password";
    } else {
        $password = $input_password;
    }


    if (empty($first_name_err) && empty($last_name_err) && empty($email_err) && empty($password_err)) {
// Prepare an insert statement
        $sql = "INSERT INTO signup (first_name, last_name, email, password) VALUES (?, ?, ?,?)";

        if ($stmt = mysqli_prepare($conn, $sql)) {
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ssss", $first_name, $last_name, $email,$password);

            // Set parameters
            $first_name = trim($_POST['first_name']);
            $last_name = trim($_POST['last_name']);
            $email = trim($_POST['email']);
            $password = trim($_POST['password']);


            // Attempt to execute the prepared statement
        //     if (mysqli_stmt_execute($stmt)) {
        //         header("location: retrieve_to.php");
        //     } else {
        //         echo "ERROR: Could not execute query: $sql. " . mysqli_error($conn);
        //     }
        // } else {
        //     echo "ERROR: Could not prepare query: $sql. " . mysqli_error($conn);
        // }

// Close statement
        mysqli_stmt_close($stmt);

// Close connection
        mysqli_close($conn);
    }
}
}
?>


<html>
<head><title>Sign up</title>
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</head>

<br> <header>
    <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="test.php">YourseriesList</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <ul class="navbar-nav me-auto mb-2 mb-md-0">
                    <li class="nav-item">
                        <!-- <a class="nav-link active" aria-current="page" href="retrieve_to.php">LIST</a> -->

                    </li>

                </ul> <br>
                <form class="d-flex">
                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-success" type="submit">Search</button>
                </form>
            </div>
        </div>
    </nav>
</header>
<br>
<div class="container mt-3"><br>
    <h2>Sign Up</h2>
    <form action="create.php" method="post" enctype="multipart/form-data">
        <!-- <input type="file" id="image" name="image" class="form-control"><br> -->
        <input type="text" id="first_name" placeholder="Enter First name" name="first_name" class="form-control"><br>
        <input type="text" id="last_name" placeholder="Enter last name" name="last_name" class="form-control"><br>
        <input type="email" id="email" placeholder="Enter email" name="email" class="form-control"><br>
        <input type="password" id="password" placeholder="Enter your password" name="password" class="form-control"><br>
<input class="btn btn-primary" type="submit" value="Submit">
</form>
</div>
</html>