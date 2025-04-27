<?php
    include('config/constants.php');


    if(!isset($_SESSION['user_logged_in'])) {
        $_SESSION['error'] = "You must log in to access this page.";
        header("Location: login.php");
        exit();
    }
    $isLoggedIn = isset($_SESSION['user_logged_in']) && $_SESSION['user_logged_in'] === true;
    $username = $isLoggedIn ? $_SESSION['user_name'] : '';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Services - Home4Paws</title>
    <link rel="stylesheet" href="css/services.css">
    <link rel="stylesheet" href="css/style1.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
    <header class="header">
        <div class="container">
            <a href="<?php echo SITEURL; ?>" class="logo"><i class="fa-solid fa-paw"></i>Home4Paws</a>
            <nav class="nav">
                <ul class="nav-links">
                <li><a href="<?php echo SITEURL; ?>" class="active">Home</a></li>
                <li><a href="<?php echo SITEURL; ?>pets.php">Pets</a></li>
                <li><a href="<?php echo SITEURL; ?>vet-community.php">Services</a></li>
                <li><a href="<?php echo SITEURL; ?>about.php">About Us</a></li>
                </ul>
                <div class="auth-buttons">
                    <?php if(isset($_SESSION['user_name'])): ?>
                        <span class="username">Welcome, <?php echo $_SESSION['user_name']; ?>!</span>
                        <a href="logout.php" class="btn btn-ghost">Log Out</a>
                    <?php else: ?>
                        <a href="login.php" class="btn btn-ghost">Log in</a>
                        <a href="register.php" class="btn btn-primary">Sign up</a>
                    <?php endif; ?>
                </div>
            </nav>
            <button class="mobile-menu-btn">
                <i class="fas fa-bars"></i>
            </button>
        </div>
    </header>

    <main>
        <h1>Our Services</h1>
        
        <div class="form-container" id="donateForm">
            <h2>Give a Pet for Adoption</h2>
            <p>Provide the details of the pet you'd like to put up for adoption.</p>
            
            <form action="" method="POST" enctype="multipart/form-data">
                <table class="tbl-30">
                    <tr>
                        <td>Pet Title</td>
                        <td><input type="text" name="title" placeholder="Enter Pet Title" required></td>
                    </tr>
                    <tr>
                        <td>Gender</td>
                        <td><input type="text" name="gender" placeholder="Pet Gender " required></td>
                    </tr>
                    <tr>
                        <td>Image</td>
                        <td><input type="file" name="image"></td>
                    </tr>
                    <tr>
                        <td>Age</td>
                        <td><input type="text" name="age" placeholder="Enter Pet Age " required></td>
                    </tr>
                    <tr>
                        <td>Category</td>
                        <td>
                            <select name="category">
                                <?php
                                $sql = "SELECT * FROM tbl_category";
                                $res = mysqli_query($conn, $sql);
                                if($res == true) {
                                    $count = mysqli_num_rows($res);
                                    if($count > 0) {
                                        while($row = mysqli_fetch_assoc($res)) {
                                            $id = $row['id'];
                                            $title = $row['title'];
                                            echo "<option value='$id'>$title</option>";
                                        }
                                    } else {
                                        echo "<option value='0'>No Category</option>";
                                    }
                                }
                                ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <input type="submit" name="submit" value="Add Pet" class="btn-secondary">
                        </td>
                    </tr>
                </table>
            </form>
        </div>
    </main>
    <?php
    if(isset($_POST['submit'])) {
        $title = trim($_POST['title']);
        $gender = trim($_POST['gender']);
        $age = trim($_POST['age']);
        $category = trim($_POST['category']);
        $featured = "Yes";
        $active = "Yes";
    
        // Validation: Check if required fields are empty
        if(empty($title) || empty($gender) || empty($age) || empty($category)) {
            $_SESSION['add-pet3'] = "<div class='error'>All fields are required!</div>";
            header("location:" . SITEURL . "vet-community.php");
            exit();
        }
    
        // Image Upload Handling
        if(isset($_FILES['image']['name']) && $_FILES['image']['name'] != "") {
            $image_name = $_FILES['image']['name'];
            $ext = pathinfo($image_name, PATHINFO_EXTENSION);
            $image_name = "Pet_name" . rand(0,99999) . '.' . $ext;
            $source = $_FILES['image']['tmp_name'];
            $destination = $_SERVER['DOCUMENT_ROOT'] . "/Pet-Adoption-main/images/pet/" . $image_name;
            $upload = move_uploaded_file($source, $destination);
            if(!$upload) {
                $_SESSION['upload'] = "<div class='error'>Image upload failed</div>";
                header('location:' . SITEURL . 'vet-community.php');
                exit();
            }
        } else {
            $image_name = "";
        }
    
        // Insert into database
        $sql2 = "INSERT INTO tbl_pet SET 
            title='$title', 
            age='$age', 
            gender='$gender', 
            image_name='$image_name', 
            category_id=$category, 
            featured='$featured', 
            active='$active'";
    
        $res2 = mysqli_query($conn, $sql2);
        if($res2) {
            echo "<script>
                Swal.fire({
                    icon: 'success',
                    title: 'Success!',
                    text: 'Pet Added Successfully!',
                    confirmButtonColor: '#8B7355',
                    confirmButtonText: 'OK'
                }).then(() => {
                    window.location.href = '" . SITEURL . "pets.php';
                });
            </script>";
        } else {
            echo "<script>
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Something went wrong!',
                    confirmButtonColor: '#d33',
                    confirmButtonText: 'Try Again'
                }).then(() => {
                    window.location.href = '" . SITEURL . "vet-community.php';
                });
            </script>";
        }
        
    }
    
    ?>

    <footer class="footer">
        <div class="container">
            <div class="footer-content">
                <div class="footer-logo">
                    <i class="fa-solid fa-paw"></i>Home4Paws</a>
                </div>
                <div class="footer-links">
                    <h3>Quick Links</h3>
                    <ul>
                    <li><a href="<?php echo SITEURL; ?>">Home</a></li>
                    <li><a href="<?php echo SITEURL; ?>pets.php">Pets</a></li>
                    <li><a href="<?php echo SITEURL; ?>vet-community.php">Services</a></li>
                    <li><a href="<?php echo SITEURL; ?>about.php">About Us</a></li>
                    </ul>
                </div>
                <div class="footer-contact">
                    <h3>Contact Us</h3>
                    <p>Address: Mumbai, India</p>
                    <p>Phone: 673-241-333</p>
                    <p>Email: info@Home4Paws.com</p>
                </div>
            </div>
            <div class="footer-bottom">
                <p>&copy; 2025 Home4Paws. All rights reserved.</p>
            </div>
        </div>
    </footer>
   
    <script src="main.js"></script>
</body>
</html>