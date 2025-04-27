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
  <title>Home4Paws - Find Your Perfect Pet</title>
  <link rel="stylesheet" href="css/pets.css" />
  <link rel="stylesheet" href="css/style1.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
  <link rel="icon" href="images/favicon.png" />
</head>

<body>
  <!-- Header -->
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
                    <?php if(isset($_SESSION['user_logged_in'])): ?>
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

  <!-- Pet Search Section -->
  <section class="search-section text-center">
    <div class="container">
      <form action="<?php echo SITEURL;?>pet-search.php" method="POST" class="search-container">
        <input type="search" name="search" class="search-input" placeholder="Search for a pet...">
        <button type="submit" name="submit" class="search-btn"><i class="fas fa-search"></i></button>
      </form>
    </div>
  </section>

  <!-- Pet Menu Section -->
  <section class="pets-section">
    <div class="container">
      <?php
      $search = $_POST['search'];
      ?>
      <h2 class="text-center section-title">You searched for: <a href="#" class="text-orange"><?php echo $search; ?></a></h2>

      <div class="pets-grid">
      <?php
$search = $_POST['search']; // Get search term

// Query to find category by search term
$category_sql = "SELECT id FROM tbl_category WHERE title LIKE '%$search%'";
$category_res = mysqli_query($conn, $category_sql);
$category_row = mysqli_fetch_assoc($category_res);
$category_id = $category_row['id'] ?? null; // If no category found, it will be null

// Start building the main query
$sql = "SELECT * FROM tbl_pet WHERE (title LIKE '%$search%' OR gender LIKE '%$search%' OR age LIKE '%$search%')";

// If a category ID is found, add the category filter
if ($category_id) {
    $sql .= " OR category_id = '$category_id'";
}

$res = mysqli_query($conn, $sql);
$count = mysqli_num_rows($res);

if ($count > 0) {
    while ($row = mysqli_fetch_assoc($res)) {
        $id = $row['id'];
        $title = $row['title'];
        $age = $row['age'];
        $gender = $row['gender'];
        $image_name = $row['image_name'];
        ?>
        <div class="pet-card">
            <div class="pet-image">
                <?php
                if ($image_name == "") {
                    echo "<div class='error'>Image not available.</div>";
                } else {
                    echo "<img src='" . SITEURL . "images/pet/" . $image_name . "' alt='" . $title . "'>";
                }
                ?>
            </div>
            <div class="pet-info">
                <h3><?php echo $title; ?></h3>
                <p class="location">🎂 <?php echo $age; ?></p>
                <p class="health-status">🐾 <?php echo $gender; ?></p>
                <a href="<?php echo SITEURL; ?>adopt.php?pet_id=<?php echo $id; ?>" class="adopt-btn">Adopt</a>
            </div>
        </div>
        <?php
    }
} else {
    echo "<div class='error text-center'>No pets found based on your search.</div>";
}
?>

      </div>
      <br>
      <br>
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
            <li><a href="<?php echo SITEURL; ?>aboutus.php">About Us</a></li>
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
