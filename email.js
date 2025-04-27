function sendMail() {
    let parms = {
        name: document.getElementById("name").value,
        email: document.getElementById("email").value,
        subject: "New Contact Form Submission", // Add a static subject or make it dynamic
        message: document.getElementById("message").value,
    };

    emailjs.send("service_9walh1g", "template_707pz8x", parms)
        .then(() => {
            alert("Email Sent!!!");
            document.querySelector("form").reset(); // Clears the form after sending
        })
        .catch((error) => {
            console.error("Email failed:", error);
            alert("Failed to send email. Please try again.");
        });
}
