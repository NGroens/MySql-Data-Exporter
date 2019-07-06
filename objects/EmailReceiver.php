<?php


namespace mrcodingmen\dataexporter\objects;


class EmailReceiver
{
    protected $email;
    protected $subject;
    protected $name;
    protected $content;

    /**
     * EmailReceiver constructor.
     * @param $email
     * @param $subject
     * @param $name
     * @param $content
     */
    public function __construct($email, $subject, $name, $content)
    {
        $this->email = $email;
        $this->subject = $subject;
        $this->name = $name;
        $this->content = $content;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return mixed
     */
    public function getSubject()
    {
        return $this->subject;
    }

    /**
     * @param mixed $subject
     */
    public function setSubject($subject)
    {
        $this->subject = $subject;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @param mixed $content
     */
    public function setContent($content)
    {
        $this->content = $content;
    }

}
