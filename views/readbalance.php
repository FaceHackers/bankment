<!DOCTYPE html>
<html>
    <head>
     <?PHP require_once('header.php'); ?>
    </head>
    <body>
        <br><br><br>
        <table class="table-fill">
            <thead>
                <tr>
                    <th class="text-left">帳號</th>
                    <th class="text-left">餘額</th>
                </tr>
            </thead>
        <tbody class="table-hover">
        <?php $row = $data;?>
            <tr>
                <td class="text-left"><?=htmlspecialchars($row["account"]);?></td>
                <td class="text-left"><?=htmlspecialchars($row["balance"]);?></td>
            </tr>
        </tbody>
    </table>
    </body>
</html>
