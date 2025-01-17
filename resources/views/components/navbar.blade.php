<header class="bg-[#543310] h-20">
    <nav class="flex justify-between items-center w-[95%] mx-auto">
        <div class="flex items-center gap-[1vw]">
            <img class="w-16" src="{{ asset('storage/Logo.png') }}" alt="Logo">
            <h1 class="text-xl text-white font-sans"><b>WOODLAK</b></h1>
        </div>
        <div class="lg:static absolute bg-[#543310] lg:min-h-fit min-h-[39vh] left-0 top-[9%] lg:w-auto w-full flex items-center px-5 justify-center lg:justify-start text-center lg:text-right xl:contents hidden lg:flex" id="content">
            <ul class="flex lg:flex-row flex-col lg:gap-[4vw] gap-8">
                <li>
                    <a class="text-white hover:text-[#D0B8A8] " href="{{route('home')}}">Home</a>
                </li>
                <li>
                    <a class="text-white hover:text-[#D0B8A8]" href="{{route('inquiry')}}">Contact Us</a>
                </li>
                <li>
                    <a class="text-white hover:text-[#D0B8A8]" href="{{asset('aboutUs/About_Us.php')}}">About Us</a>
                </li>
                <li>
                    <a class="text-white hover:text-[#D0B8A8]" href="{{ asset('product/product_catalog.php') }}">Products</a>
                </li>
                <li>
                    <a class="text-white hover:text-[#D0B8A8]" href="#">Orders</a>
                </li>
            </ul>
        </div>

        <?php
  session_start();      


if (isset($_SESSION['user_name'])) {
    $user_name = $_SESSION['user_name'];
    
} else {
    $user_name = null;
}
?>


        @if(isset($user_name))
        <div class="flex items-center gap-3">
            <span class="mr-4 text-lg">{{$user_name}}</span>
            <button class="bg-[#74512D] text-white px-5 py-2 rounded-full hover:text-[#D0B8A8]" onclick="location.href='/dashboard/woodlak/public/Userprofile/profile.php'">Profile</button> 
            <button onclick="responsive()"><i class="bi bi-list text-4xl lg:hidden text-white"></i></button>
        </div>
        @else
        <div class="flex items-center gap-3">
            <button class="bg-[#74512D] text-white px-5 py-2 rounded-full hover:text-[#D0B8A8]" onclick="location.href='/dashboard/woodlak/public/Userprofile/register.php'">Register</button>
            <button class="bg-[#74512D] text-white px-5 py-2 rounded-full hover:text-[#D0B8A8]" onclick="location.href='/dashboard/woodlak/public/Userprofile/login.php'">Login</button>
            <button onclick="responsive()"><i class="bi bi-list text-4xl lg:hidden text-white"></i></button>
        </div>
        @endif
    </nav>
</header>

<script>
    function responsive() {
        var x = document.getElementById("content");
        x.classList.toggle("hidden");
    }
</script>
