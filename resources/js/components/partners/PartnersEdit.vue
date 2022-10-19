<template>
    <nav-bar></nav-bar>

    <div class="mt-2 mb-6 text-sm text-red-600" v-if="errors !== ''">
        {{ errors }}
    </div>

    <form class="space-y-6" @submit.prevent="savePartner">
        <div>
            <input type="text" name="company" id="company" placeholder="company" v-model="partner.company">
        </div>
        <div>
            <input type="text" name="work_field" id="work_field" placeholder="work field" v-model="partner.work_field">
        </div>
        <div>
            <select name="company_size" id="company_size" v-model="partner.company_size">
                <option value="1">Personal</option>
                <option value="2">Self-Employed</option>
                <option value="3">Small (m-Sia)</option>
                <option value="4">Standard (SIA)</option>
                <option value="5">Big (AS)</option>
            </select>
        </div>
        <div><input type="text" name="phone" id="phone" placeholder="phone" v-model="partner.phone"></div>
        <div><input type="text" name="email" id="email" placeholder="email" v-model="partner.email"></div>
        <div><input type="text" name="address" id="address" placeholder="address" v-model="partner.address"></div>
        <div><button type="submit" class="border border-black p-2"> Save </button></div>
    </form>

</template>

<script>
import usePartners from "../../composables/partners";
import {onMounted} from "vue";
import NavBar from "../main/nav-bar.vue";

export default {
    components: {NavBar},
    props: {
        id:{
            required: true,
            type: String
        }
    },
    setup(props) {
        const { errors, partner, getPartner,updatePartner } = usePartners()

        onMounted(getPartner(props.id))

        const savePartner = async () => {
            await updatePartner(props.id)
        }

        return {
            errors,
            partner,
            savePartner
        }
    }
}


</script>
