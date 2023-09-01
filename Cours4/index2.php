<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <table>
    <tr>
            <td>
                1
            </td>
            <td>
                Honda
            </td>
            <td>
                Red
            </td>
            <td>
                1992
            </td>
            <td>
                <a href="modifier.php?id=<?php echo $_POST["id"] ?>">M</a>
            </td>
            <td>
                <a href="supprimer.php?id=<?php echo $_POST["id"] ?>">M</a>
            </td>
        </tr>
    </table>
</body>
</html>