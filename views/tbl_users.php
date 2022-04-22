<?php

    include '../dbo/dbConnect.php';

?>
<div>
    <span class="alertBox"></span>
</div>
<div class="tableInfo card">
    <h5 class="card-header">List of Users</h5>
    <div class="table table-hover table-responsive text-nowrap">
        <table class="table">
            <thead>
            <tr>
                <th>Name</th>
                <th>Surname</th>
                <th>ID Nr.</th>
                <th>Mobile Nr.</th>
                <th>Email</th>
                <th>Birthday</th>
                <th>Language</th>
                <th>Interests</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody class="table-border-bottom-0">
            <?php

                $userList = $con->query("SELECT * FROM `user_details` WHERE status=1");
                if($userList->rowCount() == 0){
                    echo '<tr><td colspan="8">No Users Loaded</td></tr>';
                }else{

                    while($rows = $userList->fetch()){

                        //Fetch Language
                        $langId = $rows['language'];
                        $typeLang = $con->query("SELECT * FROM dbo_languages WHERE id='$langId'");
                        $row_lang = $typeLang->fetch();

                        $rowID = md5($rows['id']);

                        echo '<tr>';
                            echo '<td>'.$rows['name'].'</td>';
                            echo '<td>'.$rows['surname'].'</td>';
                            echo '<td class="userID">'.$rows['sa_id_number'].'</td>';
                            echo '<td>'.$rows['mobile'].'</td>';
                            echo '<td class="userEmail">'.$rows['email_address'].'</td>';
                            echo '<td>'.$rows['birth_date'].'</td>';
                            echo '<td>'.$row_lang['language'].'</td>';

                            //Interests
                            $interests = unserialize($rows['interests']);
                            $interest = '';
                            $count = 0;
                            foreach ($interests as $value) {
                                $getInterestsName = $con->query("SELECT * FROM dbo_interests WHERE id='$interests[$count]'");
                                $rows = $getInterestsName->fetch();
                                $count++;

                                $interest .= '<li>'.$rows['type'].'</li>';
                            }

                            echo '<td><ul>'.$interest.'</ul></td>';

                            echo '<td>
                                    <div class="dropdown">
                                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="bx bx-dots-vertical-rounded"></i>
                                        </button>
                                        <div class="dropdown-menu" style="">
                                            <a class="edit dropdown-item" id="edit" href="edit_user.php?user='.$rowID.'"><i class="bx bx-edit-alt me-1"></i>Edit</a>
                                            <a class="delete dropdown-item" id="delete" href="javascript:void(0);"><i class="bx bx-trash me-1"></i> Delete</a>
                                        </div>
                                    </div>
                            </td>';

                        echo '</tr>';
                    }

                }

            ?>

            </tbody>
        </table>
    </div>
</div>
<script>
    $(function(){

        $('.delete').click(function(){

            //Make use of both ID and Email to ensure correct user selected
            let currentRow = $(this).closest('tr');

            let col = currentRow.parent().children().index(currentRow);
            let userMail = currentRow.find(".userEmail").html();
            let userID = currentRow.find(".userID").html();

            console.log(userMail)

            if(userMail !== '' && userID !== ''){

                $.post(
                    '../dbo/users.php',
                    {
                        formType: 'Delete',
                        email: userMail,
                        user: userID
                    },
                    function(data){

                        let alertBox = $('.alertBox');

                        if($.trim(data) === 'Success'){
                            //Refresh Table
                            $(".tableInfo").load(window.location.href + " .tableInfo" );
                            alertBox.html('<div class="alert alert-success" role="alert">User has successfully been removed</div>');
                        }else{
                            alertBox.html('<div class="alert alert-danger" role="alert">Oops! Something went wrong user has not been removed</div>');
                        }
                    }
                )
            }
        });

    });
</script>