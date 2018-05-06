<?php
return [
    'FormTemplates' => [
        'default' => [
            'error' => '<div class="help-block">{{content}}</div>',
            'input' => '<input type="{{type}}" name="{{name}}" class="form-control"{{attrs}}>',
            'textarea' => '<div class="form-group"><textarea name="{{name}}" class="form-control"{{attrs}}>{{value}}</textarea></div>',
            'inputSubmit' => '<input type="{{type}}" class="btn btn-primary btn-block"{{attrs}}>',
            'inputContainer' => '<div class="form-group">{{content}}</div>',
            'inputContainerError' => '<div class="form-group has-error">{{content}}{{error}}</div>',
            'label' => '<label {{attrs}}><strong>{{text}}</strong></label>',
            'select' => '<select name="{{name}}" class="form-control"{{attrs}}>{{content}}</select>',
            'submitContainer' => '{{content}}'
        ],
        'file' => [
            'inputContainer' => '<div class="custom-file">{{content}}</div>',
            'label' => '<label class="custom-file-label"{{attrs}}>{{text}}</label>',
            'file' => '<input type="file" name="{{name}}" class="custom-file-input"{{attrs}}>',
            'button' => '<button type="{{type}}" class="btn btn-primary my-2">{{text}}</button>',
        ]
    ]
];
