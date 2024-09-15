<header class="bg-[#543310] h-20 fixed w-full top-0 mt-0">
    <nav class="flex justify-between items-center w-[95%] mx-auto">
        <div class="flex items-center gap-[1vw]">
            <img class="w-16" src="{{ asset('storage/Logo.png') }}" alt="Logo">
            <h1 class="text-xl text-white font-sans"><b>WOODLAK</b></h1>
            <p class="text-xl text-white font-sans">Admin</p>
        </div>
        <div class="lg:static absolute bg-[#543310] lg:min-h-fit min-h-[39vh] left-0 top-[9%] lg:w-auto w-full flex items-center px-5 justify-center lg:justify-start text-center lg:text-right xl:contents hidden lg:flex" id="content">
            <ul class="flex lg:flex-row flex-col lg:gap-[4vw] gap-8">
                <li>
                    <a class="text-white hover:text-[#D0B8A8] " href="{{ route('admin.dashboard') }}">Dashboard</a>
                </li>
                <li>
                    <a class="text-white hover:text-[#D0B8A8] " href="{{ asset('product/product_detail.php') }}">Products</a>
                </li>
                <li>
                    <a class="text-white hover:text-[#D0B8A8] " href="{{ asset('orders/view_orders_Admin/OrderList.php') }}">Orders</a>
                </li>
                <li>
                    <a class="text-white hover:text-[#D0B8A8] " href="{{ route('admin.inquiry.index') }}">Inquiries</a>
                </li>
                <li>
                    <a class="text-white hover:text-[#D0B8A8] " href="{{ asset('payment_process/admin_banktrans_check/admin_panel.php') }}">Bank Transfers</a>
                </li>
                <li>
                    <a class="text-white hover:text-[#D0B8A8] " href="{{ asset('UserProfile/RegisteredUsers.php') }}">Users</a>
                </li>
            </ul>
        </div>

        <div class="flex items-center gap-3">
            <button class="bg-[#74512D] text-white px-5 py-2 rounded-full hover:text-[#D0B8A8]">Logout</button> 
            <button onclick="responsive()"><i class="bi bi-list text-4xl lg:hidden text-white"></i></button>
        </div>
    </nav>
</header>

<script>
    function responsive() {
        var x = document.getElementById("content");
        x.classList.toggle("hidden");
    }
</script>
