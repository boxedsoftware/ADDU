<html>
  <head>
    <title>Active Directory Profile Destination</title>
  </head>
  <body>
  <font face="arial">
  
  <form action="folder.php" method="post">
  Type in Users profile directory location root:
  <br /><input type="text" size="40" name="destination" />
  <br />
  (Note: Please use "/" rather than "\")
  Example: //file-server-01/D/users
  <br /><br />
  <input type="submit" />
  </form>
  <br /><br />
  Need <a href="help.php" target="_blank">HELP</a>?
  <?php include('footer.html'); ?>
