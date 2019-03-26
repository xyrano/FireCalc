<?php
/**
 * Description of SysEmail
 *
 * @author tanzberg
 */
class SysEmail extends Obj
{
    /**
     * Hold the to´s it can be devided by ;
     * @var Map 
     */
    private $tos;
    
    /**
     * Hold the from mail simple str
     * @var str
     */
    private $from;
    
    /**
     * Hold the Cc mails
     * @var Map
     */
    private $cc;
    
    /**
     * Hold the Bcc mails
     * @var Map
     */
    private $bcc;
    private $subject;
    private $message;
    
    private $additional_Headers;
    private $additional_Parameters;
    
    private $isHtmlMail = false;
    
    
    
    public function parmTos(Map $tos) {
        $this->tos = $tos;
    }
    
    public function parmFrom($from) {
        $this->from = $from;
    }
    
    public function parmCc(Map $cc) {
        $this->cc = $cc;
    }
    
    public function parmBcc(Map $bcc) {
        $this->bcc = $bcc;                
    }
    
    public function parmSubject($subject) {
        $this->subject = $subject;
    }
    
    public function parmMessage($message) {
        if(strlen($this->message) || strlen($message) > 70) {
            throw new Exception("E-Mail Text hat mehr als 70 Zeichen!");
        }
        $message = str_replace("<br>", "\n", $message);
        $this->message = $message;
    }
    
    public function isHtmlMail($isHtml = false) {
        $this->isHtmlMail = $isHtml;
    }
    
    public function newMail(SysEmail $mailObj)
    {
        $mailObj->sendMail();
    }
    
    
    private function sendMail() {
        try
        {
            if($this->isHtmlMail)
            {
                $this->buildHtmlHeader();
            }
            $succes = mail($this->to, $this->subject, $this->message, $this->additional_Headers, $this->additional_Parameters);
            
            if(!$succes)
            {
                throw new Exception(error_get_last()['message']);
            }
        }
        catch(Exception $ex)
        {
            throw $ex;
        }
    }
    
    
    private function buildHtmlHeader() {
        // für HTML-E-Mails muss der 'Content-type'-Header gesetzt werden
        $header  = 'MIME-Version: 1.0' . "\r\n";
        $header .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";                
        
        // zusätzliche Header
        $header = "To: ".$this->buildTosString($this->tos)." \r\n";
        $header .= "From: FF-BWB <".$this->from."> \r\n";
        
        // Insert Cc´s
        if($this->cc->getLength() > 0)
        {
            $header .= "Cc: ".$this->buildEmailString($this->cc)." \r\n";
        }
        
        if($this->bcc->getLength() > 0)
        {
            $header .= "Bcc: ".$this->buildEmailString($this->bcc)." \r\n";
        }
        
        
        $this->additional_Headers = $header;
    }
    
    
    private function buildEmailString(Map $mails) {
        $tosString = "";
        $mi = new MapIterator($mails);
        while($mi->next())
        {
            $tosString .= "<".$mi->currentValue().">,";
        }
        // cut last comma
        $str = substr($tosString, 0, (strlen($tosString) - 1));
        return $str;
    }
}
