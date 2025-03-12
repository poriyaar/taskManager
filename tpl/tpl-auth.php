<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>task authentication</title>
  <link rel="stylesheet" href="https://public.codepenassets.com/css/normalize-5.0.0.min.css">
  <link rel="stylesheet" href="<?= siteUrl('assets/css/auth.css') ?>">

</head>

<body>
  <!-- partial:index.partial.html -->
  <div class="container right-panel-active">
    <!-- Sign Up -->
    <div class="container__form container--signup">
      <form action="<?= siteUrl("auth.php?action=register") ?>" class="form" method="post" id="form1">
        <h2 class="form__title">Register</h2>
        <input type="text" placeholder="User" name="name" class="input" />
        <input type="email" placeholder="Email" name="email" class="input" />
        <input type="password" placeholder="Password" name="password" class="input" />
        <button class="btn">Register</button>
      </form>
    </div>

    <!-- Sign In -->
    <div class="container__form container--signin">
      <form action="<?= siteUrl("auth.php?action=login") ?>" method="post" class="form" id="form2">
        <h2 class="form__title">Sign In</h2>
        <input type="email" placeholder="Email" name="email" class="input" />
        <input type="password" placeholder="Password" name="password" class="input" />
        <!-- <a href="#" class="link">Forgot your password?</a> -->
        <button type="submit" class="btn">Sign In</button>
      </form>
    </div>

    <!-- Overlay -->
    <div class="container__overlay">
      <div class="overlay">
        <div class="overlay__panel overlay--left">
          <button class="btn" id="signIn">Sign In</button>
        </div>
        <div class="overlay__panel overlay--right">
          <button class="btn" id="signUp">Register</button>
        </div>
      </div>
    </div>
  </div>
  <!-- partial -->
  <script>
    const signInBtn = document.getElementById("signIn");
    const signUpBtn = document.getElementById("signUp");
    // const fistForm = document.getElementById("form1");
    // const secondForm = document.getElementById("form2");
    const container = document.querySelector(".container");

    signInBtn.addEventListener("click", () => {
      container.classList.remove("right-panel-active");
    });

    signUpBtn.addEventListener("click", () => {
      container.classList.add("right-panel-active");
    });

    fistForm.addEventListener("submit", (e) => e.preventDefault());
    secondForm.addEventListener("submit", (e) => e.preventDefault());
  </script>

</body>

</html>