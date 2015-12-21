<?php

namespace Frwoph\Vendor\Frwoph\Response;

class Response
{
    /**
     *
     * @var string
     */
    private $content;

    /**
     *
     * @var Headers
     */
    public $Header;

    public function __construct($content = null, $statusCode = 200, $headers = array('Content-Type: text/html'))
    {
        $this->setContent($content);

        $this->Header = new ResponseHeader($statusCode, $headers);
    }

    public function setContent($content)
    {
       $contents = null;
        
        switch (gettype($content)) {
            case 'object':
                switch (get_class($content)) {
                    case 'Frwoph\Vendor\Frwoph\View\View':
                        $contents = $content->render();
                        break;
                }
                break;
        }

        $this->content = $contents;
    }

    public function render()
    {
        return $this->content;
    }
}
