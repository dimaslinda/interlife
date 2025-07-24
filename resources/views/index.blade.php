<!DOCTYPE html>
<html lang="en" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>
        {{ $seoSetting ? $seoSetting->title : 'Interlife Furniture - Jasa Pembuatan Kitchen Set & Custom Furniture Berkualitas' }}
    </title>

    <!-- Meta Tags for SEO -->
    <meta name="description"
        content="{{ $seoSetting ? $seoSetting->description : 'Interlife Furniture menyediakan jasa pembuatan kitchen set, custom furniture, dan interior berkualitas tinggi dengan desain modern dan elegan. Wujudkan hunian impian Anda bersama kami.' }}">
    @if ($seoSetting && $seoSetting->keywords)
        <meta name="keywords" content="{{ $seoSetting->keywords }}">
    @endif
    @if ($seoSetting && $seoSetting->author)
        <meta name="author" content="{{ $seoSetting->author }}">
    @endif
    <meta name="robots" content="{{ $seoSetting ? $seoSetting->robots : 'index, follow' }}">
    <meta name="language" content="{{ $seoSetting ? $seoSetting->language : 'Indonesia' }}">
    <meta name="revisit-after" content="{{ $seoSetting ? $seoSetting->revisit_after : '7 days' }}">
    @if ($seoSetting && $seoSetting->geo_region)
        <meta name="geo.region" content="{{ $seoSetting->geo_region }}">
    @endif
    @if ($seoSetting && $seoSetting->geo_placename)
        <meta name="geo.placename" content="{{ $seoSetting->geo_placename }}">
    @endif
    @if ($seoSetting && $seoSetting->theme_color)
        <meta name="theme-color" content="{{ $seoSetting->theme_color }}">
    @endif

    <!-- Open Graph Meta Tags -->
    <meta property="og:title"
        content="{{ $seoSetting && $seoSetting->og_title ? $seoSetting->og_title : ($seoSetting ? $seoSetting->title : 'Interlife Furniture - Jasa Pembuatan Kitchen Set & Custom Furniture') }}">
    <meta property="og:description"
        content="{{ $seoSetting && $seoSetting->og_description ? $seoSetting->og_description : ($seoSetting ? $seoSetting->description : 'Wujudkan hunian impian Anda dengan kitchen set dan custom furniture berkualitas tinggi dari Interlife Furniture. Desain modern, elegan, dan terpercaya.') }}">
    <meta property="og:image"
        content="{{ $seoSetting && $seoSetting->getFirstMediaUrl('og_images') ? $seoSetting->getFirstMediaUrl('og_images') : asset('img/general/bg-banner.webp') }}">
    <meta property="og:image:width" content="{{ $seoSetting ? $seoSetting->og_image_width : '1200' }}">
    <meta property="og:image:height" content="{{ $seoSetting ? $seoSetting->og_image_height : '630' }}">
    <meta property="og:url"
        content="{{ $seoSetting && $seoSetting->canonical_url ? $seoSetting->canonical_url : url('/') }}">
    <meta property="og:type" content="{{ $seoSetting ? $seoSetting->og_type : 'website' }}">
    @if ($seoSetting && $seoSetting->og_site_name)
        <meta property="og:site_name" content="{{ $seoSetting->og_site_name }}">
    @endif

    <!-- Twitter Card Meta Tags -->
    <meta name="twitter:card" content="{{ $seoSetting ? $seoSetting->twitter_card : 'summary_large_image' }}">
    <meta name="twitter:title"
        content="{{ $seoSetting && $seoSetting->twitter_title ? $seoSetting->twitter_title : ($seoSetting ? $seoSetting->title : 'Interlife Furniture - Kitchen Set & Custom Furniture') }}">
    <meta name="twitter:description"
        content="{{ $seoSetting && $seoSetting->twitter_description ? $seoSetting->twitter_description : ($seoSetting ? $seoSetting->description : 'Jasa pembuatan kitchen set dan custom furniture berkualitas dengan desain modern dan elegan. Wujudkan hunian impian Anda bersama Interlife Furniture.') }}">
    <meta name="twitter:image"
        content="{{ $seoSetting && $seoSetting->getFirstMediaUrl('twitter_images') ? $seoSetting->getFirstMediaUrl('twitter_images') : asset('img/general/bg-banner.webp') }}">

    <!-- Pinterest Meta Tags -->
    <meta name="pinterest-rich-pin" content="true">
    @if ($seoSetting && $seoSetting->pinterest_description)
        <meta name="pinterest:description" content="{{ $seoSetting->pinterest_description }}">
    @endif
    <meta name="pinterest:image"
        content="{{ $seoSetting && $seoSetting->getFirstMediaUrl('pinterest_images') ? $seoSetting->getFirstMediaUrl('pinterest_images') : asset('img/general/bg-banner.webp') }}">

    <!-- Microsoft Bing Meta Tags -->
    @if ($seoSetting && $seoSetting->msapplication_tile_color)
        <meta name="msapplication-TileColor" content="{{ $seoSetting->msapplication_tile_color }}">
    @endif
    <meta name="msapplication-TileImage"
        content="{{ $seoSetting && $seoSetting->getFirstMediaUrl('ms_tile_images') ? $seoSetting->getFirstMediaUrl('ms_tile_images') : asset('img/general/logo.png') }}">

    <!-- Canonical URL -->
    <link rel="canonical"
        href="{{ $seoSetting && $seoSetting->canonical_url ? $seoSetting->canonical_url : url('/') }}">

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon"
        href="{{ $seoSetting && $seoSetting->getFirstMediaUrl('favicons') ? $seoSetting->getFirstMediaUrl('favicons') : asset('favicon.ico') }}">
    <link rel="apple-touch-icon"
        href="{{ $seoSetting && $seoSetting->getFirstMediaUrl('apple_touch_icons') ? $seoSetting->getFirstMediaUrl('apple_touch_icons') : asset('img/general/logo.png') }}">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">

    <!-- AOS CSS -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>

<body class="font-poppins">
    <header>
        <nav class="bg-primary border-gray-200">
            <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
                <a href="/" class="flex items-center space-x-3 rtl:space-x-reverse">
                    <img src="{{ asset('img/general/logo.png') }}" class="h-8" alt="interlifefurniture Logo" />
                </a>
                <button data-collapse-toggle="navbar-default" type="button"
                    class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-white rounded-lg lg:hidden hover:bg-gray-100"
                    aria-controls="navbar-default" aria-expanded="false">
                    <span class="sr-only">Open main menu</span>
                    <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 17 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M1 1h15M1 7h15M1 13h15" />
                    </svg>
                </button>
                <div class="hidden w-full lg:block lg:w-auto" id="navbar-default">
                    <ul
                        class="font-medium capitalize flex flex-col p-4 lg:p-0 mt-4 lg:flex-row lg:space-x-8 rtl:space-x-reverse lg:mt-0">
                        <li>
                            <a href="/"
                                class="block py-2 px-3 text-white rounded-sm hover:bg-gray-100 lg:hover:bg-transparent lg:hover:text-secondary lg:p-0"
                                aria-current="page">
                                Beranda
                            </a>
                        </li>
                        <li>
                            <a href="#tentang"
                                class="block py-2 px-3 text-white rounded-sm hover:bg-gray-100 lg:hover:bg-transparent lg:hover:text-secondary lg:p-0">
                                tentang
                            </a>
                        </li>
                        <li>
                            <a href="#layanan"
                                class="block py-2 px-3 text-white rounded-sm hover:bg-gray-100 lg:hover:bg-transparent lg:hover:text-secondary lg:p-0">
                                layanan
                            </a>
                        </li>
                        <li>
                            <a href="#portofolio"
                                class="block py-2 px-3 text-white rounded-sm hover:bg-gray-100 lg:hover:bg-transparent lg:hover:text-secondary lg:p-0">
                                portofolio
                            </a>
                        </li>
                        <li>
                            <a href="#kontak"
                                class="block py-2 px-3 text-white rounded-sm hover:bg-gray-100 lg:hover:bg-transparent lg:hover:text-secondary lg:p-0">
                                kontak
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>



    <section class="bg-center bg-cover bg-no-repeat bg-banner/60 bg-blend-multiply"
        style="background-image: url('{{ $banner && $banner->getFirstMediaUrl('banners') ? $banner->getFirstMediaUrl('banners') : asset('img/general/bg-banner.webp') }}');">
        <div class="px-4 mx-auto max-w-screen-xl text-center py-24 lg:py-56">
            <h1 class="mb-4 text-4xl font-extrabold tracking-tight leading-none text-white md:text-5xl"
                data-aos="fade-up" data-aos-delay="200">
                {{ $banner ? $banner->title : 'Wujudkan Hunian Impian, Mulai dari sini!' }}
            </h1>
            <p class="mb-8 text-lg font-normal text-white lg:text-xl sm:px-16 lg:px-48" data-aos="fade-up"
                data-aos-delay="400">
                {{ $banner ? $banner->subtitle : 'Kitchen Set | Custom Furniture | Interior - Langsung dari Workshop Profesional' }}
            </p>
            <div class="flex flex-col space-y-4 sm:flex-row sm:justify-center sm:space-y-0" data-aos="fade-up"
                data-aos-delay="600">
                <a href="{{ $banner ? $banner->primary_button_url : 'https://wa.me/+6285770622336' }}"
                    target="_blank"
                    class="inline-flex justify-center capitalize items-center py-3 px-5 text-base font-medium text-center text-[#575A4A] rounded-full bg-[#D9D7CB] hover:bg-[#D9D7CB]/95">
                    {{ $banner ? $banner->primary_button_text : 'konsultasi gratis sekarang' }}
                </a>
                <a href="{{ $banner ? $banner->secondary_button_url : '#portofolio' }}"
                    class="inline-flex justify-center capitalize hover:text-[#9E9E9E] items-center py-3 px-5 sm:ms-4 text-base font-medium text-center text-[#EDEDEA] rounded-full border border-[#EDEDEA] hover:bg-gray-100 focus:ring-4 focus:ring-gray-400">
                    {{ $banner ? $banner->secondary_button_text : 'lihat portofolio' }}
                </a>
            </div>
        </div>
    </section>

    <section id="tentang" class="bg-secondary py-10 lg:py-24">
        <div class="container mx-auto p-6">
            <div class="flex flex-col gap-5 justify-center items-center">
                <div class="text-center text-2xl lg:text-3xl xl:text-4xl font-bold text-primary" data-aos="fade-up">
                    Kenapa memilih Interlife Furniture?
                </div>

                <div
                    class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 md:gap-6 mt-10 w-full max-w-7xl px-4 sm:px-0">
                    @foreach ($features as $index => $feature)
                        <div class="bg-primary rounded-lg p-4 md:p-6 flex flex-col items-center text-center shadow-md hover:shadow-lg transition-shadow duration-300"
                            data-aos="fade-up" data-aos-delay="{{ ($index + 1) * 100 }}">
                            <div
                                class="bg-white rounded-full w-16 h-16 md:w-20 md:h-20 flex items-center justify-center mb-3 md:mb-4">
                                {!! $feature->icon !!}
                            </div>
                            <h3 class="text-white font-semibold text-base md:text-lg mb-1 md:mb-2">
                                {{ $feature->title }}
                            </h3>
                            <p class="text-white text-xs md:text-sm">
                                {{ $feature->description }}
                            </p>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    <section id="layanan" class="bg-primary py-10 lg:py-24">
        <div class="container mx-auto p-6">
            <div class="flex flex-col gap-5 justify-center items-center">
                <div class="text-center text-2xl lg:text-3xl capitalize xl:text-4xl font-bold text-secondary"
                    data-aos="fade-up">
                    layanan kami
                </div>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mt-10 w-full max-w-7xl px-4 sm:px-0">
                    @forelse($services as $index => $service)
                        <div class="bg-secondary rounded-lg overflow-hidden shadow-md hover:shadow-lg transition-shadow duration-300"
                            data-aos="fade-up" data-aos-delay="{{ ($index + 1) * 100 }}">
                            <div class="relative">
                                @if ($service->getFirstMediaUrl())
                                    <img src="{{ $service->getFirstMediaUrl('default', 'thumb') }}"
                                        alt="{{ $service->title }}" class="w-full h-48 object-cover">
                                @else
                                    <div class="w-full h-48 bg-gray-200 flex items-center justify-center">
                                        <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                                            </path>
                                        </svg>
                                    </div>
                                @endif
                            </div>
                            <div class="p-5">
                                <h3 class="text-center text-lg font-semibold text-primary mb-2">
                                    {{ $service->title }}
                                </h3>
                                <p class="text-center text-primary text-sm mb-4">
                                    {{ $service->description }}
                                </p>
                                <div class="flex justify-center">
                                    <a href="{{ $service->button_url }}" target="_blank"
                                        class="inline-flex items-center justify-center px-4 py-2 bg-[#D9D7CB] text-primary rounded-full text-sm font-medium hover:bg-[#D9D7CB]/95 transition-colors">
                                        {{ $service->button_text }}
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 ml-1" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M9 5l7 7-7 7" />
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        </div>
                    @empty
                        <!-- Fallback content when no services are available -->
                        <div class="col-span-full text-center py-12">
                            <div class="text-white font-bold text-lg mb-4">Layanan sedang dalam pengembangan</div>
                            <p class="text-white font-bold text-sm">Silakan hubungi kami untuk informasi lebih lanjut
                            </p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </section>

    <section id="portofolio" class="bg-secondary py-10 lg:py-24">
        <div class="container mx-auto p-6">
            <div class="text-center text-2xl lg:text-3xl mb-5 xl:text-4xl font-bold text-primary" data-aos="fade-up">
                Hasil Karya Interlife Furniture
            </div>
            <div class="text-center text-primary text-lg" data-aos="fade-up" data-aos-delay="100">
                Beberapa proyek terbaik yang telah kami kerjakan
            </div>

            <!-- Filter Categories -->
            <div class="flex flex-wrap justify-center gap-2 my-8" id="portfolio-filters" data-aos="fade-up"
                data-aos-delay="200">
                <button id="filter-all" data-filter="all"
                    class="bg-white capitalize cursor-pointer hover:bg-primary hover:text-white text-primary font-medium py-2 px-4 rounded-full transition-all duration-300 active">
                    Semua
                </button>
                @forelse($portfolioCategories as $category)
                    <button id="filter-{{ $category->slug }}" data-filter="{{ $category->filter_value }}"
                        class="bg-white capitalize cursor-pointer hover:bg-primary hover:text-white text-primary font-medium py-2 px-4 rounded-full transition-all duration-300">
                        {{ $category->name }}
                    </button>
                @empty
                    <button id="filter-kitchen" data-filter="kitchen set"
                        class="bg-white capitalize cursor-pointer hover:bg-primary hover:text-white text-primary font-medium py-2 px-4 rounded-full transition-all duration-300">
                        kitchen set
                    </button>
                    <button id="filter-furniture" data-filter="custom furniture"
                        class="bg-white capitalize cursor-pointer hover:bg-primary hover:text-white text-primary font-medium py-2 px-4 rounded-full transition-all duration-300">
                        custom furniture
                    </button>
                    <button id="filter-interior" data-filter="interior"
                        class="bg-white capitalize cursor-pointer hover:bg-primary hover:text-white text-primary font-medium py-2 px-4 rounded-full transition-all duration-300">
                        interior
                    </button>
                @endforelse
            </div>

            <!-- Portfolio Grid -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mt-8" id="portfolio-grid" data-aos="fade-up"
                data-aos-delay="300">
                @forelse($portfolios as $index => $portfolio)
                    <!-- Portfolio Item {{ $index + 1 }} -->
                    <div class="portfolio-item bg-white rounded-lg overflow-hidden shadow-md flex flex-col md:flex-row"
                        data-category="{{ $portfolio->portfolioCategory->filter_value ?? '' }}" data-aos="fade-up"
                        data-aos-delay="{{ 400 + $index * 100 }}">
                        <div class="relative md:w-1/3 lg:w-2/5">
                            @if ($portfolio->getFirstMediaUrl('portfolio_images'))
                                <img src="{{ $portfolio->getFirstMediaUrl('portfolio_images', 'thumb') }}"
                                    alt="{{ $portfolio->title }}" class="w-full h-48 md:h-full object-cover">
                            @else
                                <img src="{{ asset('img/portofolio/default-portfolio.webp') }}"
                                    alt="{{ $portfolio->title }}" class="w-full h-48 md:h-full object-cover">
                            @endif
                            <div
                                class="absolute top-3 left-3 bg-white text-primary text-xs font-medium px-2 py-1 rounded">
                                {{ $portfolio->portfolioCategory->name ?? 'Portfolio' }}
                            </div>
                        </div>
                        <div class="p-4 md:w-2/3 lg:w-3/5 flex flex-col justify-between">
                            <div>
                                <h3 class="font-bold text-primary text-xl mb-2">{{ $portfolio->title }}</h3>

                                <ul class="list-disc list-inside mb-10">
                                    @if ($portfolio->design_style)
                                        <li class="text-primary font-light capitalize mb-2">
                                            Gaya Desain :
                                            <span class="font-bold text-base text-primary capitalize">
                                                {{ $portfolio->design_style }}
                                            </span>
                                        </li>
                                    @endif
                                    @if ($portfolio->frame_material)
                                        <li class="text-primary font-light capitalize mb-2">
                                            rangka :
                                            <span class="font-bold text-base text-primary capitalize">
                                                {{ $portfolio->frame_material }}
                                            </span>
                                        </li>
                                    @endif
                                    @if ($portfolio->finishing)
                                        <li class="text-primary font-light capitalize mb-2">
                                            finishing :
                                            <span class="font-bold text-base text-primary capitalize">
                                                {{ $portfolio->finishing }}
                                            </span>
                                        </li>
                                    @endif
                                </ul>
                                <div class="bg-secondary rounded-lg p-4">
                                    @if ($portfolio->rating && $portfolio->rating > 0)
                                        <div class="flex items-center mb-3">
                                            <div class="flex text-yellow-400">
                                                @for ($i = 1; $i <= 5; $i++)
                                                    @if ($i <= $portfolio->rating)
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4"
                                                            viewBox="0 0 20 20" fill="currentColor">
                                                            <path
                                                                d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118l-2.799-2.034c-.784-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                                        </svg>
                                                    @else
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4"
                                                            viewBox="0 0 20 20" fill="none" stroke="currentColor"
                                                            stroke-width="1">
                                                            <path
                                                                d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118l-2.799-2.034c-.784-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                                        </svg>
                                                    @endif
                                                @endfor
                                            </div>
                                        </div>
                                    @endif
                                    @if ($portfolio->testimonial)
                                        <p class="text-sm text-primary leading-relaxed italic">
                                            "{{ $portfolio->testimonial }}"
                                        </p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <!-- Fallback content when no portfolios are available -->
                    <div class="col-span-full text-center py-12">
                        <div class="text-primary text-lg mb-4">
                            <svg class="mx-auto h-12 w-12 text-primary mb-4" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                            </svg>
                            Belum ada portfolio yang tersedia
                        </div>
                        <p class="text-primary">Portfolio akan ditampilkan setelah ditambahkan melalui admin panel.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    <section class="bg-primary py-10 lg:py-24">
        <div class="container mx-auto p-6">
            <div class="flex flex-col justify-center item-center text-center">
                <div class="text-white text-center text-2xl lg:text-3xl mb-5 xl:text-4xl font-bold"
                    data-aos="fade-up">
                    Dipercaya oleh :
                </div>
                <div class="flex flex-wrap justify-center gap-4 mt-8" data-aos="fade-up" data-aos-delay="100">
                    @forelse($partners as $index => $partner)
                        <div class="bg-white rounded-lg p-4 w-52 h-20 flex items-center justify-center"
                            data-aos="fade-up" data-aos-delay="{{ 200 + $index * 100 }}">
                            @if ($partner->getFirstMediaUrl('logo_partner', 'thumb'))
                                <img src="{{ $partner->getFirstMediaUrl('logo_partner', 'thumb') }}"
                                    alt="{{ $partner->name }}" class="max-h-8 max-w-full object-contain">
                            @else
                                <span class="text-gray-400 text-sm">{{ $partner->name }}</span>
                            @endif
                        </div>
                    @empty
                        <div class="text-white text-center">
                            <p>Belum ada partner yang ditampilkan</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </section>

    <section class="bg-secondary">
        <div>
            <div class="flex flex-col md:flex-row gap-8">
                <!-- Left Side - Image -->
                <div class="w-full md:w-[40%] md:flex md:items-stretch">
                    <img src="{{ asset('img/portofolio/proses.webp') }}" alt="Proses Instalasi"
                        class="w-full min-h-[300px] md:min-h-0 md:h-full object-cover">
                </div>

                <!-- Right Side - Process Steps -->
                <div class="w-full md:w-[60%] p-6 py-8 md:py-12 max-w-3xl mx-auto">
                    <h2 class="text-3xl md:text-4xl font-bold text-primary text-center mb-2">
                        Proses Pemesanan Mudah & Transparan
                    </h2>
                    <p class="text-primary text-center mb-8">
                        Kami memastikan proses pengerjaan yang jelas dan
                        terstruktur
                    </p>

                    <!-- Timeline -->
                    <div class="relative">
                        <!-- Vertical Line -->
                        <div class="absolute left-6 top-0 h-full w-0.5 bg-primary"></div>

                        @foreach ($processes as $index => $process)
                            <!-- Step {{ $process->step_number }} -->
                            <div class="relative flex items-start {{ $loop->last ? '' : 'mb-8' }}">
                                <div
                                    class="flex-shrink-0 bg-white rounded-full h-12 w-12 flex items-center justify-center border-2 border-primary text-primary font-bold z-10">
                                    {{ $process->step_number }}
                                </div>
                                <div class="ml-6 bg-white rounded-2xl p-6">
                                    <h3 class="font-bold text-lg text-primary">
                                        {{ $process->title }}
                                    </h3>
                                    <p class="text-primary mt-1">
                                        {{ $process->description }}
                                    </p>
                                    @if ($process->additional_info)
                                        <p
                                            class="text-primary font-semibold mt-2 text-sm italic bg-secondary p-4 rounded-lg">
                                            {{ $process->additional_info }}
                                        </p>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="mt-8 flex justify-center">
                        <a href="https://wa.me/+6285770622336" target="_blank"
                            class="inline-block bg-primary hover:bg-primary-dark text-white font-medium py-3 px-6 rounded-lg transition-all duration-300">
                            Konsultasi
                            Gratis Sekarang
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="kontak" class="bg-primary py-10 lg:py-24">
        <div class="container mx-auto p-6">
            <div class="flex flex-col justify-center item-center">
                <div class="text-white text-center text-2xl lg:text-3xl mb-5 xl:text-4xl font-bold"
                    data-aos="fade-up">
                    Siap Konsultasi? Hubungi Kami Sekarang!
                </div>
                <div class="text-center text-white text-lg font-light" data-aos="fade-up" data-aos-delay="100">
                    Dapatkan konsultasi gratis untuk mewujudkan hunian impian Anda
                </div>

                <div class="mt-10 mb-10 bg-white rounded-lg shadow-xl overflow-hidden max-w-5xl md:mx-auto"
                    data-aos="fade-up" data-aos-delay="200">
                    <div class="flex flex-col md:flex-row">
                        <!-- Form Kirim Pesan - Menggunakan komponen Flowbite -->
                        <div class="w-full md:w-1/2 p-8 bg-gray-100">
                            <h3 class="text-xl font-semibold text-primary mb-6">Kirim Pesan</h3>

                            <form id="contactForm" action="{{ route('contact.send') }}" method="POST">
                                @csrf
                                <div id="form-messages">
                                    @if (session('success'))
                                        <div class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50"
                                            role="alert">
                                            {{ session('success') }}
                                        </div>
                                    @endif

                                    @if ($errors->any())
                                        <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50"
                                            role="alert">
                                            <ul class="list-disc pl-5">
                                                @foreach ($errors->all() as $error)
                                                    <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif
                                </div>
                                <div class="mb-4">
                                    <label for="nama" class="block mb-2 text-sm font-medium text-primary">Nama
                                        Lengkap</label>
                                    <div class="relative">
                                        <div
                                            class="absolute inset-y-0 start-0 flex items-center ps-3.5 pointer-events-none">
                                            <svg class="w-4 h-4 text-gray-500" aria-hidden="true"
                                                xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                                viewBox="0 0 20 20">
                                                <path
                                                    d="M10 0a10 10 0 1 0 10 10A10.011 10.011 0 0 0 10 0Zm0 5a3 3 0 1 1 0 6 3 3 0 0 1 0-6Zm0 13a8.949 8.949 0 0 1-4.951-1.488A3.987 3.987 0 0 1 9 13h2a3.987 3.987 0 0 1 3.951 3.512A8.949 8.949 0 0 1 10 18Z" />
                                            </svg>
                                        </div>
                                        <input type="text" id="nama" name="nama"
                                            class="bg-white border border-[#E0E0E0 ] text-[#9E9E9E] text-sm rounded-lg focus:ring-primary focus:border-primary block w-full ps-10 p-2.5"
                                            placeholder="Masukkan nama lengkap" value="{{ old('nama') }}" required>
                                    </div>
                                </div>

                                <div class="mb-4">
                                    <label for="whatsapp" class="block mb-2 text-sm font-medium text-primary">Nomor
                                        Whatsapp</label>
                                    <div class="relative">
                                        <div
                                            class="absolute inset-y-0 start-0 flex items-center ps-3.5 pointer-events-none">
                                            <svg class="w-4 h-4 text-gray-500" aria-hidden="true"
                                                xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                                viewBox="0 0 19 18">
                                                <path
                                                    d="M18 13.446a3.02 3.02 0 0 0-.946-1.985l-1.4-1.4a3.054 3.054 0 0 0-4.218 0l-.7.7a.983.983 0 0 1-1.39 0l-2.1-2.1a.983.983 0 0 1 0-1.389l.7-.7a2.98 2.98 0 0 0 0-4.217l-1.4-1.4a2.824 2.824 0 0 0-4.218 0c-3.619 3.619-3 8.229 1.752 12.979C6.785 16.639 9.45 18 11.912 18a7.175 7.175 0 0 0 5.139-2.325A2.9 2.9 0 0 0 18 13.446Z" />
                                            </svg>
                                        </div>
                                        <input type="tel" id="whatsapp" name="whatsapp" pattern="[0-9]*"
                                            class="bg-white border border-[#E0E0E0 ] text-[#9E9E9E] text-sm rounded-lg focus:ring-primary focus:border-primary block w-full ps-10 p-2.5"
                                            placeholder="Contoh: 08123456789" value="{{ old('whatsapp') }}"
                                            oninput="this.value = this.value.replace(/[^0-9]/g, '')" minlength="10"
                                            maxlength="13" required>
                                    </div>
                                </div>

                                <div class="mb-4">
                                    <label for="email"
                                        class="block mb-2 text-sm font-medium text-primary">Email</label>
                                    <div class="relative">
                                        <div
                                            class="absolute inset-y-0 start-0 flex items-center ps-3.5 pointer-events-none">
                                            <svg class="w-4 h-4 text-gray-500" aria-hidden="true"
                                                xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                                viewBox="0 0 20 16">
                                                <path
                                                    d="m10.036 8.278 9.258-7.79A1.979 1.979 0 0 0 18 0H2A1.987 1.987 0 0 0 .641.541l9.395 7.737Z" />
                                                <path
                                                    d="M11.241 9.817c-.36.275-.801.425-1.255.427-.428 0-.845-.138-1.187-.395L0 2.6V14a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V2.6l-8.759 7.217Z" />
                                            </svg>
                                        </div>
                                        <input type="email" id="email" name="email"
                                            class="bg-white border border-[#E0E0E0 ] text-[#9E9E9E] text-sm rounded-lg focus:ring-primary focus:border-primary block w-full ps-10 p-2.5"
                                            placeholder="Masukkan Email" value="{{ old('email') }}" required>
                                    </div>
                                </div>

                                <div class="mb-4">
                                    <label for="layanan" class="block mb-2 text-sm font-medium text-primary">Layanan
                                        yang dibutuhkan</label>
                                    <select id="layanan" name="layanan"
                                        class="bg-white border border-[#E0E0E0 ] cursor-pointer text-[#9E9E9E] text-sm rounded-lg focus:ring-primary focus:border-primary block w-full p-2.5">
                                        <option value="" {{ old('layanan') == '' ? 'selected' : '' }}>Pilih
                                            layanan</option>
                                        <option value="kitchen-set"
                                            {{ old('layanan') == 'kitchen-set' ? 'selected' : '' }}>Kitchen Set
                                        </option>
                                        <option value="custom-furniture"
                                            {{ old('layanan') == 'custom-furniture' ? 'selected' : '' }}>Custom
                                            Furniture</option>
                                        <option value="interior" {{ old('layanan') == 'interior' ? 'selected' : '' }}>
                                            Interior</option>
                                    </select>
                                </div>

                                <div class="mb-6">
                                    <label for="pesan"
                                        class="block mb-2 text-sm font-medium text-primary">Pesan</label>
                                    <textarea id="pesan" name="pesan" rows="4"
                                        class="bg-white border border-[#E0E0E0 ] text-[#9E9E9E] text-sm rounded-lg focus:ring-primary focus:border-primary block w-full p-2.5"
                                        placeholder="Ceritakan kebutuhan Anda...">{{ old('pesan') }}</textarea>
                                </div>

                                <button type="submit" id="submit-contact-form"
                                    class="w-full text-white bg-primary hover:bg-primary/90 cursor-pointer focus:ring-4 focus:outline-none focus:ring-[#7a8b66] font-medium rounded-lg text-sm px-5 py-3 text-center transition duration-300 flex items-center justify-center">
                                    <span id="button-text">Kirim Pesan</span>
                                    <span id="loading-indicator" class="hidden ml-2">
                                        <svg class="animate-spin h-5 w-5 text-white"
                                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                            <circle class="opacity-25" cx="12" cy="12" r="10"
                                                stroke="currentColor" stroke-width="4"></circle>
                                            <path class="opacity-75" fill="currentColor"
                                                d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                                            </path>
                                        </svg>
                                    </span>
                                </button>
                            </form>
                        </div>

                        <!-- Informasi Kontak -->
                        <div class="w-full md:w-1/2 p-8 bg-secondary text-primary flex flex-col justify-between"
                            data-aos="fade-left" data-aos-delay="300">
                            <div>
                                <h3 class="text-xl font-semibold mb-6" data-aos="fade-up" data-aos-delay="400">
                                    Informasi Kontak</h3>

                                @foreach ($contacts as $index => $contact)
                                    <div class="flex items-start text-xs md:text-base {{ $index < count($contacts) - 1 ? 'mb-6' : '' }}"
                                        data-aos="fade-up" data-aos-delay="{{ 500 + $index * 100 }}">
                                        <div class="mr-3 mt-1">
                                            {!! $contact->icon !!}
                                        </div>
                                        <div>
                                            <p class="font-medium">{{ $contact->value }}</p>
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                            <!-- Map -->
                            <div class="mt-8 h-80 bg-gray-200 rounded-md overflow-hidden">
                                <iframe
                                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3965.8013055692054!2d107.04640177575936!3d-6.2898266936991805!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69e5e5de976c35%3A0x52e9cb4b66b2c2c4!2sInterlife%20Furniture!5e0!3m2!1sid!2sid!4v1753240873100!5m2!1sid!2sid"
                                    width="100%" height="100%" style="border:0;" allowfullscreen=""
                                    loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @php
        $footerSetting = \App\Models\FooterSetting::where('is_active', true)->first();
    @endphp

    @if ($footerSetting)
        <footer class="bg-footer" data-aos="fade-up">
            <div class="container mx-auto p-6">
                <div class="flex flex-col md:flex-row md:justify-between justify-center items-center gap-5 md:gap-0">
                    <div class="flex items-center text-xs md:text-base text-white font-bold" data-aos="fade-right"
                        data-aos-delay="100">
                        {{ $footerSetting->title }}
                    </div>
                    <div data-aos="fade-left" data-aos-delay="200">
                        <a href="{{ $footerSetting->button_url }}" target="_blank"
                            class="inline-block text-xs md:text-base bg-secondary hover:bg-secondary/90 text-primary font-bold py-3 px-6 rounded-full transition-all duration-300">
                            {{ $footerSetting->button_text }}
                        </a>
                    </div>
                </div>
            </div>
        </footer>
    @else
        <footer class="bg-footer" data-aos="fade-up">
            <div class="container mx-auto p-6">
                <div class="flex flex-col md:flex-row md:justify-between justify-center items-center gap-5 md:gap-0">
                    <div class="flex items-center text-xs md:text-base text-white font-bold" data-aos="fade-right"
                        data-aos-delay="100">
                        Wujudkan Hunian Impian Anda!
                    </div>
                    <div data-aos="fade-left" data-aos-delay="200">
                        <a href="https://wa.me/+6285770622336" target="_blank"
                            class="inline-block text-xs md:text-base bg-secondary hover:bg-secondary/90 text-primary font-bold py-3 px-6 rounded-full transition-all duration-300">
                            Konsultasi
                            Gratis Sekarang
                        </a>
                    </div>
                </div>
            </div>
        </footer>
    @endif

    <!-- Back to Top Button -->
    <button id="backToTop"
        class="fixed bottom-6 cursor-pointer right-6 bg-primary hover:bg-primary/90 text-white p-3 rounded-full shadow-lg transition-all duration-300 opacity-0 invisible z-50"
        onclick="scrollToTop()">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
            xmlns="http://www.w3.org/2000/svg">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18">
            </path>
        </svg>
    </button>

    <script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>

    <!-- AOS JavaScript -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

    <!-- Back to Top Script -->
    <script>
        // Back to Top functionality
        const backToTopButton = document.getElementById('backToTop');

        // Show/hide button based on scroll position
        window.addEventListener('scroll', function() {
            if (window.pageYOffset > 300) {
                backToTopButton.classList.remove('opacity-0', 'invisible');
                backToTopButton.classList.add('opacity-100', 'visible');
            } else {
                backToTopButton.classList.add('opacity-0', 'invisible');
                backToTopButton.classList.remove('opacity-100', 'visible');
            }
        });

        // Smooth scroll to top function
        function scrollToTop() {
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        }
    </script>

    <!-- AOS Initialization -->
    <script>
        AOS.init({
            duration: 1000,
            easing: 'ease-in-out',
            once: true,
            mirror: false
        });
    </script>

    <!-- Filter Portfolio Script -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Get filter container and portfolio items using ID selectors
            const filterContainer = document.getElementById('portfolio-filters');
            const portfolioItems = document.querySelectorAll('.portfolio-item');

            // Add click event to filter container (event delegation)
            filterContainer.addEventListener('click', function(e) {
                if (e.target.tagName === 'BUTTON') {
                    const clickedButton = e.target;
                    const filterValue = clickedButton.getAttribute('data-filter');

                    // Remove active class from all buttons
                    const allButtons = filterContainer.querySelectorAll('button');
                    allButtons.forEach(btn => {
                        btn.classList.remove('active', 'bg-primary', 'text-white');
                        btn.classList.add('bg-white', 'text-primary');
                    });

                    // Add active class to clicked button
                    clickedButton.classList.add('active', 'bg-primary', 'text-white');
                    clickedButton.classList.remove('bg-white', 'text-primary');

                    // Filter portfolio items without changing their style
                    portfolioItems.forEach(item => {
                        const itemCategory = item.getAttribute('data-category');

                        if (filterValue === 'all' || itemCategory === filterValue) {
                            // Show the item with explicit display value to maintain layout
                            item.style.display = 'flex';
                        } else {
                            // Hide the item
                            item.style.display = 'none';
                        }
                    });
                }
            });

            // Set 'Semua' as active by default
            const defaultButton = document.getElementById('filter-all');
            defaultButton.classList.add('active', 'bg-primary', 'text-white');
            defaultButton.classList.remove('bg-white', 'text-primary');

            // Contact form loading indicator and AJAX submission
            const contactForm = document.getElementById('contactForm');
            const submitButton = document.getElementById('submit-contact-form');
            const buttonText = document.getElementById('button-text');
            const loadingIndicator = document.getElementById('loading-indicator');
            const formMessages = document.getElementById('form-messages');

            if (contactForm && submitButton) {
                contactForm.addEventListener('submit', function(e) {
                    e.preventDefault(); // Prevent default form submission

                    // Show loading indicator
                    buttonText.textContent = 'Mengirim...';
                    loadingIndicator.classList.remove('hidden');
                    submitButton.disabled = true;
                    submitButton.classList.add('opacity-75');

                    // Get form data
                    const formData = new FormData(contactForm);

                    // Send AJAX request
                    fetch(contactForm.getAttribute('action'), {
                            method: 'POST',
                            body: formData,
                            headers: {
                                'X-Requested-With': 'XMLHttpRequest'
                            }
                        })
                        .then(response => response.json())
                        .then(data => {
                            // Reset loading state
                            buttonText.textContent = 'Kirim Pesan';
                            loadingIndicator.classList.add('hidden');
                            submitButton.disabled = false;
                            submitButton.classList.remove('opacity-75');

                            // Show success message
                            if (data.success) {
                                formMessages.innerHTML = `
                                <div class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50" role="alert">
                                    ${data.success}
                                </div>
                            `;
                                contactForm.reset(); // Reset form fields
                            } else if (data.errors) {
                                // Show error messages
                                let errorHtml = `
                                <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50" role="alert">
                                    <ul class="list-disc pl-5">
                            `;

                                Object.values(data.errors).forEach(error => {
                                    errorHtml += `<li>${error}</li>`;
                                });

                                errorHtml += `
                                    </ul>
                                </div>
                            `;

                                formMessages.innerHTML = errorHtml;
                            }

                            // Scroll to form messages
                            formMessages.scrollIntoView({
                                behavior: 'smooth'
                            });
                        })
                        .catch(error => {
                            // Reset loading state
                            buttonText.textContent = 'Kirim Pesan';
                            loadingIndicator.classList.add('hidden');
                            submitButton.disabled = false;
                            submitButton.classList.remove('opacity-75');

                            // Show error message
                            formMessages.innerHTML = `
                            <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50" role="alert">
                                Terjadi kesalahan saat mengirim pesan. Silakan coba lagi.
                            </div>
                        `;

                            // Scroll to form messages
                            formMessages.scrollIntoView({
                                behavior: 'smooth'
                            });
                        });
                });
            }
        });
    </script>
</body>

</html>
