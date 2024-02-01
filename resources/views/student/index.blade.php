@extends('layout')

@section('css')

@endsection

@section('content')
<div class="container mt-5">
    <div class="row">
        <div class="col-md-12">
            <h5>Student Information</h5>
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
                    @foreach($students as $student)
                    <tr>
                        <td>{{ $student->name }}</td>
                        <td>{{ $student->email }}</td>
                        <td>
                            <img src="{{asset('uploads/' . $student->photo)}}" class="m-2" width="50" height="50" alt="Image">
                        </td>
                        <td>
                            <input type="hidden" id="id" value="{{$student->id}}">
                            <button id="delBtn" class="btn btn-danger">Delete</button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@section('js')

@endsection