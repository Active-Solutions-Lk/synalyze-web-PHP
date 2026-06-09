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
            $mail->SMTPSecure = ($config['smtp_port'] == 465) ? PHPMailer::ENCRYPTION_SMTPS : PHPMailer::ENCRYPTION_STARTTLS;
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

    /**
     * Send a beautifully formatted HTML email notification to the owner when a demo is requested.
     */
    public static function sendDemoRequestNotification(
        string $ownerEmail,
        string $userName,
        string $userEmail,
        string $userPhone,
        string $company
    ): bool {
        $config = require dirname(__DIR__, 2) . '/config/app.php';

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
            $mail->isSMTP();
            $mail->Host       = $config['smtp_host'];
            $mail->SMTPAuth   = true;
            $mail->Username   = $smtpUser;
            $mail->Password   = $smtpPass;
            $mail->SMTPSecure = ($config['smtp_port'] == 465) ? PHPMailer::ENCRYPTION_SMTPS : PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port       = $config['smtp_port'];

            $mail->setFrom($smtpUser, $config['smtp_from_name']);
            $mail->addAddress($ownerEmail);

            $mail->isHTML(true);
            $mail->Subject = 'New Demo Request: ' . $userName . ' (' . ($company ?: 'No Company') . ')';

            $body = '
            <!DOCTYPE html>
            <html>
            <head>
                <meta charset="utf-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>New Demo Request</title>
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
                        <p>New Demo Request Submitted</p>
                    </div>
                    <div class="content">
                        <p style="font-size: 16px; line-height: 1.6; margin-bottom: 25px; color: #E2E8F0;">
                            A user has requested access to the Synalyzer demo environment. Here are the details of the request:
                        </p>
                        
                        <table style="width:100%; border-collapse: collapse; margin-bottom: 20px;">
                            <tr>
                                <td style="width:50%; padding-bottom: 15px; vertical-align: top;">
                                    <div class="meta-label">Full Name</div>
                                    <div class="meta-value">' . e($userName) . '</div>
                                </td>
                                <td style="width:50%; padding-bottom: 15px; vertical-align: top;">
                                    <div class="meta-label">Company</div>
                                    <div class="meta-value">' . ($company ? e($company) : '<em style="color:#718096">None Provided</em>') . '</div>
                                </td>
                            </tr>
                            <tr>
                                <td style="padding-bottom: 15px; vertical-align: top;">
                                    <div class="meta-label">Email</div>
                                    <div class="meta-value">' . e($userEmail) . '</div>
                                </td>
                                <td style="padding-bottom: 15px; vertical-align: top;">
                                    <div class="meta-label">Phone Number</div>
                                    <div class="meta-value">' . e($userPhone) . '</div>
                                </td>
                            </tr>
                            <tr>
                                <td style="padding-bottom: 15px; vertical-align: top;">
                                    <div class="meta-label">Requested At</div>
                                    <div class="meta-value">' . date('Y-m-d H:i:s') . '</div>
                                </td>
                            </tr>
                        </table>

                        <p style="font-size: 14px; color: #A0AEC0; margin-top: 25px; line-height: 1.5; border-top: 1px solid #2D3748; padding-top: 20px;">
                            <strong>Action Required:</strong> Log in to your <a href="' . rtrim($config['base_url'], '/') . '/admin" style="color: #00CED1; text-decoration: underline; font-weight: bold;">Synalyze admin dashboard</a> to review this request and dispatch demo credentials to the user.
                        </p>
                    </div>
                    <div class="footer">
                        <p>This is an automated notification from your Synalyze platform.</p>
                    </div>
                </div>
            </body>
            </html>
            ';

            $mail->Body = $body;
            $mail->AltBody = "New Demo Request Submitted:\n\nName: $userName\nEmail: $userEmail\nCompany: $company\nPhone: $userPhone\nPlease log in to the admin panel to send credentials.";

            $mail->send();
            return true;
        } catch (Exception $e) {
            error_log("PHPMailer failed to send demo request notification: " . $mail->ErrorInfo);
            return false;
        }
    }

    /**
     * Send a beautifully formatted HTML email to the user with their demo credentials.
     */
    public static function sendDemoCredentials(
        string $userEmail,
        string $userName,
        string $synalyzeUrl,
        string $activationKey
    ): bool {
        $config = require dirname(__DIR__, 2) . '/config/app.php';

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
            $mail->isSMTP();
            $mail->CharSet    = 'UTF-8';
            $mail->Host       = $config['smtp_host'];
            $mail->SMTPAuth   = true;
            $mail->Username   = $smtpUser;
            $mail->Password   = $smtpPass;
            $mail->SMTPSecure = ($config['smtp_port'] == 465) ? PHPMailer::ENCRYPTION_SMTPS : PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port       = $config['smtp_port'];

            $mail->setFrom($smtpUser, $config['smtp_from_name']);
            $mail->addAddress($userEmail);

            $mail->isHTML(true);
            $mail->Subject = 'Your Synalyzer Demo Activation Key';

            $body = '
            <!DOCTYPE html>
            <html>
            <head>
                <meta charset="utf-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>Your Synalyze Demo is Ready</title>
                <style>
                    body {
                        font-family: \'Inter\', \'Segoe UI\', Helvetica, Arial, sans-serif;
                        background-color: #0A0A0A;
                        color: #E2E8F0;
                        margin: 0;
                        padding: 0;
                        -webkit-font-smoothing: antialiased;
                    }
                    .btn-action {
                        display: inline-block;
                        padding: 14px 28px;
                        background-color: #00CED1;
                        color: #000000 !important;
                        font-weight: 700;
                        font-size: 15px;
                        text-transform: uppercase;
                        letter-spacing: 1px;
                        text-decoration: none;
                        border-radius: 6px;
                        margin: 15px 0;
                        box-shadow: 0 4px 14px rgba(0, 206, 209, 0.4);
                    }
                </style>
            </head>
            <body style="background-color: #0A0A0A; margin: 0; padding: 0;">
                <table width="100%" cellpadding="0" cellspacing="0" border="0" style="background-color: #0A0A0A; min-width: 100%; margin: 0; padding: 40px 0;">
                    <tr>
                        <td align="center" style="background-color: #0A0A0A;">
                            <div style="max-width: 600px; width: 100%; margin: 0 auto; background: #121212; border: 1px solid #2D3748; border-radius: 12px; overflow: hidden; text-align: left; box-shadow: 0 10px 30px rgba(0, 0, 0, 0.5);">
                                <div style="background: linear-gradient(135deg, #00CED1 0%, #008B8B 100%); padding: 30px 40px;">
                                    <h1 style="color: #000000; font-size: 24px; font-weight: 800; margin: 0; text-transform: uppercase; letter-spacing: 1.5px;">Synalyze</h1>
                                    <p style="color: #1F2937; font-size: 14px; margin: 5px 0 0 0; font-weight: 500;">Your Demo Portal is Ready</p>
                                </div>
                                <div style="padding: 40px;">
                                    <p style="font-size: 16px; line-height: 1.6; color: #FFFFFF; font-weight: 600; margin-top: 0;">
                                        Hello ' . e($userName) . ',
                                    </p>
                                    <p style="font-size: 15px; line-height: 1.6; color: #E2E8F0; margin-bottom: 20px;">
                                        Thank you for requesting a demo of the Synalyzer platform. We are excited to grant you access to our NAS fleet monitoring and syslog analytics environment.
                                    </p>
                                    <p style="font-size: 15px; line-height: 1.6; color: #E2E8F0; margin-bottom: 25px;">
                                        Use the activation key below to activate and access your demo.
                                    </p>
                                    
                                    <table width="100%" cellpadding="0" cellspacing="0" border="0" style="background: #1A1A1A; border: 1px solid #2D3748; border-radius: 8px; margin: 25px 0; border-collapse: collapse;">
                                        <tr>
                                            <td style="padding: 24px;">
                                                <div style="font-size: 11px; text-transform: uppercase; color: #00CED1; font-weight: 700; letter-spacing: 1px; margin-bottom: 6px;">Demo Platform URL</div>
                                                <div style="font-size: 16px; font-family: sans-serif; font-weight: bold; margin-bottom: 20px;">
                                                    <a href="' . e($synalyzeUrl) . '" style="color: #FFFFFF; text-decoration: none; border-bottom: 1px dashed #00CED1;">' . e($synalyzeUrl) . '</a>
                                                </div>
                                                
                                                <div style="font-size: 11px; text-transform: uppercase; color: #00CED1; font-weight: 700; letter-spacing: 1px; margin-bottom: 6px;">Activation Key</div>
                                                <table cellpadding="0" cellspacing="0" border="0" style="background: #0D0D0D; border: 1px solid #333333; border-radius: 6px; border-collapse: collapse;">
                                                    <tr>
                                                        <td style="padding: 12px 18px; font-family: \'Courier New\', Courier, monospace; font-size: 18px; color: #FFFFFF; font-weight: bold; letter-spacing: 1.5px; -webkit-user-select: all; -moz-user-select: all; -ms-user-select: all; user-select: all;">
                                                            ' . e($activationKey) . '
                                                        </td>
                                                        <td style="padding: 12px 18px 12px 0; color: #00CED1; font-size: 16px; -webkit-user-select: none; -moz-user-select: none; -ms-user-select: none; user-select: none; vertical-align: middle;">
                                                            📋
                                                        </td>
                                                    </tr>
                                                </table>
                                                <div style="font-size: 12px; color: #718096; margin-top: 8px; -webkit-user-select: none; -moz-user-select: none; -ms-user-select: none; user-select: none;">(Click the key above to highlight and copy it instantly)</div>
                                            </td>
                                        </tr>
                                    </table>

                                    <div style="text-align: center; margin: 30px 0 20px 0;">
                                        <a href="' . e($synalyzeUrl) . '" class="btn-action" target="_blank" style="display: inline-block; padding: 14px 28px; background-color: #00CED1; color: #000000 !important; font-weight: 700; font-size: 15px; text-transform: uppercase; letter-spacing: 1px; text-decoration: none; border-radius: 6px; box-shadow: 0 4px 14px rgba(0, 206, 209, 0.4);">Access Your Demo Portal</a>
                                    </div>

                                    <p style="font-size: 14px; color: #A0AEC0; margin-top: 30px; line-height: 1.5; border-top: 1px solid #2D3748; padding-top: 20px; margin-bottom: 0;">
                                        <strong>Security Note:</strong> Please keep this activation key confidential and do not share it with unauthorized personnel.
                                    </p>
                                    <p style="font-size: 13px; color: #A0AEC0; margin-top: 12px; line-height: 1.5; margin-bottom: 0;">
                                        📎 <strong>Guides Attached:</strong> We have attached the Synalyzer <em>Installation Guide</em> and <em>User Guide</em> to help you get started.
                                    </p>
                                </div>
                                <div style="background: #0D0D0D; padding: 20px 40px; text-align: center; border-top: 1px solid #1A1A1A;">
                                    <p style="font-size: 12px; color: #718096; margin: 0;">Please do not reply to this automated message.</p>
                                    <p style="font-size: 12px; color: #718096; margin: 5px 0 0 0;">&copy; ' . date('Y') . ' Synalyze. All rights reserved.</p>
                                </div>
                            </div>
                        </td>
                    </tr>
                </table>
            </body>
            </html>
            ';

            $mail->Body = $body;
            $mail->AltBody = "Your Synalyzer Demo Portal is Ready!\n\nAccess Link: $synalyzeUrl\nActivation Key: $activationKey\n\nPlease use the link and key above to activate and explore the Portal.";

            // Attach PDF guides with graceful fallback
            $guidesPath = dirname(__DIR__, 2) . '/public/assets/guides/';
            foreach ([
                ['Installation Guide.pdf', 'Synalyzer Installation Guide.pdf'],
                ['User guide.pdf', 'Synalyzer User Guide.pdf'],
            ] as [$file, $name]) {
                $fullPath = $guidesPath . $file;
                if (file_exists($fullPath)) {
                    $mail->addAttachment($fullPath, $name);
                } else {
                    error_log("Mailer: Guide attachment not found at $fullPath");
                }
            }

            $mail->send();
            return true;
        } catch (Exception $e) {
            error_log("PHPMailer failed to send demo credentials to user: " . $mail->ErrorInfo);
            return false;
        }
    }

    /**
     * Send a beautifully formatted HTML email update to a subscriber.
     */
    public static function sendUpdateEmail(
        string $toEmail,
        string $subject,
        string $message
    ): bool {
        $config = require dirname(__DIR__, 2) . '/config/app.php';

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
            $mail->isSMTP();
            $mail->CharSet    = 'UTF-8';
            $mail->Host       = $config['smtp_host'];
            $mail->SMTPAuth   = true;
            $mail->Username   = $smtpUser;
            $mail->Password   = $smtpPass;
            $mail->SMTPSecure = ($config['smtp_port'] == 465) ? PHPMailer::ENCRYPTION_SMTPS : PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port       = $config['smtp_port'];

            $mail->setFrom($smtpUser, $config['smtp_from_name']);
            $mail->addAddress($toEmail);

            $mail->isHTML(true);
            $mail->Subject = $subject;

            $body = '
            <!DOCTYPE html>
            <html>
            <head>
                <meta charset="utf-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>' . e($subject) . '</title>
                <style>
                    body {
                        font-family: \'Inter\', \'Segoe UI\', Helvetica, Arial, sans-serif;
                        background-color: #0A0A0A;
                        color: #E2E8F0;
                        margin: 0;
                        padding: 0;
                        -webkit-font-smoothing: antialiased;
                    }
                </style>
            </head>
            <body style="background-color: #0A0A0A; margin: 0; padding: 0;">
                <table width="100%" cellpadding="0" cellspacing="0" border="0" style="background-color: #0A0A0A; min-width: 100%; margin: 0; padding: 40px 0;">
                    <tr>
                        <td align="center" style="background-color: #0A0A0A;">
                            <div style="max-width: 600px; width: 100%; margin: 0 auto; background: #121212; border: 1px solid #2D3748; border-radius: 12px; overflow: hidden; text-align: left; box-shadow: 0 10px 30px rgba(0, 0, 0, 0.5);">
                                <div style="background: linear-gradient(135deg, #00CED1 0%, #008B8B 100%); padding: 30px 40px;">
                                    <h1 style="color: #000000; font-size: 24px; font-weight: 800; margin: 0; text-transform: uppercase; letter-spacing: 1.5px;">Synalyze</h1>
                                    <p style="color: #1F2937; font-size: 14px; margin: 5px 0 0 0; font-weight: 500;">Latest Updates & Announcements</p>
                                </div>
                                <div style="padding: 40px;">
                                    <h2 style="color: #FFFFFF; font-size: 20px; font-weight: 700; margin-top: 0; margin-bottom: 20px;">' . e($subject) . '</h2>
                                    <div style="font-size: 15px; line-height: 1.6; color: #E2E8F0; margin-bottom: 20px; white-space: pre-wrap;">' . nl2br(e($message)) . '</div>
                                </div>
                                <div style="background: #0D0D0D; padding: 20px 40px; text-align: center; border-top: 1px solid #1A1A1A;">
                                    <p style="font-size: 12px; color: #718096; margin: 0;">You are receiving this because you subscribed to updates from Synalyze.</p>
                                    <p style="font-size: 12px; color: #718096; margin: 5px 0 0 0;">&copy; ' . date('Y') . ' Synalyze. All rights reserved.</p>
                                </div>
                            </div>
                        </td>
                    </tr>
                </table>
            </body>
            </html>
            ';

            $mail->Body = $body;
            $mail->AltBody = $message;

            $mail->send();
            return true;
        } catch (Exception $e) {
            error_log("PHPMailer failed to send update email: " . $mail->ErrorInfo);
            return false;
        }
    }

    /**
     * Send a beautifully formatted HTML welcome email to a new subscriber.
     */
    public static function sendSubscriberWelcomeEmail(string $subscriberEmail): bool {
        $config = require dirname(__DIR__, 2) . '/config/app.php';

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
            $mail->isSMTP();
            $mail->CharSet    = 'UTF-8';
            $mail->Host       = $config['smtp_host'];
            $mail->SMTPAuth   = true;
            $mail->Username   = $smtpUser;
            $mail->Password   = $smtpPass;
            $mail->SMTPSecure = ($config['smtp_port'] == 465) ? PHPMailer::ENCRYPTION_SMTPS : PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port       = $config['smtp_port'];

            $mail->setFrom($smtpUser, $config['smtp_from_name']);
            $mail->addAddress($subscriberEmail);

            $mail->isHTML(true);
            $mail->Subject = 'Welcome to Synalyze Updates!';

            $body = '
            <!DOCTYPE html>
            <html>
            <head>
                <meta charset="utf-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>Welcome to Synalyze</title>
                <style>
                    body {
                        font-family: \'Inter\', \'Segoe UI\', Helvetica, Arial, sans-serif;
                        background-color: #0A0A0A;
                        color: #E2E8F0;
                        margin: 0;
                        padding: 0;
                        -webkit-font-smoothing: antialiased;
                    }
                </style>
            </head>
            <body style="background-color: #0A0A0A; margin: 0; padding: 0;">
                <table width="100%" cellpadding="0" cellspacing="0" border="0" style="background-color: #0A0A0A; min-width: 100%; margin: 0; padding: 40px 0;">
                    <tr>
                        <td align="center" style="background-color: #0A0A0A;">
                            <div style="max-width: 600px; width: 100%; margin: 0 auto; background: #121212; border: 1px solid #2D3748; border-radius: 12px; overflow: hidden; text-align: left; box-shadow: 0 10px 30px rgba(0, 0, 0, 0.5);">
                                <div style="background: linear-gradient(135deg, #00CED1 0%, #008B8B 100%); padding: 30px 40px;">
                                    <h1 style="color: #000000; font-size: 24px; font-weight: 800; margin: 0; text-transform: uppercase; letter-spacing: 1.5px;">Synalyze</h1>
                                    <p style="color: #1F2937; font-size: 14px; margin: 5px 0 0 0; font-weight: 500;">Subscription Confirmed</p>
                                </div>
                                <div style="padding: 40px;">
                                    <h2 style="color: #FFFFFF; font-size: 20px; font-weight: 700; margin-top: 0; margin-bottom: 20px;">Thanks for Subscribing!</h2>
                                    <p style="font-size: 15px; line-height: 1.6; color: #E2E8F0; margin-bottom: 15px;">
                                        Hi ' . e($userName) . ',
                                    </p>
                                    <p style="font-size: 15px; line-height: 1.6; color: #E2E8F0; margin-bottom: 15px;">
                                        Thank you for subscribing to Synalyze updates. You are now on the list to receive the latest updates, announcements, and guides on NAS fleet monitoring and syslog analytics.
                                    </p>
                                    <p style="font-size: 15px; line-height: 1.6; color: #E2E8F0; margin-bottom: 25px;">
                                        We promise to send only high-value content and keep emails to a minimum.
                                    </p>
                                    
                                    <div style="background: #1A1A1A; border-left: 4px solid #00CED1; border-radius: 4px; padding: 20px; margin-top: 25px;">
                                        <div style="font-size: 11px; text-transform: uppercase; color: #00CED1; font-weight: 700; letter-spacing: 1px; margin-bottom: 6px;">How to Unsubscribe</div>
                                        <p style="font-size: 14px; line-height: 1.5; color: #A0AEC0; margin: 0;">
                                            If you ever wish to stop receiving updates, simply visit the Synalyze website, log in, and click the <strong>Unsubscribe</strong> button in the footer.
                                        </p>
                                    </div>
                                </div>
                                <div style="background: #0D0D0D; padding: 20px 40px; text-align: center; border-top: 1px solid #1A1A1A;">
                                    <p style="font-size: 12px; color: #718096; margin: 0;">You are receiving this because you subscribed to updates from Synalyze.</p>
                                    <p style="font-size: 12px; color: #718096; margin: 5px 0 0 0;">&copy; ' . date('Y') . ' Synalyze. All rights reserved.</p>
                                </div>
                            </div>
                        </td>
                    </tr>
                </table>
            </body>
            </html>
            ';

            $mail->Body = $body;
            $mail->AltBody = "Thanks for subscribing to Synalyze Updates!\n\nYou will receive the latest updates and announcements about NAS fleet monitoring and syslog analytics.\n\nTo unsubscribe, visit the website and click the Unsubscribe button in the footer.";

            $mail->send();
            return true;
        } catch (Exception $e) {
            error_log("PHPMailer failed to send welcome email: " . $mail->ErrorInfo);
            return false;
        }
    }
}

