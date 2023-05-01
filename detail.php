<?php
// Check existence of id parameter before processing further
if (isset($_GET["id"]) && !empty(trim($_GET["id"]))) {
    // Include config file
    require_once "config.php";

    // Prepare a select statement
    $sql = "SELECT * FROM users WHERE id = ?";

    if ($stmt = mysqli_prepare($link, $sql)) {
        // Bind variables to the prepared statement as parameters
        mysqli_stmt_bind_param($stmt, "i", $param_id);

        // Set parameters
        $param_id = trim($_GET["id"]);

        // Attempt to execute the prepared statement
        if (mysqli_stmt_execute($stmt)) {
            $result = mysqli_stmt_get_result($stmt);

            if (mysqli_num_rows($result) == 1) {
                /* Fetch result row as an associative array. Since the result set
                contains only one row, we don't need to use while loop */
                $row = mysqli_fetch_array($result, MYSQLI_ASSOC);

                // Retrieve individual field value
                $name = $row["name"];
                $sex = $row["sex"];
                $phone = $row["phone"];
                $email = $row["email"];
                $image = $row["image"];
            }
        } else {
            echo "Oops! Something went wrong. Please try again later.";
        }
    }

    // Close statement
    mysqli_stmt_close($stmt);

    // Close connection
    mysqli_close($link);
} else {
    // URL doesn't contain id parameter. Redirect to error page
    header("location: error.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en" style="height: 100%" ;>

<head>
    <meta charset="UTF-8">
    <title>View Record</title>
    <style type="text/css">
        body {
            background: linear-gradient(to bottom right, #FF5722, #FFC107);
        }

        .wrapper {
            width: 500px;
            margin: 0 auto;
            height: 60%;
            min-height: 60vh;
            background-color: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 0px 10px 0px rgba(0, 0, 0, 0.2);
        }

        .btn {
            background-color: blue;
            color: white;
            border-radius: 5px;
            padding: 10px 20px;
            transition: transform 0.3s;
            text-decoration: none;
        }

        .btn:hover {
            transform: translateY(-3px);
        }

        .text-center {
            text-align: center;
            color: silver;
        }

        .btn:active {
            transform: translateY(3px);
        }
    </style>
</head>

<body>
    <h1 class="text-center">Detail Record</h1>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label>
                            <h3>Nama</h3>
                        </label>
                        <p class="form-control-static"><?php echo $row["name"]; ?></p>
                    </div>
                    <div class="form-group">
                        <label>
                            <h3>Jenis Kelamin</h3>
                        </label>
                        <p class="form-control-static"><?php echo $row["sex"]; ?></p>
                    </div>
                    <div class="form-group">
                        <label>
                            <h3>Nomor HP</h3>
                        </label>
                        <p class="form-control-static"><?php echo $row["phone"]; ?></p>
                    </div>
                    <div class="form-group">
                        <label>
                            <h3>Email</h3>
                        </label>
                        <p class="form-control-static"><?php echo $row["email"]; ?></p>
                    </div>
                    <div class="form-group">
                        <label>
                            <h3>Photo</h3>
                        </label>
                        <?php if (!empty($row["image"])) : ?>
                            <img src="uploads/<?php echo $row["image"]; ?>" alt="Photo" width="115" height="110">
                        <?php else : ?>
                            <p class="form-control-static">No photo available</p>
                        <?php endif; ?>
                    </div>
                    <a href="index.php" class="btn btn-primary">Back</a>
                </div>
            </div>
        </div>
    </div>
</body>

</html>