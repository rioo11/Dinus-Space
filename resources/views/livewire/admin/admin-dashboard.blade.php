<div class="relative mb-6 w-full min-h-screen bg-white dark:bg-zinc-800">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-semibold text-gray-900 dark:text-white">Dashboard</h1>
    </div>

    <!-- Dashboard Stats Section -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <!-- Stat Card 1 -->
        <div class="bg-white dark:bg-zinc-700 p-6 rounded-lg shadow-md">
            <h2 class="text-lg font-semibold text-gray-600 dark:text-gray-300">Total Users</h2>
            <p class="text-2xl font-bold text-blue-500 dark:text-blue-300">1,234</p>
        </div>

        <!-- Stat Card 2 -->
        <div class="bg-white dark:bg-zinc-700 p-6 rounded-lg shadow-md">
            <h2 class="text-lg font-semibold text-gray-600 dark:text-gray-300">Revenue</h2>
            <p class="text-2xl font-bold text-green-500 dark:text-green-300">$12,345</p>
        </div>

        <!-- Stat Card 3 -->
        <div class="bg-white dark:bg-zinc-700 p-6 rounded-lg shadow-md">
            <h2 class="text-lg font-semibold text-gray-600 dark:text-gray-300">Active Sessions</h2>
            <p class="text-2xl font-bold text-yellow-500 dark:text-yellow-300">123</p>
        </div>

        <!-- Stat Card 4 -->
        <div class="bg-white dark:bg-zinc-700 p-6 rounded-lg shadow-md">
            <h2 class="text-lg font-semibold text-gray-600 dark:text-gray-300">New Signups</h2>
            <p class="text-2xl font-bold text-purple-500 dark:text-purple-300">56</p>
        </div>

        <!-- Stat Card 5 -->
        <div class="bg-white dark:bg-zinc-700 p-6 rounded-lg shadow-md">
            <h2 class="text-lg font-semibold text-gray-600 dark:text-gray-300">Total Sales</h2>
            <p class="text-2xl font-bold text-red-500 dark:text-red-300">$45,678</p>
        </div>

        <!-- Stat Card 6 -->
        <div class="bg-white dark:bg-zinc-700 p-6 rounded-lg shadow-md">
            <h2 class="text-lg font-semibold text-gray-600 dark:text-gray-300">Pending Orders</h2>
            <p class="text-2xl font-bold text-orange-500 dark:text-orange-300">32</p>
        </div>
    </div>

    <!-- Activity Feed Section -->
    <div class="bg-white dark:bg-zinc-700 p-6 rounded-lg shadow-md mt-8">
        <h2 class="text-xl font-semibold text-gray-700 dark:text-white mb-4">Recent Activity</h2>
        <ul class="space-y-4">
            <li class="flex items-center space-x-3">
                <span class="bg-green-500 text-white p-2 rounded-full">📅</span>
                <div>
                    <p class="font-semibold text-gray-900 dark:text-white">John Doe</p>
                    <p class="text-gray-500 dark:text-gray-300 text-sm">Updated profile information</p>
                </div>
            </li>
            <li class="flex items-center space-x-3">
                <span class="bg-blue-500 text-white p-2 rounded-full">📦</span>
                <div>
                    <p class="font-semibold text-gray-900 dark:text-white">Jane Smith</p>
                    <p class="text-gray-500 dark:text-gray-300 text-sm">Ordered 3 new items</p>
                </div>
            </li>
            <li class="flex items-center space-x-3">
                <span class="bg-yellow-500 text-white p-2 rounded-full">⚙️</span>
                <div>
                    <p class="font-semibold text-gray-900 dark:text-white">Mike Johnson</p>
                    <p class="text-gray-500 dark:text-gray-300 text-sm">Changed account settings</p>
                </div>
            </li>
        </ul>
    </div>

    <!-- Line Chart Section -->
    <div class="bg-white dark:bg-zinc-700 p-6 rounded-lg shadow-md mt-8">
        <h2 class="text-xl font-semibold text-gray-700 dark:text-white mb-4">Sales Over Time</h2>
        <div class="grid auto-rows-min gap-4 md:grid-cols-2">
            <div class="relative aspect-video overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700">
                <x-placeholder-pattern class="absolute inset-0 size-full stroke-gray-900/20 dark:stroke-neutral-100/20" />
            </div>
            <div class="relative aspect-video overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700">
                <x-placeholder-pattern class="absolute inset-0 size-full stroke-gray-900/20 dark:stroke-neutral-100/20" />
            </div>
        </div>
    </div>

    <!-- Customer Feedback Section -->
    <div class="bg-white dark:bg-zinc-700 p-6 rounded-lg shadow-md mt-8">
        <h2 class="text-xl font-semibold text-gray-700 dark:text-white mb-4">Customer Feedback</h2>
        <ul class="space-y-4">
            <li class="flex items-center space-x-3">
                <span class="bg-blue-500 text-white p-2 rounded-full">🗣️</span>
                <div>
                    <p class="font-semibold text-gray-900 dark:text-white">Sarah Lee</p>
                    <p class="text-gray-500 dark:text-gray-300 text-sm">"Great experience! Highly recommend."</p>
                </div>
            </li>
            <li class="flex items-center space-x-3">
                <span class="bg-green-500 text-white p-2 rounded-full">🗣️</span>
                <div>
                    <p class="font-semibold text-gray-900 dark:text-white">James Walker</p>
                    <p class="text-gray-500 dark:text-gray-300 text-sm">"Easy to use and fast delivery."</p>
                </div>
            </li>
            <li class="flex items-center space-x-3">
                <span class="bg-red-500 text-white p-2 rounded-full">🗣️</span>
                <div>
                    <p class="font-semibold text-gray-900 dark:text-white">Emily Harris</p>
                    <p class="text-gray-500 dark:text-gray-300 text-sm">"Had a few issues with the product, but customer support was helpful."</p>
                </div>
            </li>
        </ul>
    </div>
</div>
