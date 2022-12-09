<?php
use branchonline\lightbox\Lightbox;

echo Lightbox::widget([
    'files' => [
        [
            'thumb' => '/' . $model->thmb,
            'original' => '/' . $model->name,
            //'title' => 'optional title',
        ],
    ]
]);

?>