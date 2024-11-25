// navbar.js
document.addEventListener("DOMContentLoaded", function() {
    fetch("nav.php")
        .then(response => response.text())
        .then(data => {
            document.getElementById("nav-placeholder").innerphp = data;
        })
        .catch(error => console.error("Error loading navbar:", error));
});
