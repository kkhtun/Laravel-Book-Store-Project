@extends('layouts.user-layout')
@section('user-content')
<div class="container mb-8">
    <div class="row justify-content-center">
        <div class="col-md-11">
            
            <section class="text-center mt-5 mb-5 text-gray-600">
                <h1 class="mb-3 text-xl">Total Number of Books available</h1>
                <div id="value" class="text-7xl">
                    0
                </div>
            </section>

            <hr class="mx-auto" style="width: 70%;">

            <section class="text-center mt-5 mb-5">
                <h2 class="mb-2">You can now contribute to our little online library by donating your books via email</h2>
                <p>Thanks for your help!</p>
                <div class="sm:flex justify-center items-center mt-2">
                    <a
                    class="btn btn-floating m-1 w-16"
                    href="mailto: bookhubmyanmaronline@gmail.com"
                    role="button"
                    title="bookhubmyanmaronline@gmail.com"
                    ><img src="/icons/gmail.png" alt=""></i></a>
                    <p class="text-gray-500">bookhubmyanmaronline@gmail.com</p>
                </div>
            </section>
            
            <hr class="mx-auto" style="width: 70%;">

            <section class="text-center mt-5 mb-5">
                <h2 class="mb-2">We are also planning to share our efforts to all those oppressed and endangered.</h2>
                <p class="text-gray-300 text-muted">Plan to raise donation funds for CDMers, Internally Displaced People and revolutionary heroes. (Coming Soon)</p>
            </section>




            <script>
                function animateValue(obj, start, end, duration) {
                let startTimestamp = null;
                const step = (timestamp) => {
                    if (!startTimestamp) startTimestamp = timestamp;
                    const progress = Math.min((timestamp - startTimestamp) / duration, 1);
                    obj.innerHTML = Math.floor(progress * (end - start) + start);
                    if (progress < 1) {
                    window.requestAnimationFrame(step);
                    }
                };
                window.requestAnimationFrame(step);
                }
                const obj = document.getElementById("value");
                animateValue(obj, 0, {{ $bookCount }}, 2000);
            </script>

        </div>
    </div>
</div>
@endsection
