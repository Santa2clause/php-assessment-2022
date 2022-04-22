<?php

    $con = '';
    include_once '../dbo/dbConnect.php';

    $type = $_POST['formType'];
    $date_recorded = date("Y-m-d H:i:s");

    function verifyUser($con, $email){
        $userExist = $con->query("SELECT * FROM user_details WHERE email_address = '$email'");
        if($userExist->rowCount()>1){
            return 1;
        }
    }

    function userLogs($con, $type, $email, $date_recorded){
        $con->query("INSERT INTO users_log (user_email,type,date_recorded) VALUES ('$email','$type','$date_recorded')");
    }

    if(!empty($type)){



        if(isset($name)){
            $rowUpdateId = trim($_POST['userUpdateId']);

            $name = trim($_POST['user-name']);
            $surname = trim($_POST['user-surname']);
            $idNum = trim($_POST['user-sa-id']);
            $mobile = trim($_POST['user-mobile']);
            $email = trim($_POST['user-email']);
            $birthday = trim($_POST['user-birthday']);
            $lang = trim($_POST['user-language']);
            $interests = serialize($_POST['user-interests']);
        }


        if($type == 'readUser'){
            try{
                $email = $_POST['pEmail'];
                $verifyMail = $con->query("SELECT * FROM user_details WHERE email_address = '$email'");
                if($verifyMail->rowCount() > 0){
                    echo 'Exists';
                }
            }catch (Exception $e){
                echo 'Data Not Loaded';
            }
        }

        if($type == 'addUser'){

            //Load User
            try {

                $con->query("
                    INSERT INTO user_details
                    (name, surname, sa_id_number, mobile, email_address, birth_date, language, interests, date_recorded) 
                    VALUES 
                    ('$name','$surname','$idNum','$mobile','$email','$birthday','$lang','$interests', '$date_recorded')
                ");

                //Verify User Loaded
                if(verifyUser($con, $email) == 1){

                    include '../mailer/mail-settings.php';

                    $mail->AddAddress($email);
                    $mail->Subject = "Data Capturing";
                    $content = "
                        Good day, $name $surname<br /><br />
                        
                        Please note that you have been added to our database.php<br /><br />
                        
                        Regards,<br />
                        Admin
                    ";

                    $mail->MsgHTML($content);
                    $mail->Send();

                    userLogs($con, $type, $email, $date_recorded);

                    echo 'Success';

                }else{

                    echo 'Failed';
                }

            }catch (Exception $e){
                echo 'Data Not Loaded';
            }

        }

        if($type == 'editUser'){

            try {

                $con->query("
                    UPDATE `user_details`
                    SET
                        name='$name',
                        surname='$surname',
                        sa_id_number='$idNum',
                        mobile='$mobile',
                        email_address='$email',
                        birth_date='$birthday',
                        language='$lang',
                        interests='$interests'
                    WHERE id='$rowUpdateId'
                ");

                userLogs($con, $type, $email, $date_recorded);

                echo 'Success';

            }catch (Exception $e){

                echo 'Failed';

            }

        }

        if($type == 'Delete'){

            $deleteEmail = trim($_POST['email']);
            $deleteUserID = trim($_POST['user']);

            try{

                $con->query("UPDATE `user_details` SET status=0 WHERE sa_id_number='$deleteUserID' AND email_address='$deleteEmail'");

                userLogs($con, $type, $deleteEmail, $date_recorded);

                echo 'Success';

            }catch (Exception $e){

                echo 'Failed';

            }

        }

    }
