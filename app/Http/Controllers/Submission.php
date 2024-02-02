<?php

namespace App\Http\Controllers;

use App\Traits\Template;
use Illuminate\Http\Request;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class Submission extends Controller
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

        return view('submission', $this->Template(), [
            'crumb1' => strtoLower(collect($this->Template()['pages'])->firstWhere('name', 'submission')->link),
        ]);
    }

    /**
     * Send a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request);
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
                    'type' => 'required',
                    'email' => 'required|email',
                    'name' => 'required',
                    'artist_name' => 'required',
                    'main_social_media' => 'required',
                    'music_link' => 'required',
                    'short_bio' => 'required|max:1000',
                ]);

                $mail = new PHPMailer(true);
                $mail->isSMTP();
                $mail->Host       = 'localhost';
                $mail->SMTPAuth   = false;
                $mail->Username   = env('MAIL_USERNAME');
                $mail->Password   = env('MAIL_PASSWORD');
                $mail->Port       = env('MAIL_PORT');
                $mail->setFrom($_POST['email'], $_POST['name']);
                $mail->AddAddress(env('MAIL_FROM_ADDRESS'));
                $mail->isHTML(true);
                $mail->Subject = 'Demo Music Submission';
                $mail->Body = "<!DOCTYPE html><html>
                <head>
                    <title>Demo Music Submission</title>
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
                        <p>Type : " . $_POST['type'] . "</p>
                        <p>Name : " . $_POST['name'] . "</p>
                        <p>Artist Name : " . $_POST['artist_name'] . "</p>
                        <p>Email : " . $_POST['email'] . "</p>
                        <p>Main Social Media : " . $_POST['main_social_media'] . "</p>
                        <p>Music Link : " . $_POST['music_link'] . "</p>
                        <p>" . $_POST['short_bio'] . "</p>
                        <p>Thank You</p>
                        <p>" . $_POST['name'] . "</p></td>
                        </tr>
                    </table>
                    </center>
                </body>
                </html>";
                if ($mail->Send()) {
                    return redirect(url('/submission'))->with('success', 'Submission success, we will response shortly.');
                } else {
                    return redirect(url('/submission'))->with('error', 'Server error, please come back latter.');
                }
            }
        }
    }
}
