<html>
<body>
<?php
if ($isCollection) {
    foreach ($resource as $key => $entity) {
        foreach ($entity as $key => $collection) {
            echo '<table>';
            foreach ($collection as $key => $value) {
                echo "<tr><td>$key</td> <td>$value</td></tr>";
            }
            echo '</table></br>';
        }
    }
} else {
    foreach ($resource as $key => $value) {
        echo "<table><tr><td>$key</td> <td>$value</td></tr></table>";
    }
}
?>
</body>
</html>