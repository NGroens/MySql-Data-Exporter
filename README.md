# MySql-Data-Exporter
##### A PHP script that exports the stored data of a user from the mysql database.
## Installation
1. Download the latest version of [MySql-Data-Exporter](https://github.com/MrCodingMen/MySql-Data-Exporter/releases)
2. Include the library       
    ```php
        include "DataExportEngine.php";
        include "objects/EmailCredentials.php";
        include "objects/EmailReceiver.php";
     ```
   or now
    ```php
        include "DataExporter.min.php";  
    ```
    
# Usage
### Start by creating all required variables
    
```php 
<?php
    // Import MySql-Data-Exporter classes into the global namespace
    // These must be at the top of your script, not inside a function
    use mrcodingmen\dataexporter\DataExportEngine;
    use mrcodingmen\dataexporter\objects\EmailCredentials;
    use mrcodingmen\dataexporter\objects\EmailReceiver;
    
    
    include "DataExportEngine.php";
    include "objects/EmailCredentials.php";
    include "objects/EmailReceiver.php";
    
    /**
    *Only required if the file is sent by email
    *For more information about the following data please see the documentation of the library PHPMailer (https://github.com/PHPMailer/PHPMailer/blob/master/docs/README.md)
    */
    $EmailCredentials = new EmailCredentials(
    "email-host", // email hostname
    25, // email server port
    "username", // username from the email account
    "password", // password from the email account
    "MySqlDataExporter@mycoding.systems", // email which is shown in the e-mail
    "MySql-Data-Exporter",// sender name which is shown in the e-mail 
    "Email-Layout with @content; patter", // e-mail layout. Available patters: @content; for the content
    true, // SMTP-Auth[true,false]
    "tls"); // SMTPSecure
    $DataExportEngine = new DataExportEngine("mysql-host","mysql-username","mysql-password","mysql-db-name", $EmailCredentials);
    
    // Define the tables you want to export here. "table" stands for the table name. "searchColumnName" is the name of the column used to filter the data. Here you can use for example your User-ID. 
    $tables = array(
        array(
            "table" => "user",
            "searchColumnName" => "ID"
        )
    );
```
    
### Basic example to export data to a zip without sending a e-mail
```php    
    $DataExportEngine->exportData(
    $tables, //tables variable
    18, // filter-key
    
    );
```
### Basic example with defining a export-dir and file-name
   
```php    
    $DataExportEngine->exportData(
    $tables, //tables variable
    18, // filter-key
    "exports", // export-dir
    "export" // export file name (.zip will be added automatically) 
    );
```
    
### You can also add an extra file to the zip. For example you can add a file with further instructions.

```php    
$DataExportEngine->exportData(
    $tables, //tables variable
    18, // filter-key
    "exports", // export-dir
    "export" // export file name (.zip will be added automatically) 
    "email/include/info.txt", // Path to the file which should be added
    "info.txt", // file name in zip file
)
```
### The file can also be sent directly by email after it has been created.

```php    
$DataExportEngine->exportData(
    $tables, //tables variable
    18, // filter-key
    "exports", // export-dir
    "export" // export file name (.zip will be added automatically) 
    "email/include/info.txt", // Path to the file which should be added
    "info.txt", // file name in zip file
    true, // true if a email should be send
         new EmailReceiver(
             "export-data@mycoding.dev", // email address of the receiver of the data
             "Your personal data", // subject from the email
             "NGroens", // the name of the receiver which is shown in the e-mail
             "<h1>Hello NGroens,</h1><br>Here your requested data :D" // content of the email. @content; will be replaced with this content
         ), 
         true, // true if the file should be deleted after sending. 
    
)
```

## More informations
MySql-Data-Exporter is a project which was created for fun. It is supposed to facilitate the handling with the GDPR/DSGVO for many web pages owners. I do not accept liability that this library is GDPR/DSGVO fair.
I have tried to make the code as good as possible. However it can be that not every code is well readable. This project is designed to work and not look good.
You can report bugs by email, twitter or discord.

* Email: MySqlDataExporter@mrcodingmen.de
* Discord: https://discord.gg/npDsnXs


    
    
-----

### <center>**Legal Information**</center>

-----

Please read the <a href="https://github.com/MrCodingMen/MySql-Data-Exporter/blob/master/LICENSE">**License-File**</a>.<br>
Apache-License-2.0 Summary <a href="https://tldrlegal.com/license/apache-license-2.0-(apache-2.0)">**Click here**</a><br>
For further information contact me on Discord 'MrCodingMen#5821' <br>or send an E-Mail to <a href="mailto:MySqlDataExporter@mycoding.systems">MySqlDataExporter@mycoding.systems</a>.

-----
