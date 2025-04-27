<?php
include('config/constants.php');
 // Ensure session is started

// Check if user is logged in using the correct session key
$isLoggedIn = isset($_SESSION['user_logged_in']) && $_SESSION['user_logged_in'] === true;
$username = $isLoggedIn ? $_SESSION['user_name'] : '';
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Adopt a Pet - Home4Paws</title>
  <link rel="stylesheet" href="css/style1.css" />
  <link rel="stylesheet" href="css/adopt.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
  <link rel="icon" href="images/favicon.png" />
  
</head>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<body>
    <!-- Header -->
    <header class="header">
        <div class="container">
            <a href="<?php echo SITEURL; ?>" class="logo"><i class="fa-solid fa-paw"></i>Home4Paws</a>
            <nav class="nav">
                <ul class="nav-links">
                    <li><a href="<?php echo SITEURL; ?>">Home</a></li>
                    <li>
                        <?php if (isset($_SESSION['user_name'])): ?>
                            <a href="<?php echo SITEURL; ?>pets.php">Pets</a>
                        <?php else: ?>
                            <a href="<?php echo SITEURL; ?>login.php" onclick="alert('Please log in to access this page');">Pets</a>
                        <?php endif; ?>
                    </li>
                    <li>
                        <?php if (isset($_SESSION['user_name'])): ?>
                            <a href="<?php echo SITEURL; ?>vet-community.php">Services</a>
                        <?php else: ?>
                            <a href="<?php echo SITEURL; ?>login.php" onclick="alert('Please log in to access this page');">Services</a>
                        <?php endif; ?>
                    </li>
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

<?php
// Check whether pet-id is set or not
if (isset($_GET['pet_id'])) {
    $pet_id = $_GET['pet_id'];
    $sql = "SELECT * FROM tbl_pet WHERE id=$pet_id";
    $res = mysqli_query($conn, $sql);
    $count = mysqli_num_rows($res);
    if ($count == 1) {
        $row = mysqli_fetch_assoc($res);
        $title = $row['title'];
        $age = $row['age'];
        $image_name = $row['image_name'];
        $gender = $row['gender'];
       
    } else {
        header('location:' . SITEURL);
    }
} else {
    header('location:' . SITEURL);
}

?>

<section class="pet-search2">
    <h2 class="text-center text-orange">Fill out the form below to welcome a furry friend into your home.</h2>
    <div class="container">
        <form action="" method="POST" class="adopt">
            <fieldset>
                <legend class="text-center text-orange">Selected Pet</legend>
                <section class="pet-menu">
                    <div class="pet-menu-img">
                        <?php if ($image_name == "") { echo '<div class="error">Image not available</div>'; } else { ?>
                            <img src="<?php echo SITEURL; ?>images/pet/<?php echo $image_name; ?>" class="img-curve img-responsive">
                        <?php } ?>
                    </div>
                    <div class="pet-menu-desc">
                        <h4><?php echo $title; ?></h4>
                        <p class="pet-status">Age: <?php echo $age; ?></p>
                        <p class="pet-desc">Gender: <?php echo $gender; ?></p>
                        <input type="hidden" name="pet" value="<?php echo $title; ?>">
                        <input type="hidden" name="location" value="<?php echo $age; ?>">
                    </div>
                    <div class="clearfix"></div>
                </section>
            </fieldset>
            <fieldset>
                <legend class="text-center text-orange">Your Details</legend>
                <input type="text" name="full-name" placeholder="Full Name" class="input-responsive"  required>
                <input type="tel" name="contact" placeholder="Phone Number" class="input-responsive" required>
                <input type="email" name="email" placeholder="Email" class="input-responsive" required>
                <textarea name="address" rows="2" placeholder="Address" class="input-responsive" required></textarea>
                <input type="submit" name="submit" value="Adopt Me!" class="btn btn-primary btn-center">
            </fieldset>
        </form>
        <?php
if (isset($_POST['submit'])) {
    $pet_id = $_GET['pet_id']; // Fetch pet_id from the URL

    $adoption_date = date("Y-m-d");
    $status = "Requested";
    $adoptee_name = $_POST['full-name'];
    $adoptee_contact = $_POST['contact'];
    $adoptee_email = $_POST['email'];
    $adoptee_address = $_POST['address'];

    // Fetch age and gender from tbl_pet
    $sql_pet = "SELECT title ,age, gender FROM tbl_pet WHERE id=$pet_id";
    $res_pet = mysqli_query($conn, $sql_pet);
    $row_pet = mysqli_fetch_assoc($res_pet);
    $pet_name=$row['title'];
    $age = $row_pet['age'];
    $gender = $row_pet['gender'];

    // Insert into tbl_adopt
    $sql2 = "INSERT INTO tbl_adopt SET
        pet_id='$pet_id',
        pet = '$pet_name',  
        adoption_date = '$adoption_date',
        status = '$status',
        adoptee_name = '$adoptee_name',
        adoptee_contact = '$adoptee_contact',
        adoptee_email = '$adoptee_email',
        adoptee_address = '$adoptee_address',
        age = '$age', 
        gender = '$gender'"; 

    $res2 = mysqli_query($conn, $sql2);

    if ($res2 == true) {
        echo "<script>
            Swal.fire({
                title: 'Thank You!',
                text: 'Thank you for adopting \"$title\". We will contact you soon!',
                icon: 'success',
                confirmButtonColor: '#8B7355',
                confirmButtonText: 'OK'
            }).then(() => {
                window.location.href = '".SITEURL."';
            });
        </script>";
    } else {
        echo "<script>
            Swal.fire({
                title: 'Oops!',
                text: 'Pet Adoption Request Failed. Please try again.',
                icon: 'error',
                confirmButtonText: 'OK'
            });
        </script>";
    }
}

?>

    </div>
</section>

<!-- Footer -->
<footer class="footer">
        <div class="container">
            <div class="footer-content">
                <div class="footer-logo">
                    <i class="fa-solid fa-paw"></i>Home4Paws
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
                    <p>Email: home4pawsinfo@gmail.com</p>
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
