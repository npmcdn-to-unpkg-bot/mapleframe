<?php 

namespace app\components;

class Core {
    static function pre($param) {
        echo '<div class="Mi_pre_layout"><pre class="Mi_pre">';
        print_r($param);
        echo '</pre></div>';
    }
}

?>