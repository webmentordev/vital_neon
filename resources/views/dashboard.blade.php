<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="grid grid-cols-4 gap-5 mb-6">
                        <div class="rounded-lg bg-dark border border-white/10 p-6">
                            <h2 class="text-2xl bebas">Total Products</h2>
                            <p class="text-3xl font-semibold">{{ $products }}</p>
                        </div>
                        <div class="rounded-lg bg-dark border border-white/10 p-6">
                            <h2 class="text-2xl bebas">Custom Design Orders</h2>
                            <p class="text-3xl font-semibold">{{ $design_orders }}</p>
                        </div>

                        <div class="rounded-lg bg-dark border border-white/10 p-6">
                            <h2 class="text-2xl bebas">Custom Design Pending</h2>
                            <p class="text-3xl font-semibold">{{ $design_orders_pending }}</p>
                        </div>

                        <div class="rounded-lg bg-dark border border-white/10 p-6">
                            <h2 class="text-2xl bebas">Custom Design Success</h2>
                            <p class="text-3xl font-semibold">{{ $design_orders_success }}</p>
                        </div>
                        <div class="rounded-lg bg-dark border border-white/10 p-6">
                            <h2 class="text-2xl bebas">Custom Design Cancelled</h2>
                            <p class="text-3xl font-semibold">{{ $design_orders_canceled }}</p>
                        </div>
                        <div class="rounded-lg bg-dark border border-white/10 p-6">
                            <h2 class="text-2xl bebas">Product Orders</h2>
                            <p class="text-3xl font-semibold">{{ $product_orders }}</p>
                        </div>

                        <div class="rounded-lg bg-dark border border-white/10 p-6">
                            <h2 class="text-2xl bebas">Product Pending</h2>
                            <p class="text-3xl font-semibold">{{ $product_pending }}</p>
                        </div>

                        <div class="rounded-lg bg-dark border border-white/10 p-6">
                            <h2 class="text-2xl bebas">Product Success</h2>
                            <p class="text-3xl font-semibold">{{ $product_success }}</p>
                        </div>
                        <div class="rounded-lg bg-dark border border-white/10 p-6">
                            <h2 class="text-2xl bebas">Product Cancelled</h2>
                            <p class="text-3xl font-semibold">{{ $product_canceled }}</p>
                        </div>
                    </div>
                    
                    
                    <h1 class="mb-3 text-4xl text-white">Custom Orders Filter</h1>
                    <form action="{{ route('cart.search') }}" method="GET">
                        @if (session('error'))
                            <p class="bg-red-600/10 text-red-600 mb-3 text-center p-6 rounded-lg border border-red-600">{{ session('error') }}</p>
                        @endif
                        <div class="flex items-end mb-6">
                            <div class="w-full mr-3">
                                <x-input-label for="starting_date" :value="__('Starting Date')" />
                                <x-text-input id="starting_date" class="block mt-1 w-full"
                                type="date"
                                name="starting_date"
                                required />
                            </div>
                            <div class="w-full">
                                <x-input-label for="ending_date" :value="__('Ending Date')" />
                                <x-text-input id="ending_date" class="block mt-1 w-full"
                                type="date"
                                name="ending_date"
                                required />
                            </div>
                            <x-primary-button class="ml-3 mb-1">
                                {{ __('Search') }}
                            </x-primary-button>
                        </div>
                    </form>

                    <h1 class="mb-3 text-4xl text-white">Products Order Filter</h1>
                    <form action="{{ route('order.search') }}" method="GET">
                        @if (session('error'))
                            <p class="bg-red-600/10 text-red-600 mb-3 text-center p-6 rounded-lg border border-red-600">{{ session('error') }}</p>
                        @endif
                        <div class="flex items-end mb-6">
                            <div class="w-full mr-3">
                                <x-input-label for="starting_date" :value="__('Starting Date')" />
                                <x-text-input id="starting_date" class="block mt-1 w-full"
                                type="date"
                                name="starting_date"
                                required />
                            </div>
                            <div class="w-full">
                                <x-input-label for="ending_date" :value="__('Ending Date')" />
                                <x-text-input id="ending_date" class="block mt-1 w-full"
                                type="date"
                                name="ending_date"
                                required />
                            </div>
                            <x-primary-button class="ml-3 mb-1">
                                {{ __('Search') }}
                            </x-primary-button>
                        </div>
                    </form>
                    <div class="chart flex justify-center items-center m-auto w-full bg-white p-12 rounded-lg">
                        <canvas id="myChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const ctx = document.getElementById('myChart').getContext('2d');
        const total_earned = {{ $total }};
        const config = {
            type: 'line',
            data: {
                labels: @json($months_dates),
                datasets: [
                    {
                        data: @json($data),
                        label: `Total $${total_earned} worth of Order placed`,
                        borderColor: '#658ff7',
                        backgroundColor: 'rgba(28, 67, 166, 0.1)',
                        fill: true,
                        tension: 0.2,
                        pointBackgroundColor: "#658ff7"
                    },
                ],
            },
            options:{
                responsive: true,
                radius: 10,
                hoverRadius: 12,
                hitRadius: 30,
                scales: {
                    y:{
                        ticks: {
                            callback: function(value){
                                return '$'+value+' Sales';
                            }
                        },
                        beginAtZero: true
                    },
                }
            }
        }
        const myChart = new Chart(ctx, config);
    </script>
</x-app-layout>
