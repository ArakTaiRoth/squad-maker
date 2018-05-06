<?php
namespace App\Controller\Component;

use Cake\Controller\Component;
use Cake\Controller\ComponentRegistry;
use Cake\ORM\TableRegistry;
use Cake\I18n\Date;

class ParseComponent extends Component {
    /**
     * parsePlayerJSON Method used to parse a JSON file and create players based on the data
     * @param  [string] $filename name of the file to parse
     * @return [array] containing error or success and a message
     */
    public function parsePlayerJSON($filename) {
        $data = file_get_contents($filename);
        $json = json_decode($data, true);

        $playersTable = TableRegistry::get('Players');

        return $playersTable->createPlayers($json['players']);
    }
}
