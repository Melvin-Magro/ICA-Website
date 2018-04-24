<div class="login-box">
    <img src="images/avatar.jpg" class="avatar" alt="avatar">
    <h1>Login Here</h1>
    <form method="post" action="<?= base_url(); ?>index.php?/Login/login_validation">
        <div class="login">
            <p>Email</p>
            <input type="email" name="email" placeholder="Please Enter Email..." id="email"></br>
            <span class="text-error"><?= form_error('email'); ?></span>
            <p>Password</p>
            <input type="password" name="password" placeholder="Please Enter Password..." id="password">
            <span class="text-error"><?= form_error('password'); ?></span>
        </div>
        <input type="submit" name="insert" value="Login" class="subbutton" />
        <?php echo $this->session->set_flashdata("error"); ?>
    </form>
</div>
