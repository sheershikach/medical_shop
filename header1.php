<!DOCTYPE html>
<html>
<head>
<style>
    body {
      background-color: #f0f0f0;
      background-size: cover; 
      background-repeat: no-repeat; 
      background: url('backgroundimage.jpg');
      margin: 0;
      padding: 0;
      font-family: "Arial", sans-serif;
      color: #333;
    }

    nav {
      background-color: blue;
      overflow: hidden;
      position: sticky;
      top: 0;
      border-radius: 100px;
      display: flex;
      align-items: center;
      justify-content: space-between;
      padding: 10px 30px; 
      height:70px;
    }

    .logo {
      width: 65px;
      height: 60px;
      border: 5px solid gray;
      border-radius: 100px;
    }

    .menu-links {
      display: flex;
      align-items: center;
    }

    nav a {
      color: white;
      text-align: center;
      padding: 15px 20px; 
      text-decoration: none;
      font-size: 18px;
    }

    nav a:hover {
      background-color: white;
      color: blue;
      padding: 18px 20px;
    }

    .search-form {
      display: flex;
      align-items: center;
    }

    .search-form input[type="text"] {
      padding: 10px;
      border-radius: 5px;
      border: none;
      outline: none;
      margin:10px;
      font-size: 16px;
    }

    .search-form button {
      padding: 12px;   
      margin: 10px;
      border-radius: 5px;
      border: none;
      background-color: white;
      cursor: pointer;
    }

    .search-form button:hover {
      background-color: blue;
      color: white;
    }

</style>
</head>
<body>

<nav>
  <img class="logo" src="logo.jpg"/>
  <div class="menu-links">
    <a href="customer_home.html"><i class="fa-solid fa-house-user"></i>&nbsp;Home</a>
    <a href="medicines.php"><i class="fa-solid fa-house-medical"></i>&nbsp;Medicine</a>
    <a href="about.html"><i class="fa-solid fa-address-card"></i>&nbsp;About</a>
    <a href="cart.php"><i class="fa-solid fa-cart-shopping"></i>&nbsp;Cart</a>
    <form class="search-form" action="search.php" method="GET">
      <input type="text" name="query" placeholder="Search...">
      <button type="submit"><i class="fas fa-search"></i></button>
    </form>
  </div>
</nav>

</body>
</html>
