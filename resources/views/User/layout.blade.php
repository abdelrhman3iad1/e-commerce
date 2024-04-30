@include('User.head')
<title>@yield('title')</title>
  <body>

    <!-- ***** Preloader Start ***** -->
    <div id="preloader">
        <div class="jumper">
            <div></div>
            <div></div>
            <div></div>
        </div>
    </div>
    <!-- ***** Preloader End ***** -->

    <!-- Header -->
    @include('User.navbar')

    <!-- Page Content -->
    <!-- Banner Starts Here -->
    
    @include('User.banner')

    <!-- Banner Ends Here -->

    

    
    @yield('content')
    


    @include('User.aboutFooter')

    
    
    @include('User.callAction')
    
    
    @include('User.footer')