@extends('layouts.inverse')
@section('content')
    <div class="container-fluid">
            <!-- ============================================================== -->
                <!-- Bread crumb and right sidebar toggle -->
                <!-- ============================================================== -->
                <div class="row page-titles">
                    <div class="col-md-5 align-self-center">
                        <h4 class="text-themecolor">@lang('models/ads.singular')</h4>
                    </div>
                    <div class="col-md-7 align-self-center text-right">
                        <div class="d-flex justify-content-end align-items-center">
                             <ol class="breadcrumb">
                              <li class="breadcrumb-item">
                                 <a href="{!! route('admin.ads.index') !!}">@lang('models/ads.singular')</a>
                              </li>
                              <li class="breadcrumb-item active">@lang('backend.Edit')</li>
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
                                {!! Form::model($ad, ['route' => ['admin.ads.update', $ad->id], 'method' => 'patch','files' => true]) !!}

                                    @include('admin.ads.fields')

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

@push('css')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/min/dropzone.min.css">
<style>
    .dropzone .dz-preview .dz-image img {
        width: 100%;
        height: 100%;
    }
</style>

@endpush
@push('js')

<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/min/dropzone.min.js"></script>
<script type="text/javascript">
     Dropzone.autoDiscover = false;

    $(document).ready(function() {
        $('.select2').select2();

         $('#dropzonefileUpload').dropzone({
            url:"{{ url('api/v1/upload/image/'.$ad->id ) }}",
            pramName:'file',
            uploadMultiple:true,
            maxFiles:15,
            maxFilesSize:2, //mb
            acceptedFiles:'image/*',
            dictDefaultMessage:'{{ trans('front.upload_files') }}',
            dictRemoveFile:'<span class="btn btn-danger btn-sm mt-3"><i class="fa fa-trash"></i></span>',
            params:{
                _token:'{{ csrf_token() }}',
            },
            addRemoveLinks:true,
            removedfile:function(file){
                $.ajax({
                    dataType:'json',
                    type:'post',
                    url:'{{ url('api/v1/delete/image' ) }}',
                    data:{ _token:'{{ csrf_token() }}' , id: file.FileId }
                });
            var fmock;
            return (fmock = file.previewElement ) != null ? fmock.parentNode.removeChild(file.previewElement):void 0;
            },
            init:function(){

                @foreach($ad->images()->get() as $file)
                var mock = { FileId:'{{ $file->id }}' ,name:'{{ $file->name }}',size:'{{ $file->size }}', type:'{{ $file->mime_type }}' };
                this.emit('addedfile',mock);
                this.emit("complete", mock);
                this.options.thumbnail.call(this,mock, '{{ $file->full_file }}' );
                @endforeach

                this.on('sending',function(file,xhr,formData){
                    formData.append('Fid','');
                    file.Fid = '';
                });

                this.on('success',function(file,response){
                    file.Fid = response.id;
                });
            }

        });
    });
</script>
@endpush
