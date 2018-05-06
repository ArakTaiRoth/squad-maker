<?php
namespace App\Model\Behavior;

use Cake\ORM\Behavior;
use Cake\I18n\Time;

class CurlBehavior extends Behavior {
    /**
     * _createRequest
     * Creates a curl request object
     *
     * @param  string $url a URL to request
     * @return a curl handle on success, false if errors
     */
    protected function _createRequest($url) {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 2);
        curl_setopt($ch, CURLOPT_ENCODING, '');

        return $ch;
    }

    /**
     * getResponse
     * A method to request data from a url and return a response
     *
     * @param  string $request The type of request being made
     * @param  array $data The data to be used within the request, default is null
     * @return data object of the requested data upon success, error message upon error
     */
    public function getResponse($request, $data = null) {
        switch ($request) {
            case 'players':
                $url = '';
                break;
        }

        $ch = $this->_createRequest($url);

        $response['result'] = curl_exec($ch);
        $response['status'] = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $response['error'] = curl_error($ch);
        $response['errno'] = curl_errno($ch);

        curl_close($ch);

        if ($response['status'] === 200) {
            $data = json_decode($response['result']);
            switch ($page) {
                case 'players':
                    return [
                        'type' => 'success',
                        'data' => $data->players
                    ];
                    break;
            }
        } else {
            return [
                'type' => 'error',
                'message' => $response['error']
            ];
        }
    }
}
