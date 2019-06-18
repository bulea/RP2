<?php
  session_start();
  if(isset($_POST['Početak']))
  {
    $ime = $_SESSION['ime'];
    $osmo = $_SESSION['osmo'];
    session_unset();
    session_destroy();
    session_start();
    $_SESSION['ime'] = $ime;
    $_SESSION['osmo'] = $osmo;
    $_SESSION['broj_pokusaja'] = -1;
  }
  inicijaliziraj_igru();
  odigraj_potez();
  if(isset($_SESSION['broj_pogodenih']) && isset($_SESSION['broj_rijeci']) &&
          $_SESSION['broj_pogodenih'] === $_SESSION['broj_rijeci'])
  {
    session_unset();
    session_destroy();
    ispisi_cestitku();
  }
  else
    crtaj_plocu();

 ?>

<?php
function inicijaliziraj_igru()
{
  if(!isset($_SESSION['ploca']))
  {
    if(isset($_POST['ime']))
      $_SESSION['ime'] = $_POST['ime'];
    if(!isset($_SESSION['broj_pokusaja']))
      $_SESSION['broj_pokusaja'] = 0;
    $_SESSION['poruka_za_ispis'] = '';
    $_SESSION['pogodene_rijeci'] = array();
    $_SESSION['broj_pogodenih'] = 0;
    $_SESSION['zadnja_pogodena'] = '';

    if((isset($_POST['osmo']) && $_POST['osmo'] === 'Osmosmjerka1') ||
        (isset($_SESSION['osmo']) && $_SESSION['osmo'] === 'Osmosmjerka1'))
    {
      $_SESSION['osmo'] = 'Osmosmjerka1';
      $_SESSION['ploca'] =
        [
            ['P', 'A', 'T', 'K', 'A'],
            ['E', 'I', 'S', 'O', 'N'],
            ['V', 'P', 'S', 'L', 'I'],
            ['A', 'A', 'V', 'M', 'A'],
            ['S', 'L', 'O', 'V', 'O']
        ];
      $_SESSION['boja'] =
        [
            [0, 0, 0, 0, 0],
            [0, 0, 0, 0, 0],
            [0, 0, 0, 0, 0],
            [0, 0, 0, 0, 0],
            [0, 0, 0, 0, 0]
        ];
      $_SESSION['rijeci'] = array('PATKA', 'PISMO', 'SAVE', 'NOSI', 'OSA', 'SLOVO');
      $_SESSION['broj_rijeci'] = 6;
      $_SESSION['dimenzija'] = 5;
    }

    else if((isset($_POST['osmo']) && $_POST['osmo'] === 'Osmosmjerka2') ||
        (isset($_SESSION['osmo']) && $_SESSION['osmo'] === 'Osmosmjerka2'))
    {
      $_SESSION['osmo'] = 'Osmosmjerka2';
      $_SESSION['ploca'] =
        [
            ['M', 'A', 'G', 'A', 'R', 'A', 'C', 'P'],
            ['A', 'L', 'O', 'S', 'O', 'S', 'E', 'U'],
            ['J', 'I', 'R', 'I', 'B', 'A', 'Z', 'Z'],
            ['M', 'G', 'O', 'R', 'A', 'N', 'J', 'R'],
            ['U', 'A', 'S', 'R', 'D', 'E', 'L', 'A'],
            ['N', 'T', 'O', 'K', 'E', 'L', 'A', 'B'],
            ['J', 'O', 'N', 'U', 'Z', 'E', 'V', 'A'],
            ['M', 'R', 'A', 'V', 'O', 'J', 'E', 'D']
        ];
        $_SESSION['boja'] =
          [
              [0, 0, 0, 0, 0, 0, 0, 0],
              [0, 0, 0, 0, 0, 0, 0, 0],
              [0, 0, 0, 0, 0, 0, 0, 0],
              [0, 0, 0, 0, 0, 0, 0, 0],
              [0, 0, 0, 0, 0, 0, 0, 0],
              [0, 0, 0, 0, 0, 0, 0, 0],
              [0, 0, 0, 0, 0, 0, 0, 0],
              [0, 0, 0, 0, 0, 0, 0, 0]
          ];
      $_SESSION['rijeci'] = array('ALIGATOR', 'DABAR', 'JELEN', 'LAV', 'LOSOS', 'MAGARAC', 'MAJMUN', 'MRAVOJED', 'NOJ',
                                  'NOSOROG', 'OBAD', 'PUZ', 'RIBA', 'RIS', 'SRDELA', 'ZEC', 'VUK');

      $_SESSION['broj_rijeci'] = 17;
      $_SESSION['dimenzija'] = 8;
    }
  }
}

  function crtaj_plocu()
  {
    ?>
    <!DOCTYPE html>
    <html>
      <head>
        <meta charset="utf-8">
        <title> Osmosmjerka! </title>
        <style>table, th, td
              {
                border: solid 0.5px;
                font-size: 30px;
                text-align: center;
              }
              #yellowword
              {
                background-color: yellow;
                text-decoration: line-through;
              }
              #greenword
              {
                background-color: green;
                text-decoration: line-through;
              }
              #yellowfield
              {
                background-color: yellow;
              }
              #greenfield
              {
                background-color: green;
              }
        </style>
      </head>
      <body>
      <h1> Osmosmjerka! </h1>
      <br>
      Igrač: <?php echo htmlentities( $_SESSION['ime'], ENT_QUOTES );?>
      <br>
      Broj pokušaja: <?php echo $_SESSION['broj_pokusaja']; ?>
      <br>
      <br>
      <table>
    		<?php
    			for( $red = 0; $red < $_SESSION['dimenzija']; ++$red )
    			{
    				echo "<tr>";
    				for( $stup = 0; $stup < $_SESSION['dimenzija']; ++$stup )
            {
              if($_SESSION['boja'][$red][$stup] == 2)
    					     echo "<td id = greenfield>" . $_SESSION['ploca'][$red][$stup] . "</td>";
              else if($_SESSION['boja'][$red][$stup] == 1)
         			     echo "<td id = yellowfield>" . $_SESSION['ploca'][$red][$stup] . "</td>";
              else
                  echo "<td>" . $_SESSION['ploca'][$red][$stup] . "</td>";
            }
    				echo "</tr>";
    			}
    		?>
	    </table>
      <br>
      <br>
      <?php
      if(isset($_SESSION['poruka_za_ispis']))
        echo $_SESSION['poruka_za_ispis'] . '<br>';
       ?>

      Pronađi riječ s popisa:
      <?php
        for ($i=0; $i < $_SESSION['broj_rijeci']; $i++)
        {
          if(strcmp($_SESSION['rijeci'][$i], $_SESSION['zadnja_pogodena']) == 0)
            echo "<span id = greenword>" . $_SESSION['rijeci'][$i] . "</span> ";
          else if(in_array($_SESSION['rijeci'][$i], $_SESSION['pogodene_rijeci']))
            echo "<span id = yellowword>" . $_SESSION['rijeci'][$i] . "</span> ";
          else
            echo $_SESSION['rijeci'][$i] . " ";
        }

       ?>
       <br>
       <br>
       <form action="osmo.php" method="post">
         Našao sam riječ:
         <input type="text" name="nova_rijec">
         <br>
         Prvo slovo je u redu
         <select name="redak">
              <?php
                  for ($i=1; $i <= $_SESSION['dimenzija']; $i++)
                      echo '<option value="' . $i . '">' . $i . '</option>';
               ?>
         </select>
         i u stupcu
         <select name="stupac">
              <?php
                  for ($i=1; $i <= $_SESSION['dimenzija']; $i++)
                      echo '<option value="' . $i . '">' . $i . '</option>';
               ?>
         </select>

         <br>
         <br>
         <button type="submit" name="Oznaci"> Označi pronađenu riječ! </button>
         <button type="submit" name="Početak"> Hoću sve ispočetka! </button>
       </form>
      </body>
      </html>
  <?php

  }



  function odigraj_potez()
  {
    if(isset($_POST['nova_rijec']))
    {
      $pokusaj = $_POST['nova_rijec'];
      $red = $_POST['redak']-1;
      $stup = $_POST['stupac']-1;
      $zast1 = -1;
      $zast2 = -1;
      $zast3 = -1;

      $_SESSION['broj_pokusaja']++;
      for($i = 0; $i < $_SESSION['dimenzija']; ++$i)
      {
        for($j = 0; $j < $_SESSION['dimenzija']; ++$j)
        {
          if($_SESSION['boja'][$i][$j] === 2)
            $_SESSION['boja'][$i][$j] = 1;
        }
      }
      $_SESSION['zadnja_pogodena'] = '';

      for ($i = 0; $i < $_SESSION['broj_rijeci']; ++$i)
      {
          if(strcmp($pokusaj, $_SESSION['rijeci'][$i]) == 0)
            $zast1 = $i;
      }

      if($zast1 === -1)
      {
        $_SESSION['poruka_za_ispis'] = 'Riječ nije na popisu!';
      }
      if($zast1 != -1 && in_array($pokusaj, $_SESSION['pogodene_rijeci']))
      {
        $_SESSION['poruka_za_ispis'] = 'Riječ je već pronađena';
        $zast3 = 1;
      }

      if($zast1 != -1 && $zast3 != 1)
      {
        if (provjeri_rijec(-1, 0) == 1 || provjeri_rijec(1, 0) == 1 ||
            provjeri_rijec(0, -1) == 1 || provjeri_rijec(0, 1) == 1 ||
            provjeri_rijec(-1, -1) == 1 || provjeri_rijec(1, 1) == 1 ||
            provjeri_rijec(-1, 1) == 1 || provjeri_rijec(1, -1) == 1)
            $zast2 = 1;

        if($zast2 === -1)
          $_SESSION['poruka_za_ispis'] = 'Riječ nije na pravom mjestu!';
        else if($zast1 != -1 && $zast2 != -1)
          $_SESSION['poruka_za_ispis'] = 'Riječ je pronađena!';
      }
    }
  }

  function provjeri_rijec($ld, $gd)
  {
    $pokusaj = $_POST['nova_rijec'];
    $red = $_POST['redak']-1;
    $stup = $_POST['stupac']-1;
    $brojac = 0;
    while($red >= 0 && $red < $_SESSION['dimenzija'] &&
        $stup >= 0 && $stup < $_SESSION['dimenzija'] && isset($pokusaj[$brojac]))
    {
        if(strcmp($pokusaj[$brojac], $_SESSION['ploca'][$red][$stup]) == 0)
        {
          $red+=$gd; $stup+=$ld;

          $brojac++;
        }
        else break;
    }
    if($brojac === strlen($pokusaj))
    {
      $_SESSION['pogodene_rijeci'][$_SESSION['broj_pogodenih']] = $pokusaj;
      $_SESSION['broj_pogodenih']++;
      $_SESSION['zadnja_pogodena'] = $pokusaj;
      $red-=$gd; $stup-=$ld;
      while($red != $_POST['redak']-1 || $stup != $_POST['stupac']-1)
      {
        $_SESSION['boja'][$red][$stup] = 2;
        $red-=$gd; $stup-=$ld;
      }
      $_SESSION['boja'][$red][$stup] = 2;
      $red-=$gd; $stup-=$ld;
      return 1;
    }
    return 0;
  }

  function ispisi_cestitku()
  {
    ?>
      <!DOCTYPE html>
      <html>
        <head>
          <meta charset="utf-8">
          <title> Osmosmjerka </title>
        </head>
        <body>
          <h1> Osmosmjerka! </h1>
          <h4> Čestitam! Osmosmjerka je uspješno riješena! </h4>
          <br>
          <br>
          <form action="pocetna.php" method="post">
            <button type="submit" name="Ponovo"> Probaj ponovo! </button>
          </form>

        </body>
      </html>
    <?php
  }

  ?>
