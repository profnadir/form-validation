<!DOCTYPE HTML>
<html>

<head>
    <style>
        .error{
            color: red;
        }
    </style>
</head>

<body>

    <?php 
    $name=$email=$website="";
    $errorName=$errorEmail=$errorWebsite="";
     if($_SERVER['REQUEST_METHOD']== "POST"){
        if(empty($_POST['name'])){
            $errorName = "Name est obligatoire";
        }else{
            $name = test($_POST['name']);
            if(!preg_match("/^[a-zA-Z- ]*$/",$name)){
                $errorName = "Le format du nom n'est pas valide : seulement les lettres";
            }
        }

        if(empty($_POST['email'])){
            $errorEmail = "Email est obligatoire";
        }else{
            $email = test($_POST['email']);
            if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
                $errorEmail = "Format email not valid";
            }
        }

        if(empty($_POST['website'])){
            $errorWebsite = "Website est obligatoire";
        }else{
            $website = test($_POST['website']);
            if(!str_ends_with($website,'.ma')){
                $errorWebsite = "Url doit se terminer avec .ma";
            }
        }
     }

     function test($inp){
        $inp = trim($inp);
        $inp = stripslashes($inp);
        $inp = htmlspecialchars($inp);
        return $inp;
     }
    ?>

    <h2>PHP Form Validation Example</h2>
    <form method="post" action="<?php htmlspecialchars($_SERVER['PHP_SELF']) ?>">
        Name: <input type="text" name="name" value="<?php echo $name ?>">
        <span class="error"> * <?php echo $errorName; ?></span>
        <br><br>
        E-mail: <input type="text" name="email" value="<?php echo $email ?>">
        <span class="error"> * <?php echo $errorEmail; ?></span>
        <br><br>
        Website: <input type="text" name="website" value="<?php echo $website ?>">
        <span class="error"> * <?php echo $errorWebsite; ?></span>
        <br><br>
        Comment: <textarea name="comment" rows="5" cols="40"></textarea>
        <br><br>
        Gender:
        <input type="radio" name="gender" value="female">Female
        <input type="radio" name="gender" value="male">Male
        <br><br>
        <input type="submit" name="submit" value="Submit">
    </form>
    <br>
    <h2>Your inputs</h2>
    <h4>Name : <?php echo $name ?></h4>
    <h4>Email : <?php echo $email ?></h4>
    <h4>Website : <?php echo $website ?></h4>

</body>

</html>