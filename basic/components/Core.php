<?php 

namespace app\components;

class Core {
    static function Q($param) {
        echo '<div style="padding:10px;" class="Mi_pre_layout"><pre class="Mi_pre">';
        print_r($param);
        echo '</pre></div>';
    }
    static function isNumber($number) {
        return is_numeric($number) || (is_string($number) && $number === (string)((int)$number) );
    }
}

?>