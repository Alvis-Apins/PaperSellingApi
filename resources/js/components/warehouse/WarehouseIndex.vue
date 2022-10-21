<template>
    <nav-bar></nav-bar>

    <!-- table of warehouse items -->
    <div>
        <div class="mb-20 mt-4">
            <table class="w-full">
                <thead class="bg-black border-b text-white">
                <tr>
                    <th scope="col" class="text-sm font-medium px-6 py-4 text-left w-1/12">#</th>
                    <th scope="col" class="text-sm font-medium px-6 py-4 text-left w-1/5">Description</th>
                    <th scope="col" class="text-sm font-medium px-6 py-4 text-left w-1/5">Type</th>
                    <th scope="col" class="text-sm font-medium px-6 py-4 text-left w-1/5">Price</th>
                    <th scope="col" class="text-sm font-medium px-6 py-4 text-left w-1/5">See Sales</th>
                </tr>
                </thead>
                <tbody>
                <template v-for="(item,index) in warehouseItems" :key="item.id">
                    <tr class="bg-white border-b border-gray-400">
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900"> {{ index + 1 }}.</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900"> {{ item.item }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 font-light">
                            {{ item.type }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 font-light"> €
                            {{ item.price }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 font-light">
                            <button v-on:click="showSales(index)" class="border border-black p-2 hover:bg-blue-500">
                                Details
                            </button>
                        </td>
                    </tr>
                </template>
                </tbody>
            </table>
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
                    <th scope="col" class="text-sm font-medium px-6 py-4 text-left">View Sale</th>
                </tr>
                </thead>
                <template v-for="(sale,index) in salesItems[0]" :key="sale.id">
                    <tbody>
                    <tr class="bg-white border-b border-gray-400">
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900"> {{ index + 1 }}.</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                            {{ partners[sale.partner_id].company }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 font-light"> €
                            {{ sale.total_price }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 font-light">
                            {{ dateTime(sale.created_at) }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 font-light">
                            <router-link :to="{ name: 'sales.show', params: { id: sale.id } }" class="border border-black p-2 hover:bg-blue-500">
                                View Sale
                            </router-link>
                        </td>
                    </tr>
                    </tbody>
                </template>
            </table>
        </div>
    </div>

</template>

<script>
import NavBar from "../main/nav-bar.vue";
import useWarehouse from "../../composables/warehouse";
import {onMounted, reactive} from "vue";
import moment from "moment/moment";
import usePartners from "../../composables/partners";

export default {
    components: {NavBar},
    methods: {
        dateTime(value) {
            return moment(value, "YYYY-MM-DD hh:mm:ss").fromNow();
        },
    },
    setup() {
        const {warehouseItems, getWarehouseItems} = useWarehouse()
        const {partners, getPartners} = usePartners()
        let salesItems = reactive({0: false})

        onMounted(async () => {
            await getPartners()
            await getWarehouseItems()
        })

        const showSales = (index) => {
            if (salesItems[0] === warehouseItems.value[index].sale) {
                salesItems[0].remove
            }
            salesItems[0] = warehouseItems.value[index].sale
        }

        return {
            warehouseItems,
            partners,
            salesItems,
            showSales,
        }
    }
}
</script>
