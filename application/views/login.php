<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title><?=$page_title?></title>

        <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
        <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
        <link href="<?php echo base_url('css/style.min.css'); ?>" rel="stylesheet">
        <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    </head>
    <body>
        <div class="container">
            <div class="card card-container">
                <div class="color-box">
                     <img class="login-logo" src="<?=base_url('img/mainLogoWhite.png')?>" alt="">
                     <br>
                <!-- <img class="profile-img-card" src="//lh3.googleusercontent.com/-6V8xOA6M7BA/AAAAAAAAAAI/AAAAAAAAAAA/rzlHcD0KYwo/photo.jpg?sz=120" alt="" /> -->
                <img id="profile-img" class="profile-img-card" src="//ssl.gstatic.com/accounts/ui/avatar_2x.png" />
                <p id="profile-name" class="profile-name-card"></p>
                <?=form_open($form_action);?>
                    <span id="reauth-email" class="reauth-email"></span>
                    <?php foreach ($form as $key => $input): ?>

                        <?=form_label($key.':', $input['id']);?>
                        <?=form_input($input);?>
                        <br>

                    <?php endforeach; ?>
                    <?=form_button($buttons['submit'])?>
                <?=form_close();?>
            </div><!--color-box-->
        </div><!-- /card-container -->
    </div><!-- /container -->

    </body>
</html>
