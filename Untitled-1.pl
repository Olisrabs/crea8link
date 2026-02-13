// $mail = new PHPMailer(true);

                                    // try {
                                    //     $mail->isSMTP();
                                    //     $mail->Host       = 'smtp.yourdomain.com';
                                    //     $mail->SMTPAuth   = true;
                                    //     $mail->Username   = 'no-reply@yourdomain.com';
                                    //     $mail->Password   = 'EMAIL_PASSWORD';
                                    //     $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                                    //     $mail->Port       = 587;

                                    //     $mail->setFrom('no-reply@yourdomain.com', 'Your App Name');
                                    //     $mail->addAddress($email);

                                    //     $mail->isHTML(true);
                                    //     $mail->Subject = 'Verify Your Email';
                                    //     $mail->Body = "<style>
                                    //                         html,
                                    //                         body {
                                    //                             margin: 0 auto !important;
                                    //                             padding: 0 !important;
                                    //                             height: 100% !important;
                                    //                             width: 100% !important;
                                    //                             font-family: 'Roboto', sans-serif !important;
                                    //                             font-size: 14px;
                                    //                             margin-bottom: 10px;
                                    //                             line-height: 24px;
                                    //                             color: #8094ae;
                                    //                             font-weight: 400;
                                    //                         }
                                    //                         * {
                                    //                             -ms-text-size-adjust: 100%;
                                    //                             -webkit-text-size-adjust: 100%;
                                    //                             margin: 0;
                                    //                             padding: 0;
                                    //                         }
                                    //                         table,
                                    //                         td {
                                    //                             mso-table-lspace: 0pt !important;
                                    //                             mso-table-rspace: 0pt !important;
                                    //                         }
                                    //                         table {
                                    //                             border-spacing: 0 !important;
                                    //                             border-collapse: collapse !important;
                                    //                             table-layout: fixed !important;
                                    //                             margin: 0 auto !important;
                                    //                         }
                                    //                         table table table {
                                    //                             table-layout: auto;
                                    //                         }
                                    //                         a {
                                    //                             text-decoration: none;
                                    //                         }
                                    //                         img {
                                    //                             -ms-interpolation-mode:bicubic;
                                    //                         }
                                    //                     </style>

                                    //                     <center style='width: 100%; background-color: #f5f6fa;'>
                                    //                         <table width='100%' border='0' cellpadding='0' cellspacing='0' bgcolor='#f5f6fa'>
                                    //                             <tr>
                                    //                             <td style='padding: 40px 0;'>
                                    //                                     <table style='width:100%;max-width:620px;margin:0 auto;'>
                                    //                                         <tbody>
                                    //                                             <tr>
                                    //                                                 <td style='text-align: center; padding-bottom:25px'>
                                    //                                                     <a href='#'><img style='height: 60px' src='' alt='logo'></a>
                                    //                                                 </td>
                                    //                                             </tr>
                                    //                                         </tbody>
                                    //                                     </table>
                                    //                                     <table style='width:100%;max-width:620px;margin:0 auto;background-color:#ffffff;'>
                                    //                                         <tbody>
                                    //                                             <tr>
                                    //                                                 <td style='padding: 30px 30px 15px 30px; text-align: center;'>
                                    //                                                     <h2 style='font-size: 18px; color: #84B700; font-weight: 600; margin: 0;'>One Time Password</h2>
                                    //                                                 </td>
                                    //                                             </tr>
                                    //                                             <tr>
                                    //                                                 <td style='padding: 0 30px 20px; text-align: center;'>
                                    //                                                     <p style='margin-bottom: 10px;'>Hi there,</p>
                                    //                                                     <p style='margin-bottom: 10px;'>Your OTP to complete your registration is:</p>
                                    //                                                     <h1 style='font-size: 35px; color: #84B700; font-weight: 600; margin: 0;'> $otp</h1>
                                    //                                                     <p style='margin-top: 20px;'>This OTP is valid for the next 10 minutes.</p>
                                                                                    
                                    //                                                 </td>
                                    //                                             </tr>
                                                                            
                                                                            
                                    //                                         </tbody>
                                    //                                     </table>
                                    //                                     <table style='width:100%;max-width:620px;margin:0 auto;'>
                                    //                                         <tbody>
                                    //                                             <tr>
                                    //                                                 <td style='text-align: center; padding:25px 20px 0;'>
                                    //                                                     <p style='font-size: 13px;'>Copyright © $year Crea8link. All rights reserved. <br> </p>
                                                                                        
                                    //                                                 </td>
                                    //                                             </tr>
                                    //                                         </tbody>
                                    //                                     </table>
                                    //                             </td>
                                    //                             </tr>
                                    //                         </table>
                                    //                     </center>";

                                    //     $mail->send();
                                    //     echo "<script>
                                    //         window.location.href = 'verify-otp.php?email=" . urlencode($email) . "';
                                    //     </script>";
                                    //     exit;

                                    // } catch (Exception $e) {
                                    //     echo "<script>alert('Email could not be sent. Please try again.');</script>";
                                    // }