<template>
    <nav class="py-4">
        <div class="px-8 bg-black text-white h-16">
            <div class="flex justify-between">
                <!-- navbar left side -->
                <div class="flex m-6">
                    <router-link :to="{ name: 'home.index'}" class="hover:text-red-600 px-2"> Home </router-link>
                    <router-link :to="{ name: 'partners.index'}" class="hover:text-red-600 px-2"> Partners </router-link>
                    <router-link :to="{ name: 'sales.index'}" class="hover:text-red-600 px-2"> Sales </router-link>
                </div>
                <!-- nav bar right side -->
                <div class="flex m-6">
                    <router-link :to="{ name: 'partners.index'}"> Partners </router-link>
                </div>
            </div>
        </div>
    </nav>
</template>
