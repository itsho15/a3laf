@extends('layouts.inverse')

@section('content')
    <div class="container-fluid">
           <!-- ============================================================== -->
                <!-- Bread crumb and right sidebar toggle -->
                <!-- ============================================================== -->
                <div class="row page-titles">
                    <div class="col-md-5 align-self-center">
                        <h4 class="text-themecolor">@lang('backend.users')</h4>
                    </div>
                    <div class="col-md-7 align-self-center text-right">
                        <div class="d-flex justify-content-end align-items-center">
                             <ol class="breadcrumb">
                              <li class="breadcrumb-item">
                                 <a href="{!! route('admin.categories.index') !!}">@lang('backend.Categories')</a>
                              </li>
                              <li class="breadcrumb-item active">@lang('backend.Details')</li>
                            </ol>
                            <a href="{!! route('admin.users.create') !!}" class="btn btn-info d-none d-lg-block m-l-15"><i class="fa fa-plus-circle"></i> @lang('backend.Create')</a>
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
                               @include('admin.categories.show_fields')
                            </div>
                        </div>
                    </div>
                </div>
                <!-- ============================================================== -->
                <!-- End PAge Content -->
                <!-- ============================================================== -->
    </div>
@endsection
