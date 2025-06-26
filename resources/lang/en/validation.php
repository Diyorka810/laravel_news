<?php

return [
'required' => 'Field «:attribute» is required.',
'string'   => 'Field «:attribute» must be a string.',
'image'    => 'Field «:attribute» must be an image.',
'max'      => [
    'string' => 'Length «:attribute» must be less than :min chars.',
    'file'   => 'Size «:attribute» must be less than :max Kb.',
],

'attributes' => [
    'title'      => __('messages.title'),
    'content'    => __('messages.content'),
    'locale'   => __('messages.locale'),
    'image_file' => __('messages.image'),
],
'custom' => [
        'user_name' => [
            'unique' => __('messages.username_taken'),
        ],
        'email' => [
            'unique' => __('messages.email_taken'),
        ],
    ],

];