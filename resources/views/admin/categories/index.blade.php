@extends('layouts.inverse')
@section('content')
    <div class="container-fluid">
         <!-- ============================================================== -->
                <!-- Bread crumb and right sidebar toggle -->
                <!-- ============================================================== -->
                <div class="row page-titles">
                    <div class="col-md-5 align-self-center">
                        <h4 class="text-themecolor">@lang('backend.Categories')</h4>
                    </div>
                    <div class="col-md-7 align-self-center text-right">
                        <div class="d-flex justify-content-end align-items-center">
                             <ol class="breadcrumb">
                              <li class="breadcrumb-item">
                                 <a href="{!! route('admin.categories.index') !!}">@lang('backend.Admin')</a>
                              </li>
                              <li class="breadcrumb-item active">@lang('backend.Categories')</li>
                            </ol>
                            <a href="{!! route('admin.categories.create') !!}" class="btn btn-info d-none d-lg-block m-l-15"><i class="fa fa-plus-circle"></i> @lang('backend.Create')</a>
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

                                <a href="" class="btn btn-warning edit_dep showbtn_control hide" ><i class="fa fa-edit"></i> @lang('backend.edit') </a>

                                 <a href="" class="btn btn-danger delete_dep showbtn_control hide"  data-toggle="modal" data-target="#delete_bootstrap_modal" ><i class="fa fa-trash"></i> {{ trans('backend.delete') }}</a>

                                  <div id="delete_bootstrap_modal" class="modal fade" role="dialog">
                                      <div class="modal-dialog">

                                        <!-- Modal content-->
                                        <div class="modal-content">
                                          <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            <h4 class="modal-title">{{ trans('backend.delete') }}</h4>
                                          </div>
                                          <form action="" method="post" id="form_Delete_department">
                                            @csrf
                                            @method("DELETE")
                                          <div class="modal-body">
                                            <h4>
                                             {{ trans('backend.ask_delete_dep') }} <span id="dep_name"></span>
                                            </h4>
                                          </div>
                                          <div class="modal-footer">
                                            <button type="button" class="btn btn-info" data-dismiss="modal">{{ trans('backend.close') }}</button>

                                            <button type="submit" class="btn btn-danger">{{trans('backend.yes')}}</button>
                                          </div>
                                          </form>
                                        </div>

                                      </div>
                                    </div>
                                <div class="clearfix"></div>
                                  <div id="jstree" style="direction: ltr"></div>
                                  <div class="clearfix"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- ============================================================== -->
                <!-- End PAge Content -->
                <!-- ============================================================== -->
    </div>
@endsection

@push('js')
<script type="text/javascript">
$(document).ready(function(){

  $('#jstree').jstree({
    "core" : {
      'data' : {!! load_dep() !!},
      "themes" : {

        "name" : "proton",
        'responsive': true
      },
    },
    "checkbox" : {
      //"keep_selected_style" : true
    },
    "plugins" : [ "wholerow" ]//checkbox
  });

});

 $('#jstree').on('changed.jstree',function(e,data){
    var i , j , r = [];
    var  name = [];
    for(i=0,j = data.selected.length;i < j;i++)
    {
        r.push(data.instance.get_node(data.selected[i]).id);
        name.push(data.instance.get_node(data.selected[i]).text);
    }
    $('#form_Delete_department').attr('action','{{ aurl('categories') }}/'+r.join(', '));
    $('#dep_name').text(name.join(', '));
    if(r.join(', ') != '')
    {
      $('.showbtn_control').removeClass('hide');
      $('.edit_dep').attr('href','{{ aurl('categories') }}/'+r.join(', ')+'/edit');
    }else{
      $('.showbtn_control').addClass('hide');
    }
});

</script>
@endpush

