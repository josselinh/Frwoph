<?php

namespace Frwoph\Vendors\FrwophResponse;

class FrwophResponse implements FrwophResponseInterface
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
    public $Headers;

    public function __construct($content = null, $statusCode = 200, $headers = array('Content-Type: text/html'))
    {
        $this->setContent($content);

        $this->Headers = new FrwophResponseHeader($statusCode, $headers);
    }

    public function setContent($content)
    {
       $contents = null;
        
        switch (gettype($content)) {
            case 'object':
                switch (get_class($content)) {
                    case 'Frwoph\Vendors\FrwophView\FrwophView':
                        /**
                         * @var $content Frwoph\Vendors\FrwophView\FrwophView
                         */
                        
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
