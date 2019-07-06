<?php
/**
 * MySql-Data-Exporter - A PHP script that exports the stored data of a user from the mysql database.
 *
 *
 * @see       https://github.com/MrCodingMen/MySql-Data-Exporter The MySql-Data-Exporter GitHub project
 *
 * @author    Nils G. (original founder) <MySqlDataExporter@mrcodingmen.de>
 * @copyright 2019 - 2020 Nils G.
 * @license   http://www.gnu.org/copyleft/lesser.html GNU Lesser General Public License
 * @note      This program is distributed in the hope that it will be useful - WITHOUT
 * ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or
 * FITNESS FOR A PARTICULAR PURPOSE.
 */

namespace mrcodingmen\dataexporter;

use mrcodingmen\dataexporter\objects\EmailCredentials;
use mrcodingmen\dataexporter\objects\EmailReceiver;
use PDO;
use PDOException;
use ZipArchive;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'libs/Exception.php';
require 'libs/PHPMailer.php';
require 'libs/SMTP.php';

/**
 * MySql-Data-Exporter - A PHP script that exports the stored data of a user from the mysql database.
 *
 * @author    Nils G. (original founder) <MySqlDataExporter@mrcodingmen.de>
 */
class DataExportEngine
{
    // Configuration
    private $errorhandling = 'nothing'; // 'showall', 'show', 'error' and 'nothing' possible
    private $ip;
    private $username;
    private $password;
    private $dbname;
    private $emailcredentials;

    public function __construct($ip, $username, $password, $dbname, EmailCredentials $EmailCredentials = null)
    {
        $this->ip = $ip;
        $this->username = $username;
        $this->password = $password;
        $this->dbname = $dbname;
        $this->emailcredentials = $EmailCredentials;
    }

    public $db;
    public $pdo;

    public function exportData($tables, $value, $exportdir = "exports", $filename = "", $extrafile = "", $extrafilepath = "", $sendMail = false, $EmailReceiver = null, $deleteAfterSend = false)
    {
        try {
            if ($filename == "") $filename = uniqid();

            if (isset($tables[0])) {

                if (!file_exists($exportdir)) mkdir($exportdir,0755,true);


                $zip = new ZipArchive;

                if ($zip->open($exportdir . '/' . $filename . '.zip', ZipArchive::CREATE) === TRUE) {
                    foreach ($tables AS $item) {
                        $data = $this->select($item['table'], $item['searchColumnName'] . "=?", array($value));
                        $zip->addFromString($item['table'] . ".json", json_encode($data, JSON_PRETTY_PRINT));

                    }

                    if ($extrafile != "") $zip->addFile($extrafile, $extrafilepath);

                    $zip->close();
                }
                $end = array(
                    "success" => true
                );

                if ($sendMail) {
                    $end = $this->sendMail($EmailReceiver, $exportdir . '/' . $filename . '.zip');
                    if ($deleteAfterSend) {
                        unlink($exportdir . '/' . $filename . '.zip');
                    }
                }
            }
        } catch (\Exception $e) {
            $end = array(
                "success" => false,
                "error" => $e
            );
        }
        return $end;

    }

    protected function sendMail(EmailReceiver $EmailReceiver, $Attachment)
    {
        $mail = new PHPMailer(true);

        try {
            $mail->isSMTP();
            $mail->Host = $this->emailcredentials->getHost();
            $mail->SMTPAuth = $this->emailcredentials->getSMTPAuth();
            $mail->Username = $this->emailcredentials->getUsername();
            $mail->Password = $this->emailcredentials->getPassword();
            $mail->SMTPSecure = $this->emailcredentials->getSMTPSecure();
            $mail->Port = $this->emailcredentials->getPort();

            $mail->setFrom($this->emailcredentials->getSendFromEmail(), $this->emailcredentials->getSendFromName());
            $mail->addAddress($EmailReceiver->getEmail(), $EmailReceiver->getName());

            $mail->addAttachment($Attachment);


            $mail->isHTML(true);
            $mail->Subject = $EmailReceiver->getSubject();
            $mail->Body = str_replace("@content;", $EmailReceiver->getContent(), $this->emailcredentials->getTemplate());
            $mail->AltBody = 'Your browser does not support HTML emails. Please use another one.';

            $mail->send();
            $data = array(
                "success" => true
            );
        } catch (Exception $e) {
            $data = array(
                "success" => false,
                "error" => $mail->ErrorInfo
            );
        }
        return $data;
    }

    private
    function db()
    {
        try {
            $this->db = new PDO('mysql:host=' . $this->ip . ';charset=utf8;dbname=' . $this->dbname, $this->username, $this->password);
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $this->db;
        } catch (PDOException $e) {
            switch ($this->errorhandling) {
                case "showall":
                    echo "<b>Could not Connect to mySQL Database: </b><br>" . $e . "<br>";
                    break;
                case "show":
                    echo "<b>Could not Connect to mySQL Database</b><br>";
                    break;
                case "error":
                    echo "<b>There was an error while handling your request</b><br>";
                    break;
                case "nothing":
                    break;
            }
        }
    }

    private
    function select($table, $cond = null, $data = array())
    {
        $stmt = $this->db()->prepare("SELECT * FROM `" . $table . "` " . $this->updatecond($cond));
        $stmt->execute($data);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    private
    function updatecond($cond)
    {
        if ($cond != null) {
            return $cond = "WHERE " . $cond;
        } else {
            return $cond;
        }
    }
}

