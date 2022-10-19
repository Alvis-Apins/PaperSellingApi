<template>
    <nav-bar></nav-bar>

    <div class="mt-2 mb-6 text-sm text-red-600" v-if="errors !== ''">
        {{ errors }}
    </div>

    <form class="space-y-6" @submit.prevent="savePartner">
        <div>
            <input type="text" name="company" id="company" placeholder="company" v-model="form.company">
        </div>
        <div>
            <input type="text" name="work_field" id="work_field" placeholder="work field" v-model="form.work_field">
        </div>
        <div>
            <select name="company_size" id="company_size" v-model="form.company_size">
                <option value="1">Personal</option>
                <option value="2">Self-Employed</option>
                <option value="3">Small (m-Sia)</option>
                <option value="4">Standard (SIA)</option>
                <option value="5">Big (AS)</option>
            </select>
        </div>
        <div><input type="text" name="phone" id="phone" placeholder="phone" v-model="form.phone"></div>
        <div><input type="text" name="email" id="email" placeholder="email" v-model="form.email"></div>
        <div><input type="text" name="address" id="address" placeholder="address" v-model="form.address"></div>
        <div><button type="submit" class="border border-black p-2"> Save </button></div>
    </form>
</template>

<script>
import {reactive} from "vue";
import usePartners from "../../composables/partners";
import NavBar from "../main/nav-bar.vue";


export default {
    components: {NavBar},
    setup() {
        const form = reactive({
            'company': '',
            'work_field': '',
            'company_size': '',
            'phone': '',
            'email': '',
            'address': '',
        })

        const { errors, storePartner } = usePartners()

        const savePartner = async () => {
            await storePartner({...form});
        }

        return {
            form,
            errors,
            savePartner
        }
    }
}
</script>
