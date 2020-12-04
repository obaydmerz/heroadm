@extends('heroadm::layouts.master')

@section('content')
<section class="content-header">
    @include('heroadm.includes.crumb', [
    'crumb' => [
    ['title' => $title1, 'route' => 'heroadm.crud.' . strtolower($title1) . '.index']
    ],
    ])
</section>

@section('content')

<div class="row row-sm">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-header pb-0">
                <div class="d-flex justify-content-between">
                    <h4 class="card-title mg-b-0">SIMPLE TABLE</h4>
                    <i class="mdi mdi-dots-horizontal text-gray"></i>
                </div>
                <p class="tx-12 tx-gray-500 mb-2">Example of Valex Simple Table. <a href="">Learn more</a></p>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table text-md-nowrap" id="example1">
                        <thead>
                            <tr>
                                <th class="wd-15p border-bottom-0">First name</th>
                                <th class="wd-15p border-bottom-0">Last name</th>
                                <th class="wd-20p border-bottom-0">Position</th>
                                <th class="wd-15p border-bottom-0">Start date</th>
                                <th class="wd-10p border-bottom-0">Salary</th>
                                <th class="wd-25p border-bottom-0">E-mail</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Bella</td>
                                <td>Chloe</td>
                                <td>System Developer</td>
                                <td>2018/03/12</td>
                                <td>$654,765</td>
                                <td>b.Chloe@datatables.net</td>
                            </tr>
                            <tr>
                                <td>Jennifer</td>
                                <td>Acosta</td>
                                <td>Junior Javascript Developer</td>
                                <td>2017/02/01</td>
                                <td>$75,650</td>
                                <td>j.acosta@datatables.net</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    
@endsection