@extends('heroadm::layouts.master')

@section('content')
<section class="content-header">
    @include('heroadm::includes.crumb', [
        'crumb' => [
            ['title' => 'Users', 'route' => 'heroadm.users'],
            ['title' => 'Send Notification', 'route' => 'heroadm.users'],
        ]
    ])
</section>

<!-- Main content -->
<section class="content">
    <!-- Info boxes -->
    <div class="row">
        <div class="container">
            <form action="{{route('heroadm.users.sendntf', ['id' => $user->id])}}" method="post">
                @csrf
                <div class="form-group">
                <label for="dataf">Data:</label>
                <textarea name="data" id="dataf" cols="30" rows="10" class="form-control"></textarea>
                </div>
                <div class="form-group container row">
                    <button class="btn btn-success" type="submit">Notify</button>
                    <a class="btn btn-danger ml-1" href="{{route('heroadm.users')}}">Close</a>
                </div>
            </form>
        </div>
    </div>

</section>
<!-- /.content -->
@endsection