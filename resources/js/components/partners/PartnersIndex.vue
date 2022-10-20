<template>
    <nav-bar></nav-bar>
    <div class="flex justify-end mr-4">
        <div class="w-fit bg-black text-white hover:text-red-600">
            <router-link :to="{ name: 'partners.create'}"><div class="p-2">Add Partner</div></router-link>
        </div>
    </div>
    <!-- table of partners -->
    <div>
        <div class="mb-20 mt-4">
            <table class="min-w-full">
                <thead class="bg-black border-b text-white">
                <tr>
                    <th scope="col" class="text-sm font-medium px-6 py-4 text-left">#</th>
                    <th scope="col" class="text-sm font-medium px-6 py-4 text-left">Partner</th>
                    <th scope="col" class="text-sm font-medium px-6 py-4 text-left">Phone</th>
                    <th scope="col" class="text-sm font-medium px-6 py-4 text-left">Email</th>
                    <th scope="col" class="text-sm font-medium px-6 py-4 text-left">Address</th>
                    <th scope="col" class="text-sm font-medium px-6 py-4 text-left">Sales</th>
                    <th scope="col" class="text-sm font-medium px-6 py-4 text-left">Edit</th>
                    <th scope="col" class="text-sm font-medium px-6 py-4 text-left">Delete</th>
                </tr>
                </thead>
                <template v-for="(partner,index) in partners" :key="partner.id">
                    <tbody>
                    <tr class="bg-white border-b border-gray-400">
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900"> {{ index + 1 }}. </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900"> {{ partner.company }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 font-light"> {{ partner.phone }} </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 font-light"> {{ partner.email }} </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 font-light"> {{ partner.address }} </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 font-light"> <button v-on:click="showSales(index)" class="border border-black p-2 hover:bg-blue-500">See Sales</button> </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 font-light"> <router-link :to="{ name: 'partners.edit', params: { id: partner.id } }" class="border border-black p-2 hover:bg-blue-500">Edit</router-link> </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 font-light"> <button @click="deletePartner(partner.id)" class="border border-black p-2 hover:bg-blue-500"> Delete </button> </td>
                    </tr>
                    </tbody>
                </template>
            </table>
        </div>
    </div>

    <!-- table of sales -->
    <div>
        <div class="mb-20 mt-4">
            <table class="w-full">
                <thead class="bg-black border-b text-white">
                <tr>
                    <th scope="col" class="text-sm font-medium px-6 py-4 text-left w-1/4">#</th>
                    <th scope="col" class="text-sm font-medium px-6 py-4 text-left w-1/4">Price</th>
                    <th scope="col" class="text-sm font-medium px-6 py-4 text-left w-1/4">Time</th>
                    <th scope="col" class="text-sm font-medium px-6 py-4 text-left w-1/4">Details</th>
                </tr>
                </thead>
                <tbody v-if="salesItems && salesItems !== false">
                <template v-for="(sale,index) in salesItems[0]" :key="sale.id">
                    <tr class="bg-white border-b border-gray-400">
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900"> {{ index + 1 }}. </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900"> € {{ sale.total_price }} </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 font-light"> {{ dateTime(sale.created_at) }} </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 font-light"> <router-link :to="{ name: 'sales.show', params: { id: sale.id } }" class="border border-black p-2 hover:bg-blue-500">Details</router-link> </td>
                    </tr>
                </template>
                </tbody>
            </table>
        </div>
    </div>
</template>

<script>
import NavBar from "../main/nav-bar.vue";
import usePartners from "../../composables/partners";
import {onMounted, reactive} from "vue";
import moment from 'moment';

export default {
    components: {NavBar},
    setup() {
        const {partners, getPartners, destroyPartner} = usePartners()
        let salesItems = reactive({0:false})

        onMounted(getPartners)

        const deletePartner = async (id) => {
            if (!window.confirm("Are you sure?")) {
                return
            }

            await destroyPartner(id);
            await getPartners();
        }

        const showSales = (index) => {
                if (salesItems[0] === partners.value[index].sale) {
                    salesItems[0].remove
                }
                salesItems[0] = partners.value[index].sale

        }

        const dateTime = (value) => {
            return moment(value, "YYYY-MM-DD hh:mm:ss").fromNow();
        }


        return {
            partners,
            salesItems,
            deletePartner,
            showSales,
            dateTime
        }
    }
}
</script>

