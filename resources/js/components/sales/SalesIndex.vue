<template>
    <nav-bar></nav-bar>

    <div class="border-black border p-2 w-fit h-fit bg-blue-500">
        <router-link :to="{ name: 'sales.create'}"> Add Sale </router-link>
    </div>

    <div class="w-1/2 h-auto flex items-center">
        <div class="flex flex-col">
            <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="py-2 inline-block min-w-full sm:px-6 lg:px-8">
                    <div class="overflow-hidden">
                        <table class="min-w-full">
                            <thead class="border-b">
                            <tr>
                                <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                    #
                                </th>
                                <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                    Partner
                                </th>
                                <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                    Total
                                </th>
                                <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                    Date
                                </th>
                                <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                    Delete
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            <template v-for="(sale,index) in sales" :key="sale.id">
                                <tr class="border-b">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                        {{ index + 1 }}
                                    </td>
                                    <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                        {{ sale.partner.company }}
                                    </td>
                                    <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                        € {{ sale.total_price }}
                                    </td>
                                    <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                        {{ dateTime(sale.created_at) }}
                                    </td>
                                    <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                        <button @click="deleteSale(sale.id)" class="border border-black p-2">
                                            Delete
                                        </button>
                                    </td>
                                </tr>
                            </template>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

</template>
<script>
import NavBar from "../main/nav-bar.vue";
import useSales from "../../composables/sales"
import {onMounted} from "vue";
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

        onMounted(getSales)

        const deleteSale = async (id) => {
            if (!window.confirm("Are you sure?")) {
                return
            }

            await destroySale(id);
            await getSales();
        }

        return {
            sales,
            deleteSale
        }
    }
}
</script>
