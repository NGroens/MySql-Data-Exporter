<?php
/**
 * MySql-Data-Exporter - A PHP script that exports the stored data of a user from the mysql database.
 *
 *
 * @see       https://github.com/MrCodingMen/MySql-Data-Exporter The MySql-Data-Exporter GitHub project
 *
 * @author    Nils G. (original founder) <MySqlDataExporter@mrcodingmen.de>
 * @copyright 2019 - 2020 Nils G.
 * @license   https://tldrlegal.com/license/apache-license-2.0-(apache-2.0) Apache-License-2.0
 * @note      This program is distributed in the hope that it will be useful - WITHOUT
 * ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or
 * FITNESS FOR A PARTICULAR PURPOSE.
 */

namespace mrcodingmen\dataexporter\objects;

/**
 * MySql-Data-Exporter - A PHP script that exports the stored data of a user from the mysql database.
 *
 * @author    Nils G. (original founder) <MySqlDataExporter@mrcodingmen.de>
 */
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
