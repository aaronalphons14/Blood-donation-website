document.getElementById("loginForm").addEventListener("submit", function(event) {
    event.preventDefault();
    const username = document.getElementById("username").value;
    const password = document.getElementById("password").value;
    const errorMessage = document.getElementById("errorMessage");

    const userData = localStorage.getItem(username);
    if (!userData) {
        errorMessage.textContent = "Account not found. Please sign up.";
        return;
    }

    const user = JSON.parse(userData);
    if (user.password === password) {
        alert("Login successful!");
        window.location.href = "frontpage2.html";
    } else {
        errorMessage.textContent = "Incorrect password. Please try again.";
    }
});
