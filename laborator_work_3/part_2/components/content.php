<p class="test">Тоёта не ломается, а хонда???</p>
<div class="photo_car">
    <?php
    /**
     * Директория, в которой ищем изображения.
     * @var string $dir
     */
    $dir = 'image/';

    /**
     * Cписок файлов из директории $dir.
     * @var array|false $files Массив файлов в директории.
     */
    $files = scandir($dir);

    if ($files === false) {
        return; 
    }

    /**
     * Перебираем все найденные файлы и вывод изображения
     */
    for ($i = 0; $i < count($files); $i++) {
        if (($files[$i] != ".") && ($files[$i] != "..")) {
            /**
             * Полный путь к изображению
             * @var string $path
             */
            $path = $dir . $files[$i];
            ?>
            <img src="<?= $path; ?>" alt="<?= htmlspecialchars($files[$i]); ?>">
        <?php
        }
    }
    ?>
</div>
