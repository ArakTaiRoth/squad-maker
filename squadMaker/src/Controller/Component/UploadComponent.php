<?php
namespace App\Controller\Component;

use Cake\Controller\Component;
use Cake\Controller\ComponentRegistry;
use Cake\Utility\Text;

class UploadComponent extends Component {
    public $allowedExtensions;
    public $directory;

    public function initialize(array $config) {
        $this->allowedExtensions = (isset($config['allowedExtensions'])) ? $config['allowedExtensions'] : ['json'];
        $this->directory = (isset($config['directory'])) ? $config['directory'] : 'players';
    }

    public function upload($data) {
        $config = $this->setConfig($this->_defaultConfig);

        if ($data['size'] !== 0) {
            $filename = $data['name'];
            $tmp_file = $data['tmp_name'];

            if (!in_array(substr(strrchr($filename, '.'), 1), $this->allowedExtensions)) {
                return [
                    'type' => 'error',
                    'message' => 'This extension is not allowed',
                    'file' => ''
                ];
            } elseif (is_uploaded_file($tmp_file)) {
                $path = WWW_ROOT . 'files' . DS . 'uploads' . DS . $this->directory;
                if (!is_dir($path)) {
                    mkdir($path);
                }

                $filename = Text::uuid() . '-players.json';
                $new_file = $path . DS . $filename;
                move_uploaded_file($tmp_file, $new_file);

                return [
                    'type' => 'success',
                    'message' => 'Player file successfully uploaded',
                    'file' => $path . DS . $filename
                ];
            }
        } else {
            return [
                'type' => 'error',
                'message' => 'You didn\'t supply a file',
                'file' => ''
            ];
        }
    }
}
