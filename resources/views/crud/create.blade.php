@extends('heroadm::layouts.master')

@section('content')
<section class="content-header">
    @include('heroadm.includes.crumb', [
        'crumb' => [
            ['title' => ucfirst(strtolower($title1)), 'route' => 'heroadm.crud.' . strtolower($title1) . '.index']
        ]
    ])
</section>

@section('content')

<div class="row row-sm">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-header pb-0">
                <div class="d-flex justify-content-between">
                    <h4 class="card-title mg-b-0">Create In {{ucfirst($title1)}}</h4>
                    <i class="mdi mdi-dots-horizontal text-gray"></i>
                </div>
                {{-- <p class="tx-12 tx-gray-500 mb-2">Example of Valex Simple Table. <a href="">Learn more</a></p> --}}
            </div>
            <div class="card-body">
                <form action="{{route('heroadm.crud.' . strtolower($title1) . '.store')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    @foreach ($columns as $column)   
                        @if(isset($column->datas['rolescontrol']) ? in_array(auth()->user()->role, explode('|', $column->datas['rolescontrol'])) : true)               
                            <div class="form-group">
                                @if(($column->type != "relationmany" && ($column->type == "relation" ? ((isset($column->datas['auto_create']) && $column->datas['auto_create'] == true)) != true : true)) && $column->type != "auto_increment")
                                    <label for="{{$column->name}}">{{$localetrt->isTrans($column->display_name) ? $localetrt->getTradCompressed($column->display_name, app()->getLocale(), 'Unknown Column') : $column->display_name}}</th>:</label>
                                @endif
                                @if($column->type == "text")
                                    @if($trans = (isset($column->datas['trans']) ? $column->datas['trans'] : false))
                                        <div class="jumbotron p-3" id="{{$column->name}}">
                                            @foreach ($trans['langs'] as $lang)
                                                <label for="{{$column->name}}_{{$lang}}">{{$localetrt->isTrans($column->display_name) ? $localetrt->getTradCompressed($column->display_name, app()->getLocale(), 'Unknown Column') : $column->display_name}} {{__('heroadm/heroadm.per_' . $lang)}}</th></label>
                                                <textarea name="{{$column->name}}_{{$lang}}" id="{{$column->name}}_{{$lang}}" cols="30" rows="10" class="form-control"></textarea>
                                            @endforeach
                                        </div>
                                    @else
                                        <textarea name="{{$column->name}}" id="{{$column->name}}" cols="30" rows="10" class="form-control"></textarea>
                                    @endif      
                                @elseif($column->type == "string")
                                    @if($trans = (isset($column->datas['trans']) ? $column->datas['trans'] : false))
                                        <div class="jumbotron p-3" id="{{$column->name}}">
                                            @foreach ($trans['langs'] as $lang)
                                                <label for="{{$column->name}}_{{$lang}}">{{$localetrt->isTrans($column->display_name) ? $localetrt->getTradCompressed($column->display_name, app()->getLocale(), 'Unknown Column') : $column->display_name}} {{__('heroadm/heroadm.per_' . $lang)}}</label>
                                                <input type="text" name="{{$column->name}}_{{$lang}}" id="{{$column->name}}_{{$lang}}" class="form-control">
                                            @endforeach
                                        </div>
                                    @else
                                        <input type="text" name="{{$column->name}}" id="{{$column->name}}" class="form-control">
                                    @endif
                                @elseif($column->type == "email")
                                    <input type="email" name="{{$column->name}}" id="{{$column->name}}" class="form-control">
                                @elseif($column->type == "integer")
                                    <input type="number" name="{{$column->name}}" id="{{$column->name}}" class="form-control">
                                @elseif($column->type == "password")
                                    <input type="password" name="{{$column->name}}" id="{{$column->name}}" class="form-control">
                                @elseif($column->type == "enum")
                                    <select id="{{$column->name}}" name="{{$column->name}}" class="form-control">
                                        @if(!$column->required)
                                            <option value="">@lang('heroadm/heroadm.lang.none')</option>
                                        @endif
                                        @foreach ($column->datas['values'] as $value)
                                            <option value="{{$value}}">{{$value}}</option>
                                        @endforeach
                                    </select>
                                @elseif($column->type == "switch")
                                    <div class="custom-control text-center custom-switch col-6">
                                        <input type="checkbox" class="custom-control-input" id="{{$column->name}}" name="{{$column->name}}">
                                        <label class="custom-control-label mt-1" for="{{$column->name}}"></label>
                                    </div>
                                @elseif($column->type == "imageurl")
                                    <input type="text" name="{{$column->name}}" id="{{$column->name}}" class="form-control">
                                @elseif($column->type == "file")
                                    <input type="file" name="{{$column->name}}" id="{{$column->name}}" class="form-control">
                                @elseif($column->type == "relation" && !(isset($column->datas['auto_create']) && $column->datas['auto_create'] == true))
                                    <select id="{{$column->name}}" name="{{$column->name}}">
                                        @if(!$column->required)
                                            <option value="">@lang('heroadm/heroadm.lang.none')</option>
                                        @endif
                                    </select>
                                @elseif($column->type == "date")
                                    <input type="date" name="{{$column->name}}" id="{{$column->name}}" class="form-control">
                                @elseif($column->type == "url")
                                    <input type="text" name="{{$column->name}}" id="{{$column->name}}"  class="form-control">
                                @endif
                            </div>
                        @endif
                    @endforeach
                    <div class="form-group container row">
                        <button class="btn btn-success" id="btn-save" type="submit">Save</button>
                        <a href="{{route('heroadm.crud.' . strtolower($title1) . '.index')}}" class="btn btn-danger ml-2">Close</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
@endsection

@section('scripts')
    <script>
        @foreach ($columns as $column)
            @if($column->type == "relation")
                $('#' + '{{$column->name}}').select2({
                    ajax: {
                        url: "{{route('heroadm.crud.' . strtolower($title1) . '.relation')}}",
                        data: function (params) {
                            var query = {
                                table: '{{$column->datas['relation_model']}}',
                                column: '{{$column->datas['relation_column_returned']}}',
                                requi: {{$column->required == true ? 'true' : 'false'}},
                                term: params.term
                            }

                            return query;
                        }
                    }
                });
            @endif
        @endforeach
    </script>
    <style>
        .select2 {
            width: 100% !important;
        }
    </style>
@endsection

@section('scripts')
    <script>
        @foreach ($columns as $column)
            @if($column->type == "relation")
                $('#' + '{{$column->name}}').select2({
                    ajax: {
                        url: "{{route('heroadm.crud.' . strtolower($title1) . '.relation')}}",
                        data: function (params) {
                            var query = {
                                table: '{{$column->datas['relation_model']}}',
                                column: '{{$column->datas['relation_column_returned']}}',
                                requi: {{$column->required == true ? 'true' : 'false'}},
                                term: params.term
                            }

                            return query;
                        }
                    }
                });
            @endif
        @endforeach

        
    </script>
    <style>
        .select2 {
            width: 100% !important;
        }
    </style>
@endsection