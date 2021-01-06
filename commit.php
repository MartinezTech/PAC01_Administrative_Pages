<?php
$db_hostname = 'localhost';
$db_user = 'root';
$db_passwd = 'P@ssw0rd';
$db = mysqli_connect($db_hostname, $db_user, $db_passwd) or
    die ('Unable to connect. Check your connection parameters.');

mysqli_select_db($db, 'moviesite') or die(mysqli_error($db));

?>
<html>
 <head>
  <title>Commit</title>
 </head>
 <body>
<?php
switch ($_GET['action']) {
    
case 'add':
    switch ($_GET['type']) {
    case 'movie':
        $query = 'INSERT INTO
            movie
                (movie_name, movie_year, movie_type, movie_leadactor,
                movie_director)
            VALUES
                ("' . $_POST['movie_name'] . '",
                 ' . $_POST['movie_year'] . ',
                 ' . $_POST['movie_type'] . ',
                 ' . $_POST['movie_leadactor'] . ',
                 ' . $_POST['movie_director'] . ')';
        break;
    
    }
    case 'people':
        $isactor = intval($_POST['people_isactor']);
        $isdirector = intval($_POST['people_isdirector']);
        $query =    'INSERT INTO people (people_isactor, people_isdirector, people_fullname)
                    VALUES
                        (' . $isactor . ', ' . $isdirector . ', "'. $_POST['people_fullname'].'")';
        break;
    break;
case 'edit':
    switch ($_GET['type']) {
    case 'movie':
        $query = 'UPDATE movie SET
                movie_name = "' . $_POST['movie_name'] . '",
                movie_year = ' . $_POST['movie_year'] . ',
                movie_type = ' . $_POST['movie_type'] . ',
                movie_leadactor = ' . $_POST['movie_leadactor'] . ',
                movie_director = ' . $_POST['movie_director'] . '
            WHERE
                movie_id = ' . $_POST['movie_id'];       
        break;
    case 'people':
        $isactor = intval($_POST['people_isactor']);
        $isdirector = intval($_POST['people_isdirector']);
        $people_id = intval($_POST['people_id']);
        $query =    'UPDATE people SET
                        people_isactor = '. $isactor .',
                        people_isdirector = '. $isdirector .',
                        people_fullname = "' . $_POST['people_fullname'] . '"  
                    WHERE
                        people_id = '. $people_id;

        break;
   

    }

    break;
}

if (isset($query)) {
    $result = mysqli_query($db, $query) or die(mysqli_error($db));
}
?>
  <p>Done!</p>
  <a href="admin.php">Return to Index</a></p>
 </body>
</html>
