import {ref} from "vue";
import axios from "axios";
import { useRouter } from "vue-router";

export default function usePartners() {
    const partners = ref([])
    const partner = ref([])
    const router = useRouter()
    const errors = ref('')

    const getPartners = async () => {
        let response = await axios.get('/api/partners')
        partners.value = response.data.data;
    }

    const getPartner = async (id) => {
        let response = await axios.get('/api/partners/' + id)
        partner.value = response.data.data;
    }

    const storePartner = async (data) => {
        errors.value = ''
        try {
            await axios.post('/api/partners/', data)
            await router.push({name: 'partners.index'})
        } catch (e) {
            if (e.response.status === 422) {
                for (const key in e.response.data.errors) {
                    errors.value += e.response.data.errors[key][0] + ' ';
                }
            }
        }
    }

    const updatePartner = async (id) => {
        errors.value = ''
        try {
            await axios.put('/api/partners/' + id, partner.value)
            await router.push({name: 'partners.index'})
        } catch (e) {
            if (e.response.status === 422) {
                for (const key in e.response.data.errors) {
                    errors.value += e.response.data.errors[key][0] + ' ';
                }
            }
        }
    }

    const destroyPartner = async (id) => {
        await axios.delete('/api/partners/' + id)
    }

    return {
        partners,
        partner,
        errors,
        getPartners,
        getPartner,
        destroyPartner,
        storePartner,
        updatePartner
    }
}
