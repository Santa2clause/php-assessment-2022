<div class="mb-3">
    <label class="form-label">Name</label>
    <div class="input-group input-group-merge">
                                                <span id="basic-icon-default-name" class="input-group-text">
                                                    <i class="bx bx-user"></i></span>
        <input
            type="text"
            class="form-control"
            id="user-name"
            name="user-name"
            placeholder="John"
            aria-label="John"
            aria-describedby="basic-icon-default-name"
            value = "<?php if(isset($name)){ echo $name; } ?>"
            required
        />
    </div>
</div>
<div class="mb-3">
    <label class="form-label">Surname</label>
    <div class="input-group input-group-merge">
                                                <span id="basic-icon-default-surname" class="input-group-text">
                                                    <i class="bx bx-user"></i></span>
        <input
            type="text"
            class="form-control"
            id="user-surname"
            name="user-surname"
            placeholder="Doe"
            aria-label="Doe"
            aria-describedby="basic-icon-default-surname"
            value = "<?php if(isset($surname)){ echo $surname; } ?>"
            required
        />
    </div>
</div>
<div class="mb-3">
    <label class="form-label">SA ID Number</label>
    <div class="input-group input-group-merge">
                                                <span id="basic-icon-default-id-number" class="input-group-text">
                                                    <i class="bx bx-id-card"></i></span>
        <input
            type="text"
            class="form-control"
            id="user-sa-id"
            name="user-sa-id"
            placeholder="13-Digit SA ID"
            aria-label="13-Digit SA ID"
            aria-describedby="basic-icon-default-id-number"
            maxlength="13"
            value = "<?php if(isset($sa_id_number)){ echo $sa_id_number; } ?>"
            required
        />
    </div>
    <div class="user-input-count-id"></div>
</div>
<div class="mb-3">
    <label class="form-label">Phone No</label>
    <div class="input-group input-group-merge">
                                            <span id="basic-icon-default-phone2" class="input-group-text">
                                                <i class="bx bx-phone"></i></span>
        <input
            type="text"
            id="user-mobile"
            name="user-mobile"
            class="form-control phone-mask"
            placeholder="083 --- ----"
            aria-label="083 --- ----"
            aria-describedby="basic-icon-default-phone2"
            value = "<?php if(isset($mobile)){ echo $mobile; } ?>"
            required
        />
    </div>
</div>
<div class="mb-3">
    <label class="form-label">Email</label>
    <div class="input-group input-group-merge">
        <span class="input-group-text"><i class="bx bx-envelope"></i></span>
        <input
            type="text"
            id="user-email"
            name="user-email"
            class="form-control"
            placeholder="john.doe@example.com"
            aria-label="john.doe@example.com"
            aria-describedby="basic-icon-default-email2"
            value = "<?php if(isset($email_address)){ echo $email_address; } ?>"
            required
        />
    </div>
    <div class="user-input-email-id"></div>
</div>
<div class="mb-3 row">
    <label class="form-label">Birthday</label>
    <div class="input-group input-group-merge">
        <span class="input-group-text"><i class="bx bx-calendar"></i></span>
        <input
            class="form-control"
            type="date"
            value="<?php if(isset($birth_date)){ echo $birth_date; }else{ echo date('Y-m-d');} ?>"
            id="user-birthday"
            name="user-birthday"
            required
        />
    </div>
</div>
<div class="mb-3 row">
    <label class="form-label">Language</label>
    <div class="input-group input-group-merge">
        <select class="form-select" name="user-language" id="user-language" aria-label="User Language" required>
            <option value="" selected>Select a language</option>
            <?php

            $fetchLanguages = $con->query("SELECT * FROM dbo_languages");
            while($rows = $fetchLanguages->fetch()){

                if($language == $rows['id']){ $selected = "selected"; }

                echo ' <option value="'.$rows['id'].'" '.$selected.' >'.$rows['language'].'</option>';
            }

            ?>
        </select>
    </div>
</div>

<div class="mb-3 row">
    <label class="form-label" title="Hold down CTRL-key to select multiple">Interest</label>
    <div class="input-group input-group-merge">
        <select
            multiple
            class="form-select"
            id="user-interests"
            name="user-interests[]"
            aria-label="Select all user interests"
            required
        >
            <?php

            $fetchInterests = $con->query("SELECT * FROM dbo_interests");
            $x = 0;
            while($rows = $fetchInterests->fetch()){

                if($interests[$x] == $rows['id']){ $selectedInterests = "selected"; }else{ $selectedInterests = ""; }

                echo ' <option value="'.$rows['id'].'" '.$selectedInterests.' >'.$rows['type'].'</option>';

                $x++;
            }

            ?>
        </select>
    </div>
</div>