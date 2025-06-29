<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" integrity="sha512-..." crossorigin="anonymous" referrerpolicy="no-referrer" />

  <title>WebTech Layout</title>
  <style>
    * {
      box-sizing: border-box;
      font-family: 'Poppins', sans-serif;
    }

    body {
      margin: 0;
      padding: 40px;
      background: linear-gradient(135deg, #0f2027, #203a43, #2c5364);
      background-size: 400% 400%;
      animation: gradientBG 15s ease infinite;
      min-height: 100vh;
      display: flex;
      justify-content: center;
      align-items: flex-start;
      color: #fff;
    }

    @keyframes gradientBG {
      0% { background-position: 0% 50%; }
      50% { background-position: 100% 50%; }
      100% { background-position: 0% 50%; }
    }

    .container {
      max-width: 1300px;
      width: 100%;
    }

    .logo-container {
      text-align: center;
      margin-bottom: 25px;
    }

    .logo-container img {
      width: 140px;
      filter: drop-shadow(0 4px 12px rgba(255, 255, 255, 0.5));
    }

    .box-layout {
      display: flex;
      flex-wrap: wrap;
      gap: 35px;
      justify-content: center;
    }

    .left-column, .right-column {
      display: flex;
      flex-direction: column;
      gap: 25px;
    }

    .form-box, .login-box, .box-3 {
      border-radius: 20px;
      padding: 40px 30px;
      width: 420px;
    }

    .form-box {
      background: linear-gradient(135deg, #ff6ec4, #7873f5, #42e695);
      box-shadow: 0 0 30px rgba(255, 110, 196, 0.4);
      color: #fff;
    }

    .login-box {
      background: linear-gradient(135deg, #74ebd5, #acb6e5);
      box-shadow: 0 0 20px rgba(116, 235, 213, 0.4);
      color: #333;
    }

    .box-3 {
      background: rgba(255, 255, 255, 0.05);
      border: 1px solid rgba(255, 255, 255, 0.15);
      box-shadow: 0 0 15px rgba(255, 255, 255, 0.1);
      backdrop-filter: blur(20px);
      text-align: center;
    }

    .form-box:hover, .login-box:hover, .box-3:hover {
      transform: translateY(-6px);
      box-shadow: 0 0 25px rgba(255, 255, 255, 0.3);
    }

    h2 {
      text-align: center;
      margin-bottom: 20px;
      font-size: 24px;
      color: #000;
    }

    ::placeholder {
  color: #000000;
  opacity: 1;
}
    label {
      color: #222222;
      font-weight: 600;
      font-size: 15px;
      margin-bottom: 5px;
      margin-top: 5px;
      display: block;
    }

    .input-icon {
  position: relative;
  margin-bottom: 10px;
}

.input-icon i {
  position: absolute;
  top: 50%;
  left: 12px;
  transform: translateY(-50%);
  color: #000000;
  font-size: 16px;
  pointer-events: none;
}

.input-icon input {
  padding-left: 40px;
}

    input, select {
      width: 100%;
      padding: 12px 16px;
      font-size: 15px;
      background: rgba(255, 255, 255, 0.1);
      border: 1px solid rgba(255, 255, 255, 0.3);
      border-radius: 12px;
      color: #0d0d0d;
      transition: 0.3s ease;
      outline: none;
    }

    input:focus, select:focus {
      border-color: #00f2fe;
      box-shadow: 0 0 8px #00f2fe;
      background: rgba(255, 255, 255, 0.15);
    }

    select {
  background-color: #1e1e2f;
  color: #ffffff;
  border: 1px solid #5c6bc0;
  border-radius: 12px;
  padding: 12px 16px;
  font-size: 15px;
  background-image: url('data:image/svg+xml;charset=US-ASCII,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 4 5"><path fill="white" d="M2 0L0 2h4z"/></svg>');
  background-repeat: no-repeat;
  background-position: right 1rem center;
  appearance: none;
  -webkit-appearance: none;
  -moz-appearance: none;
  padding-right: 40px;
  transition: background-color 0.3s ease, border-color 0.3s ease, box-shadow 0.3s ease, transform 0.2s ease;
}

select:hover {
  transform: scale(1.02);
  background-color: #24243e;
  box-shadow: 0 0 10px rgba(93, 173, 226, 0.4);
  border-color: #7f94e9;
}

select:focus {
  outline: none;
  border-color: #42e695;
  box-shadow: 0 0 12px #42e695;
  background-color: #2a2a3d;
}
@keyframes pulse {
  0% { box-shadow: 0 0 0 0 rgba(93, 173, 226, 0.6); }
  70% { box-shadow: 0 0 0 10px rgba(93, 173, 226, 0); }
  100% { box-shadow: 0 0 0 0 rgba(93, 173, 226, 0); }
}

select:focus {
  animation: pulse 1.2s ease-out;
}

    .gender-group {
  display: flex;
  gap: 20px;
  margin-top: 10px;
  justify-content: center;
}
.gender-group input[type="radio"] {
  display: none; /* Hide the default radio button */
}

.gender-group label::before {
  content: '';
  display: inline-block;
  width: 20px;
  height: 20px;
  margin-right: 10px;
  border-radius: 50%;
  border: 2px solid #fff;
  vertical-align: middle;
  background: transparent;
  transition: all 0.3s ease;
}

.gender-group input[type="radio"]:checked + label::before {
  content: '✔';
  display: inline-block;
  font-size: 16px;
  text-align: center;
  line-height: 20px;
  background: #42e695;
  color: #000;
  font-weight: bold;
}

.gender-group label {
  display: inline-block;
  padding: 10px 20px;
  border-radius: 30px;
  cursor: pointer;
  background: linear-gradient(135deg, #667eea, #764ba2);
  color: white;
  font-weight: 600;
  transition: all 0.3s ease;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
  user-select: none;
}

.gender-group input[type="radio"]:checked + label {
  background: linear-gradient(135deg, #42e695, #3bb2b8);
  box-shadow: 0 0 15px rgba(66, 230, 149, 0.6);
  transform: scale(1.05);
}

.gender-group label:hover {
  transform: scale(1.03);
  box-shadow: 0 6px 12px rgba(118, 75, 162, 0.4);
}

   button {
  margin-top: 20px;
  padding: 14px;
  width: 100%;
  background: linear-gradient(135deg, #6a11cb 0%, #2575fc 100%);
  color: white;
  border: none;
  border-radius: 14px;
  font-weight: 600;
  font-size: 16px;
  cursor: pointer;
  box-shadow:
    0 6px #1c3aa9,
    0 0 12px rgba(100, 255, 255, 0.5);
  transition: all 0.2s ease;
  position: relative;
}

button:hover {
  transform: translateY(4px); /* Goes DOWN */
  box-shadow:
    0 2px #1c3aa9,
    0 0 10px rgba(255, 255, 255, 0.6);
}

button:active {
  transform: translateY(6px); /* Goes DEEPER on click */
  box-shadow:
    0 0px #1c3aa9,
    0 0 6px rgba(255, 255, 255, 0.4);
}

#error-message {
  background: rgba(255, 0, 0, 0.05);
  background-color: #1e07c8;
  border-left: 4px solid #ff4d4d;
  color: #ffcccc;
  padding: 15px 20px;
  margin: 15px 0;
  border-radius: 12px;
  font-size: 14px;
  display: none;
  position: relative;
  animation: fadeIn 0.6s ease-in-out;
  box-shadow: 0 4px 12px rgba(255, 0, 0, 0.1);
}

#error-message ul {
  margin: 0;
  padding-left: 20px;
}

#error-message ul li {
  margin-bottom: 8px;
  list-style: none;
  position: relative;
  padding-left: 22px;
}

#error-message ul li::before {
  content: "\f057"; /* Font Awesome exclamation-circle */
  font-family: "Font Awesome 6 Free";
  font-weight: 900;
  position: absolute;
  left: 0;
  top: 0;
  color: #ff4d4d;
  font-size: 14px;
}

@keyframes fadeIn {
  from { opacity: 0; transform: translateY(-10px); }
  to { opacity: 1; transform: translateY(0); }
}

.blurred-content {
      filter: blur(3px);
      pointer-events: none;
      margin-top: 15px;
      color: #fff;
    }

  .blurred-content table {
      width: 100%;
      border-collapse: collapse;
    }

    .blurred-content th, .blurred-content td {
      border: 1px solid rgba(255, 255, 255, 0.2);
      padding: 10px;
    }
  </style>
</head>
<body>
  <div class="container">
    <div class="logo-container">
      <img src="https://www.aiub.edu/Files/Templates/NewAIUB/assets/images/aiub-logo.svg" alt="AIUB Logo" />
    </div>
    <div class="box-layout">
      <div class="left-column">
        <div class="form-box">
          <h2>Registration Form</h2>
          <div id="error-message"></div>
          <form id="registrationForm" action="process.php" method="POST">
            <div class="input-icon">
            <i class="fas fa-user"></i>
            <input type="text" name="name" placeholder="Your Name" />
          </div>
          <div class="input-icon">
            <i class="fas fa-envelope"></i>
            <input type="email" name="email" placeholder="Email Address" />
          </div>
          <div class="input-icon">
            <i class="fas fa-lock"></i>
            <input type="password" name="password" placeholder="Password" />
          </div>
            <div class="input-icon">
            <i class="fas fa-lock"></i>
            <input type="password" name="confirmPassword" placeholder="Confirm Password" />
          </div>
            <label>Gender</label>
            <div class="gender-group">
  <input type="radio" id="male" name="gender" value="male">
  <label for="male">Male</label>

  <input type="radio" id="female" name="gender" value="female">
  <label for="female">Female</label>
</div>
            <div class="input-icon">
            <select name="country">
              <option value="">Select Country</option>
              <option value="bd">Bangladesh</option>
              <option value="us">United States</option>
              <option value="uk">United Kingdom</option>
              <option value="in">India</option>
              <option value="ca">Canada</option>
              <option value="au">Australia</option>
              <option value="de">Germany</option>
              <option value="fr">France</option>
              <option value="jp">Japan</option>
              <option value="cn">China</option>
            </select>
          </div>
            <div class="input-icon">
            <i class="fas fa-calendar-alt"></i>
            <input type="date" name="dob" />
            </div>

            <button type="submit">SignUp</button>
          </form>
        </div>
        <div class="login-box">
          <h2>LogIn</h2>
          <div id="login-error"></div>
          <?php
          $email = isset($_COOKIE['email']) ? $_COOKIE['email'] : '';
          $password = isset($_COOKIE['password']) ? $_COOKIE['password'] : '';
          ?>
          <form id="loginForm" action="login.php" method="POST" onsubmit="return validateForm();">
            <label for="loginEmail">Email</label>
            <input type="email" id="loginEmail" name="loginEmail"/>
            <label for="loginPassword">Password</label>
            <input type="password" id="loginPassword" name="loginPassword"/>
           <div class="input-group remember-me">
            <input type="checkbox" id="remember" name="remember">
            <label for="remember">Remember Me</label>
            </div>
            <button type="submit">LogIn</button>
          </form>
        </div>
      </div>
      <div class="right-column">
        <div class="box-3">
          <h2>Content will be shown after login</h2>
          <div class="blurred-content">
            <table>
              <thead>
                <tr><th>Field</th><th>Value</th></tr>
              </thead>
              <tbody>
                <tr><td>Name</td><td></td></tr>
                <tr><td>Email</td><td></td></tr>
                <tr><td>Country</td><td></td></tr>
                <tr><td>Gender</td><td></td></tr>
                <tr><td>DOB</td><td></td></tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script>
    document.getElementById("registrationForm").addEventListener("submit", function (e) {
      e.preventDefault();
      const form = e.target;
      const errorDiv = document.getElementById("error-message");
      errorDiv.classList.remove("success");
      errorDiv.style.display = "none";
      errorDiv.innerHTML = "";

      const name = form.elements["name"].value;
      const email = form.elements["email"].value;
      const password = form.elements["password"].value;
      const confirmPassword = form.elements["confirmPassword"].value;
      const gender = form.querySelector('input[name="gender"]:checked');
      const country = form.elements["country"].value;
      const dob = form.elements["dob"].value;

      const nameRegex = /^[A-Za-z\s]+$/;
      const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

      let errors = [];
      if (!nameRegex.test(name)) errors.push("Please enter a valid name (letters and spaces only).");
      if (!emailRegex.test(email)) errors.push("Please enter a valid email address.");
      if (password.length < 6) errors.push("Password must be at least 6 characters.");
      if (password !== confirmPassword) errors.push("Passwords do not match.");
      if (!gender) errors.push("Please select your gender.");
      if (country === "") errors.push("Please select your country.");
      if (dob === "") errors.push("Please select your date of birth.");
      else {
        const birthDate = new Date(dob);
        const today = new Date();
        let age = today.getFullYear() - birthDate.getFullYear();
        const m = today.getMonth() - birthDate.getMonth();
        if (m < 0 || (m === 0 && today.getDate() < birthDate.getDate())) age--;
        if (age < 18) errors.push("You must be at least 18 years old to register.");
      }

      if (errors.length > 0) {
        errorDiv.innerHTML = "<ul><li>" + errors.join("</li><li>") + "</li></ul>";
        errorDiv.style.display = "block";
      } else {
        errorDiv.innerHTML = "Registration Successful!";
        errorDiv.classList.add("success");
        errorDiv.style.display = "block";
        this.submit();
      }
    });

    document.getElementById("loginForm").addEventListener("submit", function (e) {
      e.preventDefault();
      const errorDiv = document.getElementById("login-error");
      errorDiv.classList.remove("success");
      errorDiv.style.display = "none";
      errorDiv.innerHTML = "";

      const email = this.elements["loginEmail"].value.trim();
      const password = this.elements["loginPassword"].value.trim();

      let errors = [];
      if (email === "") errors.push("Please enter your email.");
      if (password === "") errors.push("Please enter your password.");

      if (errors.length > 0) {
        errorDiv.innerHTML = "<ul><li>" + errors.join("</li><li>") + "</li></ul>";
        errorDiv.style.display = "block";
        return;
      }

      this.submit();
    });
  </script>

  <script>
// Read cookie helper
function getCookie(name) {
  const value = `; ${document.cookie}`;
  const parts = value.split(`; ${name}=`);
  if (parts.length === 2) return parts.pop().split(';').shift();
}

window.onload = function () {
  const rememberedEmail = getCookie('remember_email');
  const rememberedPassword = getCookie('remember_password');

  if (rememberedEmail) {
    document.getElementById('loginEmail').value = decodeURIComponent(rememberedEmail);
    document.getElementById('remember').checked = true;
  }

  if (rememberedPassword) {
    document.getElementById('loginPassword').value = decodeURIComponent(rememberedPassword);
  }
};
</script>

</body>
</html>
