@extends('heroadm::layouts.master')

@section('content')
<section class="content-header">
    @include('heroadm::includes.crumb', [
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
            <form action="{{route('heroadm.media.upfile')}}" method="post">
                @csrf
                <input type="hidden" name="new" value="media_new">
                <div class="form-group">
                    <label for="path">Path:</label>
                    <input type="text" name="path" id="path" class="form-control">
                </div>
                <div class="form-group">
                    <label for="file">File:</label>
                    <textarea type="file" name="file" id="file" cols="30" rows="10" class="form-control"></textarea>
                </div>
                <div class="form-group container row">
                    <button class="btn btn-success" type="submit">@lang('heroadm/site.media.new')</button>
                </div>
            </form>
        </div>
    </div>

</section>
<!-- /.content -->
@endsection