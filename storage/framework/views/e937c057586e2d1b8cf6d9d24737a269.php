

<?php $__env->startSection('css'); ?>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="container mt-5">
    <div class="row">
        <div class="col-md-6">
            <h5>Student Information</h5>
            <span id="msg" class="text-success"></span>
            <input type="text" id="name" name="name" class="form-control" placeholder="Enter Name">
            <input type="text" id="email" name="email" class="form-control" placeholder="Enter Email">
            <input type="file" id="images" class="form-control" multiple>
            <div id="imagePreview"></div>
            <button class="btn btn-primary" id="submitBtn">Submit</button>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>


<?php $__env->startSection('js'); ?>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script>
    var formData = new FormData();

    $(document).ready(function() {
        $('#images').change(function() {
            imagePreview(this);
        })
    });

    function imagePreview(input) {
        $('#imagePreview').html('');
        var reader = new FileReader();
        if (input.files) {
            $.each(input.files, function(i, file) {
                reader.onload = function(e) {
                    $('#imagePreview').append('<img src="' + e.target.result + '" class="m-2" width="150" height="150" alt="Image">');
                    formData.append('images', file);
                }
                reader.readAsDataURL(file);
            })
        }
    }

    $('#submitBtn').click(function() {
        var name = $('#name').val();
        var email = $('#email').val();
        formData.append('name', name);
        formData.append('email', email);
        $.ajax({
            url: 'http://localhost/multiple_image_upload/public/api/insert',
            method: 'POST',
            data: formData,
            contentType:false,
            processData:false,
            success: function(response){
                $('#msg').html(response.data);
            }
        })
    })
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\multiple_image_upload\resources\views/student/create.blade.php ENDPATH**/ ?>