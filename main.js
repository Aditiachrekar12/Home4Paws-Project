document.addEventListener("DOMContentLoaded", () => {
    var mobileMenuBtn = document.querySelector(".mobile-menu-btn")
    var nav = document.querySelector(".nav")
  
    mobileMenuBtn.addEventListener("click", () => {
      nav.classList.toggle("nav-active")
    })
  
    // Close menu when clicking outside
    document.addEventListener("click", (event) => {
      if (!nav.contains(event.target) && !mobileMenuBtn.contains(event.target)) {
        nav.classList.remove("nav-active")
      }
    })
  
    // Close menu when window is resized to larger screen
    window.addEventListener("resize", () => {
      if (window.innerWidth > 768) {
        nav.classList.remove("nav-active")
      }
    })
  })
  
  
// Email validation helper
function isValidEmail(email) {
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return emailRegex.test(email);
}

// Add smooth scrolling for anchor links
document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function (e) {
        e.preventDefault();
        document.querySelector(this.getAttribute('href')).scrollIntoView({
            behavior: 'smooth'
        });
    });
});
  
  // Handle form submissions
  document.getElementById('adoptForm').addEventListener('submit', function(e) {
    e.preventDefault();
    // Add your form submission logic here
    alert('Adoption form submitted successfully!');
    this.reset();
  });
  
  document.getElementById('giveForm').addEventListener('submit', function(e) {
    e.preventDefault();
    // Add your form submission logic here
    alert('Pet donation form submitted successfully!');
    this.reset();
  });
  
  // File input preview functionality
  document.getElementById('picture').addEventListener('change', function(e) {
    const file = e.target.files[0];
    if (file) {
        // Add your image preview logic here if needed
        console.log('File selected:', file.name);
    }
  });

// Form Validation
function validateForm(formId) {
    const form = document.getElementById(formId);
    if (!form) return;

    form.addEventListener('submit', function(event) {
        event.preventDefault();

        const inputs = form.querySelectorAll('input[required], textarea[required]');
        let isValid = true;

        inputs.forEach(input => {
            if (!input.value.trim()) {
                isValid = false;
                input.classList.add('error');
            } else {
                input.classList.remove('error');
            }
        });

        if (isValid) {
            // In a real application, you would send the form data to a server here
            console.log('Form submitted successfully');
            form.reset();
        }
    });
}

// Initialize form validation for contact form
validateForm('contactForm');