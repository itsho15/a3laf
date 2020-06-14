@extends('layouts.inverse')

@section('content')

    <div class="container-fluid">

          <div class="row page-titles">
            <div class="col-md-5 align-self-center">
                <h4 class="text-themecolor">@lang('backend.Category')</h4>
            </div>
            <div class="col-md-7 align-self-center text-right">
                <div class="d-flex justify-content-end align-items-center">
                     <ol class="breadcrumb">
                      <li class="breadcrumb-item">
                         <a href="{!! route('admin.users.index') !!}">@lang('backend.Categories')</a>
                      </li>
                      <li class="breadcrumb-item active">@lang('backend.Category')</li>
                    </ol>

                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">

                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif

                     {!! Form::open(['route' => 'admin.settings.store', 'files' => true]) !!}
                        {!! csrf_field() !!}

                        @if(count(config('setting_fields', [])) )

                            @foreach(config('setting_fields') as $section => $fields)
                                <div class="panel panel-info">
                                    <div class="panel-heading">
                                        <i class="{{ array_get($fields, 'icon', 'glyphicon glyphicon-flash') }}"></i>
                                        {{ $fields['title'] }}
                                    </div>

                                    <div class="panel-body">
                                        <p class="text-muted">{{ $fields['desc'] }}</p>
                                    </div>

                                    <div class="panel-body">
                                        <div class="row">
                                            <div class="col-md-7  col-md-offset-2">
                                                @foreach($fields['elements'] as $field)
                                                    @includeIf('admin.setting.fields.' . $field['type'] )
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <!-- end panel for {{ $fields['title'] }} -->
                            @endforeach

                        @endif

                        <div class="row m-b-md">
                            <div class="col-md-12">
                                <button class="btn-primary btn">
                                    Save Settings
                                </button>
                            </div>
                        </div>
                   {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection