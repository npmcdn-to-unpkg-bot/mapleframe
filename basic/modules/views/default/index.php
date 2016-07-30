<?php
$this->registerCssFile(Yii::getAlias('@web/css/ell.css'));
?>
<div class="Ell_map">
<?php
if(!isset($map)) {
    $map = [];
}
foreach ($map as $index => $field) {
        $type = '';
        switch( $field['type'] ) {
            case '0':
                $type = 'Ell_field_ecology';
                break;
            case '1':
                $type = 'Ell_field_oil';
                break;
            case '2':
                $type = 'Ell_field_minerals';
                break;
            case '3':
                $type = 'Ell_field_oil Ell_field_minerals';
                break;
        }
    ?>
    <div class="Ell_field <?php echo 'Ell_field_' . $index . ' ' . $type; ?>">
        <?php echo $index; ?>
    </div>
<?php } ?>
</div>


<div class="ell-default-index">
    <h1><?= $this->context->action->uniqueId ?></h1>
    <p>
        This is the view content for action "<?= $this->context->action->id ?>".
        The action belongs to the controller "<?= get_class($this->context) ?>"
        in the "<?= $this->context->module->id ?>" module.
    </p>
    <p>
        You may customize this page by editing the following file:<br>
        <code><?= __FILE__ ?></code>
    </p>
</div>
