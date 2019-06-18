<?php
session_start();
require_once 'crtaj_header.php';

 ?>
<div id="bigger">

<form action="novi_projekt.php" method="post">
  Title of project:
  <input type="text" name="naslov" style="height: 25px; font-size: 20px;">
  <br>
  <br>
  Description:
  <input type="textbox" name="opis" style="height: 50px; width: 400px; font-size: 20px;">
  <br>
  <br>
  Number of members:
  <input type="text" name="broj_clanova" style="height: 25px; font-size: 20px;">
  <br>
  <br>
  <button type="submit" name="izradi" style="font-size: 20px;"> Make a project! </button>

</form>
</div>


<?php
require_once 'crtaj_footer.php';

 ?>
