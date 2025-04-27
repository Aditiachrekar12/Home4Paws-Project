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
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Home4Paws - Find Your Perfect Pet</title>
  <link rel="stylesheet" href="css/pets.css" />
  <link rel="stylesheet" href="css/style1.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
  <link rel="icon" href="images/favicon.png" />
</head>

<style>
  .hidden-pet {
    display: none;
  }
  .text-center {
    display: flex;
    justify-content: center;
    align-items: center;
    margin-top: 20px;
}

.view-all-btn {
    background-color:#8B7355;
    color: white;
    padding: 10px 20px;
    border: none;
    cursor: pointer;
    font-size: 16px;
    border-radius: 5px;
    text-align: center;
   
}

.view-all-btn:hover {
    background-color:rgb(123, 94, 58);
}

</style>
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
    <h2 class="text-center section-title">Explore Pets</h2>
    <div class="pets-grid">
      <?php
      $sql2 = "SELECT * FROM tbl_pet";
      $res2 = mysqli_query($conn, $sql2);
      $count2 = mysqli_num_rows($res2);
      $counter = 0; // Counter to track the number of pets displayed

      if ($count2 > 0) {
        while ($row = mysqli_fetch_assoc($res2)) {
          $id = $row['id'];
          $title = $row['title'];
          $age = $row['age'];
          $gender = $row['gender'];
          $image_name = $row['image_name'];
          $counter++;

          // Hide pets beyond the first 4
          $extra_class = ($counter > 4) ? "hidden-pet" : "";
          ?>
          <div class="pet-card <?php echo $extra_class; ?>">
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
              <p class="age"> 🎂 <?php echo $age; ?></p>
              <p class="gender">🐾<?php echo $gender; ?></p>
              <a href="<?php echo SITEURL; ?>adopt.php?pet_id=<?php echo $id; ?>" class="adopt-btn">Adopt</a>
            </div>
          </div>
          <?php
        }
      } else {
        echo "<div class='error text-center'>No pets available.</div>";
      }
      ?>
    </div>

    <!-- View All Pets Button -->
    <?php if ($count2 > 4): ?>
      <div class="text-center">
        <button id="view-all-btn" class="view-all-btn">View All Pets</button>
      </div>
    <?php endif; ?>
  </div>
</section>

<script>
  document.getElementById("view-all-btn").addEventListener("click", function() {
    // Show all hidden pets
    document.querySelectorAll(".hidden-pet").forEach(pet => {
      pet.classList.remove("hidden-pet");
    });

    // Hide the button after clicking
    this.style.display = "none";
  });
</script>
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
