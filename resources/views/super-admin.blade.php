<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title }}</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
</head>
<body>
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
          <a class="navbar-brand" href="#">QS Super Admin</a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
              <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="{{ route('su.users') }}">All Users</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="{{ route('su.admins') }}">All Admins</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="{{ route('su.members') }}">All Members</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="{{ route('su.plans') }}">Plans</a>
              </li>             
            </ul>
          </div>
        </div>
      </nav>

     <!-- Container to display data -->
    <div id="data-container" style="margin-top: 2em">
        <!-- Data will be loaded here dynamically -->       
        <h1 style="text-align: center">{{ $title }}</h1>
    </div>

     <!-- Include jQuery -->
     <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

     <!-- Handle navigation link clicks -->
     <script>
         $(document).ready(function() {
             $('nav a').click(function(e) {
                 e.preventDefault(); // Prevent default link behavior
                 var url = $(this).attr('href');
                 console.log(1)
 
                 // Fetch data using AJAX
                 $.get(url, function(data) {
                     $('#data-container').html(data);
                 });
             });
             
         });
     </script>    
     <!-- Bootstrap JavaScript (optional) -->
     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
