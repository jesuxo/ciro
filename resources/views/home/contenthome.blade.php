

    @php $mantenimiento = 0; @endphp

    @if($mantenimiento)

        <div class="container searched_hide section-header searched_hide">
            <div class="row">
                <div class="col-md-6"><img class="" style="width: 100%" src="img/mantenimiento.png" alt=""></div>
                <div class="col-md-6" style="text-align:justify">
                    <h2>P&aacute;gina en Mantenimiento</h2>
                    <p>
                        Actualmente estamos actualizando nuestra secci&oacuten de promociones, pronto estaremos de vuelta con muchas mas promociones
                    </p>
                    <p>
                        <a href="https://www.instagram.com/ciroenlinea/" class="btn btn-primary">@ciroelinea</a>
                    </p>
                </div>
            </div>
        </div>

    @endif

    <section class="section">
        <div class="container">
            <div class="row gy-4 gy-lg-0">
                <a href="/" class="col-lg-3 col-sm-6">
                    <img src="{{ URL::asset('build/images/logohorz.png') }}" alt="" class="" style="max-width: 100%">
                </a>
                <div class="col-lg-3 col-sm-6">
                    <div class="d-flex align-items-center gap-3">
                        <a href="https://api.whatsapp.com/send/?phone=584247105601&text=Hola+Srs.+de+CIRO+quisiera+informacion+sobre%3A+&type=phone_number&app_absent=0" class="flex-shrink-0">
                            <img src="{{ URL::asset('img/logowhatsapp.png') }}" alt="" class="avatar-sm">
                        </a>
                        <div class="flex-grow-1">
                            <h5 class="fs-15">Cont&aacute;ctanos</h5>
                            <a href="https://api.whatsapp.com/send/?phone=584247105601&text=Hola+Srs.+de+CIRO+quisiera+informacion+sobre%3A+&type=phone_number&app_absent=0" class="text-muted mb-0">+58 424-7105601</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <div class="d-flex align-items-center gap-3">
                        <div class="flex-shrink-0">
                            <img src="{{ URL::asset('img/horario.png') }}" alt=""
                                 class="avatar-sm">
                        </div>
                        <div class="flex-grow-1">
                            <h5 class="fs-15">Horario Corrido</h5>
                            <p class="text-muted mb-0">Lunes - Domingo</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <div class="d-flex align-items-center gap-3">
                        <div class="flex-shrink-0">
                            <img src="{{ URL::asset('img/corazon.png') }}" alt="" class="avatar-sm">
                        </div>
                        <div class="flex-grow-1">
                            <h5 class="fs-15">Atenci&oacute;n Personalizada</h5>
                            <p class="text-muted mb-0">El Cliente es nuestro jefe</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="section pt-0">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <a href="/promociones/SanCristobal"
                       class="product-banner-1 mt-4 mt-lg-0 rounded overflow-hidden position-relative d-block">
                        <img src="{{ URL::asset('build/images/ecommerce/features/img-3.jpg') }}" class="img-fluid rounded"
                             alt="">
                        <div class="product-content p-4">
                            <p class="text-uppercase text-white mb-5">Ver promociones <i class="bi bi-arrow-right ms-2"></i></p>
                            <h1 class="text-white   fw-medium ff-secondary"> De nuestra tienda de la Av. Rotaria</h1>
                            <div class="product-btn  text-white">
                                San Cristobal, Edo T&aacute;chira Venezuela
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-lg-6">
                    <a href="/promociones/ElVigia"
                       class="product-banner-1 mt-4 mt-lg-0 rounded overflow-hidden position-relative d-block">
                        <img src="{{ URL::asset('build/images/ecommerce/features/vigia.jpg') }}" class="img-fluid rounded"
                             alt="">
                        <div class="product-content p-4">
                            <p class="text-uppercase  text-white mb-5">Ver promociones <i class="bi bi-arrow-right ms-2"></i></p>
                            <h1 class=" fw-medium ff-secondary text-white">De nuestra tienda en la Av 16 con Calle 5</h1>
                            <div class="product-btn text-white">
                                El Vig&iacute;a, Edo M&eacute;rida Venezuela
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <section class="position-relative bg-danger-subtle bg-cta">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <div class="py-5">
                        <p class="text-uppercase  badge bg-danger-subtle text-danger fs-13">Mueve tu vida, acelera tus metas.</p>

                        <h1 class="lh-base fw-semibold mb-3 text-capitalize">Más que motos, pasión por avanzar.</h1>
                        <p class="fs-16 mt-2">No es solo un lema, es nuestra filosofía. En nuestra tienda, encuentras
                            todo lo que necesitas para impulsar tu día a día; desde artículos para el hogar que hacen
                            tu vida más práctica y cómoda, hasta motos y accesorios diseñados para quienes viven con pasión y libertad.
                            Ofrecemos productos de calidad que te ayudan a avanzar,
                            ya sea en casa o en la ruta. ¡Transforma tus espacios, conquista el camino y haz realidad tus metas con nosotros!
                        </p>

                        <div class="mt-4 pt-2 d-flex gap-2">
                            <a href="https://api.whatsapp.com/send/?phone=584247105601&text=Hola+Srs.+de+Ciro+quisiera+informacion+sobre%3A+&type=phone_number&app_absent=0" class="btn btn-primary w-md btn-hover" style="background-color:#11887B "><i class="bi bi-whatsapp"></i> Cont&aacute;ctanos</a>
                            <a href="https://instagram.com/ciroenlinea" style="font-style: normal !important;" class="btn btn-danger w-md btn-hover"><i class="bi bi-instagram"> Ciroenlinea</i></a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="mt-lg-n5">
                        <img src="{{ URL::asset('/build/images/ecommerce/home/cta.png') }}" alt="" class="mt-lg-n4">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- START INSTAGRAM -->
    <section class="section pb-0">
        <div class="container">
            <div class="row justify-content-center g-0">
                <div class="col-lg-7">
                    <div class="text-center">
                        <h3 class="mb-3">Siguenos en Instagram</h3>
                        <p class="text-muted fs-15">Siempre tendremos actualizadas nuestras redes sociales, donde verás todas nuestras publicaciones</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="position-relative">
            <div class="row g-0 mt-5">
                <div class="col">
                    <div class="insta-img">
                        <a href="https://instagram.com/ciroenlinea" target="_blank" class="stretched-link">
                            <img src="{{ URL::asset('build/images/ecommerce/instagram/img-1.jpg') }}" class="img-fluid" alt="">
                            <i class="ri-instagram-line"></i>
                        </a>
                    </div>
                </div>

                <div class="col">
                    <div class="insta-img">
                        <a href="https://instagram.com/ciroenlinea" target="_blank"  class="stretched-link">
                            <img src="{{ URL::asset('build/images/ecommerce/instagram/img-2.jpg') }}" class="img-fluid" alt="">
                            <i class="ri-instagram-line"></i>
                        </a>
                    </div>
                </div>

                <div class="col d-none d-md-block">
                    <div class="insta-img">
                        <a href="https://instagram.com/ciroenlinea" target="_blank"  class="stretched-link">
                            <img src="{{ URL::asset('build/images/ecommerce/instagram/img-3.jpg') }}" class="img-fluid" alt="">
                            <i class="ri-instagram-line"></i>
                        </a>
                    </div>
                </div>

                <div class="col d-none d-md-block">
                    <div class="insta-img">
                        <a href="https://instagram.com/ciroenlinea" target="_blank"  class="stretched-link">
                            <img src="{{ URL::asset('build/images/ecommerce/instagram/img-4.jpg') }}" class="img-fluid" alt="">
                            <i class="ri-instagram-line"></i>
                        </a>
                    </div>
                </div>
                <div class="col d-none d-lg-block">
                    <div class="insta-img">
                        <a href="https://instagram.com/ciroenlinea" target="_blank"  class="stretched-link">
                            <img src="{{ URL::asset('build/images/ecommerce/instagram/img-5.jpg') }}" class="img-fluid" alt="">
                            <i class="ri-instagram-line"></i>
                        </a>
                    </div>
                </div>
                <div class="col d-none d-lg-block">
                    <div class="insta-img">
                        <a href="https://instagram.com/ciroenlinea" target="_blank"  class="stretched-link">
                            <img src="{{ URL::asset('build/images/ecommerce/instagram/img-6.jpg') }}" class="img-fluid" alt="">
                            <i class="ri-instagram-line"></i>
                        </a>
                    </div>
                </div>
            </div>

            <div class="insta-lable text-center">
                <a href="https://instagram.com/ciroenlinea" target="_blank"  class="btn btn-primary btn-hover">
                    <i class="ph-instagram-logo align-middle me-1"></i> Siguenos en Instagram
                </a>
            </div>
        </div>
    </section>
    <!-- END INSTAGRAM -->

    <section class="section">
        <div class="container">

            <div
                class="row row-cols-lg-5 row-cols-md-3 row-cols-1 text-center justify-content-center align-items-center g-3    ">
                <div class="col">
                    <div class="client-images">
                        <a href="#!">
                            <img src="{{ URL::asset('build/images/clients/edge.jpg') }}" alt="client-img"
                                 class="mx-auto img-fluid d-block">
                        </a>
                    </div>
                </div>
                <div class="col">
                    <div class="client-images">
                        <a href="#!">
                            <img src="{{ URL::asset('build/images/clients/royal.jpg') }}" alt="client-img"
                                 class="mx-auto img-fluid d-block">
                        </a>
                    </div>
                </div>
                <div class="col">
                    <div class="client-images">
                        <a href="#!">
                            <img src="{{ URL::asset('build/images/clients/vivo.jpg') }}" alt="client-img"
                                 class="mx-auto img-fluid d-block">
                        </a>
                    </div>
                </div>
                <div class="col">
                    <div class="client-images">
                        <a href="#!">
                            <img src="{{ URL::asset('build/images/clients/coloman.jpg') }}" alt="client-img"
                                 class="mx-auto img-fluid d-block">
                        </a>
                    </div>
                </div>
                <div class="col">
                    <div class="client-images">
                        <a href="#!">
                            <img src="{{ URL::asset('build/images/clients/exceline.jpg') }}" alt="client-img"
                                 class="mx-auto img-fluid d-block">
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
