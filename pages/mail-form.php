<?php
    require 'protected/sendEmail.php';

    if (input()['website'] == '') {
        try {
            // Email from
            $mail->setFrom("kemish@tbcutah.com", "TBC Website");
            $mail->addReplyTo(input()['email'], input()['name']);
            // Content
            $mail->isHTML(true);
            $mail->Subject = "Website contact inquiry";
            $mail->Body = 
                "From: " . input()['name'] . "<br>Email: " . input()['email'] . "<br>City: " . "<br>Message:<br>" . input()['message'];
        
            $mail->send();
            $message = 'Message has been sent';
        } catch (Exception $e) {
            $message = "Message could not be sent.";
        }
    } else {
        $message = "Message could not be sent.";
    }

    header("refresh:5;url=home");
    ?>
    <br><br><br><br>
    <div class="row my-5">
        <div class="col-md-12">
            <p class="display-4 text-center">Your <?php echo $message; ?></p>
        </div>
    </div>
    <br><br><br><br>

