<?php 

namespace app\components;

class Core {
    static function pre($param) {
        echo '<div style="padding:80px 40px 0 40px;" class="Mi_pre_layout"><pre class="Mi_pre">';
        print_r($param);
        echo '</pre></div>';
    }
}

?>