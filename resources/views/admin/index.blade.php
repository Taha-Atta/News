@extends('admin.app')
@section('title',"index")

@section('content')

    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
            
        </div>

        <!-- Content Row -->
        @livewire('admin.statices')
        <!-- Content Row -->

        <div class="row">

            <!-- Area Chart -->
            <div class="col-6">
                <div class="card shadow mb-4">

                    <div class="card-body">

                        <h4>{{ $User_chart->options['chart_title'] }}</h4>
                        {!! $User_chart->renderHtml() !!}

                    </div>
                </div>
            </div>
            <div class="col-6">
                <div class="card shadow mb-4">

                    <div class="card-body">

                        <h4>{{ $Post_chart->options['chart_title'] }}</h4>
                        {!! $Post_chart->renderHtml() !!}

                    </div>
                </div>
            </div>


        </div>

        <!-- Content Row -->
   @livewire('admin.latest-post-comments')

    </div>
    <!-- /.container-fluid -->
@endsection
@push('js')
{!! $Post_chart->renderChartJsLibrary() !!}
{!! $User_chart->renderJs() !!}
{!! $Post_chart->renderJs() !!}

@endpush