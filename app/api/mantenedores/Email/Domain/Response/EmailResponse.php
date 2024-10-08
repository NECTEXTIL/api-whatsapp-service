<?php
namespace Mnt\mantenedores\Email\Domain\Response;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;


class EmailResponse
{
    private $request;
    private $response;
    private $service;
    private $app;
    private $model;

    public function __construct($request = null, $response = null, $service = null, $app = null)
    {
        $this->request = $request;
        $this->response = $response;
        $this->service = $service;
        $this->app = $app;

        $this->model = $request ?? $response ?? $service ?? $app;
    }

     /**
     * @param $data type array
     * @return array
     */
    public function ListaResponse($data)
    {
        if (count($data)) {
            foreach ($data as $key => $value) {
                $data[$key]['template_values'] = json_decode($value['template_values']);
            }
        }

        return $data;
    }

    public function SendEmail($email,$empresa){

        $mail = new PHPMailer(true);
        $mail->SMTPDebug = 0;                    //Enable verbose debug output
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host       = EMAIL_HOST;                     //Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        $mail->Username   = APP_EMAIL;                     //SMTP username
        $mail->Password   = EMAIL_PASSWORD;                               //SMTP password
        $mail->SMTPSecure = SMTPSecure;            //Enable implicit TLS encryption
        $mail->Port       = EMAIL_PORT;

        //Recipients
        $mail->setFrom(APP_EMAIL, $email['email_title']);
        $mail->addAddress($email['email'], $email['email_name']);     //Add a recipient
        //$mail->addAddress('jhamsel.rec@gmail.com', 'Copia de email de prueba');     //Add a recipient

        //Content
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = $email['email_subject'];

        $template = $empresa['template_body'];
        $template_values = array(
            "titulo" => "Email de notificación",
            "nombre" => "jhon does",
            "codigo" => "12",
            "fecha" => "2024-08-12",
            "hora" => "10:30:09"
        );

        foreach ($template_values as $key => $value) {
            // Construimos la variable de búsqueda en el formato {{%variable%}}
            $search = "{{%" . $key . "%}}";
            // Reemplazamos la variable por su valor correspondiente
            $template = str_replace($search, $value, $template);
        }

        $mail->Body    = $template;

        $mail->send();
        return 'mensaje enviado';
    }

}
