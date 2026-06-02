<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class Mailer {
    /**
     * Send a beautifully formatted HTML email notification when a contact form is submitted.
     */
    public static function sendContactNotification(
        string $ownerEmail,
        string $senderName,
        string $senderEmail,
        string $company,
        string $subject,
        string $message
    ): bool {
        // Load configurations
        $config = require dirname(__DIR__, 2) . '/config/app.php';

        // Fetch SMTP credentials from global settings
        try {
            $pdo = \Core\Database::getInstance()->getConnection();
            $stmt = $pdo->query("SELECT smtpUsername, smtpPassword FROM globalsettings WHERE id = 1");
            $settings = $stmt->fetch(PDO::FETCH_ASSOC);
            $smtpUser = !empty($settings['smtpUsername']) ? $settings['smtpUsername'] : $config['smtp_username'];
            $smtpPass = !empty($settings['smtpPassword']) ? $settings['smtpPassword'] : $config['smtp_password'];
        } catch (\Exception $e) {
            $smtpUser = $config['smtp_username'];
            $smtpPass = $config['smtp_password'];
        }

        $mail = new PHPMailer(true);

        try {
            // Server settings
            $mail->isSMTP();
            $mail->Host       = $config['smtp_host'];
            $mail->SMTPAuth   = true;
            $mail->Username   = $smtpUser;
            $mail->Password   = $smtpPass;
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port       = $config['smtp_port'];

            // Recipients
            $mail->setFrom($smtpUser, $config['smtp_from_name']);
            $mail->addAddress($ownerEmail);
            $mail->addReplyTo($senderEmail, $senderName);

            // Content
            $mail->isHTML(true);
            $mail->Subject = 'New Contact Submission: ' . $subject;

            // Beautiful premium HTML email body
            $body = '
            <!DOCTYPE html>
            <html>
            <head>
                <meta charset="utf-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>New Contact Submission</title>
                <style>
                    body {
                        font-family: \'Inter\', \'Segoe UI\', Helvetica, Arial, sans-serif;
                        background-color: #0A0A0A;
                        color: #E2E8F0;
                        margin: 0;
                        padding: 40px 20px;
                        -webkit-font-smoothing: antialiased;
                    }
                    .container {
                        max-width: 600px;
                        margin: 0 auto;
                        background: #121212;
                        border: 1px solid #2D3748;
                        border-radius: 12px;
                        overflow: hidden;
                        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.5);
                    }
                    .header {
                        background: linear-gradient(135deg, #00CED1 0%, #008B8B 100%);
                        padding: 30px 40px;
                        text-align: left;
                    }
                    .header h1 {
                        color: #000000;
                        font-size: 24px;
                        font-weight: 800;
                        margin: 0;
                        text-transform: uppercase;
                        letter-spacing: 1.5px;
                    }
                    .header p {
                        color: #1F2937;
                        font-size: 14px;
                        margin: 5px 0 0 0;
                        font-weight: 500;
                    }
                    .content {
                        padding: 40px;
                    }
                    .meta-grid {
                        display: grid;
                        grid-template-columns: 1fr 1fr;
                        gap: 20px;
                        margin-bottom: 30px;
                        padding-bottom: 20px;
                        border-bottom: 1px solid #2D3748;
                    }
                    .meta-item {
                        margin-bottom: 15px;
                    }
                    .meta-label {
                        font-size: 11px;
                        text-transform: uppercase;
                        color: #00CED1;
                        font-weight: 700;
                        letter-spacing: 1px;
                        margin-bottom: 4px;
                    }
                    .meta-value {
                        font-size: 15px;
                        color: #FFFFFF;
                        font-weight: 500;
                    }
                    .message-box {
                        background: #1A1A1A;
                        border-left: 4px solid #00CED1;
                        border-radius: 4px;
                        padding: 20px;
                        margin-top: 25px;
                    }
                    .message-title {
                        font-size: 12px;
                        text-transform: uppercase;
                        color: #A0AEC0;
                        font-weight: 700;
                        letter-spacing: 1px;
                        margin-bottom: 8px;
                    }
                    .message-text {
                        font-size: 15px;
                        line-height: 1.6;
                        color: #E2E8F0;
                        white-space: pre-wrap;
                    }
                    .footer {
                        background: #0D0D0D;
                        padding: 20px 40px;
                        text-align: center;
                        border-top: 1px solid #1A1A1A;
                    }
                    .footer p {
                        font-size: 12px;
                        color: #718096;
                        margin: 0;
                    }
                </style>
            </head>
            <body>
                <div class="container">
                    <div class="header">
                        <h1>Synalyze</h1>
                        <p>New Inquiry Received</p>
                    </div>
                    <div class="content">
                        <div class="meta-item">
                            <div class="meta-label">Subject</div>
                            <div class="meta-value" style="font-size: 18px; font-weight: 700; color: #FFFFFF;">' . e($subject) . '</div>
                        </div>
                        <div style="height: 20px;"></div>
                        
                        <table style="width:100%; border-collapse: collapse; margin-bottom: 20px;">
                            <tr>
                                <td style="width:50%; padding-bottom: 15px; vertical-align: top;">
                                    <div class="meta-label">From</div>
                                    <div class="meta-value">' . e($senderName) . '</div>
                                </td>
                                <td style="width:50%; padding-bottom: 15px; vertical-align: top;">
                                    <div class="meta-label">Email</div>
                                    <div class="meta-value"><a href="mailto:' . e($senderEmail) . '" style="color: #00CED1; text-decoration: none;">' . e($senderEmail) . '</a></div>
                                </td>
                            </tr>
                            <tr>
                                <td style="padding-bottom: 15px; vertical-align: top;">
                                    <div class="meta-label">Company</div>
                                    <div class="meta-value">' . ($company ? e($company) : '<em style="color:#718096">None Provided</em>') . '</div>
                                </td>
                                <td style="padding-bottom: 15px; vertical-align: top;">
                                    <div class="meta-label">Date/Time</div>
                                    <div class="meta-value">' . date('Y-m-d H:i:s') . '</div>
                                </td>
                            </tr>
                        </table>

                        <div class="message-box">
                            <div class="message-title">Message Message</div>
                            <div class="message-text">' . nl2br(e($message)) . '</div>
                        </div>
                    </div>
                    <div class="footer">
                        <p>This is an automated notification from your Synalyze contact form.</p>
                    </div>
                </div>
            </body>
            </html>
            ';

            $mail->Body = $body;
            $mail->AltBody = "New Contact Submission Received:\n\nSubject: $subject\nName: $senderName\nEmail: $senderEmail\nCompany: $company\nMessage:\n$message";

            $mail->send();
            return true;
        } catch (Exception $e) {
            error_log("PHPMailer failed to send email: " . $mail->ErrorInfo);
            return false;
        }
    }
}
