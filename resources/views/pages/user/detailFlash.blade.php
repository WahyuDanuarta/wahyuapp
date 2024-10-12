@extends('layouts.user.main')
@section('content')
<!-- Start Banner Area -->
<section class="banner-area organic-breadcrumb">
    <div class="container">
        <div class="breadcrumb-banner d-flex flex-wrap align-items-center justify-content-end">
            <div class="col-first">
                <h1>Detail Produk Flash Sale</h1>
                <nav class="d-flex align-items-center">
                    <a href="{{ route('user.dashboard') }}">Home <span class="lnr lnr-arrow-right"></span></a>
                    <a href="#">Detail Produk Flash Sale</a>
                </nav>
            </div>
        </div>
    </div>
</section>
<!-- End Banner Area -->

<section class="section_gap">
    <!-- Single Product Area -->
    <div class="product_image_area">
        <div class="container">
            <div class="row s_product_inner">
                <div class="col-lg-6">
                    <div class="single-prd-item mb-4">
                        <img class="img-fluid" src="{{ asset('images/' . $flashsales->image) }}" alt="{{ $flashsales->name }}">
                    </div>
                </div>
                <div class="col-lg-5 offset-lg-1">
                    <div class="s_product_text">
                        <h3>{{ $flashsales->name }}</h3>
                        <h2 class="text-primary">Diskon: {{ $flashsales->diskon_price }} Points</h2>
                        <h4 class="text-muted"><del>Harga Normal: {{ $flashsales->original_price }} Points</del></h4>
                        <ul class="list mt-3 mb-3">
                            <li>
                                <span class="font-weight-bold">Kategori</span>: {{ $flashsales->category }}
                            </li>
                        </ul>
                        <p>{{ $flashsales->description }}</p>
                        <div class="card_area d-flex align-items-center mt-4">
                            <a class="primary-btn" href="javascript:void(0);" onclick="confirmCash('{{ $flashsales->id }}', '{{ Auth::user()->id }}')">Beli Produk</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Single Product Area -->
</section>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    function confirmCash(flashsaleId, userId) {
        Swal.fire({
            title: 'Apakah Anda yakin?',
            text: "Anda akan membeli produk ini!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, Beli!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = '/flashsale/purchaseCash/' + flashsaleId + '/' + userId;
            }
        });
    }
</script>
@endsection
