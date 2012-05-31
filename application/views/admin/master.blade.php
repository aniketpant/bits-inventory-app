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
                                    
                                        <a class="brand" href="<?php echo url('home') ?>">Inventory Management System</a>
                                        <nav class="nav nav-collapse">
                                                <ul class="nav">
                                                    @section('navigation')
                                                    <li><a href="<?php echo url('admin') ?>">Home</a></li>
                                                    <li><a href="<?php echo url('admin/login') ?>">Login</a></li>
                                                    @yield_section
                                                </ul>
                                        </nav>
                                        
                                </div>
                            
                        </div>
                    
                </div>
            
        </header>
        
        <div class="container">
            
                <div role="main" class="content">
                    
                        <div class="alert alert-danger pull-right"><strong>Attention!</strong> Only admins allowed.</div>
                        @yield('content')
                        
                </div>
            
        </div>
        
        <div class="container">
            
                <footer role="contentinfo" class="footer">
                        <p class="attr pull-right">&copy; <strong>BITS</strong> Pilani, K K Birla Goa Campus</p>
                </footer>
            
        </div>
        
</body>
</html>