@extends('littleadm.layouts.app')

@section('content')
<section class="content-header">
    @include('littleadm.includes.crumb', [
        'crumb' => [
            ['title' => 'Configs', 'route' => 'littleadm.configs']
        ],
    ])
</section>

<section class="content">
<form style="display: none;" action="{{route('littleadm.configs.default')}}" method="POST" id="formformr">
    @csrf
</form>
    <form action="{{route('littleadm.configs.save')}}" method="POST">
        @csrf
        <div class="container">

            <div>
                @foreach ($configs->getAll() as $config)
                    <div class="row" title="@if($config->desc) {{$config->desc}} @else {{$config->display_name}} @endif">
                        <h3 class="col-6 @if($config->val != "off" && $config->val != "" && $config->val != "0") text-success @else text-danger @endif"><i class="fas fa-cogs"></i>&nbsp;&nbsp;{{$localetrt->isTrans($config->display_name) ? $localetrt->getTradCompressed($config->display_name, app()->getLocale()) : $config->display_name}}</h3>
                        @if($config->type == "switch")
                            <div class="custom-control text-center custom-switch col-6">
                                <input type="checkbox" class="custom-control-input" id="{{$config->name}}" name="{{$config->name}}" onchange="ch(this, {{$config->que}})" @if($config->val != "off") checked @endif>
                                <label class="custom-control-label mt-1" for="{{$config->name}}"></label>
                            </div>
                        @else
                            <div class="form-group text-center col-6">
                                <input type="text" class="form-control" id="{{$config->name}}" name="{{$config->name}}" placeholder="{{$config->default_val}} | Type // Or Leave Empty To Set The Defualt Value " value="{{$config->val}}">
                            </div>
                        @endif
                    </div>
                @endforeach
            </div>
            <div class="row text-center mb-3">
                <div class="col-7"></div>
                <button type="button" onclick="confirm('Convert touts les configurations a par default') ? document.getElementById('formformr').submit() : ''" class="btn btn-success col-2">Par Default</button>
                <button type="submit" class="btn btn-primary ml-2 col-2">Soumettere</button>
            </div>       
        </div>
    </form>
    <script>
        function ch(elem, que){
            if(que == 1 && elem.checked == true){
                if(!confirm('Change The Configuration ?\n This Action is not ...')){
                    elem.checked = false;
                }
            }else if(que == 2 && elem.checked == false){
                if(!confirm('Change The Configuration ?\n This Action is not ...')){
                    elem.checked = true;
                }
            }
        }
    </script>
</section>
@endsection
