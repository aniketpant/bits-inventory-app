<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title>Inventory Management System</title>
    <meta name="viewport" content="width=device-width">
    {{ Asset::styles() }}
    {{ Asset::scripts() }}
</head>

<body>    
    <header role="banner">        
        <div class="navbar navbar-fixed-top">
            <div class="navbar-inner">
                
                <div class="container">
                    <a class="brand" href="<?php echo url('user') ?>">Inventory Management System</a>

                    <!-- .btn-navbar is used as the toggle for collapsed navbar content -->
                    <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    </a>
                                        
                    <nav>
                        <ul class="nav nav-collapse">
                            @if(Auth::check())
                                <li><a href="<?php echo url('user/dashboard/base') ?>">Dashboard</a></li>
                                <li><a href="<?php echo url('user/logout') ?>">Logout</a></li>
                            @else
                                <li><a href="<?php echo url('user') ?>">Home</a></li>
                                <li><a href="<?php echo url('user/login') ?>">Login</a></li>
                            @endif
                        </ul>
                    </nav>
                </div>
                            
            </div>

        </div>
            
    </header>
        
    <div class="container">
        <div role="main" class="content">                    
            @yield('content')
        </div>        
            @yield('errors')     
            @yield('scripts')       
    </div>
        
    <div class="container">
        <footer role="contentinfo" class="footer">
            <div class="attr">
                <p class="bits">&copy; <strong>BITS</strong> Pilani, K K Birla Goa Campus</p>
            </div>
        </footer>
    </div>
        
</body>
</html>