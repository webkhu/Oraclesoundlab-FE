<?php

namespace App\Http\Controllers;

use App\Traits\Template;
use Illuminate\Http\Request;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class Contact extends Controller
{
    use Template;

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $previousURL = explode("/", $request->header('referer'));
        $envURL = explode("/", env('APP_URL'));

        if ($envURL[0] === 'http:' || $envURL[0] === 'https:') {
            $envURL = $envURL[2];
        } else {
            $envURL = $envURL[0];
        }

        if (!@$previousURL[2] || $previousURL[2] != $envURL) {
            return redirect(url('/'));
        }

        return view('contact', $this->Template(), [
            'crumb1' => collect($this->Template()['pages'])->firstWhere('name', 'contact')->link,
        ]);
    }

    /**
     * Send a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $previousURL = explode("/", $request->header('referer'));
        $envURL = explode("/", env('APP_URL'));

        if ($envURL[0] === 'http:' || $envURL[0] === 'https:') {
            $envURL = $envURL[2];
        } else {
            $envURL = $envURL[0];
        }

        if (!@$previousURL[2] || $previousURL[2] != $envURL) {
            return redirect(url('/'));
        } else {
            if (@$_POST['SendMail'] === 'Sending') {

                $request->validate([
                    'name' => 'required',
                    'email' => 'required|email',
                    'subject' => 'required',                    
                    'message' => 'required',
                ]);

                $mail = new PHPMailer(true);
                $mail->isSMTP();
                $mail->Host          = env('MAIL_HOST');
                $mail->SMTPAuth      = false;
                $mail->Username      = env('MAIL_USERNAME');
                $mail->Password      = env('MAIL_PASSWORD');
                $mail->Port          = env('MAIL_PORT');
                $mail->SMTPSecure    = 'ssl';
                $mail->Timeout       = 60; 
                $mail->SMTPKeepAlive = true;
                $mail->setFrom($_POST['email'], $_POST['name']);
                $mail->AddAddress(env('MAIL_FROM_ADDRESS'));
                $mail->isHTML(true);
                $mail->Subject = $_POST['subject'];
                $mail->Body = "<!DOCTYPE html><html>
                <head>
                    <title>" . $_POST['subject'] . "</title>
                    <meta http-equiv=\"Content-Type\" content=\"text/html; charset=iso-8859-1\">
                    <style type=\"text/css\">
                    body {
                        font-family:\"Lucida Grande\", \"Lucida Sans Unicode\",
                        \"Lucida Sans\", \"DejaVu Sans\", Verdana, \"sans-serif\";
                    }
                    .head {
                        color:#ffffff;
                        font-size:18px;
                        padding:10px;
                    }
                    .content {
                        font-size:16px;
                        padding:10px;
                        text-align: left;
                    }
                    </style>
                </head>
                <body>
                    <center>
                    <table width=\"600\" cellspacing=\"1\" bgcolor=\"#4f4f4f\">
                        <tr><td class=\"content\" bgcolor=\"#ffffff\">
                        <p>Dear Admin,</p>
                        <p>Contact email from:</p>
                        <p>Name : " . $_POST['name'] . "</p>
                        <p>Email : " . $_POST['email'] . "</p>
                        <p>" . $_POST['message'] . "</p>
                        <p>Thank You</p>
                        <p>" . $_POST['name'] . "</p></td>
                        </tr>
                    </table>
                    </center>
                </body>
                </html>";
                if ($mail->Send()) {
                    return redirect(url('/contact'))->with('success', 'Email sended successfully, we will response shortly.');
                } else {
                    return redirect(url('/contact'))->with('error', 'Email server error, please come back latter.');
                }
            }
        }
    }
}
