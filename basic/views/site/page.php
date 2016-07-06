
<?php

/* @var $this yii\web\View */
$this->registerJsFile(Yii::getAlias('@web/js/page.js', $this::POS_END));
?>
<div class="site-index">

    <div style="display:none;" class="Mi_row">
        <div class="Mi_cell">
            <h1 class="Mi_title_i">Congratulations!</h1>
            <p class="Mi_pph lead">You have successfully created your Yii-powered application.</p>
            <p><a id="btn1" href="" class="btn btn-lg btn-success">Get started with Yii</a></p>
        </div>
    </div>

        <?php
        foreach ($page_content as $i => $part) {
            echo($part['content']);
        }
        ?>
        
        <?php /*
        <div class="Mi_row">
            <div class="Mi_cell">
                <h2 class="Mi_title_ii">Heading</h2>

                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
                    dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
                    ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu
                    fugiat nulla pariatur.</p>

                <p><a class="btn btn-default" href="http://www.yiiframework.com/doc/">Yii Documentation &raquo;</a></p>
            </div>
            <div class="Mi_cell">
                <h3 class="Mi_title_iii">Heading</h3>

                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
                    dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
                    ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu
                    fugiat nulla pariatur.</p>

                <p><a class="btn btn-default" href="http://www.yiiframework.com/forum/">Yii Forum &raquo;</a></p>
            </div>
            <div class="Mi_cell">
                <h4 class="Mi_title_iv">Heading</h2>

                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
                    dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
                    ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu
                    fugiat nulla pariatur.</p>

                <p><a class="btn btn-default" href="http://www.yiiframework.com/extensions/">Yii Extensions &raquo;</a></p>
            </div>
        </div>
        */?>

</div>
