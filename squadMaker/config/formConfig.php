<?php
return [
    'FormTemplates' => [
        'default' => [
            'button' => '<button type="{{type}}" class="btn btn-primary my-2">{{text}}</button>',
        ],
        'file' => [
            'inputContainer' => '<div class="custom-file">{{content}}</div>',
            'label' => '<label class="custom-file-label"{{attrs}}>{{text}}</label>',
            'file' => '<input type="file" name="{{name}}" class="custom-file-input"{{attrs}}>',
            'button' => '<button type="{{type}}" class="btn btn-primary my-2">{{text}}</button>',
        ]
    ]
];
