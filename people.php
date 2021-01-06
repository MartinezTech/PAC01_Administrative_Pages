<?php
$db_hostname = 'localhost';
$db_user = 'root';
$db_passwd = 'P@ssw0rd';
$db = mysqli_connect($db_hostname, $db_user, $db_passwd) or
    die ('Unable to connect. Check your connection parameters.');

mysqli_select_db($db, 'moviesite') or die(mysqli_error($db));

if ($_GET['action'] == 'edit') {
    //retrieve the record's information 
    $query = 'SELECT
            people_id, people_fullname, people_isactor, people_isdirector
        FROM
            people
        WHERE
            people_id = ' . $_GET['id'];
    $result = mysqli_query($db, $query) or die(mysqli_error($db));
    extract(mysqli_fetch_assoc($result));
}else {
    //set values to blank
    $people_fullname = '';
    $people_isactor = '';
    $people_isdirector = '';
}


?>
<html>
<head>
    <title><?php echo ucfirst($_GET['action']); ?> People</title>
</head>
<body>
</body>
    <form action="commit.php?action=<?php echo $_GET['action']; ?>&type=people" method="post">
        <table>
            <tr>
                <td>
                    People fullname
                </td>
                <td>
                    <input type="text" name="people_fullname" value="<?php echo $people_fullname; ?>"/>
                </td>
            </tr>
            <tr>
                <td>
                    Is actor?
                </td>
                <td>
                    <select id="people_isactor" name="people_isactor">
                    <?php
                    // select the movie type information
                    $query = 'SELECT DISTINCT
                            people_isactor
                        FROM
                            people
                        ORDER BY
                            people_isactor';
                      
                    $result = mysqli_query($db, $query) or die(mysqli_error($db));

                    // populate the select options with the results
                    while ($row = mysqli_fetch_assoc($result)) {
                        
                        if ($row['people_isactor'] == $people_isactor) {
                            echo '<option value="' . $row['people_isactor'] .
                                '" selected>';
                        } else {
                            echo '<option value="' . $row['people_isactor'] . '">';
                        }
                        echo $row['people_isactor'] . '</option>';
                        
                    }
                    ?>
                     
                    </select>
                    (yes = 1) (no = 0)
                </td>
            </tr>
            <tr>
            <td>
                    Is director?
                </td>
                <td>
                    <select id="people_isdirector" name="people_isdirector">
                    <?php
                    
                    $query = 'SELECT DISTINCT
                            people_isdirector
                        FROM
                            people
                        ORDER BY
                            people_isdirector';

                      
                    $result = mysqli_query($db, $query) or die(mysqli_error($db));

                    // populate the select options with the results
                    while ($row = mysqli_fetch_assoc($result)) {
                        
                        if ($row['people_isdirector'] == $people_isdirector) {
                            echo '<option value="' . $row['people_isdirector'] .
                                '" selected>';
                        } else {
                            echo '<option value="' . $row['people_isdirector'] . '">';
                        }
                        echo $row['people_isdirector'] . '</option>';
                        
                    }
                    ?>
                     
                    </select>
                    (yes = 1) (no = 0) 
                </td>
                <td>
                    
                </td>
            </tr>
            <tr>
                <td>
                    <?php
                    if ($_GET['action'] == 'edit') {
                        echo '<input type="hidden" value="' . $_GET['id'] . '" name="people_id" />';
                    }
                    ?>
                    <input type="submit" name="submit"
                    value="<?php echo ucfirst($_GET['action']); ?>" />
                </td>
            </tr>
        </table>
    </form>
</html>