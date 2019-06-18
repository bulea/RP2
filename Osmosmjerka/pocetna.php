<!DOCTYPE html>
<html lang="hr">
  <head>
    <meta charset="utf-8">
    <title>Osmosmjerka!</title>
  </head>
  <body>
    <h1> Osmosmjerka! </h1>
    <br>
    <form action="osmo.php" method="post">
      Unesi svoje ime:
      <input type="text" name="ime">
      <br>
      Odaberi osmosmjerku:
      <br>
      <input type="radio" name="osmo" value="Osmosmjerka1" checked>
      Osmosmjerka 1
      <br>
      <input type="radio" name="osmo" value="Osmosmjerka2">
      Osmosmjerka 2
      <br>
      <button type="submit" name="igra"> Započni igru! </button>
    </form>
  </body>
</html>
