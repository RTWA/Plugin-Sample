<?php

namespace WebApps\Plugin;

use App\Models\Plugin;

class sample_Plugin extends Plugin
{
    public $name;
    public $icon;
    public $version;
    public $author;

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $plugin = json_decode(file_get_contents(__DIR__ . '/plugin.json'), true);
        $this->name = $plugin['name'];
        $this->icon = $plugin['icon'];
        $this->version = $plugin['version'];
        $this->author = $plugin['author'];
    }

    public $options = [
        'message' => [
            'type' => 'text',
            'label' => 'Enter the sample message',
            'maxlength' => 255,
            'required' => true
        ]
    ];

    public $new = [
        'message' => ''
    ];

    public $preview = '<h1 data-val="value.message" />';

    public function output($edit = false)
    {
        $this->edit = $edit;
        ob_start();
        require('include/_html.php');
        $html = str_replace(["\r", "\n", "\t"], '', trim(ob_get_clean()));
        $html = preg_replace('/(\s){2,}/s', '', $html);
        return $html;
    }

    public function style()
    {
        return file_get_contents(__DIR__.'/include/_style.css');
    }

    public function scripts($edit = false)
    {
        return '';
    }
}
