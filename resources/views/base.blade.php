<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="_token" content="{{ csrf_token() }}">
  <title>Importer</title>
  <link rel="stylesheet" href="/css/app.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script type='text/javascript' src="{{ asset('js/config.js') }}"></script>
</head>

<body>
  <header class="header">
    <section class="header-bar">
      <nav class="navbar navbar-default">
        <div class="container-fluid">
          <!-- Collapse para mobile -->
          <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1"
              aria-expanded="false">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
            <a class="navbar-brand" href="{{ route('Produtos.index') }}">XLS Importer</a>
          </div>
          <!-- Collapse par amobile -->
          <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
              <li class="nav-item {{ Request::is('Produtos/create') ? 'active' : '' }}"><a href="{{ route('Produtos.create') }}">Importar <span class="sr-only">Importar</span></a></li>
              <li class="nav-item {{ Request::is('Produtos') ? 'active' : '' }}"><a href="{{ route('Produtos.index') }}">Produtos</a></li>
            </ul>
          </div>
          <!-- /.navbar-collapse -->
        </div>
        <!-- /.container-fluid -->
      </nav>
    </section>
  </header>





  <main class="main-wrapper">@yield('main')</main>




  <footer class="footer-wrapper">
    <section class="copyright">
      <h5>Copyright © Lucas Santos - 2017</h5>
    </section>
  </footer>


</body>

</html>
