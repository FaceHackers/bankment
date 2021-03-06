目標
===
撰寫一個簡易銀行系統，不同使用者有自己的餘額和明細，可出款、入款、查看餘額和帳目明細。另外須達成以下四項要求


要求
---
1. 程式撰寫命名與風格(Coding style)務必一致。可參考PHP-FIG網站
2. 確保同一使用者可”同時”進行出入款且餘額計算無誤。可用兩台電腦同時按送出測試問題。可搜尋Race condition進一步了解問題
3. 善加利用Git版本控制，務必讓每個commit清楚明瞭，讓評分者可以快速瞭解所有修改歷程與內容

  a. commit 說明務必簡單明瞭，可讓人一眼看出內容修改了什麼

  b. 一個 commit只做一件事，或只完成一個小段落，避免大量不同方面修改在同一個 commit 裡

4. 請注意Injection等資訊安全問題。帳號登入問題可以忽略

MySQL 交易功能 Transaction 說明
---
資料庫的交易(Transaction)功能，能確保多個 SQL 指令，全部執行成功，或全部不執行，不會因為一些意外狀況，而只執行一部份指令，造成資料異常。


LOCK IN SHARE MODE (加共享鎖)
---
 1. 在 select 過程遇到的資料列加上共享鎖。
 2. 加上共享鎖的資料，其他連線還是能讀取。
 3. 加上共享鎖的資料，也允許其他連線再執行 select ... lock in share mode

[情況1] 有一交易A正在進行中，並異動某些資料列，例如 update ...where id=1，但尚未commit。
一般情形，其他連線 select...where id=1，會立即得到資料。但其他連線若下達 select...where id=1 lock in share mode，則須等交易A執行 commit 後，結果才會出來。

FOR UPDATE (加排它鎖)
---
1. 在遇到的資料列加上排他鎖。
2. 加上排他鎖的資料，其他連線能用普通的 select ... 讀取鎖定的資料，但不能用 select ... lock in share mode 讀取鎖定的資料 ( select ... from ... for update 當然也不行)。
3. 所以排他鎖跟共享鎖主要的差異，在於是否允許其他連線使用 select ... lock in share mode 讀取鎖定的資料。
