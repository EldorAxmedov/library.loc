<?php
namespace common\components;
use yii\base\Component;

class CurlComponent extends Component
{
    public $url;
    public $method;
    public $data;
    public $headers;
    public $options;

    public function init()
    {
        parent::init();
        $this->url = null;
        $this->method = 'GET';
        $this->data = null;
        $this->headers = [];
        $this->options = [];
    }

    public function setUrl($url)
    {
        $this->url = $url;
    }

    public function setMethod($method)
    {
        $this->method = $method;
    }

    public function setData($data)
    {
        $this->data = $data;
    }

    public function setHeaders($headers)
    {
        $this->headers = $headers;
    }

    public function setOptions($options)
    {
        $this->options = $options;
    }

    public function paginationCount(){
        $this->setUrl($this->url);
        $this->setMethod('GET');
        $this->setHeaders(
            'Authorization: Bearer 877G31ndrUJ3z55OiCup_PWAjiwO0BHm'
        );
        $response = $this->send();
        $response = json_decode($response, true);
        return $response['data']['pagination']['pageCount'];
    }

    public function send()
    {
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $this->url);
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, $this->method);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $this->headers);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $this->data);
        curl_setopt_array($curl, $this->options);
        $response = curl_exec($curl);
        curl_close($curl);
        return $response;
    }


}