document.getElementById("loginForm").addEventListener("submit", function(event) {
    event.preventDefault();  // Prevent the form from submitting normally

    const username = document.getElementById("username").value.trim();
    const password = document.getElementById("password").value.trim();
    const errorMessage = document.getElementById("errorMessage");

    // Check if username and password are both provided
    if (!username || !password) {
        errorMessage.textContent = "Please enter both username and password.";
        return;
    }

    // Retrieve user data from localStorage
    const storedUserData = localStorage.getItem(username);

    if (!storedUserData) {
        // If no user data found for the username
        errorMessage.textContent = "Account not found. Please sign up.";
        return;
    }

    // Parse the stored user data
    const userData = JSON.parse(storedUserData);

    // Check if the entered password matches the stored password
    if (userData.password === password) {
        // Store the logged-in user's username in localStorage
        localStorage.setItem("loggedInUser", username);

        // Redirect to frontpage2.html after successful login
        alert("Login successful!");
        window.location.href = "frontpage2.html";
    } else {
        // If password is incorrect, show error message
        errorMessage.textContent = "Incorrect password. Please try again.";
    }
});
