@extends('layouts.dashboard.app')

@section('title','Add Category')

@push('css')

@endpush

@section('content')
    <div class="container-fluid">
        <!-- Vertical Layout | With Floating Label -->
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>
                           Add New Category
                        </h2>
                    </div>
                    <div class="body">
                        <form action="{{ route('admin.category.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group form-float">
                                <label class="form-label">Category Name</label>
                                <div class="form-line">
                                    <input type="text" id="name" class="form-control" name="name" placeholder="Category Name">
                                </div>
                            </div> 
                             <div class="form-group form-float">
                                <label class="form-label">Category Image</label>
                                <div class="form-line">
                                    <input type="file" id="name" class="form-control" name="image">  
                                </div>
                            </div> 
                        

                            <a  class="btn btn-danger m-t-15 waves-effect" href="{{ route('admin.category.index') }}">BACK</a>
                            <button type="submit" class="btn btn-primary m-t-15 waves-effect">SUBMIT</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')

@endpush



