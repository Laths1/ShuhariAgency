//footer.js
document.addEventListener("DOMContentLoaded", function() {
    fetch("footer.php")
        .then(response => response.text())
        .then(data => {
            document.getElementById("footer").innerphp = data;
        })
        .catch(error => console.error("Error loading navbar:", error));
});
