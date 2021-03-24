<?php
include_once('Mailable.php');
include_once('../Mails/Constant.php');


/**
 *
 */
class InfoMail extends Mailable
{
    /**
    * Data which must be parse to view in this order

    */
    protected $data;

    function __construct($send_to, $data)
    {
        $this->send_to = $send_to;
        $this->data = $data;
    }

    protected function url()
    {
        return __DIR__."/views/Info.php";
    }

    protected function body()
    {
        return sprintf(
            file_get_contents($this->url()),
            $this->data['email'],
            $this->data['email'],
            $this->data['password']
        ); 
    }

    protected function subject()
    {
        return 'Nouvelle Information';
    }

}
