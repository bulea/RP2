<?php
session_start();
require_once 'crtaj_header.php';
require_once 'db.class.php';


if(isset($_GET['id'])){
  $id = $_GET['id'];
}

try
{
  $db = DB::getConnection();
  $st = $db->prepare( 'SELECT id, id_user, title, abstract, status, number_of_members FROM dz2_projects WHERE id=:id' );
  $st->execute(array( 'id' => $id ));
}
catch( PDOException $e ) { exit( 'PDO error ' . $e->getMessage() ); }

$project = $st->fetch();

try
{
  $db = DB::getConnection();
  $user = $db->prepare( 'SELECT username FROM dz2_users WHERE id=:id' );
  $user->execute(array( 'id' => $project['id_user'] ));
}
catch( PDOException $e ) { exit( 'PDO error ' . $e->getMessage() ); }
$username = $user->fetch();
$username = $username['username'];

  echo '<div class="projekt">';
  echo '<p id="gray"> Author: ';
  echo '<span id="red"> &nbsp' . $username . ' </span><br>';
  echo '<p/>';

  echo '<p id="bigger">';
  echo $project['title'];
  echo '<p/>';

  echo '<span id=gray> Description: </span><br>';
  echo '<span id=tekst>' . $project['abstract'] . '</span><br>';

  echo '<br>';
  echo '<span id=gray> Members: </span>';

  try
  {
    $db = DB::getConnection();
    $members = $db->prepare( 'SELECT id_user FROM dz2_members WHERE id_project=:id' );
    $members->execute(array( 'id' => $project['id'] ));
  }
  catch( PDOException $e ) { exit( 'PDO error ' . $e->getMessage() ); }

  $clan = 0;
  while($member = $members->fetch())
  {
    try
    {
      $db = DB::getConnection();
      $user = $db->prepare( 'SELECT username FROM dz2_users WHERE id=:id' );
      $user->execute(array( 'id' => $member['id_user'] ));
    }
    catch( PDOException $e ) { exit( 'PDO error ' . $e->getMessage() ); }
    $membername = $user->fetch();
    $membername = $membername['username'];

    if($membername === $_SESSION['username'])
      $clan = 1;

    if($membername !== $username)
      echo '<span id="red"> &nbsp' . $membername . '&nbsp</span> ';
  }
  echo '<span id=gray> (largest team size: ' . $project['number_of_members'] . ') </span><br>';

  if($clan === 0 && $project['status'] === 'open')
  {
    echo '<form action="novi_clan.php?id=' . $project['id'] . '" method="post">';
    echo '<button type="submit" name="apply"> Apply for this project! </button>';
    echo '</form>';
    echo '<br>';
  }

  echo '</div>';
  echo '<br>';


require_once 'crtaj_footer.php';

 ?>
