<?php

namespace App\Traits;

trait ApiResponse
{
    protected $meta;
    protected $data;
    protected $response;

    protected function setMeta($key, $value)
    {
        $this->meta[$key] = $value;
    }

    protected function setData($key, $value)
    {
        $this->data[$key] = $value;
    }

    protected function setResponse()
    {
        $this->response['meta'] = $this->meta;
        $this->response['data'] = $this->data;
        return $this->response;
    }
}