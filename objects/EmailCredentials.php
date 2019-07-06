<?php


namespace mrcodingmen\dataexporter\objects;


class EmailCredentials
{
    protected $host;
    protected $port;
    protected $username;
    protected $password;
    protected $sendFromEmail;
    protected $sendFromName;
    protected $template;
    protected $SMTPAuth;
    protected $SMTPSecure;

    /**
     * EmailCredentials constructor.
     * @param $host
     * @param $port
     * @param $username
     * @param $password
     * @param $sendFromEmail
     * @param $sendFromName
     * @param $template
     * @param $SMTPAuth
     * @param $SMTPSecure
     */
    public function __construct($host, $port, $username, $password, $sendFromEmail, $sendFromName, $template, $SMTPAuth, $SMTPSecure)
    {
        $this->host = $host;
        $this->port = $port;
        $this->username = $username;
        $this->password = $password;
        $this->sendFromEmail = $sendFromEmail;
        $this->sendFromName = $sendFromName;
        $this->template = $template;
        $this->SMTPAuth = $SMTPAuth;
        $this->SMTPSecure = $SMTPSecure;
    }

    /**
     * @return mixed
     */
    public function getHost()
    {
        return $this->host;
    }

    /**
     * @param mixed $host
     */
    public function setHost($host)
    {
        $this->host = $host;
    }

    /**
     * @return mixed
     */
    public function getPort()
    {
        return $this->port;
    }

    /**
     * @param mixed $port
     */
    public function setPort($port)
    {
        $this->port = $port;
    }

    /**
     * @return mixed
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @param mixed $username
     */
    public function setUsername($username)
    {
        $this->username = $username;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param mixed $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }

    /**
     * @return mixed
     */
    public function getSendFromEmail()
    {
        return $this->sendFromEmail;
    }

    /**
     * @param mixed $sendFromEmail
     */
    public function setSendFromEmail($sendFromEmail)
    {
        $this->sendFromEmail = $sendFromEmail;
    }

    /**
     * @return mixed
     */
    public function getSendFromName()
    {
        return $this->sendFromName;
    }

    /**
     * @param mixed $sendFromName
     */
    public function setSendFromName($sendFromName)
    {
        $this->sendFromName = $sendFromName;
    }

    /**
     * @return mixed
     */
    public function getTemplate()
    {
        return $this->template;
    }

    /**
     * @param mixed $template
     */
    public function setTemplate($template)
    {
        $this->template = $template;
    }

    /**
     * @return mixed
     */
    public function getSMTPAuth()
    {
        return $this->SMTPAuth;
    }

    /**
     * @param mixed $SMTPAuth
     */
    public function setSMTPAuth($SMTPAuth)
    {
        $this->SMTPAuth = $SMTPAuth;
    }

    /**
     * @return mixed
     */
    public function getSMTPSecure()
    {
        return $this->SMTPSecure;
    }

    /**
     * @param mixed $SMTPSecure
     */
    public function setSMTPSecure($SMTPSecure)
    {
        $this->SMTPSecure = $SMTPSecure;
    }



}
