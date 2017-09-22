<html>

<head>
    <title>Master</title>
</head>

<body>
<h1>Headers Checked!</h1>

<Span><strong>Header was checked on Url:</strong> <p><?= $url ?></p></Span>
<table border="1">
    <?php
    foreach ($header as $headerKey => $value) {
        if (is_array($value)) {
            foreach ($value as $secondElement) {
                echo "
                <tr>
                    <td><strong>$headerKey</strong></td>
                    <td><p>$secondElement</p></td>
                </tr>
                ";
            }
        } else {
            echo "  
        <tr>
            <td><strong>$headerKey</strong></td>
            <td><p>$value</p></td>
        </tr>
        ";
        }
    }
    ?>
</table>
</body>
</html>