import {ref} from "vue";
import axios from "axios";
import { useRouter } from "vue-router";

export default function useWarehouse() {
    const warehouseItems = ref([])

    const getWarehouseItems = async () => {
        let response = await axios.get('/api/warehouse')
        warehouseItems.value = response.data.data
    }

    return {
        warehouseItems,
        getWarehouseItems
    }
}
