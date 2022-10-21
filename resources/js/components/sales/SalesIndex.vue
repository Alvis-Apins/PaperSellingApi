<template>
    <nav-bar></nav-bar>

    <div class="flex justify-end mr-4">
        <div class="w-fit bg-black text-white hover:text-red-600">
            <router-link :to="{ name: 'sales.create'}">
                <div class="p-2"> Add Sale</div>
            </router-link>
        </div>
    </div>
    <!-- table of sales -->
    <div>
        <div class="mb-20 mt-4">
            <table class="min-w-full">
                <thead class="bg-black border-b text-white">
                <tr>
                    <th scope="col" class="text-sm font-medium px-6 py-4 text-left">#</th>
                    <th scope="col" class="text-sm font-medium px-6 py-4 text-left">Partner</th>
                    <th scope="col" class="text-sm font-medium px-6 py-4 text-left">Total</th>
                    <th scope="col" class="text-sm font-medium px-6 py-4 text-left">When</th>
                    <th scope="col" class="text-sm font-medium px-6 py-4 text-left">Details</th>
                    <th scope="col" class="text-sm font-medium px-6 py-4 text-left">View Sale</th>
                    <th scope="col" class="text-sm font-medium px-6 py-4 text-left">Delete</th>
                </tr>
                </thead>
                <template v-for="(sale,index) in sales" :key="sale.id">
                    <tbody>
                    <tr class="bg-white border-b border-gray-400">
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900"> {{ index + 1 }}.</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                            {{ sale.partner.company }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 font-light"> €
                            {{ sale.total_price }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 font-light">
                            {{ dateTime(sale.created_at) }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 font-light">
                            <button v-on:click="showItems(index)" class="border border-black p-2 hover:bg-blue-500">
                                Details
                            </button>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 font-light">
                            <router-link :to="{ name: 'sales.show', params: { id: sale.id } }" class="border border-black p-2 hover:bg-blue-500">
                                View Sale
                            </router-link>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 font-light">
                            <button @click="deleteSale(sale.id)" class="border border-black p-2 hover:bg-blue-500">
                                Delete
                            </button>
                        </td>
                    </tr>
                    </tbody>
                </template>
            </table>
        </div>
    </div>
    <!-- table of warehouse items -->
    <div>
        <div class="mb-20 mt-4">
            <table class="w-full">
                <thead class="bg-black border-b text-white">
                <tr>
                    <th scope="col" class="text-sm font-medium px-6 py-4 text-left w-1/4">#</th>
                    <th scope="col" class="text-sm font-medium px-6 py-4 text-left w-1/4">Description</th>
                    <th scope="col" class="text-sm font-medium px-6 py-4 text-left w-1/4">Type</th>
                    <th scope="col" class="text-sm font-medium px-6 py-4 text-left w-1/4">Price</th>
                </tr>
                </thead>
                <tbody v-if="salesItems && salesItems !== false">
                <template v-for="(item,index) in salesItems[0]" :key="item.id">
                    <tr class="bg-white border-b border-gray-400">
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900"> {{ index + 1 }}.</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900"> {{ item.item }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 font-light">
                            {{ item.type }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 font-light"> €
                            {{ item.price }}
                        </td>
                    </tr>
                </template>
                </tbody>
            </table>
        </div>
    </div>

</template>
<script>
import NavBar from "../main/nav-bar.vue";
import useSales from "../../composables/sales"
import {onMounted, reactive} from "vue";
import moment from 'moment';

export default {
    components: {NavBar},
    methods: {
        dateTime(value) {
            return moment(value, "YYYY-MM-DD hh:mm:ss").fromNow();
        },
    },
    setup() {
        const {sales, getSales, destroySale} = useSales()
        let salesItems = reactive({0: false})

        onMounted(getSales)

        const deleteSale = async (id) => {
            if (!window.confirm("Are you sure?")) {
                return
            }

            await destroySale(id);
            await getSales();
        }

        const showItems = (index) => {
            if (salesItems[0] === sales.value[index].warehouse) {
                salesItems[0].remove
            }
            salesItems[0] = sales.value[index].warehouse
        }

        return {
            sales,
            salesItems,
            deleteSale,
            showItems
        }
    }
}
</script>
