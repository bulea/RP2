<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>TeamUp!</title>
  </head>
  <style>
    h1
    {
      text-align: center;
      font-size: 40px;
      background-color: #01A9DB;
      padding-top: 30px;
    }
    .right
    {
      text-align: right;
      font-size: 25px;
      background-color: #01A9DB;
      color: white;
      padding-right: 100px;
      padding-bottom: 40px;
    }
    .link
    {
      font-size: 25px;
      padding-left: 10%;
      padding-right: 10%;
    }
    .projekt
    {
      padding: 1%;
      font-size: 20px;
      border-style: solid;
      border-width: 2px;
      border-color: #3E3F3E;
    }
    #gray
    {
      color: gray;
    }
    #bigger
    {
      font-size: 25px;
    }
    #green
    {
      background-color: #1A9E27;
      color: white;
    }
    #red
    {
      background-color: #DC2525;
      color: white;
    }
    #tekst
    {
      font-size: 23px;
      color: #3E3F3E;
    }
    #moj
    {
      background-color: #E3F25C;
    }


  </style>
  <body>
    <div class="right">
      <h1>TeamUp</h1>
      <?php echo "" . $_SESSION['username']; ?>
      <br>
      <a href="logout.php">logout</a>
    </div>

    <br><br>

    <div class="traka">
      <a href="all_projects.php" class="link">All projects</a>
      <a href="my_projects.php" class="link">My projects</a>
      <a href="new_project.php" class="link">Start a new project</a>
    </div>

    <br><br>
