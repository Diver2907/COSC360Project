// Wait for the DOM to load
document.addEventListener('DOMContentLoaded', () => {
    const loginForm = document.getElementById('loginForm');
    const registerForm = document.getElementById('registerForm');
    const messageDiv = document.getElementById('message');
  
    // Retrieve users from localStorage or initialize an empty object
    let users = JSON.parse(localStorage.getItem('users')) || {};
  
    // Handle login form submission
    loginForm.addEventListener('submit', (e) => {
      e.preventDefault();
      const username = loginForm.username.value;
      const password = loginForm.password.value;
  
      if (users[username] && users[username] === password) {
        // Successful login: redirect to Home.html
        window.location.href = 'home.html';
      } else {
        messageDiv.textContent = 'Invalid username or password.';
      }
    });
  
    // Handle registration form submission
    registerForm.addEventListener('submit', (e) => {
      e.preventDefault();
      const email = registerForm.email.value;
      const username = registerForm.username.value;
      const password = registerForm.password.value;
  
      if (users[username]) {
        messageDiv.textContent = 'User already exists.';
      } else {
        // Save the new user credentials in localStorage (insecure for production!)
        users[username] = password;
        localStorage.setItem('users', JSON.stringify(users));
        // Redirect to Home.html after registration
        window.location.href = 'home.html';
      }
    });
  });
  