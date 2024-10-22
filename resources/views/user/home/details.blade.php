@extends('user.layouts.master')

@section('content')
    <div class="py-3"></div>
     <!-- Single Product Start -->
     <div class="container-fluid py-5 mt-5">
        <div class="container py-5">
            <div class="row g-4 mb-5">
                <div class="col-lg-8 col-xl-9">
                    <a href="{{route('userHome')}}" class="mx-2">Home</a><i class="fa-solid fa-greater-than me-2"></i>Details
                    <div class="row g-4">
                        <div class="col-lg-6">
                            <div class="border rounded">
                                <a href="#">
                                    <img src="{{asset('product/'.$product->image)}}" class="img-fluid rounded" alt="Image">
                                </a>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <h4 class="fw-bold mb-3"> {{$product->name}} </h4>
                            <p class="mb-3">Category:  {{$product->category_name}} </p>
                            <h5 class="fw-bold mb-3"> {{$product->price}} MMK </h5>
                            {{-- <small> {{round($rate)}} </small> <br> --}}
                            @php
                                $remain= 5- $rate;
                            @endphp
                            <b >Products Rating </b>
                            <div class="d-flex mb-4 mt-2 align-items-center">

                                @for($i=0; $i<$rate; $i++)
                                    <i class="fa fa-star text-secondary"></i>
                                @endfor
                                @for($i=0; $i<$remain; $i++)
                                    <i class="fa fa-star"></i>
                                @endfor
                                <i class="fa-solid fa-eye mx-3 text-secondary"> <span class="text-dark">{{count($action_log)}}</span> </i>
                            </div>
                            <p class="mb-4"> {{$product->description}}</p>
                            <span class="">Available Stock: <b class="text-success"> {{$product->stock}} @if($product->stock == 1) item @else items @endif </b></span>
                            <div class="d-flex align-items-center">


                                <form action="{{route('product#addToCart')}}" method="POST" class="mt-4">
                                    @csrf

                                    <input type="hidden" name="userId" value="{{ Auth::user()->id }}">
                                    <input type="hidden" name="productId" value="{{ $product->id }}">
                                    <div class="input-group quantity mb-5" style="width: 100px;">
                                        <div class="input-group-btn">
                                            <button class="btn btn-sm btn-minus rounded-circle bg-light border" type="button" >
                                                <i class="fa fa-minus"></i>
                                            </button>
                                        </div>

                                        <input type="text" name="count" class="form-control form-control-sm text-center border-0" value="1">
                                        <div class="input-group-btn">
                                            <button class="btn btn-sm btn-plus rounded-circle bg-light border" type="button">
                                                <i class="fa fa-plus"></i>
                                            </button>
                                        </div>
                                    </div>

                                    <button class="btn border border-secondary rounded-pill px-4 py-2 mb-4 text-primary" type="submit"><i class="fa-solid fa-cart-shopping me-2 text-primary"></i> Add to cart</button>
                                </form>


                                <form action="{{route('user#rating')}}" class="ms-5" method="post">
                                    @csrf
                                    <input type="hidden" name="" id="count_rate" value="{{$count}}">
                                    <h4 class="mb-5"><span>Please Rate for this product</span></h4>

                                    <input type="hidden" name="product_id" value="{{$product->id}}">
                                    <input type="hidden" name="user_id" value="{{Auth::user()->id}}">
                                    <div class="d-flex justify-content-center">
                                        <div>
                                            <label for="rating1" id="label-1" class="label "><i class="fa fa-star"></i></i></label>
                                            <input type="checkbox" id="rating1" class="rating" name="rating" value="1">
                                        </div>
                                        <div class="px-1">
                                            <label for="rating2" id="label-2" class="label"><i class="fa fa-star"></i></label>
                                            <input type="checkbox" id="rating2" class="rating" name="rating" value="2">
                                        </div>
                                        <div>
                                            <label for="rating3" id="label-3" class="label"><i class="fa fa-star"></i></label>
                                            <input type="checkbox" id="rating3" class="rating" name="rating" value="3">
                                        </div>
                                        <div class="px-1">
                                            <label for="rating4" id="label-4" class="label"><i class="fa fa-star"></i></label>
                                            <input type="checkbox" id="rating4" class="rating" name="rating" value="4">
                                        </div>
                                        <div>
                                            <label for="rating5" id="label-5" class="label"><i class="fa fa-star"></i></label>
                                            <input type="checkbox" id="rating5" class="rating" name="rating" value="5">
                                        </div>
                                        <button type="submit" class="btn btn-sm btn-outline-primary ms-4">Rate</button>
                                    </div>
                                </form>

                            </div>


                        </div>
                        <div class="col-lg-12">
                            <nav>
                                <div class="nav nav-tabs mb-3">
                                    <button class="nav-link active border-white border-bottom-0" type="button" role="tab"
                                        id="nav-about-tab" data-bs-toggle="tab" data-bs-target="#nav-about"
                                        aria-controls="nav-about" aria-selected="true">Ratings<span class="btn btn-rounded btn-sm ms-2 text-white" style="background: lightgray">{{count($ratings)}}</span> </button>
                                    <button class="nav-link border-white border-bottom-0" type="button" role="tab"
                                        id="nav-mission-tab" data-bs-toggle="tab" data-bs-target="#nav-mission"
                                        aria-controls="nav-mission" aria-selected="false">Comments <span class="btn btn-rounded btn-sm text-white" style="background: lightgray">{{count($comment)}}</span> </button>
                                </div>
                            </nav>
                            <div class="tab-content mb-5">
                                <div class="tab-pane active" id="nav-about" role="tabpanel" aria-labelledby="nav-about-tab">
                                    <h5 class="text-center">Ratings for This Product</h5>
                                    @foreach ($ratings as $rating)
                                    <div class="d-flex">
                                        <img src="{{asset('profile/'.$rating->profile)}}" class="img-fluid rounded-circle p-3" style="width: 100px; height: 100px;" alt="">
                                        <div class="">
                                            <p class="mb-2" style="font-size: 14px;"> {{$rating->created_at}} </p>
                                            <div class="d-flex justify-content-between">
                                                <h5>  {{$rating->name== null? $rating->nickname: $rating->name }} </h5>
                                            </div>
                                            <span>
                                                @switch($rating->count)
                                                    @case(1)
                                                    <div class="d-flex mb-4 justify-content-center">
                                                        <i class="fa fa-star text-secondary"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                    </div>
                                                        @break
                                                    @case(2)
                                                    <div class="d-flex mb-4 justify-content-center">
                                                        <i class="fa fa-star text-secondary"></i>
                                                        <i class="fa fa-star text-secondary"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                    </div>
                                                        @break
                                                    @case(3)
                                                    <div class="d-flex mb-4 justify-content-center">
                                                        <i class="fa fa-star text-secondary"></i>
                                                        <i class="fa fa-star text-secondary text-secondary"></i>
                                                        <i class="fa fa-star text-secondary text-secondary"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                    </div>
                                                        @break
                                                    @case(4)
                                                    <div class="d-flex mb-4 justify-content-center">
                                                        <i class="fa fa-star text-secondary"></i>
                                                        <i class="fa fa-star text-secondary"></i>
                                                        <i class="fa fa-star text-secondary"></i>
                                                        <i class="fa fa-star text-secondary"></i>
                                                        <i class="fa fa-star"></i>
                                                    </div>
                                                        @break

                                                    @default
                                                    <div class="d-flex mb-4 justify-content-center">
                                                        <i class="fa fa-star text-secondary"></i>
                                                        <i class="fa fa-star text-secondary"></i>
                                                        <i class="fa fa-star text-secondary"></i>
                                                        <i class="fa fa-star text-secondary"></i>
                                                        <i class="fa fa-star text-secondary"></i>
                                                    </div>

                                                @endswitch
                                            </span>
                                        </div>
                                    </div>
                                    @endforeach

                                </div>
                                <div class="tab-pane" id="nav-mission" role="tabpanel" aria-labelledby="nav-mission-tab">
                                    @foreach ($comment as $item)
                                    <div class="d-flex">
                                        <img src="{{asset('profile/'.$item->profile)}}" class="img-fluid rounded-circle p-3" style="width: 100px; height: 100px;" alt="">
                                        <div class="">
                                            <p class="mb-2" style="font-size: 14px;"> {{$item->created_at}} </p>
                                            <div class="d-flex justify-content-between">
                                                <h5>  {{$item->name== null? $item->nickname: $item->name }} </h5>
                                            </div>
                                            <div class="d-flex justify-content-center">
                                                <p class="me-4"> {{$item->message}}  </p>
                                                @if ($item->user_id== Auth::user()->id)
                                                <a href="">
                                                    <small><i class="fa-regular fa-pen-to-square text-muted me-2 "></i></small>
                                                </a>
                                                <a href="{{route('user#comment#delete', $item->id)}}">
                                                    <small><i class="fa-regular fa-trash-can text-muted "></i></small>
                                                </a>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach

                                </div>

                            </div>
                        </div>
                        <form action="{{route('user#comment', $product->id)}}" method="post">
                            @csrf
                            <h4 class="mb-5 fw-bold">Leave a Reply</h4>
                            <div class="row g-4">
                                <div class="col-lg-12">
                                    <input type="hidden" name="product_id" value="{{$product->id}}">
                                    <input type="hidden" name="user_id" value="{{Auth::user()->id}}">
                                    <div class="border-bottom rounded my-4">
                                        <textarea name="comment" id="" class="form-control border-0" cols="30" rows="8" placeholder="Your Review *" spellcheck="false"></textarea>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="d-flex justify-content-between py-3 mb-5">
                                        <button class="btn border border-secondary text-primary rounded-pill px-4 py-3" type="submit"> Post Comment</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-lg-4 col-xl-3">
                    <div class="row g-4 fruite">
                        <div class="col-lg-12">
                            <div class="input-group w-100 mx-auto d-flex mb-4">
                                <input type="search" class="form-control p-3" placeholder="keywords" aria-describedby="search-icon-1">
                                <span id="search-icon-1" class="input-group-text p-3"><i class="fa fa-search"></i></span>
                            </div>
                            {{-- <div class="mb-4">
                                <h4>Categories</h4>
                                <ul class="list-unstyled fruite-categorie">
                                    <li>
                                        <div class="d-flex justify-content-between fruite-name">
                                            <a href="#"><i class="fas fa-apple-alt me-2"></i>Apples</a>
                                            <span>(3)</span>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="d-flex justify-content-between fruite-name">
                                            <a href="#"><i class="fas fa-apple-alt me-2"></i>Oranges</a>
                                            <span>(5)</span>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="d-flex justify-content-between fruite-name">
                                            <a href="#"><i class="fas fa-apple-alt me-2"></i>Strawbery</a>
                                            <span>(2)</span>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="d-flex justify-content-between fruite-name">
                                            <a href="#"><i class="fas fa-apple-alt me-2"></i>Banana</a>
                                            <span>(8)</span>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="d-flex justify-content-between fruite-name">
                                            <a href="#"><i class="fas fa-apple-alt me-2"></i>Pumpkin</a>
                                            <span>(5)</span>
                                        </div>
                                    </li>
                                </ul>
                            </div> --}}
                        </div>
                        <div class="col-lg-12">
                            <h4 class="mb-4">Featured products</h4>
                            <div class="d-flex align-items-center justify-content-start">
                                <div class="rounded" style="width: 100px; height: 100px;">
                                    <img src="img/featur-1.jpg" class="img-fluid rounded" alt="Image">
                                </div>
                                <div>
                                    <h6 class="mb-2">Big Banana</h6>
                                    <div class="d-flex mb-2">
                                        <i class="fa fa-star text-secondary"></i>
                                        <i class="fa fa-star text-secondary"></i>
                                        <i class="fa fa-star text-secondary"></i>
                                        <i class="fa fa-star text-secondary"></i>
                                        <i class="fa fa-star"></i>
                                    </div>
                                    <div class="d-flex mb-2">
                                        <h5 class="fw-bold me-2">2.99 $</h5>
                                        <h5 class="text-danger text-decoration-line-through">4.11 $</h5>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex align-items-center justify-content-start">
                                <div class="rounded" style="width: 100px; height: 100px;">
                                    <img src="img/featur-2.jpg" class="img-fluid rounded" alt="">
                                </div>
                                <div>
                                    <h6 class="mb-2">Big Banana</h6>
                                    <div class="d-flex mb-2">
                                        <i class="fa fa-star text-secondary"></i>
                                        <i class="fa fa-star text-secondary"></i>
                                        <i class="fa fa-star text-secondary"></i>
                                        <i class="fa fa-star text-secondary"></i>
                                        <i class="fa fa-star"></i>
                                    </div>
                                    <div class="d-flex mb-2">
                                        <h5 class="fw-bold me-2">2.99 $</h5>
                                        <h5 class="text-danger text-decoration-line-through">4.11 $</h5>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex align-items-center justify-content-start">
                                <div class="rounded" style="width: 100px; height: 100px;">
                                    <img src="img/featur-3.jpg" class="img-fluid rounded" alt="">
                                </div>
                                <div>
                                    <h6 class="mb-2">Big Banana</h6>
                                    <div class="d-flex mb-2">
                                        <i class="fa fa-star text-secondary"></i>
                                        <i class="fa fa-star text-secondary"></i>
                                        <i class="fa fa-star text-secondary"></i>
                                        <i class="fa fa-star text-secondary"></i>
                                        <i class="fa fa-star"></i>
                                    </div>
                                    <div class="d-flex mb-2">
                                        <h5 class="fw-bold me-2">2.99 $</h5>
                                        <h5 class="text-danger text-decoration-line-through">4.11 $</h5>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex align-items-center justify-content-start">
                                <div class="rounded me-4" style="width: 100px; height: 100px;">
                                    <img src="img/vegetable-item-4.jpg" class="img-fluid rounded" alt="">
                                </div>
                                <div>
                                    <h6 class="mb-2">Big Banana</h6>
                                    <div class="d-flex mb-2">
                                        <i class="fa fa-star text-secondary"></i>
                                        <i class="fa fa-star text-secondary"></i>
                                        <i class="fa fa-star text-secondary"></i>
                                        <i class="fa fa-star text-secondary"></i>
                                        <i class="fa fa-star"></i>
                                    </div>
                                    <div class="d-flex mb-2">
                                        <h5 class="fw-bold me-2">2.99 $</h5>
                                        <h5 class="text-danger text-decoration-line-through">4.11 $</h5>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex align-items-center justify-content-start">
                                <div class="rounded me-4" style="width: 100px; height: 100px;">
                                    <img src="img/vegetable-item-5.jpg" class="img-fluid rounded" alt="">
                                </div>
                                <div>
                                    <h6 class="mb-2">Big Banana</h6>
                                    <div class="d-flex mb-2">
                                        <i class="fa fa-star text-secondary"></i>
                                        <i class="fa fa-star text-secondary"></i>
                                        <i class="fa fa-star text-secondary"></i>
                                        <i class="fa fa-star text-secondary"></i>
                                        <i class="fa fa-star"></i>
                                    </div>
                                    <div class="d-flex mb-2">
                                        <h5 class="fw-bold me-2">2.99 $</h5>
                                        <h5 class="text-danger text-decoration-line-through">4.11 $</h5>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex align-items-center justify-content-start">
                                <div class="rounded me-4" style="width: 100px; height: 100px;">
                                    <img src="img/vegetable-item-6.jpg" class="img-fluid rounded" alt="">
                                </div>
                                <div>
                                    <h6 class="mb-2">Big Banana</h6>
                                    <div class="d-flex mb-2">
                                        <i class="fa fa-star text-secondary"></i>
                                        <i class="fa fa-star text-secondary"></i>
                                        <i class="fa fa-star text-secondary"></i>
                                        <i class="fa fa-star text-secondary"></i>
                                        <i class="fa fa-star"></i>
                                    </div>
                                    <div class="d-flex mb-2">
                                        <h5 class="fw-bold me-2">2.99 $</h5>
                                        <h5 class="text-danger text-decoration-line-through">4.11 $</h5>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex justify-content-center my-4">
                                <a href="#" class="btn border border-secondary px-4 py-3 rounded-pill text-primary w-100">Vew More</a>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="position-relative">
                                <img src="img/banner-fruits.jpg" class="img-fluid w-100 rounded" alt="">
                                <div class="position-absolute" style="top: 50%; right: 10px; transform: translateY(-50%);">
                                    <h3 class="text-secondary fw-bold">Fresh <br> Fruits <br> Banner</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @if (count($products)> 4)
            <small> {{count($products)}} </small>
            <h1 class="fw-bold mb-0 text-center">Related products</h1>
            <div class="vesitable">
                <div class="owl-carousel vegetable-carousel justify-content-center">
                    @foreach ($products as $item)
                        @if ($product->id !== $item->id)
                            <div class="border border-primary rounded position-relative vesitable-item">
                                <div class="vesitable-img d-flex justify-content-center" >
                                    <a href="{{route('product#details', $item->id)}}"><img src={{asset('product/'.$item->image)}} style="height: 200px" class="img-fluid w-100 rounded-top" alt="" ></a>
                                </div>
                                <div class="text-white bg-primary px-3 py-1 rounded position-absolute" style="top: 10px; right: 10px;"> {{$item->name}} </div>
                                <div class="p-4 pb-0 rounded-bottom">
                                    <h4> {{$item->name}} </h4>
                                    <p> {{ Str::words($item->description, 3, '...') }} </p>
                                    <div class="d-flex justify-content-between flex-lg-wrap">
                                        <p class="text-dark fs-5 fw-bold"> {{$item->price}} </p>
                                        <a href="#" class="btn border border-secondary rounded-pill px-3 py-1 mb-4 text-primary"><i class="fa fa-shopping-bag me-2 text-primary"></i> Add to cart</a>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach

                </div>
            </div>
            @else
            <h1 class="fw-bold mb-0 text-center">Related products</h1>
            <div class="vesitable w-100 d-flex flex-row gap-5 justify-content-center mt-3">
                    @foreach ($products as $item)
                        @if ($product->id !== $item->id)
                            <div class="border border-primary rounded position-relative vesitable-item">
                                <div class="vesitable-img d-flex justify-content-center" >
                                    <a href="{{route('product#details', $item->id)}}"><img src={{asset('product/'.$item->image)}} style="height: 200px" class="img-fluid w-100 rounded-top" alt="" ></a>
                                </div>
                                <div class="text-white bg-primary px-3 py-1 rounded position-absolute" style="top: 10px; right: 10px;"> {{$item->name}} </div>
                                <div class="p-4 pb-0 rounded-bottom">
                                    <h4> {{$item->name}} </h4>
                                    <p> {{ Str::words($item->description, 3, '...') }} </p>
                                    <div class="d-flex justify-content-between flex-lg-wrap">
                                        <p class="text-dark fs-5 fw-bold"> {{$item->price}} </p>
                                        <a href="#" class="btn border border-secondary rounded-pill px-3 py-1 mb-4 text-primary"><i class="fa fa-shopping-bag me-2 text-primary"></i> Add to cart</a>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach
            </div>
            @endif
        </div>
    </div>
    <!-- Single Product End -->


    <!-- Footer Start -->
    {{-- <div class="container-fluid bg-dark text-white-50 footer pt-5 mt-5">
        <div class="container py-5">
            <div class="pb-4 mb-4" style="border-bottom: 1px solid rgba(226, 175, 24, 0.5) ;">
                <div class="row g-4">
                    <div class="col-lg-3">
                        <a href="#">
                            <h1 class="text-primary mb-0">Fruitables</h1>
                            <p class="text-secondary mb-0">Fresh products</p>
                        </a>
                    </div>
                    <div class="col-lg-6">
                        <div class="position-relative mx-auto">
                            <input class="form-control border-0 w-100 py-3 px-4 rounded-pill" type="number" placeholder="Your Email">
                            <button type="submit" class="btn btn-primary border-0 border-secondary py-3 px-4 position-absolute rounded-pill text-white" style="top: 0; right: 0;">Subscribe Now</button>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="d-flex justify-content-end pt-3">
                            <a class="btn  btn-outline-secondary me-2 btn-md-square rounded-circle" href=""><i class="fab fa-twitter"></i></a>
                            <a class="btn btn-outline-secondary me-2 btn-md-square rounded-circle" href=""><i class="fab fa-facebook-f"></i></a>
                            <a class="btn btn-outline-secondary me-2 btn-md-square rounded-circle" href=""><i class="fab fa-youtube"></i></a>
                            <a class="btn btn-outline-secondary btn-md-square rounded-circle" href=""><i class="fab fa-linkedin-in"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row g-5">
                <div class="col-lg-3 col-md-6">
                    <div class="footer-item">
                        <h4 class="text-light mb-3">Why People Like us!</h4>
                        <p class="mb-4">typesetting, remaining essentially unchanged. It was
                            popularised in the 1960s with the like Aldus PageMaker including of Lorem Ipsum.</p>
                        <a href="" class="btn border-secondary py-2 px-4 rounded-pill text-primary">Read More</a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="d-flex flex-column text-start footer-item">
                        <h4 class="text-light mb-3">Shop Info</h4>
                        <a class="btn-link" href="">About Us</a>
                        <a class="btn-link" href="">Contact Us</a>
                        <a class="btn-link" href="">Privacy Policy</a>
                        <a class="btn-link" href="">Terms & Condition</a>
                        <a class="btn-link" href="">Return Policy</a>
                        <a class="btn-link" href="">FAQs & Help</a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="d-flex flex-column text-start footer-item">
                        <h4 class="text-light mb-3">Account</h4>
                        <a class="btn-link" href="">My Account</a>
                        <a class="btn-link" href="">Shop details</a>
                        <a class="btn-link" href="">Shopping Cart</a>
                        <a class="btn-link" href="">Wishlist</a>
                        <a class="btn-link" href="">Order History</a>
                        <a class="btn-link" href="">International Orders</a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="footer-item">
                        <h4 class="text-light mb-3">Contact</h4>
                        <p>Address: 1429 Netus Rd, NY 48247</p>
                        <p>Email: Example@gmail.com</p>
                        <p>Phone: +0123 4567 8910</p>
                        <p>Payment Accepted</p>
                        <img src="img/payment.png" class="img-fluid" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div> --}}
    <!-- Footer End -->

    <!-- Copyright Start -->
    {{-- <div class="container-fluid copyright bg-dark py-4">
        <div class="container">
            <div class="row">
                <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
                    <span class="text-light"><a href="#"><i class="fas fa-copyright text-light me-2"></i>Your Site Name</a>, All right reserved.</span>
                </div>
                <div class="col-md-6 my-auto text-center text-md-end text-white">

                    Designed By <a class="border-bottom" href="https://htmlcodex.com">HTML Codex</a> Distributed By <a class="border-bottom" href="https://themewagon.com">ThemeWagon</a>
                </div>
            </div>
        </div>
    </div> --}}
    <!-- Copyright End -->



    <!-- Back to Top -->
    <a href="#" class="btn btn-primary border-3 border-primary rounded-circle back-to-top"><i class="fa fa-arrow-up"></i></a>
@endsection
