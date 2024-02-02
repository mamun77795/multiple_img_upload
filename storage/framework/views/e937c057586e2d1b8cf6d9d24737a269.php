

<?php $__env->startSection('css'); ?>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="container mt-5">
    <div class="row">
        <div class="col-md-6">
            <h5>Information Form</h5>
            <span id="msg" class="text-success"></span>
            <input type="text" id="name" name="name" class="form-control" placeholder="Enter Name">
            <input type="text" id="email" name="email" class="form-control" placeholder="Enter Email">
            <input type="file" id="images" class="form-control" multiple>
            <div id="imagePreview">
                <img src="" alt="">
            </div>
            <button class="btn btn-primary" id="submitBtn">Submit</button>
            <button class="btn btn-primary" id="updateBtn" style="display: none;">Update</button>
        </div>
        <div class="col-md-12">
    <h5>Student Information</h5>
    <span id="msg"></span>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Photo</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php $__currentLoopData = $students; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $student): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td><?php echo e($student->name); ?></td>
                <td><?php echo e($student->email); ?></td>
                <td>
                    <img src="<?php echo e(asset('uploads/' . $student->photo)); ?>" class="m-2" width="50" height="50" alt="Image">
                </td>
                <td style="width: 200px;">
                    <!-- <input type="hidden" id="id" value="<?php echo e($student->id); ?>"> -->
                    <input type="hidden" id="path" value="<?php echo e(asset('uploads')); ?>">
                    <button class="btn btn-secondary editBtn"  data-id="<?php echo e($student->id); ?>">Edit</button>
                    <button class="btn btn-danger delBtn" data-id="<?php echo e($student->id); ?>">Delete</button>
                </td>
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>
</div>
    </div>
</div>

<?php $__env->stopSection(); ?>


<?php $__env->startSection('js'); ?>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script>
    var url = 'http://localhost/multiple_image_upload/public/api/';
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
            url: url + 'insert',
            method: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            success: function(response) {
                // console.log(response.data);
                $('#msg').html(response.data);
            }
        })
    })

    var id;
    $('.editBtn').click(function(){
        id = $(this).data('id');
        formData.append('id', id);
        var path = $('#path').val();
        $('#imagePreview').html('');

        $('#submitBtn').css('display', 'none');
        $('#updateBtn').css('display', 'block');
        $.ajax({
            url: url + 'edit-data',
            method: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            success: function(response){
                var data = response.data;
                $('#name').val(data.name);
                $('#email').val(data.email);
                $('#imagePreview').html('<img src="' + path+ '/' + data.photo + '" class="m-2" width="150" height="150" alt="Image">')
                formData.append('photo', data.photo);
            }
        })
    })

    $('#updateBtn').click(function(){
        var name = $('#name').val();
        var email = $('#email').val();
        formData.append('name', name);
        formData.append('email', email);

        $.ajax({
            url: url + 'update-data',
            method: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            success: function(response){
                // console.log(response.data);
                $('#msg').html(response.data);
            }
        })
    })

    $('.delBtn').click(function() {
        id = $(this).data('id');
        formData.append('id', id);

        $.ajax({
            url: url + 'delete-data',
            method: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            success: function(response) {
                $('#msg').html(response.data);
            }
        })
    })
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\multiple_image_upload\resources\views/student/create.blade.php ENDPATH**/ ?>