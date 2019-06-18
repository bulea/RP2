<?php
session_start();
require_once 'crtaj_header.php';
require_once 'db.class.php';


//saznajemo id_user za sebe
try
{
  $db = DB::getConnection();
  $user = $db->prepare( 'SELECT id FROM dz2_users WHERE username=:username' );
  $user->execute(array( 'username' => $_SESSION['username'] ));
}
catch( PDOException $e ) { exit( 'PDO error ' . $e->getMessage() ); }
$user_id = $user->fetch();
$user_id = $user_id['id'];

//tražimo u kojim projektima sudjelujemo
try
{
  $db = DB::getConnection();
  $projects = $db->prepare( 'SELECT id_project FROM dz2_members WHERE id_user=:id' );
  $projects->execute(array( 'id' => $user_id ));
}
catch( PDOException $e ) { exit( 'PDO error ' . $e->getMessage() ); }

while( $project_id = $projects->fetch() )
{
  try
  {
    $db = DB::getConnection();
    $st = $db->prepare( 'SELECT id_user, title, status FROM dz2_projects WHERE id=:id' );
    $st->execute(array( 'id' => $project_id['id_project'] ));
  }
  catch( PDOException $e ) { exit( 'PDO error ' . $e->getMessage() ); }

  $row = $st->fetch();

  try
  {
    $db = DB::getConnection();
    $user = $db->prepare( 'SELECT username FROM dz2_users WHERE id=:id' );
    $user->execute(array( 'id' => $row['id_user'] ));
  }
  catch( PDOException $e ) { exit( 'PDO error ' . $e->getMessage() ); }
  $username = $user->fetch();
  $username = $username['username'];

  if($username === $_SESSION['username'])
    echo '<div class="projekt" id="moj">';
  else
    echo '<div class="projekt">';
  echo '<p id="gray">';
  echo 'Author: ' . $username . ' (status: ';
  if($row['status'] === 'open')
    echo '<span id="green"> &nbsp' . $row['status'] . ' </span>';
  else echo '<span id="red"> &nbsp' . $row['status'] . ' </span>';
  echo ')';
  echo '<p/>';

  echo '<p id="bigger">';
  echo '<a href="project.php?id=' . $row['id_user'] . '" id="bigger">' . $row['title'] . '</a>';
  echo '<p/>';
  echo '</div>';
  echo '<br>';


}

require_once 'crtaj_footer.php';

 ?>
