<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin | Calla's Coffee</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,600;0,700;1,400&family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'coffee-dark': '#3e2723',
                        'coffee-medium': '#5d4037',
                        'coffee-light': '#8d6e63',
                        'warm-beige': '#f5f0e6',
                        'creamy-white': '#fcfbf9',
                        'accent': '#d4a373',
                    },
                    fontFamily: {
                        serif: ['"Playfair Display"', 'serif'],
                        sans: ['Poppins', 'sans-serif'],
                    }
                }
            }
        }
    </script>
    <style>
        body { background-color: #f5f0e6; }
        .glass-panel {
            background: rgba(252, 251, 249, 0.95);
            border: 1px solid rgba(255, 255, 255, 0.6);
            box-shadow: 0 10px 40px -10px rgba(62, 39, 35, 0.08);
        }
        /* Custom Scrollbar for tables */
        ::-webkit-scrollbar { width: 6px; height: 6px; }
        ::-webkit-scrollbar-track { background: transparent; }
        ::-webkit-scrollbar-thumb { background: #d4a373; border-radius: 10px; }
    </style>
</head>
<body class="font-sans text-coffee-dark antialiased">

    <!-- Sidebar & Topbar Layout -->
    <div class="flex h-screen overflow-hidden">
        
        <!-- Sidebar -->
        <aside class="w-64 glass-panel border-r border-coffee-light/20 flex flex-col hidden md:flex">
            <div class="p-6 border-b border-coffee-light/10 text-center">
                <h1 class="font-serif text-2xl font-bold tracking-wide">Calla's <span class="text-accent italic">Coffee</span></h1>
                <p class="text-xs text-coffee-medium mt-1">Admin Dashboard</p>
            </div>
            <nav class="flex-1 p-4 space-y-2">
                <a href="#" class="block px-4 py-3 bg-warm-beige text-coffee-dark rounded-xl font-medium shadow-sm border border-coffee-light/10 transition-colors">
                    Daftar Pesanan
                </a>
                <a href="#menu-management" class="block px-4 py-3 text-coffee-medium hover:bg-warm-beige/50 hover:text-coffee-dark rounded-xl font-medium transition-colors">
                    Kelola Menu
                </a>
            </nav>
            <div class="p-4 border-t border-coffee-light/10">
                <a href="/index.html" class="block w-full text-center px-4 py-2 text-sm text-red-600 hover:bg-red-50 rounded-lg transition-colors font-medium">
                    Keluar
                </a>
            </div>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 flex flex-col overflow-y-auto bg-[#fdfbf7]">
            <!-- Topbar mobile -->
            <div class="md:hidden glass-panel p-4 flex justify-between items-center border-b border-coffee-light/20 sticky top-0 z-10">
                <h1 class="font-serif text-xl font-bold">Calla's <span class="text-accent italic">Coffee</span></h1>
                <a href="/index.html" class="text-sm font-medium text-coffee-medium">Keluar</a>
            </div>

            <div class="p-6 md:p-10 max-w-6xl mx-auto w-full">
                
                @if(session('success'))
                <div class="mb-6 p-4 bg-green-100 border border-green-200 text-green-700 rounded-xl shadow-sm text-sm font-medium">
                    {{ session('success') }}
                </div>
                @endif

                <!-- Overview Cards -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">
                    <div class="glass-panel p-6 rounded-2xl flex items-center justify-between">
                        <div>
                            <p class="text-coffee-medium text-sm font-medium mb-1">Total Pesanan</p>
                            <h3 class="font-serif text-3xl font-bold">{{ $orders->count() }}</h3>
                        </div>
                        <div class="w-12 h-12 bg-accent/10 text-accent rounded-full flex items-center justify-center">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                        </div>
                    </div>
                    <div class="glass-panel p-6 rounded-2xl flex items-center justify-between">
                        <div>
                            <p class="text-coffee-medium text-sm font-medium mb-1">Pesanan Selesai</p>
                            <h3 class="font-serif text-3xl font-bold">{{ $orders->where('status', 'completed')->count() }}</h3>
                        </div>
                        <div class="w-12 h-12 bg-green-100 text-green-600 rounded-full flex items-center justify-center">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                        </div>
                    </div>
                    <div class="glass-panel p-6 rounded-2xl flex items-center justify-between">
                        <div>
                            <p class="text-coffee-medium text-sm font-medium mb-1">Total Pendapatan</p>
                            <h3 class="font-serif text-2xl font-bold">Rp {{ number_format($orders->where('status', 'completed')->sum('total_price'), 0, ',', '.') }}</h3>
                        </div>
                        <div class="w-12 h-12 bg-blue-100 text-blue-600 rounded-full flex items-center justify-center">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        </div>
                    </div>
                </div>

                <!-- Orders Table -->
                <div class="mb-12">
                    <div class="flex items-center justify-between mb-6">
                        <h2 class="font-serif text-2xl font-bold text-coffee-dark">Daftar Pesanan Terbaru</h2>
                    </div>
                    
                    <div class="glass-panel rounded-2xl overflow-hidden shadow-sm">
                        <div class="overflow-x-auto">
                            <table class="w-full text-left border-collapse">
                                <thead>
                                    <tr class="bg-warm-beige border-b border-coffee-light/20 text-sm">
                                        <th class="py-4 px-6 font-semibold text-coffee-medium">ID Nota</th>
                                        <th class="py-4 px-6 font-semibold text-coffee-medium">Pelanggan</th>
                                        <th class="py-4 px-6 font-semibold text-coffee-medium">Detail Order</th>
                                        <th class="py-4 px-6 font-semibold text-coffee-medium">Total (Metode)</th>
                                        <th class="py-4 px-6 font-semibold text-coffee-medium">Status</th>
                                        <th class="py-4 px-6 font-semibold text-coffee-medium">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody class="text-sm">
                                    @forelse($orders as $order)
                                    <tr class="border-b border-coffee-light/10 hover:bg-warm-beige/30 transition-colors">
                                        <td class="py-4 px-6 font-medium text-accent">{{ $order->receipt_number }}<br><span class="text-xs text-coffee-light">{{ $order->order_code }}</span></td>
                                        <td class="py-4 px-6 font-semibold">{{ $order->customer_name }}</td>
                                        <td class="py-4 px-6 text-coffee-medium">
                                            <ul class="list-disc pl-4">
                                                @foreach($order->items as $item)
                                                    <li>{{ $item->menu->name ?? 'Menu Dihapus' }} (x{{ $item->quantity }})</li>
                                                @endforeach
                                            </ul>
                                        </td>
                                        <td class="py-4 px-6">
                                            <div class="font-semibold">Rp {{ number_format($order->total_price, 0, ',', '.') }}</div>
                                            <div class="text-xs text-coffee-medium mt-1">{{ $order->payment_method }}</div>
                                        </td>
                                        <td class="py-4 px-6">
                                            @if($order->status == 'pending')
                                                <span class="bg-yellow-100 text-yellow-700 px-3 py-1 rounded-full text-xs font-semibold">Menunggu</span>
                                            @elseif($order->status == 'process')
                                                <span class="bg-blue-100 text-blue-700 px-3 py-1 rounded-full text-xs font-semibold">Diproses</span>
                                            @else
                                                <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-xs font-semibold">Selesai</span>
                                            @endif
                                        </td>
                                        <td class="py-4 px-6">
                                            <form action="/admin/orders/{{ $order->id }}/status" method="POST" class="flex gap-2">
                                                @csrf
                                                <select name="status" class="bg-creamy-white border border-coffee-light/30 text-xs rounded-lg px-2 py-1 focus:outline-none focus:ring-1 focus:ring-accent">
                                                    <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                                    <option value="process" {{ $order->status == 'process' ? 'selected' : '' }}>Process</option>
                                                    <option value="completed" {{ $order->status == 'completed' ? 'selected' : '' }}>Completed</option>
                                                </select>
                                                <button type="submit" class="bg-coffee-dark text-white px-3 py-1 rounded-lg text-xs hover:bg-coffee-medium transition-colors shadow-sm">Update</button>
                                            </form>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="6" class="py-8 text-center text-coffee-medium italic">Belum ada pesanan masuk.</td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- Menu Management -->
                <div id="menu-management" class="mb-10">
                    <div class="flex items-center justify-between mb-6">
                        <h2 class="font-serif text-2xl font-bold text-coffee-dark">Manajemen Ketersediaan Menu</h2>
                    </div>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach($menus as $menu)
                        <div class="glass-panel p-6 rounded-2xl flex flex-col justify-between">
                            <div>
                                <div class="flex justify-between items-start mb-2">
                                    <h4 class="font-serif text-lg font-bold">{{ $menu->name }}</h4>
                                    <span class="text-accent font-semibold text-sm">Rp {{ number_format($menu->price, 0, ',', '.') }}</span>
                                </div>
                                <p class="text-xs text-coffee-medium mb-4 line-clamp-2">{{ $menu->description }}</p>
                            </div>
                            <div class="pt-4 border-t border-coffee-light/10 flex justify-between items-center">
                                <span class="text-sm font-medium {{ $menu->is_available ? 'text-green-600' : 'text-red-500' }}">
                                    {{ $menu->is_available ? 'Tersedia' : 'Habis' }}
                                </span>
                                <form action="/admin/menus/{{ $menu->id }}/toggle" method="POST">
                                    @csrf
                                    <button type="submit" class="px-4 py-2 rounded-xl text-xs font-semibold transition-colors {{ $menu->is_available ? 'bg-red-50 text-red-600 hover:bg-red-100 border border-red-200' : 'bg-green-50 text-green-600 hover:bg-green-100 border border-green-200' }}">
                                        {{ $menu->is_available ? 'Set Habis' : 'Set Tersedia' }}
                                    </button>
                                </form>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>

            </div>
        </main>
    </div>

</body>
</html>
