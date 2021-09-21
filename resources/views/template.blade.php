<html>

<head>
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/css/bootstrap.min.css" />
    <!------ Include the above in your HEAD tag ---------->
</head>

<body>
    <nav class="navbar navbar-expand navbar-dark bg-primary">
        <a href="#menu-toggle" id="menu-toggle" class="navbar-brand">
            <span class="navbar-toggler-icon"></span>
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExample02"
            aria-controls="navbarsExample02" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarsExample02">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active"> <a class="nav-link" href="#">Home <span
                            class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item"> <a class="nav-link" href="#">Link</a> </li>
            </ul>
            <form class="form-inline my-2 my-md-0"> </form>
        </div>
    </nav>
    <div id="wrapper" class="toggled">
        <!-- Sidebar -->
        <div id="sidebar-wrapper">
            <ul class="sidebar-nav">
                <li class="sidebar-brand"> <a href="#"> Start Bootstrap </a> </li>
                <li> <a href="#">Dashboard</a> </li>
                <li> <a href="#">Shortcuts</a> </li>
                <li> <a href="#">Overview</a> </li>
                <li> <a href="#">Events</a> </li>
                <li> <a href="#">About</a> </li>
                <li> <a href="#">Services</a> </li>
                <li> <a href="#">Contact</a> </li>
            </ul>
        </div> <!-- /#sidebar-wrapper -->
        <!-- Page Content -->
        <div id="page-content-wrapper">
            <div class="container-fluid">
                <h1>Simple Sidebar</h1>
                <p>This template has a responsive menu toggling system. The menu will appear collapsed on smaller
                    screens,
                    and will appear non-collapsed on larger screens. When toggled using the button below, the menu will
                    appear/disappear. On small screens, the page content will be pushed off canvas.</p>
                <p>Make sure to keep all page content within the <code>#page-content-wrapper</code>.</p>
            </div>
        </div> <!-- /#page-content-wrapper -->
    </div> <!-- /#wrapper -->
    <!-- Bootstrap core JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.10.1/umd/popper.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/js/bootstrap.min.js"></script>
    <script>
        $(function(){
            $("#menu-toggle").click(function(e) {
                e.preventDefault();
                $("#wrapper").toggleClass("toggled");
            });

            $(window).resize(function(e) {
              if($(window).width()<=768){
                $("#wrapper").removeClass("toggled");
              }else{
                $("#wrapper").addClass("toggled");
              }
            });
          });
           
    </script>

</html>