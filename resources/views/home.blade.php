<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Woodlak</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        
        .bg-translucent {
            background-color: rgba(255, 255, 255, 0.7); /* white background with 80% opacity */
        }
        body {
                background-image: url('wallPaper_02.png');
                background-repeat: no-repeat;
                background-attachment: fixed;
                background-size: cover;
                font-family: sans-serif;
                color: #fff;
            }

            .header-title {
                color: #D0B8A8;
            }

            .comb-card {
                transition: transform 0.3s, box-shadow 0.3s;
            }

            .comb-card:hover {
                transform: scale(1.05);
                box-shadow: 0 10px 20px rgba(0, 0, 0, 0.5);
            }

            .hero {
                background: rgba(0, 0, 0, 0.5);
                padding: 50px;
            }

            .btn-primary-custom {
                background-color: #74512D;
                color: #fff;
                border: none;
                transition: background-color 0.3s, color 0.3s, transform 0.3s;
            }

            .btn-primary-custom:hover {
                background-color: #D0B8A8;
                color: #543310;
                transform: scale(1.05);
            }

            .subheading {
                color: #E2D1C3;
            }

            .feature-section {
                background-color: rgba(116, 81, 45, 0.9);
                padding: 60px;
                border-radius: 15px;
                margin-top: 30px;
            }

            img {
                height: auto;
                max-height: 200px;
                object-fit: cover;
            }
    </style>
</head>
<body class="font-sans text-gray-900 antialiased bg-gray-100"
      style="background-image: url('{{ asset('storage/bg1.jpg') }}'); background-size: cover;">
    
    <x-navbar/>
   
    

        <section class="feature-section text-center mt-80">
            <h2 class="text-4xl font-semibold header-title mb-5">Why Choose Our Neem Combs?</h2>
            <div class="flex justify-center gap-8">
                <div class="w-[30%]">
                <i class="bi bi-flower3 text-5xl mb-3"></i>
                    <h3 class="text-2xl font-semibold subheading">Natural Benefits</h3>
                    <p>Neem has natural antibacterial properties that promote a healthy scalp and reduce dandruff.</p>
                </div>
                <div class="w-[30%]">
                    <i class="bi bi-gem text-5xl mb-3"></i>
                    <h3 class="text-2xl font-semibold subheading">Durability</h3>
                    <p>Our combs are strong and long-lasting, crafted from premium neem wood for everyday use.</p>
                </div>
                <div class="w-[30%]">
                    <i class="bi bi-recycle text-5xl mb-3"></i>
                    <h3 class="text-2xl font-semibold subheading">Eco-Friendly</h3>
                    <p>Our combs are 100% biodegradable, making them a sustainable choice for your daily hair care routine.</p>
                </div>
            </div>
        </section>

        <section class="grid grid-cols-1 md:grid-cols-3 gap-8 mt-10 px-10">
     
            <div class="comb-card bg-[#543310] text-center rounded-lg shadow-lg p-5 hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2">
                <img src="{{asset('storage/Curly_Hair.jpg')}}" alt="Curly Hair Comb" class="w-full rounded-t-lg object-cover h-56">
                <h3 class="mt-5 text-2xl header-title">Curly Hair Neem Comb</h3>
                <p class="mt-3 text-[#E2D1C3]">Perfect for defining curls and reducing frizz naturally.</p>
                <a href="{{ asset('product/product_catalog.php') }}" class="block mt-5 btn-primary-custom px-5 py-2 rounded-full w-full transition-all duration-300 transform hover:scale-105">View Product</a>
            </div>

            <div class="comb-card bg-[#543310] text-center rounded-lg shadow-lg p-5 hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2">
                <img src="{{asset('storage/Straight_Hair.png')}}" alt="Straight Hair Comb" class="w-full rounded-t-lg object-cover h-56">
                <h3 class="mt-5 text-2xl header-title">Straight Hair Neem Comb</h3>
                <p class="mt-3 text-[#E2D1C3]">For smooth and tangle-free hair, with gentle detangling action.</p>
                <a href="{{ asset('product/product_catalog.php') }}" class="block mt-5 btn-primary-custom px-5 py-2 rounded-full w-full transition-all duration-300 transform hover:scale-105">View Product</a>
            </div>

            <div class="comb-card bg-[#543310] text-center rounded-lg shadow-lg p-5 hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2">
                <img src="{{asset('storage/Thick_Hair.jpg')}}" alt="Thick Hair Comb" class="w-full rounded-t-lg object-cover h-56">
                <h3 class="mt-5 text-2xl header-title">Thick Hair Neem Comb</h3>
                <p class="mt-3 text-[#E2D1C3]">Ideal for thick hair, providing a firm yet smooth combing experience.</p>
                <a href="{{ asset('product/product_catalog.php') }}" class="block mt-5 btn-primary-custom px-5 py-2 rounded-full w-full transition-all duration-300 transform hover:scale-105">View Product</a>
            </div>
        </section>

        <script>
            function responsive() {
                var x = document.getElementById("content");
                if (x.classList.contains("hidden")) {
                    x.classList.remove("hidden");
                } else {
                    x.classList.add("hidden");
                }
            }
        </script>
       <x-footer/>
</body>
</html>
