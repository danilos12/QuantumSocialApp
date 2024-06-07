
@extends('layouts.errorpage')
@section('content')
<h1 class="error_headline darkmode">Oopps!</h1>
<h3>404 - Page Not Found</h3>
<span>Sorry we couldn't find what you're looking for</span>
<div class="p-12">
<button id="navigateButton" class="custom-button ">Go Home</button>
</div>
<div class=""><img class="astro" loading="lazy" src="{{ asset('public/')}}/ui-images/icons/astronaut.png" alt="astronaut"></div>

<script>
    document.getElementById('navigateButton').addEventListener('click', function() {
        window.location.href = "{{ route('dashboard') }}";
    });
</script>
<style>
    .astro{
        height: 400px;
    }
     .alpha-text {
            opacity: 0.5; /* 50% opacity */
        }
    .p-12{
        padding: 2rem;
    }
    .error_headline{
        font-size: 12em;
        color: white;
        font-weight: 700;
    }
    .custom-button{
        padding: 1rem;
        border: none;
        background: #43ebf1;
        width: 150px;
        border-radius: 2rem;
        font-weight: 700

    }

</style>
@endsection
