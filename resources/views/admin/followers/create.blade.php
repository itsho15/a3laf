@extends('layouts.inverse')

@section('content')
    <div class="container-fluid">
            <!-- ============================================================== -->
                <!-- Bread crumb and right sidebar toggle -->
                <!-- ============================================================== -->
                <div class="row page-titles">
                    <div class="col-md-5 align-self-center">
                        <h4 class="text-themecolor">@lang('models/followers.singular')</h4>
                    </div>
                    <div class="col-md-7 align-self-center text-right">
                        <div class="d-flex justify-content-end align-items-center">
                             <ol class="breadcrumb">
                              <li class="breadcrumb-item">
                                 <a href="{!! route('admin.followers.index') !!}">@lang('models/followers.singular')</a>
                              </li>
                              <li class="breadcrumb-item active">@lang('backend.Create')</li>
                            </ol>

                        </div>
                    </div>
                </div>
                <!-- ============================================================== -->
                <!-- End Bread crumb and right sidebar toggle -->
                <!-- ============================================================== -->
                <!-- ============================================================== -->
                <!-- Start Page Content -->
                <!-- ============================================================== -->
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                  {!! Form::open(['route' => 'admin.followers.store']) !!}

                                    @include('admin.followers.fields')

                                {!! Form::close() !!}
                            </div>
                        </div>
                    </div>
                </div>
                <!-- ============================================================== -->
                <!-- End PAge Content -->
                <!-- ============================================================== -->
    </div>
@endsection
