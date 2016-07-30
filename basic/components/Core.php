<?php

namespace app\components;

class Core {
    static function Q($param, $title = '') {
        echo '<div style="padding:10px;" class="Mi_pre_layout"><div style="font-family:Courier new;">'.$title.'</div><pre class="Mi_pre">';
        print_r($param);
        echo '</pre></div>';
    }
    static function is_integer($number) {
        return is_numeric($number) || (is_string($number) && $number === (string)((int)$number) );
    }
}

?>