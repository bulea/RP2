<?php
session_start();
require_once 'crtaj_header.php';
require_once 'db.class.php';


if(isset($_POST['apply']))
{
  if(isset($_GET['id'])){
    $id = $_GET['id'];
  }

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

  //ubaci novog membera
  try
  {
    $db = DB::getConnection();
    $st = $db->prepare( 'INSERT INTO dz2_members (id_project, id_user, member_type) VALUES (:project, :user, :type)' );
    $st->execute(array( 'project' => $id, 'user' => $user_id, 'type' => 'member' ));
  }
  catch( PDOException $e ) { exit( 'PDO error ' . $e->getMessage() ); }

  //dohvati ukupan broj membera
  $num = 0;
  try
  {
    $db = DB::getConnection();
    $members = $db->prepare( 'SELECT id_user FROM dz2_members WHERE id_project=:id_project' );
    $members->execute(array( 'id_project' => $id ));
  }
  catch( PDOException $e ) { exit( 'PDO error ' . $e->getMessage() ); }

  while($member = $members->fetch())
    $num++;

  //provjeri treba li promijeniti status projekta
  try
  {
    $db = DB::getConnection();
    $mem = $db->prepare( 'SELECT number_of_members FROM dz2_projects WHERE id=:id' );
    $mem->execute(array( 'id' => $id ));
  }
  catch( PDOException $e ) { exit( 'PDO error ' . $e->getMessage() ); }
  $num_mem = $mem->fetch();
  $num_mem = $num_mem['number_of_members'];


  if($num == $num_mem)
  {
    try
    {
      $db = DB::getConnection();
      $mem = $db->prepare( 'UPDATE dz2_projects SET status =:status WHERE id=:id' );
      $mem->execute(array( 'id' => $id, 'status' => 'closed' ));
    }
    catch( PDOException $e ) { exit( 'PDO error ' . $e->getMessage() ); }
  }

  //dohvati naslov projekta za ispis
  try
  {
    $db = DB::getConnection();
    $st = $db->prepare( 'SELECT title FROM dz2_projects WHERE id=:id' );
    $st->execute(array( 'id' => $id ));
  }
  catch( PDOException $e ) { exit( 'PDO error ' . $e->getMessage() ); }

  $project = $st->fetch();
  $title = $project['title'];

}
?>

<p id="bigger">
  You became a member of the project <?php echo $title; ?>!
  <br>
  Congratulations!
</p>


<?php

echo '<p id="bigger">';
echo 'Go back to the project site <a href="project.php?id=' . $id . '">' . $title . '</a>';
echo '.<p/>';

require_once 'crtaj_footer.php';

 ?>
