@extends('layouts.inverse')

@section('content')

     <div class="container-fluid">
            <!-- ============================================================== -->
                <!-- Bread crumb and right sidebar toggle -->
                <!-- ============================================================== -->
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
                                {!! Form::open(['route' => 'admin.categories.store', 'files' => true]) !!}

                                        @include('admin.categories.fields')

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

@push('js')
<script type="text/javascript">
$(document).ready(function(){

  $('#jstree').jstree({
     "core" : {
      'data' : {!! load_dep(old('parent_id')) !!},
      "themes" : {
        "name" : "proton",
        'responsive': true
      },
    },

    "checkbox" : {
      "keep_selected_style" : false
    },
    "plugins" : [ "wholerow"]
  });

});

 $('#jstree').on('changed.jstree',function(e,data){
    var i , j , r = [];
    for(i=0,j = data.selected.length;i < j;i++)
    {
        r.push(data.instance.get_node(data.selected[i]).id);
    }
    $('.parent_id').val(r.join(', '));
});


$(document).ready(function(){
    var jstreeInstance = $.jstree.create('#jstree', {
        core: {
            data: {!! load_dep() !!},
            check_callback: true
        },
        search: {
            show_only_matches: true,
            fuzzy: true,
            delay: 100
        },
        plugins: ['dnd', 'search','wholerow']
    });

      $('#searchـjstree').keyup(function(event) {
        var t1 = performance.now();

        jstreeInstance.search(this.value);

        var t2 = performance.now();
        console.log('Search took', (t2 - t1), 'milliseconds');
    });

});

</script>
@endpush
