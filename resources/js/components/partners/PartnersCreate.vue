<template>
    <nav-bar></nav-bar>

    <div class="flex items-center justify-center p-12">
        <div class="mx-auto w-full max-w-[550px]">
            <div class="mt-2 mb-6 text-sm text-red-600" v-if="errors !== ''">
                {{ errors }}
            </div>

            <form @submit.prevent="savePartner">
                <div class="mb-5">
                    <label for="company" class="mb-3 block font-medium">Company Name</label>
                    <input type="text" name="company" id="company" placeholder="company" v-model="form.company"
                           class="w-full rounded-md border border-black bg-white py-3 px-6 text-base font-medium outline-none"/>
                </div>
                <div class="mb-5">
                    <label for="work_field" class="mb-3 block font-medium">Work Field</label>
                    <input type="text" name="work_field" id="work_field" placeholder="Work Field"
                           v-model="form.work_field"
                           class="w-full rounded-md border border-black bg-white py-3 px-6 text-base font-medium outline-none"/>
                </div>
                <div class="mb-5">
                    <label for="company_size" class="mb-3 block font-medium">Company Size</label>
                    <select name="company_size" id="company_size" v-model="form.company_size"
                            class="w-full rounded-md border border-black bg-white py-3 px-6 text-base font-medium outline-none">
                        <option value="1">Personal</option>
                        <option value="2">Self-Employed</option>
                        <option value="3">Small (m-Sia)</option>
                        <option value="4">Standard (SIA)</option>
                        <option value="5">Big (AS)</option>
                    </select>
                </div>
                <div class="mb-5">
                    <label for="phone" class="mb-3 block font-medium">Phone</label>
                    <input type="text" name="phone" id="phone" placeholder="phone" v-model="form.phone"
                           class="w-full rounded-md border border-black bg-white py-3 px-6 text-base font-medium outline-none"/>
                </div>
                <div class="mb-5">
                    <label for="email" class="mb-3 block font-medium">Email</label>
                    <input type="text" name="email" id="email" placeholder="email" v-model="form.email"
                           class="w-full rounded-md border border-black bg-white py-3 px-6 text-base font-medium outline-none"/>
                </div>
                <div class="mb-5">
                    <label for="address" class="mb-3 block font-medium">Address</label>
                    <input type="text" name="address" id="address" placeholder="address" v-model="form.address"
                           class="w-full rounded-md border border-black bg-white py-3 px-6 text-base font-medium outline-none"/>
                </div>
                <div>
                    <button type="submit" class="hover:text-red-600 rounded-md bg-black text-white py-3 px-8">Save
                    </button>
                </div>
            </form>
        </div>
    </div>
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

        const {errors, storePartner} = usePartners()

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
