<?php

return [
'required' => 'Поле «:attribute» обязательно.',
'string'   => 'Поле «:attribute» должно быть строкой.',
'image'    => 'Поле «:attribute» должно быть изображением.',
'max'      => [
    'string' => 'Длина «:attribute» не должна превышать :max симв.',
    'file'   => 'Размер «:attribute» не должен быть больше :max Кб.',
],

'attributes' => [
    'title'      => __('messages.title'),
    'content'    => __('messages.content'),
    'locale'   => __('messages.locale'),
    'image_file' => __('messages.image'),
],

];