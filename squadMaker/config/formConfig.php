<?php
return [
    'FormTemplates' => [
        'default' => [
            'inputContainer' => '<div class="form-group">{{content}}</div>',
            'input' => '<input type="{{type}}" name="{{name}}" class="form-control"{{attrs}} />',
            'label' => '<label{{attrs}}>{{text}}</label>',
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
