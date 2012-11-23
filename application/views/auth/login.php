<div class="row-fluid">
    <div class="span4 offset4">
        <div class="alert">
            <?php echo form_open("auth/login"); ?>
            <h2 class="form-signin-heading">Login.</h2>
            <?php echo form_input($identity); ?>
            <?php echo form_input($password); ?>
            <label class="checkbox">
                <?php echo form_checkbox('remember', '1', FALSE, 'id="remember"'); ?> Remember me
            </label>
            <?php echo form_submit('submit', 'Login','class="btn btn-primary"'); ?>
            <?php echo form_close(); ?>

            <p><a href="forgot_password">Forgot your password?</a></p>
        </div>
    </div>
</div>



