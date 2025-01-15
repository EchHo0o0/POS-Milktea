<?php 
$user = $conn->query("SELECT * FROM users where id ='".$_settings->userdata('id')."'");
foreach($user->fetch_array() as $k =>$v){
    $meta[$k] = $v;
}
?>
<?php if($_settings->chk_flashdata('success')): ?>
<script>
    alert_toast("<?php echo $_settings->flashdata('success') ?>",'success')
</script>
<?php endif;?>

<div class="card card-outline rounded-0 card-navy">
    <div class="card-body">
        <div class="container-fluid">
            <div id="msg"></div>
            <form action="" id="manage-user">    
                <input type="hidden" name="id" value="<?php echo $_settings->userdata('id') ?>">
                <div class="form-group">
                    <label for="name">First Name</label>
                    <input type="text" name="firstname" id="firstname" class="form-control" value="<?php echo isset($meta['firstname']) ? $meta['firstname']: '' ?>" required>
                </div>
                <div class="form-group">
                    <label for="name">Last Name</label>
                    <input type="text" name="lastname" id="lastname" class="form-control" value="<?php echo isset($meta['lastname']) ? $meta['lastname']: '' ?>" required>
                </div>
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" name="username" id="username" class="form-control" value="<?php echo isset($meta['username']) ? $meta['username']: '' ?>" required  autocomplete="off">
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" class="form-control" value="" autocomplete="off">
                    <small><i>Leave this blank if you don't want to change the password.</i></small>
                </div>
                <div class="form-group">
                    <label for="code">Code</label>
                    <input type="code" name="code" id="code" class="form-control" value="" autocomplete="off">
                </div>
            </div>
            <div class="form-group d-flex justify-content-center">
            </div>
        </form>
    </div>
    <div class="card-footer">
        <div class="col-md-12">
            <div class="row">
                <button class="btn btn-sm btn-primary" form="manage-user">Update</button>
            </div>
        </div>
    </div>
</div>

<style>
    /* Milk tea-inspired color scheme */
    body {
        background-color: #f1e3d3; /* Milky White background */
        font-family: Arial, sans-serif;
    }

    .container-fluid {
        background-color: rgba(226, 173, 126, 0.7); /* Soft milk tea color */
        padding: 30px;
        border-radius: 8px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    }

    .form-group label {
        font-size: 14px;
        font-weight: bold;
        color: #3c2e1f; /* Dark Milk Tea Color */
    }

    .form-control {
        background-color: rgba(235, 204, 173, 0.7); /* Light Beige background */
        border: 1px solid rgba(176, 101, 63, 0.7); /* Soft Brown Border */
        border-radius: 5px;
        padding: 10px;
        font-size: 16px;
        color: #3c2e1f; /* Dark Milk Tea Color */
    }

    .form-control:focus {
        border-color:rgb(237, 196, 115); /* Warm Honey Yellow Color for Focus */
        box-shadow: 0 0 5px rgba(244, 165, 3, 0.7); /* Glow effect */
    }

    .btn-primary {
        background-color:rgb(242, 202, 122); /* Warm Honey Yellow Color for Buttons */
        border-color:rgb(250, 206, 118);
        color: white;
        padding: 10px 20px;
        font-size: 16px;
        border-radius: 8px;
    }

    .btn-primary:hover {
        background-color:rgb(229, 183, 117); /* Slightly Darker Honey Yellow for Hover */
    }

    .alert-danger {
        background-color: #e33a3a; /* Soft Red Background for Errors */
        color: #721c24;
        border-radius: 5px;
        padding: 15px;
        font-size: 14px;
        margin-bottom: 20px;
    }

    .alert-success {
        background-color: #39e252; /* Soft Green Background for Success */
        color: #155724;
        border-radius: 5px;
        padding: 15px;
        font-size: 14px;
        margin-bottom: 20px;
    }

    .toast {
        background-color:rgb(242, 204, 128); /* Milk Tea Toast Background */
        color: white;
        font-size: 14px;
        border-radius: 8px;
        padding: 10px 20px;
        text-align: center;
    }
</style>

<script>
$('#manage-user').submit(function(e){
    e.preventDefault();
    start_loader();

    // Check if all required fields are filled
    var firstname = $('#firstname').val().trim();
    var lastname = $('#lastname').val().trim();
    var username = $('#username').val().trim();
    var password = $('#password').val().trim();
    var code = $('#code').val().trim();

    if (firstname === "" || lastname === "" || username === "" || (password !== "" && code === "")) {
        // Show error if required fields are empty
        $('#msg').html('<div class="alert alert-danger">Please fill in all the required fields.</div>');
        end_loader();
        return; // Stop the form submission
    }

    $.ajax({
        url: _base_url_ + 'classes/Users.php?f=save',
        data: new FormData($(this)[0]),
        cache: false,
        contentType: false,
        processData: false,
        method: 'POST',
        type: 'POST',
        success: function(resp) {
            if (resp == 1) {
                // Show success toast and redirect
                alert_toast("Your information has been updated. Please update your info in <a href='forget.php'>forget.php</a>", 'success');
                setTimeout(function(){
                    window.location.href = '../forgot.php';  // Redirect to forget.php after a short delay
                }, 3000);  // 3-second delay before redirect
            } else {
                $('#msg').html('<div class="alert alert-danger">Username already exists</div>');
                end_loader();
            }
        }
    });
});
</script>
