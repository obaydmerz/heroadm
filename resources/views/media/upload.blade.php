@extends('heroadm.layouts.app')

@section('content')
<section class="content-header">
    @include('heroadm.includes.crumb', [
        'crumb' => [
            ['title' => 'Media', 'route' => 'heroadm.media'],
            ['title' => 'Upload', 'route' => 'heroadm.media.upload'],
        ]
    ])
</section>

<!-- Main content -->
<section class="content">
    <!-- Info boxes -->
    <div class="row">
        <div class="container">
            <form action="{{route('heroadm.media.uploadfile')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="path">Path:</label>
                    <input type="text" name="path" id="path" class="form-control">
                </div>
                <div class="form-group">
                    <label for="fnfn">File Name:</label>
                    <input type="text" name="fn" id="fn" class="form-control">
                </div>
                <div class="form-group">
                    <label for="file">File:</label>
                    <input type="file" name="file" id="file" class="form-control">
                </div>
                <div class="form-group container row">
                    <button class="btn btn-success" type="submit">Upload</button>
                </div>
            </form>
        </div>
    </div>

</section>
<!-- /.content -->
@endsection