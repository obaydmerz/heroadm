@extends('layouts.master')
@section('title')
{{ __('site.title page index cite') }}
@stop
@section('css')
<!-- Internal Data table css -->
<link href="{{URL::asset('assets/plugins/datatable/css/dataTables.bootstrap4.min.css')}}" rel="stylesheet" />
<link href="{{URL::asset('assets/plugins/datatable/css/buttons.bootstrap4.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/datatable/css/responsive.bootstrap4.min.css')}}" rel="stylesheet" />
<link href="{{URL::asset('assets/plugins/datatable/css/jquery.dataTables.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/datatable/css/responsive.dataTables.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet">

@endsection
@section('page-header')
<!-- breadcrumb -->
@include('heroadm.includes.crumb', [
'crumb' => [
['title' => $title1, 'route' => 'heroadm.crud.' . strtolower($title1) . '.index']
],
])
<!-- breadcrumb -->
@endsection
@section('content')



<!-- row -->
<div class="row">
    <div class="col-xl-12">

        <div class="card mg-b-20">
            <div class="card-header pb-0">
                <div class="d-flex justify-content-between">
                    <a class="btn ripple btn-primary" data-target="#modaldemo1" data-toggle="modal"
                        href="">{{ ucfirst($title1) }}</a>
                </div>
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table id="example1" class="table key-buttons text-md-nowrap">
                        <thead>
                            <tr>
                                @foreach ($columns as $column)
                                    @if(isset($column->datas['rolesread']) ? in_array(auth()->user()->role, explode('|',
                                        $column->datas['rolesread'])) : true)
                                        @if($column->type == "password" ? isset($column->datas['hashing']) ?
                                                !$column->datas['hashing'] : true : true)
                                            <th class="border-bottom-0"
                                                aria-label="{{$column->display_name}}">
                                                {{$localetrt->isTrans($column->display_name) ? $localetrt->getTradCompressed($column->display_name, app()->getLocale(), 'Unknown Column') : $column->display_name}}
                                            </th>
                                        @endif
                                    @endif
                                @endforeach

                                <th class="border-bottom-0">Actions</th>

                            </tr>
                        </thead>
                        <tbody>
                            @isset($cites)
                                @foreach ($cites as $cite)
                                <tr>
                                    <td>{{$item->id}}</td>
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
                                                        download="{{$item[$column->name]}}">@lang('heroadm/heroadm.download')</a>
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
                                                    <a href="{{route('heroadm.crud.' . strtolower($title1) . '.update', ['id' => $item->id])}}"
                                                        class="btn btn-primary"><i class="fas fa-edit"></i> @lang('heroadm/heroadm.edit')</a>
                                                    @endif
                                                    @if($permi->allowat(strtolower($title1) . '_delete', $roles,
                                                    auth()->user()->role))
                                                    <form
                                                        action="{{route('heroadm.crud.' . strtolower($title1) . '.delete', ['id' => $item->id])}}"
                                                        method="post" id="frmdelete{{$item->id}}">
                                                        @csrf
                                                    </form>
                                                    <button onclick="sconfirm('@lang('heroadm/heroadm.lang.deletei') ?', {icon: 'warning', yesbtn: '@lang('heroadm/heroadm.sweet.yes')', nobtn: '@lang('heroadm/heroadm.sweet.no')'}, function(){
                                                        document.getElementById('frmdelete{{$item->id}}').submit();
                                                    }),function(){}" class="ml-2 btn btn-danger"><i
                                                            class="fas fa-trash"></i> @lang('heroadm/heroadm.delete')</button>
                                    </td>
                                    @endif
                                </tr>
                                @endforeach
                            @endisset

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!--/div-->
{{-- 
    <!-- Add cite -->
    <div class="modal" id="modaldemo1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content modal-content-demo">
                <div class="modal-header">
                    <h6 class="modal-title">{{ __('site.add cite') }}</h6><button aria-label="Close" class="close"
                        data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('cite.store') }}" method="post" autocomplete="off">
                        @csrf

                        <div class="form-group">
                            <label for="name">{{ __('site.nom cite fr') }}</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}">
                        </div>



                        <div class="form-group">
                            <label for="name_ar">{{ __('site.nom cite ar') }}</label>
                            <input type="text" class="form-control" id="name_ar" name="name_ar"
                                value="{{ old('name_ar') }}">
                        </div>



                        <div class="form-group">
                            <label for="cite_id" class="col-md-4 control-label">{{ __('site.commune') }} :</label>
                            <div class="col-md-6">
                                <select name="commune_id" id="commune_id" class="form-control">
                                    @isset($communes)

                                    @foreach($communes as $commune)
                                    @if (App::isLocale('ar'))
                                    <option value="{{ $commune->id }}">{{ $commune->name_ar }}</option>
                                    @else
                                    <option value="{{ $commune->id }}">{{ $commune->name }}</option>
                                    @endif

                                    @endforeach
                                    @endisset
                                </select>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="submit" class="btn btn-success">{{ __('site.confirmer') }}</button>
                            <button type="button" class="btn btn-secondary"
                                data-dismiss="modal">{{ __('site.annuler') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
    <!-- End Add cite -->

    <!-- edit -->
    <div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="d-flex justify-content-between">
                        <h4 class="card-title mg-b-0">Edit {{ucfirst($title1)}}</h4>
                        <i class="mdi mdi-dots-horizontal text-gray"></i>
                    </div>
                </div>
                <div class="modal-body">
                    <form action="/" id="ed_form" method="post" enctype="multipart/form-data">
                        @csrf
                        @foreach ($columns as $column)
                            @if(isset($column->datas['rolescontrol']) ? in_array(auth()->user()->role, explode('|', $column->datas['rolescontrol'])) : true)                  
                                <div class="form-group">
                                    @if(($column->type != "relationmany" && ($column->type == "relation" ? ((isset($column->datas['auto_create']) && $column->datas['auto_create'] == true)) != true : true)) && $column->type != "auto_increment")
                                        <label for="{{$column->name}}">{{$localetrt->isTrans($column->display_name) ? $localetrt->getTradCompressed($column->display_name, app()->getLocale(), 'Unknown Column') : $column->display_name}}</th>:</label>
                                    @endif
                                    @if($column->type == "text")
                                        @if($trans = (isset($column->datas['trans']) ? $column->datas['trans'] : false))
                                            @php
                                                $lostr = $localetrt->extract($collection[$column->name]);
                                            @endphp
                                            <div class="jumbotron p-3" id="{{$column->name}}">
                                                @foreach ($trans['langs'] as $lang)
                                                    <label for="{{$column->name}}_{{$lang}}">{{$localetrt->isTrans($column->display_name) ? $localetrt->getTradCompressed($column->display_name, app()->getLocale(), 'Unknown Column') : $column->display_name}} {{__('heroadm/heroadm.per_' . $lang)}}</label>
                                                    <textarea name="{{$column->name}}_{{$lang}}" id="{{$column->name}}_{{$lang}}" cols="30" rows="10" class="form-control">{{$lostr[$lang]}}</textarea>
                                                @endforeach
                                            </div>
                                        @else
                                            <textarea name="{{$column->name}}" id="{{$column->name}}" cols="30" rows="10" class="form-control"></textarea>
                                        @endif
                                    @elseif($column->type == "string")
                                        @if($trans = (isset($column->datas['trans']) ? $column->datas['trans'] : false))
                                            @php
                                                $lostr = $localetrt->extract($collection[$column->name]);
                                            @endphp
                                            <div class="jumbotron p-3" id="{{$column->name}}">
                                                @foreach ($trans['langs'] as $lang)
                                                    <label for="{{$column->name}}_{{$lang}}">{{$localetrt->isTrans($column->display_name) ? $localetrt->getTradCompressed($column->display_name, app()->getLocale(), 'Unknown Column') : $column->display_name}} {{__('heroadm/heroadm.per_' . $lang)}}</label>
                                                    <input type="text" name="{{$column->name}}_{{$lang}}" id="{{$column->name}}_{{$lang}}" value="{{$lostr[$lang]}}" class="form-control">
                                                @endforeach
                                            </div>
                                        @else
                                            <input type="text" name="{{$column->name}}" id="{{$column->name}}" value="{{$collection[$column->name]}}" class="form-control">
                                        @endif
                                    @elseif($column->type == "email")
                                        <input type="email" name="{{$column->name}}" id="{{$column->name}}" value="{{$collection[$column->name]}}" class="form-control">
                                    @elseif($column->type == "integer")
                                        <input type="number" name="{{$column->name}}" id="{{$column->name}}" value="{{$collection[$column->name]}}" class="form-control">
                                    @elseif($column->type == "password")
                                        <input type="password" name="{{$column->name}}" id="{{$column->name}}" class="form-control">
                                    @elseif($column->type == "imageurl")
                                        <input type="text" name="{{$column->name}}" id="{{$column->name}}" value="{{$collection[$column->name]}}" class="form-control">
                                    @elseif($column->type == "enum")
                                        <select id="{{$column->name}}" name="{{$column->name}}" class="form-control">
                                            @if(!$column->required)
                                                <option value="" @if(!$collection[$column->name]) selected @endif>@lang('heroadm/heroadm.lang.none')</option>
                                            @endif
                                            @foreach ($column->datas['values'] as $value)
                                                <option value="{{$value}}" @if($collection[$column->name] == $value) selected @endif>{{$value}}</option>
                                            @endforeach
                                        </select>
                                    @elseif($column->type == "switch")
                                        <div class="custom-control text-center custom-switch col-6">
                                            <input type="checkbox" class="custom-control-input" id="{{$column->name}}" name="{{$column->name}}" @if($collection[$column->name] != "off") checked @endif>
                                            <label class="custom-control-label mt-1" for="{{$column->name}}"></label>
                                        </div>
                                    @elseif($column->type == "file")
                                        <input type="file" name="{{$column->name}}" id="{{$column->name}}" value="{{$collection[$column->name]}}" class="form-control">
                                    @elseif($column->type == "date")
                                        <input type="date" name="{{$column->name}}" id="{{$column->name}}" value="{{$collection[$column->name]}}" class="form-control">
                                    @elseif($column->type == "relation" && !(isset($column->datas['auto_create']) && $column->datas['auto_create'] == true))
                                        <select id="{{$column->name}}" name="{{$column->name}}" style="width: 100%;">
                                            @if(!$column->required && !$collection[$column->name])
                                                <option value="">@lang('heroadm/heroadm.lang.none')</option>
                                            @else
                                                @php
                                                $colunmret = $collection[$column->datas['relation']];
                                                $valueret = $colunmret[$column->datas['relation_column_returned']];
                                                @endphp
                                                <option value="{{$collection[$column->name]}}">{{$localetrt->isTrans($valueret) ? $localetrt->getTradCompressed($valueret, app()->getLocale()) : $valueret}}</option>
                                            @endif
                                        </select>
                                    @elseif($column->type == "url")
                                        <input type="text" name="{{$column->name}}" id="{{$column->name}}" value="{{$collection[$column->name]}}" class="form-control">
                                    @endif
                                </div>
                            @endif
                        @endforeach
                        <div class="form-group container row">
                            <button class="btn btn-success" type="submit">Save</button>
                            <a href="{{route('heroadm.crud.' . strtolower($title1) . '.index')}}" class="btn btn-danger ml-2">Close</a>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div> --}}

    {{-- <!-- delete -->
    <div class="modal" id="modaldemo9">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content modal-content-demo">
                <div class="modal-header">
                    <h6 class="modal-title">{{ __('site.remove cite') }}</h6><button aria-label="Close" class="close"
                        data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                </div>
                <form action={{ route('cite.destroy', '') }} method="post">
                    @method('delete')
                    @csrf
                    <div class="modal-body">
                        <p>{{ __('site.confirme suppression') }}</p><br>
                        <input type="hidden" name="id" id="id" value="">
                        <input class="form-control" name="name" id="name" type="text" readonly>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary"
                            data-dismiss="modal">{{ __('site.annuler') }}</button>
                        <button type="submit" class="btn btn-danger">{{ __('site.confirmer') }}</button>
                    </div>

                </form>
            </div>
        </div>
    </div> --}}
</div>
</div>
</div>
@endsection
@section('js')
<!-- Internal Data tables -->
<script src="{{URL::asset('assets/plugins/datatable/js/jquery.dataTables.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/dataTables.dataTables.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/responsive.dataTables.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/jquery.dataTables.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/dataTables.bootstrap4.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/dataTables.buttons.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/buttons.bootstrap4.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/jszip.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/pdfmake.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/vfs_fonts.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/buttons.html5.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/buttons.print.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/buttons.colVis.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/responsive.bootstrap4.min.js')}}"></script>
<!--Internal  Datatable js -->
<script src="{{URL::asset('assets/js/table-data.js')}}"></script>

<script>
    $('#exampleModal2').on('show.bs.modal', function(event) {
        var originalact = "{{route('heroadm.crud.' . strtolower($title1) . '.edit', ['id' => 5885])}}";
        var button = $(event.relatedTarget);
		var id = button.data('id');

        var name = button.data('name');
        var name_ar = button.data('name_ar');
        var commune = button.data('commune_id');
        var modal = $(this);
        /* modal.find('.modal-body #ed_id').val(id); */
        modal.find('.modal-body #ed_name').val(name);
        modal.find('.modal-body #ed_name_ar').val(name_ar);
		modal.find('.modal-body form').prop(action, originalact.replace("5885", id));
		
		var el = document.getElementById("ed_cite_id");
	})
		
		$('#modaldemo9').on('show.bs.modal', function(event) {
			var button = $(event.relatedTarget)
			var id = button.data('id')
			var name = button.data('name')

			
			var modal = $(this)
			modal.find('.modal-body #id').val(id);
			modal.find('.modal-body #name').val(name);
		})


</script>


@endsection