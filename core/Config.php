<?PHP

class Config
{
    public $projectName;

    public $root;

    public $imgRoot;

    public $cssRoot;

    public $jsRoot;

    public $db;

    public function __construct()
    {
        //專案名稱 - <title>
        $this->projectName = '簡易銀行系統';

        //專案目錄結構設定
        $this->root         = '/payment/';
        $this->imgRoot      = $this->root . 'views/images/';
        $this->cssRoot      = $this->root . 'views/css/';
        $this->scssRoot     = $this->root . 'views/scss/';
        $this->jsRoot       = $this->root . 'views/js/';

        //資料庫連線設定
        $this->db['host']       = 'localhost';
        $this->db['port']       = '3306';
        $this->db['username']   = 'Hackers';
        $this->db['password']   = '06071221';
        $this->db['dbname']     = 'bank';
    }
}
