<?php
session_start();
require_once 'crtaj_header.php';
require_once 'db.class.php';

if(isset($_POST['izradi']) && isset($_POST['naslov']) && isset($_POST['broj_clanova']))
{
  if($_POST['broj_clanova'] == 1)
    $status = 'closed';
  else $status = 'open';

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

  //ubaci projekt u bazi dz2_projects
  try
  {
    $db = DB::getConnection();
    $st = $db->prepare( 'INSERT INTO dz2_projects (id_user, title, abstract, number_of_members, status)
          VALUES (:user, :title, :description, :num_of_mem, :status)' );
    $st->execute(array( 'user' => $user_id, 'title' => $_POST['naslov'], 'description' => $_POST['opis'],
          'num_of_mem' => $_POST['broj_clanova'], 'status' => $status ));
  }
  catch( PDOException $e ) { exit( 'PDO error ' . $e->getMessage() ); }

  //saznajemo id novog projekta
  try
  {
    $db = DB::getConnection();
    $project = $db->prepare( 'SELECT id FROM dz2_projects WHERE title=:title' );
    $project->execute(array( 'title' => $_POST['naslov'] ));
  }
  catch( PDOException $e ) { exit( 'PDO error ' . $e->getMessage() ); }
  $project_id = $project->fetch();
  $project_id = $project_id['id'];

  //korisnik koji je stvorio projekt je automatski član
  try
  {
    $db = DB::getConnection();
    $st = $db->prepare( 'INSERT INTO dz2_members (id_project, id_user, member_type) VALUES (:project, :user, :type)' );
    $st->execute(array( 'project' => $project_id, 'user' => $user_id, 'type' => 'member' ));
  }
  catch( PDOException $e ) { exit( 'PDO error ' . $e->getMessage() ); }

}

?>

<p id="bigger">
  You started a new project <?php echo $_POST['naslov']; ?>!
  <br>
  Congratulations!
</p>


<?php

  echo '<p id="bigger">';
  echo 'Go to the project site <a href="project.php?id=' . $project_id . '">' . $_POST['naslov'] . '</a>';
  echo '.<p/>';

require_once 'crtaj_footer.php';

 ?>
