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
        <template v-for="(itemCart, index) in listCart" :key="itemCart.id">
            <tr class="border-b">
                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900"> {{ index + 1}} </td>
                <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                    {{ itemCart.item_name }}
                </td>
                <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                    {{ itemCart.unit_price }}
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
                        {{ index + 1 }}. - {{ item.item }} <button @click="addCart(item)" class="border-black border p-2"> Add </button>
                    </li>
                </template>
            </ul>
            <button @click="closeModal()">Cancel</button>
        </div>
    </div>

</template>

<script>
import {onMounted, ref} from "vue";
import NavBar from "../main/nav-bar.vue";
import usePartners from "../../composables/partners";
import useWarehouse from "../../composables/warehouse";
import useSales from "../../composables/sales";
import router from "../../router";

export default {
    components: {NavBar},
    setup() {
        const {partners, getPartners} = usePartners()
        const {warehouseItems, getWarehouseItems} = useWarehouse()
        const { errors, storeSale } = useSales()
        const showModal = ref(false)
        const hideModal = ref(true)
        const partner = ref('')
        let listCart = ref([])

        onMounted(async () => {
            await getPartners()
            await getWarehouseItems()
        })

        const saveSale = async () => {
            if (listCart.value.length >= 1){
                let finalPrice = 0
                finalPrice = total()

                const formData = new FormData()
                formData.append('sale_items', listCart.value)
                formData.append('partner_id', partner.value)
                formData.append('total', finalPrice.value)

                console.log(formData.values())

                await axios.post("/api/add_sale", formData)
                listCart.value = []
                await router.push({name: 'partners.index'})
            }
        }

        const setPartner = (event) => {
            partner.value = event.target.value
        }
        const openModal = () => {
            showModal.value = !showModal.value
        }
        const closeModal = () => {
            showModal.value = !hideModal.value
        }
        const addCart = (item) => {
            console.log(item)
            const itemCart = {
                id: item.id,
                item_name: item.item,
                item_type: item.type,
                unit_price: item.price,
            }
            listCart.value.push(itemCart)
            closeModal()
        }
        const total = () => {
            let total = 0
            listCart.value.map((data) => {
                total = total + data.unit_price
            })
            return total
        }
        const removeItem = (i) => {
            listCart.value.splice(i,1)
        }

        return {
            partners,
            listCart,
            warehouseItems,
            showModal,
            hideModal,
            errors,
            openModal,
            closeModal,
            total,
            addCart,
            removeItem,
            saveSale,
            setPartner
        }
    }
}
</script>
