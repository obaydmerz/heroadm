@extends('littleadm.layouts.app')

@section('content')
<section class="content-header">
    @include('littleadm.includes.crumb', [
        'crumb' => [
            ['title' => 'Media', 'route' => 'littleadm.media']
        ]
    ])
</section>

<!-- Main content -->
<section class="content">
    <!-- Info boxes -->
    <div class="row d-flex justify-content-center">
        <table class="table">
            <thead>
                <tr role="row">
                    <th class="sorting_asc" tabindex="0" aria-controls="example2" rowspan="1"
                        colspan="1" aria-sort="ascending">Type</th>
                    <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1"
                        colspan="1">Name
                    </th>
                    <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1"
                        colspan="1">
                        Size</th>
                    <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1"
                        colspan="1">
                        Mime</th>
                    <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1"
                        colspan="1">
                        Public Path</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($dirs as $dir)
                    {{-- @php
                        dd(route('littleadm.media', ['path' =>  $dir->path . $dir->name]));
                    @endphp --}}
                    @if(str_replace('/storage', '', $dir->path) == $path . $dir->name)
                        <tr role="row" class="odd">
                            <td class="sorting_1">Directory</td>
                            <td><a onclick="location.assign(location.href + '{{$dir->name}}/')">{{$dir->name}}</a></td>
                            <td>/</td>
                            <td>/</td>
                            <td title="{{$dir->path}}">
                                <a href="{{asset($dir->path)}}" target="_blank">Public Path</a>
                            </td>
                        </tr>
                    @endif
                @endforeach
                @foreach ($files as $file)
                    {{-- @php
                        dd($file);
                    @endphp --}}
                    @if(str_replace('/storage', '', $file->path) == $path . $file->name . '.' . $file->mime)
                        <tr role="row" class="odd">
                            <td class="sorting_1">File</td>
                            <td><a onclick="location.assign(location.href + '{{$file->name . '.' . $file->mime}}')">{{$file->name}}</a></td>
                            <td>{{$file->size}}</td>
                            <td>{{$file->mime}}</td>
                            <td title="{{$file->path}}">
                                <a href="{{asset($file->path)}}" target="_blank">Public Path</a>
                            </td>
                        </tr>
                    @endif
                @endforeach
            </tbody>
        </table>
    </div>

</section>
@endsection