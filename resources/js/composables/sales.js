import {ref} from "vue";
import axios from "axios";
import { useRouter } from "vue-router";


export default function useSales() {
    const router = useRouter()
    const sales = ref([])
    const errors = ref('')

    const getSales = async () => {
        let response = await axios.get('/api/sales')
        sales.value = response.data.data
    }

    const storeSale = async (data) => {
        errors.value = ''
        try {
            await axios.post('/api/sales/', data)
            //console.log(await axios.post('/api/sales/', data))
            await router.push({name: 'sales.index'})
        } catch (e) {
            if (e.response.status === 422) {
                for (const key in e.response.data.errors) {
                    errors.value += e.response.data.errors[key][0] + ' ';
                }
            }
        }
    }

    const destroySale = async (id) => {
        await axios.delete('/api/sales/' + id)
    }



    return {
        sales,
        errors,
        getSales,
        storeSale,
        destroySale,
    }
}
