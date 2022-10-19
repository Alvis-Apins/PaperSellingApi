<template>
    <nav-bar></nav-bar>

    <div class="mt-2 mb-6 text-sm text-red-600" v-if="errors !== ''">
        {{ errors }}
    </div>


    <div>
        <select name="partner_id" id="partner_id" @change="setPartner($event)">
            <option disabled>Select Partner</option>
            <option :value="partner.id" v-for="partner in partners" :key="partner.id" @select="setPartner(partner.id)">
                {{ partner.company }}
            </option>
        </select>
    </div>


    <!-- add items button for popup modal -->
    <button @click="openModal()">Add Products</button>
    <!-- selected items-->
    <table class="min-w-full">
        <thead class="border-b">
        <tr>
            <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                #
            </th>
            <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                Item
            </th>
            <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                Price
            </th>
            <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                Delete
            </th>
        </tr>
        </thead>
        <tbody>
        <template v-for="(listItem, index) in saleItems" :key="listItem.id">
            <tr class="border-b">
                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900"> {{ index + 1}} </td>
                <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                    {{ listItem.item }}
                </td>
                <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                    {{ listItem.price }}
                </td>
                <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">

                    <button  @click="removeItem(i)" class="border border-black p-2 hover:bg-blue-500">Delete</button>
                </td>
            </tr>
        </template>
        </tbody>
    </table>



    <!-- total -->
    <div>
        <p>Total</p>
        <span>$ {{ total() }}</span>
    </div>

    <!--save button-->
    <div><button class="border border-black p-2" @click="saveSale()"> Save </button></div>



    <!-- pop up modal warehouse -->
    <div class="hidden" :class="{ show:showModal }">
        <div class="bg-blue-500">
            <ul>
                <template v-for="(item, index) in warehouseItems" :key="item.id">
                    <li >
                        {{ index + 1 }}. - {{ item.item }} <button @click="addSale(item)" class="border-black border p-2"> Add </button>
                    </li>
                </template>
            </ul>
            <button @click="closeModal()">Cancel</button>
        </div>
    </div>

</template>

<script>
import {onMounted, reactive, ref} from "vue";
import NavBar from "../main/nav-bar.vue";
import useSales from "../../composables/sales";
import usePartners from "../../composables/partners";
import useWarehouse from "../../composables/warehouse";


export default {
    components: {NavBar},
    setup() {
        const { errors, storeSale } = useSales()
        const { partners, getPartners } = usePartners()
        const { warehouseItems, getWarehouseItems } = useWarehouse()
        const showModal = ref(false)
        const hideModal = ref(true)
        const partner = ref('')
        const saleItems = ref([])
        const form = reactive({
            'partner': '',
            'total': '',
            'items': [],
        })

        onMounted(async () => {
            await getPartners()
            await getWarehouseItems()
        })

        const saveSale = async () => {
            await storeSale({...form});
        }

        const addSale = (item) => {
            form.items.push(item)
            closeModal()
        }

        const total = () => {
            let total = 0
            saleItems.value.map((data) => {
                total = total + data.price
            })
            return total
        }

        const removeItem = (i) => {
            saleItems.value.splice(i,1)
        }

        const setPartner = (event) => {
            partner.value = event.target.value
            console.log(partner.value)
        }

        const openModal = () => {
            showModal.value = !showModal.value
        }

        const closeModal = () => {
            showModal.value = !hideModal.value
        }

        return {
            form,
            errors,
            partners,
            warehouseItems,
            showModal,
            hideModal,
            saleItems,
            saveSale,
            openModal,
            closeModal,
            total,
            addSale,
            removeItem,
            setPartner,
        }
    }
}
</script>
