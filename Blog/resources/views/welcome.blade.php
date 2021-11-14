@extends('layouts.frontend.app')

@section('title','Login')

@push('css')

   <link href="{{ asset('assets/frontend/css/home/styles.css') }}" rel="stylesheet">

    <link href="{{ asset('assets/frontend/css/home/responsive.css') }}" rel="stylesheet">

@endpush

@section('content')


  <div class="main-slider">
        <div class="swiper-container position-static" data-slide-effect="slide" data-autoheight="false"
             data-swiper-speed="500" data-swiper-autoplay="10000" data-swiper-margin="0" data-swiper-slides-per-view="4"
             data-swiper-breakpoints="true" data-swiper-loop="true" >
            <div class="swiper-wrapper">

             
                    <div class="swiper-slide">
                        <a class="slider-category" href="">
                            <div class="blog-image"><img src="{{ asset('assets/frontend/images/slider-1.jpg') }}" alt=""></div>

                            <div class="category">
                                <div class="display-table center-text">
                                    <div class="display-table-cell">
                                        <h3><b>Lorem Ipsum is simply</b></h3>
                                    </div>
                                </div>
                            </div>

                        </a>
                    </div><!-- swiper-slide -->
             
                    <div class="swiper-slide">
                        <strong>No Data Found :(</strong>
                    </div><!-- swiper-slide -->
            

            </div><!-- swiper-wrapper -->

        </div><!-- swiper-container -->

    </div><!-- slider -->

    <section class="blog-area section">
        <div class="container">

            <div class="row">

                
                    <div class="col-lg-4 col-md-6">
                        <div class="card h-100">
                            <div class="single-post post-style-1">

                                <div class="blog-image"><img src="{{ asset('assets/frontend/images/audrey-jackson-260657.jpg') }} " alt=""></div>

                                <a class="avatar" href=""><img src="{{ asset('assets/frontend/images/audrey-jackson-260657.jpg') }}" alt="Profile Image"></a>

                                <div class="blog-info">

                                    <h4 class="title"><a href=""><b>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s,</b></a></h4>

                                    <ul class="post-footer">

                                        <li>
                                         
                                                <a href="javascript:void(0);" onclick="toastr.info('To add favorite list. You need to login first.','Info',{
                                                    closeButton: true,
                                                    progressBar: true,
                                                "><i class="ion-heart"></i>dfas</a>
                                          
                                             

                                                

                                        </li>
                                        <li>
                                            <a href="#"><i class="ion-chatbubble"></i></a>
                                        </li>
                                        <li>
                                            <a href="#"><i class="ion-eye"></i></a>
                                        </li>
                                    </ul>

                                </div><!-- blog-info -->
                            </div><!-- single-post -->
                        </div><!-- card -->
                    </div><!-- col-lg-4 col-md-6 -->
                    <div class="col-lg-12 col-md-12">
                        <div class="card h-100">
                            <div class="single-post post-style-1 p-2">
                               <strong>No Post Found :(</strong>
                            </div><!-- single-post -->
                        </div><!-- card -->
                    </div><!-- col-lg-4 col-md-6 -->
            
            </div><!-- row -->

            <a class="load-more-btn" href=""><b>LOAD MORE</b></a>

        </div><!-- container -->
    </section><!-- section -->


@endsection


@push('js')
<script src="{{ asset('assets/frontend/js/swiper.js') }}"></script>

@endpush