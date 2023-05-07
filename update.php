<?php 
    session_start();
    include "authentication.php";
    include "config.php";

    $id = $_GET['id'];
    $fsql = "SELECT * FROM users WHERE id='$id'";
    $fquery = mysqli_query($link,$fsql);
    $result = mysqli_fetch_assoc($fquery);

    if(isset($_POST['submit'])){
        $name = $_POST['name'];
        $sex = $_POST['sex'];
        $phone = $_POST['phone'];
        $email = $_POST['email'];
        $photo = $_FILES['photo'];
        $photo_name = $photo['name'];
        $photo_temp = $photo['tmp_name'];

        move_uploaded_file($photo_temp,'uploads/'.$photo_name);
        
        if(empty($photo_name)){
            $photo_name_old = $result['image'];
            $usql = "UPDATE users SET name='$name',sex='$sex',phone='$phone',email='$email',image='$photo_name_old' WHERE id='$id'";
        }else{
            $usql = "UPDATE users SET name='$name',sex='$sex',phone='$phone',email='$email',image='$photo_name' WHERE id='$id'";
            if($result['image'] != 'avatar.png'){
                $image_path = 'uploads/'.$result['image'];
                unlink($image_path);
            }
        }
        $uquery = mysqli_query($link,$usql);
        if($uquery){
            $log = getHostByName($_SERVER['HTTP_HOST']).' - '.date("F j, Y, g:i a").PHP_EOL.
            "Record updated_".time().PHP_EOL.
            "---------------------------------------".PHP_EOL;
            file_put_contents('logs/log_'.date("j-n-Y").'.log', $log, FILE_APPEND);
            
            $_SESSION['success'] = "One record updated successfully";
            header('location:index.php');
        }else{
            $_SESSION['error'] = "Something is wrong, Record not updated";
            header('location:index.php');
        }
    }
?>
<!DOCTYPE html>
<html lang="en"
style="height: 100%";>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modify User</title>
    <link rel="stylesheet" href="css/update.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <style>
        body {
  background-color: #FF5733;
  background-image: linear-gradient(to bottom, #FF5733, #FF8F33);
}
/* Animasi untuk tombol "Submit" */
button[name="submit"] {
  position: relative;
  transition: all 0.3s ease;
}

button[name="submit"]:hover {
  top: -5px;
  box-shadow: 0 5px 10px rgba(0, 0, 0, 0.3);
}

/* Animasi untuk tombol "Back" */
a.btn-secondary {
  position: relative;
  transition: all 0.3s ease;
}

a.btn-secondary:hover {
  top: -5px;
  box-shadow: 0 5px 10px rgba(0, 0, 0, 0.3);
}
.text-center {
  display: flex;
  flex-direction: row;
  justify-content: center;
  align-items: center;
}

.btn {
  margin: 0 10px;
}
h1 {
  color: silver;
}
.btn-secondary{
    text-decoration: none;
}
    </style>
</head>
<body>
<h1 class="text-center">Edit Existing User</h1>
    <div class="container">
        <form action="" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="name"><strong>Name</strong></label>
                <input type="text" class="form-control" placeholder="Enter fullname" name="name" value="<?php echo $result['name'] ?>" required>
            </div>
            <div class="form-group">
                <label for="email"><strong>Gender</strong></label><br>
                <?php if($result['sex'] == 'male'){ ?>
                    <input type="radio" name="sex" value="male" checked> Male &nbsp;
                    <input type="radio" name="sex" value="female"> Female
                <?php } ?>
                <?php if($result['sex'] == 'female'){ ?>
                    <input type="radio" name="sex" value="male"> Male &nbsp;
                    <input type="radio" name="sex" value="female" checked> Female
                <?php } ?>
                <?php if(empty($result['sex'])){ ?>
                    <input type="radio" name="sex" value="male"> Male &nbsp;
                    <input type="radio" name="sex" value="female"> Female
                <?php } ?>
            </div>
            <div class="form-group">
                <label for="phone"><strong>Phone</strong></label>
                <input type="text" class="form-control" placeholder="Enter phone number" name="phone" value="<?php echo $result['phone'] ?>" required>
            </div>
            <div class="form-group">
                <label for="email"><strong>Email</strong></label>
                <input type="email" class="form-control" placeholder="Enter email" name="email" value="<?php echo $result['email'] ?>" required>
            </div>
            <div class="form-group">
                <label for="photo"><strong>Photo</strong></label><br>
                <input type="file" name="photo">
            </div>
            <div class="text-center mt-5">
                <button type="submit" class="btn btn-primary" name="submit">Submit</button>
                <a href="index.php" class="btn btn-secondary">Back</a>
            </div>
        </form>
    </div>
</body>
</html>