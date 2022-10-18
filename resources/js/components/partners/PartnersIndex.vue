<template>

    <div class="border-black border p-2 w-fit h-fit bg-blue-500">
        <router-link :to="{ name: 'partners.create'}"> Add Partner </router-link>
    </div>
    <!-- dropdown for partners style later
    <div>
        <select name="" id="" class="input">
            <option>Select Partner</option>
            <option :value="partner.id" v-for="partner in partners" :key="partner.id">
                {{ partner.company }}
            </option>
        </select>
    </div>
    -->
    <!-- table of partners -->
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
                                    Edit
                                </th>
                                <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                    Delete
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            <template v-for="(partner,index) in partners" :key="partner.id">
                                <tr class="border-b">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900"> {{ index + 1}} </td>
                                    <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                        {{ partner.company }}
                                    </td>
                                    <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                        <router-link :to="{ name: 'partners.edit', params: { id: partner.id } }">Edit</router-link>
                                    </td>
                                    <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                        <button @click="deletePartner(partner.id)" class="border border-black p-2">Delete</button>
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
import usePartners from "../../composables/partners";
import {onMounted} from "vue";

export default {
    setup() {
        const {partners, getPartners, destroyPartner} = usePartners()

        onMounted(getPartners)

        const deletePartner = async (id) => {
            if (!window.confirm("Are you sure?")) {
                return
            }

            await destroyPartner(id);
            await getPartners();
        }

        return {
            partners,
            deletePartner
        }
    }
}
</script>
