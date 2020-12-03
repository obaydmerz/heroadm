@extends('littleadm.layouts.app')

@section('content')
<section class="content-header">
    @include('littleadm.includes.crumb', [
        'crumb' => [
            ['title' => ucfirst(strtolower($title1)), 'route' => 'littleadm.crud.' . strtolower($title1) . '.index']
        ]
    ])
</section>

<!-- Main content -->
<section class="content">
    <!-- Info boxes -->
    <div class="row">
        <div class="container">
            <form action="{{route('littleadm.crud.' . strtolower($title1) . '.edit', ['id' => $collection->id])}}" method="post" enctype="multipart/form-data">
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
                                            <label for="{{$column->name}}_{{$lang}}">{{$localetrt->isTrans($column->display_name) ? $localetrt->getTradCompressed($column->display_name, app()->getLocale(), 'Unknown Column') : $column->display_name}} {{__('littleadm/littleadm.per_' . $lang)}}</label>
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
                                            <label for="{{$column->name}}_{{$lang}}">{{$localetrt->isTrans($column->display_name) ? $localetrt->getTradCompressed($column->display_name, app()->getLocale(), 'Unknown Column') : $column->display_name}} {{__('littleadm/littleadm.per_' . $lang)}}</label>
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
                                        <option value="" @if(!$collection[$column->name]) selected @endif>@lang('littleadm/littleadm.lang.none')</option>
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
                                        <option value="">@lang('littleadm/littleadm.lang.none')</option>
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
                    <a href="{{route('littleadm.crud.' . strtolower($title1) . '.index')}}" class="btn btn-danger ml-2">Close</a>
                </div>
            </form>
        </div>
    </div>

</section>
<!-- /.content -->
@endsection

@section('scripts')
    <script>
        @foreach ($columns as $column)
            @if($column->type == "relation")
                $('#' + '{{$column->name}}').select2({
                    ajax: {
                        url: "{{route('littleadm.crud.' . strtolower($title1) . '.relation')}}",
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
