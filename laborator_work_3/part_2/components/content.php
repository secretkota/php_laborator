
<p class="test">Тоёта не ломается, а хонда???</p>
<div class="photo_car">
    <?php
        $dir = 'image/';
        $files = scandir($dir);

    if ($files === false) {
        return;
    }

    for ($i =0; $i < count($files); $i++){
        if (($files[$i] != ".") && ($files[$i] != "..")){
            $path = $dir . $files[$i]; ?>
            <img src="<?= $path; ?>" alt="<?= $files[$i]; ?>">
    <?php

        }
    }?>
</div>