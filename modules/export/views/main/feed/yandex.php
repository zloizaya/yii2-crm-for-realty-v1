<?php
use yii\widgets\ListView;
$date = date('c');
?>
<realty-feed xmlns="http://webmaster.yandex.ru/schemas/feed/realty/2010-06">
    <generation-date><?= $date ?></generation-date>
<?= ListView::widget([
    'dataProvider' => $dataProvider,
    'itemOptions' => ['tag' => false],
    'options' => ['tag' => false],
    'itemView' => '/main/tmpl/_yaList',
    'summary' => false,
]) ?>
</realty-feed>