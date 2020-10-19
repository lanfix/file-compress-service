<?php

use yii\web\View;

/**
 * @var View $this
 * @var string[] $imagesList
 */

?>
<div class="container">
    <h1>Всего изображений: <?= count($imagesList) ?></h1>
</div>
<div class="container">
    <?php foreach ($imagesList as $image): ?>
        <div class="img-node">
            <img data-name="<?= $image ?>">
        </div>
    <?php endforeach; ?>
</div>
<?php
$this->registerJs(<<<JS
$(function () {
    /**
    * Заранее извиняюсь за мой ужасный джс.
    * Я backend developer, а не фулстек.
    */
    let target = '/generator.php';
    $('.img-node img').each(function() {
        let node = $(this);
        let imageName = node.attr('data-name');
        let targetFull = target + '?name=' + imageName + '&size=mic';
        node.attr('src', targetFull);
    });
    $(document).on('mouseup', function(e) {
        let gallery = $('#gallery');
        if (!gallery.is(e.target) && gallery.has(e.target).length === 0) {
			gallery.remove();
		}
    });
    $(document).on('click', '.img-node img', function(e) {
        let imageName = $(this).attr('data-name');
        $('body').append(`<div id="gallery"></dev>`);
        if ($(window).width() <= 479) {
            // Для мобильных устройств не показываем big
            $('#gallery').append(`
                <h3>Размер <code>med</code></h3>
                <div><img src="\${target}?name=\${imageName}&size=med"></div>
                <h3>Размер <code>min</code></h3>
                <div><img src="\${target}?name=\${imageName}&size=min"></div>
                <h3>Размер <code>mic</code></h3>
                <div><img src="\${target}?name=\${imageName}&size=mic"></div>
            `);
        } else {
            // Для PC не показываем mic
            $('#gallery').append(`
                <h3>Размер <code>big</code></h3>
                <div><img src="\${target}?name=\${imageName}&size=big"></div>
                <h3>Размер <code>med</code></h3>
                <div><img src="\${target}?name=\${imageName}&size=med"></div>
                <h3>Размер <code>min</code></h3>
                <div><img src="\${target}?name=\${imageName}&size=min"></div>
            `);
        }
        $('#gallery').css({
            left: ($(window).width() - $('#gallery').width()) / 2 + 'px'
        });
    });
});
JS);
$this->registerCss(<<<CSS
body {
    margin: 0;
    padding: 0;
    position: relative;
}
.container h1 {
    font-size: 24px;
    padding: 40px 0;
    margin: 0;
}
.container {
    margin: 0 auto;
    width: 630px;
    font-size: 0;
}
.container .img-node {
    display: inline-block;
    width: 150px;
    height: 150px;
    text-align: center;
    margin: 0 10px 10px 0;
    overflow: hidden;
    font-size: 0;
}
.container .img-node:nth-child(4n) {
    margin-right: 0;
}
.container .img-node img {
    max-width: 100%;
    max-height: 100%;
    cursor: pointer;
}
#gallery {
    max-width: 100vw;
    min-width: 800px;
    min-height: 200px;
    position: absolute;
    top: 100px;
    background: #CCC;
    box-sizing: border-box;
    padding: 30px;
}
CSS);
?>
