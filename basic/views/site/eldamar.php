<?php

$this->registerCssFile('http://maplemoon.ru/mapleInterface/global/global.core.css');
$this->registerCssFile('http://maplemoon.ru/mapleInterface/form/form.core.css');
$this->registerCssFile('http://maplemoon.ru/mapleInterface/table/table.core.css');
$this->registerCssFile('http://maplemoon.ru/mapleInterface/btns/btns.core.css');
foreach($frames as $index => $frame) {
    echo($frame['template']);
}
?>