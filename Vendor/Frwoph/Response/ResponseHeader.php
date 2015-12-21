<?php

namespace Frwoph\Vendor\Frwoph\Response;

class ResponseHeader
{
    private $statusCode;
    private $headers;

    public function __construct($statusCode = 200, $headers = array('Content-Type: text/html'))
    {
        $this->statusCode = $statusCode;

        if (!empty($headers)) {
            foreach ($headers as $header) {
                $this->add($header);
            }
        }
    }

    public function setStatusCode($statusCode)
    {
        $this->statusCode = $statusCode;
    }

    public function add($header)
    {
        $this->headers[] = $header;
    }
}
