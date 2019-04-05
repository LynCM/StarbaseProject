<html>
<body>

  <p><b>Create a new account</b></p>

<form action = "registerdone.php" method = "post">
  <label>Username :</label>
  <input type = "text" name = "username" id = "username" />
  <br />
  <br />

  <label>Password :</label>
  <input type = "text" name = "password" id = "password" />
  <br />
    <br />

   <label>First name :</label>
   <input type = "text" name = "fname" id = "fname" />
   <br />
     <br />

   <label>Last name :</label>
   <input type = "text" name = "lname" id = "lname" />
   <br />
   <br />

   <label>Type: </label><br>
   <input type = "radio" name = "type" value="Client">Client<br>
   <input type = "radio" name = "type" value="Flight Crew">Flight Crew<br>
   <input type = "radio" name = "type" value="Ground Control">Ground Control<br>

   <button type="submit" class="btn" name="regclient">Register</button>
   <br />
</form>

</body>
</html>
