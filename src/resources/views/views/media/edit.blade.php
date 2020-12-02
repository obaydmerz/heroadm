@extends('littleadm.layouts.app')

@section('content')
<section class="content-header">
    @include('littleadm.includes.crumb', [
        'crumb' => [
            ['title' => 'Media', 'route' => 'littleadm.media'],
            ['title' => 'Upload', 'route' => 'littleadm.media.upload'],
        ]
    ])
</section>

<!-- Main content -->
<section class="content">
    <!-- Info boxes -->
    <div class="row">
        <div class="container">
            <form action="{{route('littleadm.media.upfile')}}" method="post">
                @csrf
                <div class="form-group">
                    <label for="path">Path:</label>
                    <input type="text" name="path" value="{{$path}}" id="path" class="form-control">
                </div>
                <div class="form-group">
                    <label for="file">File:</label>
                    <textarea type="file" name="file" id="file" cols="30" rows="10" class="form-control">{{$data}}</textarea>
                </div>
                <div class="form-group container row">
                    <button class="btn btn-success" type="submit">Edit</button>
                </div>
            </form>
        </div>
    </div>

</section>
<!-- /.content -->
@endsection