<?php

$this->registerCssFile('http://maplemoon.ru/mapleInterface/form/form.core.css');
foreach($frames as $frame) {
    echo($frame['template']);
}

?>

<form style="display:none;" id="qwerty">
    <input type="text">
    <textarea></textarea>
    <input value="Send" type="submit">
</form>
