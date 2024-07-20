function login() {
  const emailInput = document.querySelector('input[name="email"]');
  const passInput = document.querySelector('input[name="pass"]');
  const emailValue = emailInput.value.trim();
  const passValue = passInput.value.trim();

  if (emailValue === '' || passValue === '') {
    window.location.href = 'index.php?field=true'; // Replace with your desired URL
    return;
  }

  document.getElementById("loginButton").style.display = "none";
  document.getElementById("loading").classList.remove("d-none");

  // You should add your login logic here, and upon success, redirect the user to the desired page.
  // For demonstration purposes, we'll simulate a delay with setTimeout.
  setTimeout(function () {
      // Replace this with your actual login logic.
      // Upon successful login, you can redirect the user to a different page.
      // window.location.href = 'dashboard.php';
      // For now, let's just reset the button and hide the loading spinner after 2 seconds.
      document.getElementById("loginButton").style.display = "block";
      document.getElementById("loading").classList.add("d-none");
  }, 5000); // Simulating a 5-second delay.
}