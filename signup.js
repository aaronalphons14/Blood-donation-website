document.getElementById("signupForm").addEventListener("submit", function(event) {
    event.preventDefault();
    const firstName = document.getElementById("firstName").value;
    const lastName = document.getElementById("lastName").value;
    const email = document.getElementById("email").value;
    const dob = document.getElementById("dob").value;
    const bloodGroup = document.getElementById("bloodGroup").value;
    const username = document.getElementById("username").value;
    const password = document.getElementById("password").value;
    const signupMessage = document.getElementById("signupMessage");

    if (localStorage.getItem(username)) {
        signupMessage.textContent = "Username already taken. Please choose another one.";
        return;
    }

    const userData = {
        firstName,
        lastName,
        email,
        dob,
        bloodGroup,
        username,
        password
    };

    localStorage.setItem(username, JSON.stringify(userData));
    alert("Sign up successful! Please log in.");
    window.location.href = "login.html";
});

document.getElementById('loginForm').addEventListener('submit', function (event) {
    event.preventDefault();

    // Get the username and password values
    const username = document.getElementById('username').value;
    const password = document.getElementById('password').value;

    // Simple validation
    if (username && password) {
        // Store user data in localStorage
        const userData = { firstName: username }; // You can expand this object to include more user details
        localStorage.setItem('loggedInUser', username);
        localStorage.setItem(username, JSON.stringify(userData));

        // Redirect to the front page (homepage)
        window.location.href = 'frontpage.html';
    } else {
        document.getElementById('errorMessage').textContent = 'Please enter both username and password.';
    }
});

