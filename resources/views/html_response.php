<html>
<body>

<table>
        <?php
        foreach ($resource->toArray() as $key => $value) {
            echo "<tr><td>$key</td> <td>$value</td></tr>";
        }
        ?>
</table>

</br>
</br>
</br>

<table>
    <thead>
    <td>Header</td>
    <td>Value</td>
    </thead>
    <tbody>
    <?php
    foreach ($resource->responses as $response) {
        ?>
        <?php foreach ($response->responseHeaders as $responseHeader) { ?>

            <tr>
                <td><?= $responseHeader->name ?></td>
                <td><?= $responseHeader->value ?></td>
            </tr>
            <?php
        }
    }
    ?>
    </tbody>
</table>

</body>

</html>