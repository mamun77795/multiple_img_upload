

<?php $__env->startSection('css'); ?>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="container mt-5">
    <div class="row">
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
                        <td>
                            <input type="hidden" id="id" value="<?php echo e($student->id); ?>">
                            <button id="delBtn" class="btn btn-danger">Delete</button>
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
    var formData = new FormData();

    $(document).ready(function(){
        $('#delBtn').click(function(){
            var id = $('#id').val();
            formData.append('id', id);

            $.ajax({
                url: 'http://localhost/multiple_image_upload/public/api/delete-data',
                method:'POST',
                data: formData,
                contentType: false,
                processData: false,
                success: function(response){
                    $('#msg').html(response.data);
                }
            })
        })
    })
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\multiple_image_upload\resources\views/student/index.blade.php ENDPATH**/ ?>