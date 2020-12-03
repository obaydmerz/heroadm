@extends('littleadm.layouts.app')

@section('content')
<section class="content-header">
    @include('littleadm.includes.crumb', [
    'crumb' => [
    ['title' => $title1, 'route' => 'littleadm.crud.' . strtolower($title1) . '.index']
    ],
    ])
</section>

<section class="content">
    <div class="container-fluid">
        <form action="{{route('littleadm.crud.' . strtolower($title1) . '.truncate')}}" style="display: none;"
            id="truncatef" method="post">
            @csrf
        </form>
        <div class="row">
            <div class="container">
                @if($permi->allowat(strtolower($title1) . '_create', $roles, auth()->user()->role))
                <div class="row col-12 mb-3">
                    <a href="{{route('littleadm.crud.' . strtolower($title1) . '.create')}}" style="height: 100%;"
                        class="btn btn-success text-center @if($permi->allowat(strtolower($title1) . '_delete', $roles, auth()->user()->role)) col-9 @else col-12 @endif mb-2">
                        <i class="fas fa-copy"></i> @lang('littleadm/littleadm.create')
                    </a>
                    @if($permi->allowat(strtolower($title1) . '_delete', $roles, auth()->user()->role))
                    <button type="button" onclick="sconfirm('@lang('littleadm/littleadm.truncate') ?', {icon: 'warning', yesbtn: '@lang('littleadm/littleadm.sweet.yes')', nobtn: '@lang('littleadm/littleadm.sweet.no')'}, function(){
                        document.getElementById('truncatef').submit();
                    }),function(){}" style="height: 100%;"
                        class="ml-2 col-2 btn btn-danger"><i class="fas fa-trash"></i> @lang('littleadm/littleadm.truncate')</button>
                    @endif
                </div>
                @endif
            </div>
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">{{$title1}}</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div id="example2_wrapper" class="dataTables_wrapper dt-bootstrap4">
                            <div class="row">
                                <div class="col-sm-12">
                                    @if($collection->count())
                                    <table id="example2" class="table table-bordered table-hover dataTable dtr-inline"
                                        role="grid" aria-describedby="example2_info">
                                        <thead>
                                            <tr role="row">
                                                <th class="sorting_asc" tabindex="0" aria-controls="example2"
                                                    rowspan="1" colspan="1" aria-sort="ascending">
                                                    ID</th>
                                                @foreach ($columns as $column)
                                                @if(isset($column->datas['rolesread']) ? in_array(auth()->user()->role, explode('|', $column->datas['rolesread'])) : true)
                                                    @if($column->type == "password" ? isset($column->datas['hashing']) ? !$column->datas['hashing'] : true : true)
                                                        <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1"
                                                            colspan="1" aria-label="{{$column->display_name}}">
                                                            {{$localetrt->isTrans($column->display_name) ? $localetrt->getTradCompressed($column->display_name, app()->getLocale(), 'Unknown Column') : $column->display_name}}</th>
                                                    @endif
                                                @endif
                                                @endforeach
                                                <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1"
                                                    colspan="1" aria-label="Actions">@lang('littleadm/littleadm.actions')
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($collection as $item)
                                            <tr role="row" class="odd">
                                                <td tabindex="0" class="sorting_1">{{$item->id}}</td>
                                                @foreach ($columns as $column)
                                                @if(isset($column->datas['rolesread']) ? in_array(auth()->user()->role, explode('|', $column->datas['rolesread'])) : true)
                                                    @if($column->type == "password" ? isset($column->datas['hashing']) ? !$column->datas['hashing'] : true : true)
                                                    <td>
                                                            @if($column->type == "text" || $column->type == "string")
                                                                @php
                                                                    $trans = isset($column->datas['trans']) ? $column->datas['trans'] :
                                                                    false;
                                                                @endphp
                                                                @if(($localetrt->isTrans($item[$column->name]) && $trans))
                                                                    {{$trans ? $localetrt->getTradCompressed($item[$column->name], app()->getLocale(), !$trans['def'] ? 'No Translate For Lang (' . app()->getLocale() . ')' : $trans['def']) : $item[$column->name]}}
                                                                @else
                                                                    {{$trans ? $localetrt->getTradCompressed($item[$column->name], app()->getLocale(), 'No Translate For Lang (' . app()->getLocale() . ')') : $item[$column->name]}}
                                                                @endif
                                                            @elseif($column->type == "imageurl")
                                                                <img src="{{$item[$column->name]}}">
                                                            @elseif($column->type == "attr")
                                                                @php
                                                                    $trans = isset($column->datas['trans']) ? $column->datas['trans'] :
                                                                    false;
                                                                @endphp
                                                                @if(($localetrt->isTrans($item[$column->name]) && $trans))
                                                                    {{$trans ? $localetrt->getTradCompressed($item[$column->name], app()->getLocale(), !$trans['def'] ? 'No Translate For Lang (' . app()->getLocale() . ')' : $trans['def']) : $item[$column->name]}}
                                                                @else
                                                                {{$trans ? $localetrt->getTradCompressed($item[$column->name], app()->getLocale(), 'No Translate For Lang (' . app()->getLocale() . ')') : $item[$column->name]}}
                                                            @endif
                                                            @elseif($column->type == "integer")
                                                                {{$item[$column->name]}}
                                                            @elseif($column->type == "email")
                                                                {{$item[$column->name]}}
                                                            @elseif($column->type == "url")
                                                                <a href="{{$item[$column->name]}}"
                                                                    target="{{$column->datas['target']}}">{{$item[$column->name]}}</a>
                                                            @elseif($column->type == "file")
                                                                @if($column->datas['type'] == "image")
                                                                    <img
                                                                        src="{{asset('storage/' . strtolower($title1) . '/' . $column->name . '/' . $item[$column->name])}}">
                                                                @else
                                                                <a href="{{asset('storage/' . strtolower($title1) . '/' . $column->name . '/' . $item[$column->name])}}"
                                                                    download="{{$item[$column->name]}}">@lang('littleadm/littleadm.download')</a>
                                                            @endif
                                                            @elseif($column->type == "default")
                                                                {{$item[$column->name]}}
                                                            @elseif($column->type == "relation")
                                                                @php
                                                                    $colunmret = $item[$column->datas['relation']];
                                                                    $valueret = $colunmret[$column->datas['relation_column_returned']];
                                                                @endphp
                                                                {{$localetrt->isTrans($valueret) ? $localetrt->getTradCompressed($valueret, app()->getLocale()) : $valueret}}
                                                            @elseif($column->type == "auto_increment")
                                                                {{$item[$column->name]}}
                                                            @elseif($column->type == "enum")
                                                                {{$item[$column->name]}}
                                                            @elseif($column->type == "relationmany")
                                                                <button class="btn btn-success"
                                                                    onclick="getRelationMany('{{$column->datas['model']}}', '{{$column->datas['name']}}')">
                                                                    {{ucfirst($column->datas['name'])}}
                                                                </button>
                                                            @elseif($column->type == "date")
                                                                {{$item[$column->name]}}
                                                            @endif
                                                        @endif
                                                    @endif
                                                </td>
                                                @endforeach
                                                <td class="row d-flex justify-content-center">
                                                    @if($permi->allowat(strtolower($title1) . '_update', $roles,
                                                    auth()->user()->role))
                                                    <a href="{{route('littleadm.crud.' . strtolower($title1) . '.update', ['id' => $item->id])}}"
                                                        class="btn btn-primary"><i class="fas fa-edit"></i> @lang('littleadm/littleadm.edit')</a>
                                                    @endif
                                                    @if($permi->allowat(strtolower($title1) . '_delete', $roles,
                                                    auth()->user()->role))
                                                    <form
                                                        action="{{route('littleadm.crud.' . strtolower($title1) . '.delete', ['id' => $item->id])}}"
                                                        method="post" id="frmdelete{{$item->id}}">
                                                        @csrf
                                                    </form>
                                                    <button onclick="sconfirm('@lang('littleadm/littleadm.lang.deletei') ?', {icon: 'warning', yesbtn: '@lang('littleadm/littleadm.sweet.yes')', nobtn: '@lang('littleadm/littleadm.sweet.no')'}, function(){
                                                        document.getElementById('frmdelete{{$item->id}}').submit();
                                                    }),function(){}" class="ml-2 btn btn-danger"><i
                                                            class="fas fa-trash"></i> @lang('littleadm/littleadm.delete')</button>
                                                </td>
                                                @endif
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    @else
                                    <h1 class="text-danger text-center">@lang('littleadm/littleadm.not') {{$title1}}</h1>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.row -->
            </div>

            <div class="modal fade" id="manyrelmodel" tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
                aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Many Relation</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <table class="table">
                                <thead id="manyrelhd">
                                    <tr>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody id="manyrelbd">
                                    <tr>
                                        <td scope="row"></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
</section>
@endsection

@section('scripts')
<script defer>
    $('#example2').DataTable({
     "paging": true,
     "lengthChange": true,
     "searching": true,
     "ordering": true,
     "info": true,
     "autoWidth": false,
     "responsive": true,
   });
   $('#example1').DataTable({
     "paging": true,
     "lengthChange": true,
     "searching": true,
     "ordering": true,
     "info": true,
     "autoWidth": false,
     "responsive": true,
   });

   function getRelationMany(model, name){
       $.getJSON("http://winrak.org/fr/littleadm/subscribes/relationmany?model=" + model + "&name=" + name, function( json ) {
           var html = `<tr>`;
           var html1 = ``;
           var htp = '';


           json.schema.forEach(function(jn){
               html += `
                   <th>${jn}</th>
               `;
           });

           html += "</tr>";

           json.values.forEach(function(jn){
               htp = "<tr>";
               json.schema.forEach(function(jll){
                   htp += `
                       <th>${jn[jll]}</th>
                   `;
               });
               htp += "</tr>";
               html1 += htp;
           });

           document.getElementById("manyrelhd").innerHTML = html;
           document.getElementById("manyrelbd").innerHTML = html1;
           $("#manyrelmodel").modal();
       });
   }
</script>
@endsection