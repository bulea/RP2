<?php
session_start();
require_once 'crtaj_header.php';
require_once 'db.class.php';

try
{
  $db = DB::getConnection();
  $st = $db->prepare( 'SELECT id, id_user, title, status FROM dz2_projects ORDER BY id' );
  $st->execute();
}
catch( PDOException $e ) { exit( 'PDO error ' . $e->getMessage() ); }

while( $row = $st->fetch() )
{
  try
  {
    $db = DB::getConnection();
    $user = $db->prepare( 'SELECT username FROM dz2_users WHERE id=:id' );
    $user->execute(array( 'id' => $row['id_user'] ));
  }
  catch( PDOException $e ) { exit( 'PDO error ' . $e->getMessage() ); }
  $username = $user->fetch();
  $username = $username['username'];

  echo '<div class="projekt">';
  echo '<p id="gray">';
  echo 'Author: ' . $username . ' (status: ';
  if($row['status'] === 'open')
    echo '<span id="green"> &nbsp' . $row['status'] . ' </span>';
  else echo '<span id="red"> &nbsp' . $row['status'] . ' </span>';
  echo ')';
  echo '<p/>';

  echo '<p id="bigger">';
  echo '<a href="project.php?id=' . $row['id'] . '" id="bigger">' . $row['title'] . '</a>';
  echo '<p/>';
  echo '</div>';
  echo '<br>';

}

require_once 'crtaj_footer.php';

 ?>
