<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">

    {{-- Custom Style --}}
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

    <title>Student Database</title>
  </head>
  <body>
    <div class="container">
      <div class="row">
        <div class="col-md-12 text-center my-5 mx-auto">
          <div class="card shadow p-5">
              <div class="card-body">
                <a href="{{ route('student.index') }}" class="text-decoration-none text-monospace">
                    <h1 class="text-success">Click <br>to see the Student Database</h1>
                </a>
              </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="{{ asset('js/jquery-3.5.1.js') }}"></script>
    <script src="{{ asset('js/popper.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/script.js') }}">

    </script>
  </body>
</html>
