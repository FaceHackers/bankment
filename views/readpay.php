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
                    <th class="text-left">出款</th>
                    <th class="text-left">入款</th>
                    <th class="text-left">處理日期</th>
                </tr>
            </thead>
        <tbody class="table-hover">
            <?php for ($i = 0 ; $i < count($data) ; $i++) : ?>
            <tr>
                <td class="text-left"><?=htmlspecialchars($data[$i]["account"]);?></td>
                <td class="text-left"><?=htmlspecialchars($data[$i]["dispensing"]);?></td>
                <td class="text-left"><?=htmlspecialchars($data[$i]["deposit"]);?></td>
                <td class="text-left"><?=htmlspecialchars($data[$i]["date"]);?></td>
            </tr>
            <?php endfor; ?>
        </tbody>
    </table>
    </body>
</html>