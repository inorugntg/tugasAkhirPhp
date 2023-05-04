<?php
session_start();
include "authentication.php";
include "config.php";

$page = isset($_GET['page']) ? $_GET['page'] : 1;
$limit = 3;
$offset = ($page - 1) * $limit;
$sql = "SELECT * FROM users LIMIT $limit OFFSET $offset";
$query = mysqli_query($link, $sql);

// definisikan variabel total_page
$total_page = 0;

// logika untuk menghitung nilai total_page
// ...

// gunakan variabel total_page di baris ke-168
echo "Total pages: " . $total_page;

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP CRUD Operation</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="index.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
    <style>
        div h1 {
            color: rgb(192, 192, 255);
        }

        .btn-info {
            text-decoration: none;
        }

        .btn-danger {
            text-decoration: none;
        }

        .table thead tr {
            background-color: #333;
            color: #fff;
        }

        .table tbody tr {
            background-color: #fff;
        }

        table {
            border-collapse: collapse;
            width: 100%;
        }

        th,
        td {
            text-align: center;
            padding: 8px;
            border: 1px solid #ddd;
        }

        th {
            background-color: #343a40;
            color: white;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        table {
            table-layout: fixed;
            width: 100%;
        }

        th:first-child,
        td:first-child {
            width: 5%;
        }
        table {
  box-shadow: 0 0 5px 2px rgba(0, 0, 0, 0.2);
}
.btn-logout {
  box-shadow: 0 0 5px 2px rgba(0, 0, 0, 0.2);
}

    </style>
</head>

<body>
    <nav class="navbar navbar-expand-sm bg-secondary navbar-dark">
        <p class="navbar-brand">
            <?php echo isset($_SESSION['id']) ? 'Welcome ' . $_SESSION['name'] : '' ?> |
        </p>
        <p class="nav-item text-white">
            <?php echo isset($_SESSION['login_at']) ? 'Login at: ' . $_SESSION['login_at'] : '' ?> | &nbsp;&nbsp;
        </p>
        <p class="float-right">
            <a href="logout.php" class="btn btn-danger"><i class='fas fa-sign-out-alt'></i> Logout</a>
        </p>
    </nav>

    <div>
        <h1 class="text-center">User List</h1>
    </div>
    <div class="text-right"><a href="create.php" class="btn btn-success mb-2"><i class='fas fa-plus'></i> Add User</a></div>
    <div class="container">
        <?php if (isset($_SESSION['success'])) { ?>
            <div class="alert alert-success"><?php echo $_SESSION['success'];
                                                unset($_SESSION['success']); ?></div>
        <?php } ?>
        <?php if (isset($_SESSION['error'])) { ?>
            <div class="alert alert-danger"><?php echo $_SESSION['error'];
                                            unset($_SESSION['error']); ?></div>
        <?php } ?>
        <?php if (isset($_SESSION['warning'])) { ?>
            <div class="alert alert-warning"><?php echo $_SESSION['warning'];
                                                unset($_SESSION['warning']); ?></div>
        <?php } ?>

        <table class="table table-bordered table-striped table-hover">
            <thead class="bg-dark text-center text-white">
                <tr>
                    <th>Id</th>
                    <th>Name</th>
                    <th>Gender</th>
                    <th>Phone</th>
                    <th>Email</th>
                    <th>Photo</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody class="text-center">
                <?php if (mysqli_num_rows($query) == 0) { ?>
                    <tr>
                        <td colspan="8" class="text-center" style="width: 100%">No record found</td>
                    </tr>

                <?php } else {
                    $psql = "SELECT * FROM users";
                    $pquery = mysqli_query($link, $psql);
                    $total_record = mysqli_num_rows($pquery);
                    $total_page = ceil($total_record / $limit);
                ?>
                    <?php while ($row = mysqli_fetch_assoc($query)) { ?>
                        <tr>
                            <td><?php echo $row['id'] ?></td>
                            <td><?php echo $row['name'] ?></td>
                            <td>
                                <?php if ($row['sex'] == 'male') { ?>
                                    <i class='fas fa-male'></i> Male
                                <?php } ?>
                                <?php if ($row['sex'] == 'female') { ?>
                                    <i class='fas fa-female'></i> Female
                                <?php } ?>
                            </td>
                            <td><?php echo $row['phone'] ?></td>
                            <td><?php echo $row['email'] ?></td>
                            <td><img src="uploads/<?php echo $row['image'] ?>" width="115" height="115"></td>
                            <td>
                                <a href="update.php?id=<?php echo $row['id'] ?>" class="text-dark"><i class='fas fa-edit'></i></a>&nbsp;&nbsp;
                                <a href="delete.php?id=<?php echo $row['id'] ?>" class="text-dark"><i class='fas fa-trash'></i></a>&nbsp;&nbsp;
                                <a href="detail.php?id=<?php echo $row['id'] ?>" class="text-dark"><i class='fas fa-info-circle'></i></a>
                            </td>
                        </tr>
                <?php }
                } ?>
            </tbody>
        </table>
    </div>
    <ul class="pagination">
        <li class="page-item <?php echo ($page > 1) ? '' : 'disabled' ?>"><a class="page-link" href="index.php?page=<?php echo $page - 1 ?>">Previous</a></li>
        <?php for ($i = 1; $i <= $total_page; $i++) { ?>
            <li class="page-item <?php echo ($page == $i) ? 'active' : '' ?>"><a class="page-link" href="index.php?page=<?php echo $i ?>"><?php echo $i ?></a></li>
        <?php } ?>
        <li class="page-item <?php echo ($total_page > $page) ? '' : 'disabled' ?>"><a class="page-link" href="index.php?page=<?php echo $page + 1 ?>">Next</a></li>
    </ul>

    <script>
        function showDetail(id) {
            window.location.href = "detail.php?id=" + id;
        }
    </script>
    
</body>

</html>