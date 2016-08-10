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
                    <th class="text-left" colspan="4">功能</th>
                </tr>
            </thead>
        <tbody class="table-hover">
            <?php for ($i = 0 ; $i < count($data) ; $i++) : ?>
            <tr>
                <td class="text-left"><?=htmlspecialchars($data[$i]["account"]);?></td>
                <td class="text-left" ><a href="readeposit?show_id=<?=htmlspecialchars($data[$i]["account"]);?>">存款</a></td>
                <td class="text-left" ><a href="readispensing?show_id=<?=htmlspecialchars($data[$i]["account"]);?>">提款</a></td>
                <td class="text-left" ><a href="readbalance?show_id=<?=htmlspecialchars($data[$i]["account"]);?>">查看餘額</a></td>
                <td class="text-left" ><a href="readpay?show_id=<?=htmlspecialchars($data[$i]["account"]);?>">帳目明細</a></td>
            </tr>
            <?php endfor; ?>
        </tbody>
    </table>
    </body>
</html>
