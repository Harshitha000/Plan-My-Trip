<?php
    session_start();
    header('Content-Type: application/json'); // Ensure JSON response

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
    
    require '../PHPMailer/src/Exception.php';
    require '../PHPMailer/src/PHPMailer.php';
    require '../PHPMailer/src/SMTP.php';

    error_reporting(E_ALL);
    ini_set('display_errors', 1);

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $data = json_decode(file_get_contents('php://input'), true);
        $email = $data['email'];
        

        // Generate a random 6-digit OTP
        $otp = rand(100000, 999999);
        $_SESSION['otp'] = $otp;

        // Send OTP via email
        $subject = "Your OTP for Signup";
        $message = "Your OTP is: $otp";

        $mail = new PHPMailer(true);

        try {

            $mail->isSMTP();                                            //Send using SMTP
            $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    
            $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
            $mail->Username   = '21121a3321@gmail.com';                     //SMTP username
            $mail->Password   = 'avkd euzb jiun tyfn';                               //SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;            //ENCRYPTION_SMTPS 465 - Enable implicit TLS encryption
            $mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
    
            //Recipients
            $mail->setFrom('21121a3321@gmail.com', 'Plan My Trip pvt ltd');
            $mail->addAddress($email);     //Add a recipient
            
            //Content
            $mail->isHTML(true);                                  //Set email format to HTML
            $mail->Subject = $subject;
            $mail->Body = $message;

            if ($mail->send()) {
                echo json_encode(['success' => true, 'message' => 'OTP sent successfully!']);
            } else {
                echo json_encode(['success' => false, 'message' => 'Failed to send OTP.']);
            }
        } catch (Exception $e) {
            echo json_encode([
                'success' => false,
                'message' => 'Error occurred: ' . $mail->ErrorInfo
            ]);
        }
    }

    
?>
