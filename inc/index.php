<?php
// Include the database configuration file to get the DB credentials
require_once("../config.php");



// Create a database connection
$conn = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, 'cscs_db');

// Check if the connection was successful
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch user details using the session user ID
$user_id = $_settings->userdata('id'); // Ensure $_settings is correctly initialized
$user = $conn->query("SELECT * FROM users WHERE id = '$user_id'");

// Check if the query returned results
if ($user) {
    foreach ($user->fetch_assoc() as $k => $v) {
        $meta[$k] = $v;
    }
} else {
    die("Failed to fetch user data: " . $conn->error);
}
?>

<?php if ($_settings->chk_flashdata('success')): ?>
<script>
    alert_toast("<?php echo $_settings->flashdata('success'); ?>", 'success');
</script>
<?php endif; ?>

<div class="card card-outline rounded-0 card-navy">
    <div class="card-body">
        <div class="container-fluid">
            <div id="msg"></div>
            <form action="" id="manage-user">
                <input type="hidden" name="id" value="<?php echo $_settings->userdata('id'); ?>">
                <div class="form-group">
                    <label for="firstname">First Name</label>
                    <input type="text" name="firstname" id="firstname" class="form-control" 
                           value="<?php echo isset($meta['firstname']) ? $meta['firstname'] : ''; ?>" required>
                </div>
                <div class="form-group">
                    <label for="lastname">Last Name</label>
                    <input type="text" name="lastname" id="lastname" class="form-control" 
                           value="<?php echo isset($meta['lastname']) ? $meta['lastname'] : ''; ?>" required>
                </div>
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" name="username" id="username" class="form-control" 
                           value="<?php echo isset($meta['username']) ? $meta['username'] : ''; ?>" required autocomplete="off">
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" class="form-control" value="" autocomplete="off">
                    <small><i>Leave this blank if you don't want to change the password.</i></small>
                </div>
            </form>
        </div>
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
    img#cimg {
        height: 15vh;
        width: 15vh;
        object-fit: cover;
        border-radius: 100%;
    }
</style>

<script>
    $('#manage-user').submit(function(e) {
        e.preventDefault();
        start_loader();
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
                    location.reload();
                } else {
                    $('#msg').html('<div class="alert alert-danger">Username already exists</div>');
                    end_loader();
                }
            }
        });
    });
</script>
