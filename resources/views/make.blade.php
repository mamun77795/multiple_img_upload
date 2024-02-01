@extends('layout')
@section('css')
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

@endsection

@section('content')
<div class="container mt-5">
    <input type="text" id="name" name="name" class="form-control">
    <input type="text" id="description" name="description" class="form-control">
    <input type="file" id="images" class="form-control" multiple>
    <div id="imagePreview" class="d-flex flex-wrap mt-2"></div>
    <button id="uploadBtn" class="btn btn-primary mt-2">Upload Image</button>
</div>


@endsection

@section('js')
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script>
    var formData = new FormData();
   
    $(document).ready(function() {
        $('#images').change(function() {
            previewImages(this);
        })
    })

    function previewImages(input) {
        // $('#imagePreview').html('');
        if (input.files) {
            $.each(input.files, function(i, file) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#imagePreview').append('<img src="' + e.target.result + '" class"m-2" width="150" height="150" alt="Image">');
                    formData.append('images[]', file);
                };
                reader.readAsDataURL(file);
            })
        }
    }

    $('#uploadBtn').click(function(){
        var name = $('#name').val();
        var description = $('#description').val();
        formData.append('name', name);
        formData.append('description', description);
        
        $.ajax({
            url: 'http://localhost/multiple_image_upload/public/api/uploads',
            method: 'POST',
            data: formData,
            contentType: false,
            processData:false,
            success: function(response){ 
                alert(response.data);
            }
        });
    });
</script>
@endsection