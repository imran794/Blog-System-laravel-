@extends('layouts.dashboard.app')

@section('title','Pending Post')

@push('css')
<!-- JQuery DataTable Css -->
<link href="{{ asset('assets/dashboard/plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css') }}" rel="stylesheet">
@endpush

@section('content')
<div class="container-fluid">
    <!-- Exportable Table -->
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <h2>
                        Pending Post
                        <span class="badge bg-blue">{{ $posts->count() }}</span>
                    </h2>
                </div>
                <div class="body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Title</th>
                                    <th>AddedBy</th>
                                    <th>Image</th>
                                    <th><i class="material-icons">visibility<i /></th>
                                    <th>Is Approved</th>
                                    <th>Status</th>
                                    <th>CREATED AT</th>

                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>ID</th>
                                    <th>Title</th>
                                    <th>AddedBy</th>
                                    <th>Image</th>
                                    <th><i class="material-icons">visibility<i /></th>
                                    <th>Is Approved</th>
                                    <th>Status</th>
                                    <th>CREATED AT</th>

                                    <th>Action</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                @foreach($posts as $key=>$post)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ Str::limit($post->title,10) }}</td>
                                    <td>{{ $post->user->name }}</td>
                                    <td>
                                        <img width="100" src="{{ Storage::disk('public')->url('post/'.$post->image) }}" alt="image">
                                    </td>
                                    <td>{{ $post->view_count }}</td>
                                    <td>
                                        @if ($post->is_approve == true)
                                        <span class="badge bg-blue">Approved</span>
                                        @else
                                        <span class="badge bg-pink">Pending</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($post->status == true)
                                        <span class="badge bg-blue">Published</span>
                                        @else
                                        <span class="badge bg-pink">Pending</span>
                                        @endif
                                    </td>

                                    <td>{{ $post->created_at }}</td>


                                    <td class="text-center">
                                        @if($post->is_approved == false)
                                        <button type="button" class="btn btn-success waves-effect" onclick="approvePost({{ $post->id }})">
                                            <i class="material-icons">done</i>
                                            
                                        </button>
                                        <form method="post" action="{{ route('admin.post.approve',$post->id) }}" id="approval-form" style="display: none">
                                            @csrf
                                            @method('PUT')
                                        </form>
                                        @endif
                                        <a href="{{ route('admin.post.show',$post->id) }}" class="btn btn-info waves-effect">
                                            <i class="material-icons">visibility</i>
                                        </a>
                                        <a href="{{ route('admin.post.edit',$post->id) }}" class="btn btn-info waves-effect">
                                            <i class="material-icons">edit</i>
                                        </a>
                                        <button class="btn btn-danger waves-effect" type="button" onclick="deletepost({{ $post->id }})">
                                            <i class="material-icons">delete</i>
                                        </button>
                                        <form id="delete-form-{{ $post->id }}" action="{{ route('admin.post.destroy',$post->id) }}" method="POST" style="display: none;">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- #END# Exportable Table -->
</div>
@endsection

@push('js')
<!-- Jquery DataTable Plugin Js -->
<script src="{{ asset('assets/dashboard/plugins/jquery-datatable/jquery.dataTables.js') }}"></script>
<script src="{{ asset('assets/dashboard/plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js') }}"></script>
<script src="{{ asset('assets/dashboard/plugins/jquery-datatable/extensions/export/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('assets/dashboard/plugins/jquery-datatable/extensions/export/buttons.flash.min.js') }}"></script>
<script src="{{ asset('assets/dashboard/plugins/jquery-datatable/extensions/export/jszip.min.js') }}"></script>
<script src="{{ asset('assets/dashboard/plugins/jquery-datatable/extensions/export/pdfmake.min.js') }}"></script>
<script src="{{ asset('assets/dashboard/plugins/jquery-datatable/extensions/export/vfs_fonts.js') }}"></script>
<script src="{{ asset('assets/dashboard/plugins/jquery-datatable/extensions/export/buttons.html5.min.js') }}"></script>
<script src="{{ asset('assets/dashboard/plugins/jquery-datatable/extensions/export/buttons.print.min.js') }}"></script>

<script src="{{ asset('assets/dashboard/js/pages/tables/jquery-datatable.js') }}"></script>
<script src="https://unpkg.com/sweetalert2@7.19.1/dist/sweetalert2.all.js"></script>
<script type="text/javascript">
    function deletepost(id) {
        swal({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!',
            cancelButtonText: 'No, cancel!',
            confirmButtonClass: 'btn btn-success',
            cancelButtonClass: 'btn btn-danger',
            buttonsStyling: false,
            reverseButtons: true
        }).then((result) => {
            if (result.value) {
                event.preventDefault();
                document.getElementById('delete-form-' + id).submit();
            } else if (
                // Read more about handling dismissals
                result.dismiss === swal.DismissReason.cancel
            ) {
                swal(
                    'Cancelled',
                    'Your data is safe :)',
                    'error'
                )
            }
        })
    }


 function approvePost(id) {
        swal({
            title: 'Are you sure?',
            text: "You went to approve this post!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, approve it!',
            cancelButtonText: 'No, cancel!',
            confirmButtonClass: 'btn btn-success',
            cancelButtonClass: 'btn btn-danger',
            buttonsStyling: false,
            reverseButtons: true
        }).then((result) => {
            if (result.value) {
                event.preventDefault();
                document.getElementById('approval-form').submit();
            } else if (
                // Read more about handling dismissals
                result.dismiss === swal.DismissReason.cancel
            ) {
                swal(
                    'Cancelled',
                    'The post remain pending :)',
                    'error'
                )
            }
        })
    }

</script>
@endpush
