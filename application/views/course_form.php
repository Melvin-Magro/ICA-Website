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
    <body id = "body-login">
        <div class="container">
            <div class="card card-container">
                <div class="color-box">
                    <img class="login-logo" src="<?=base_url('img/mainLogoWhite.png')?>" alt="">
                     <br>
                     <!-- <img class="profile-img-card" src="//lh3.googleusercontent.com/-6V8xOA6M7BA/AAAAAAAAAAI/AAAAAAAAAAA/rzlHcD0KYwo/photo.jpg?sz=120" alt="" /> -->
                <!-- <img id="profile-img" class="profile-img-card" src="//ssl.gstatic.com/accounts/ui/avatar_2x.png" /> -->
                <p id="profile-name" class="profile-name-card"></p>
<?="NB. Please use course level 1 for part-time courses."?>
<br><br><br>
<?=form_open($properties['action'], NULL, $properties['hidden'])?>
<?=form_error('form')?>
  <?php foreach ($form as $key => $input):?>
    <div>
      <?=form_error($key);?>
      <?=form_label($key.':', $input['id']);?>
      <?=form_input($input);?>
    </div>
  <?php endforeach;?>
  <?=form_submit(null, "Submit")?>
<?=form_close()?>

</div><!--color-box-->
        </div><!-- /card-container -->
    </div><!-- /container -->

</body>
</html>
