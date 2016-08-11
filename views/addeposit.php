<!DOCTYPE html>
<html>
    <head>
    <?PHP require_once('header.php'); ?>
    </head>
    <body>
    <?php $row = $data;?>
    <div id="wrapper">

    <h1>戶頭存款</h1>

    <form method="post" name="form" action="addEposit">
     <div class="col-2">
        <label>
             戶頭帳號
             <input type="text"  id="account" name="account" readonly value="<?=htmlspecialchars($row["account"]);?>" tabindex="2">
        </label>
     </div>
    <div class="col-2">
        <label>
             存款金額
             <input type="number" placeholder="金額" id="eposit" name="eposit"  tabindex="1" autocomplete="off"  required>
        </label>
     </div>
    <div class="col-submit">
        <button class="submitbtn" name="insert">確定存款</button>
    </div>
  </form>
  </div>
  <script type="text/javascript">
    var elems = Array.prototype.slice.call(document.querySelectorAll('.js-switch'));
    elems.forEach(function(html) {
    var switchery = new Switchery(html);
    });
  </script>
</body>
</html>