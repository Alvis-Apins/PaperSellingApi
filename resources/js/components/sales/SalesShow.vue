<template>
    <nav-bar></nav-bar>

    <section class="py-20 bg-black">
        <div class="max-w-5xl mx-auto py-16 bg-white">
            <article class="overflow-hidden">
                <div class="bg-[white] rounded-b-md">
                    <div class="p-9">
                        <div class="text-slate-700">
                            <p class="text-xl tracking-tight uppercase font-body">
                                {{ sale.partner.company }}
                            </p>
                        </div>
                    </div>
                    <div class="p-9">
                        <div class="flex w-full">
                            <div class="grid grid-cols-4 gap-12">
                                <div class="text-sm font-light text-slate-500">
                                    <p class="text-sm font-normal text-slate-700">
                                        Issued: {{ dateTime(sale.created_at) }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="p-9">
                        <div class="flex flex-col mx-0 mt-8">
                            <table class="min-w-full divide-y divide-slate-500">
                                <thead>
                                <tr>
                                    <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm font-normal text-slate-700 sm:pl-6 md:pl-0">
                                        #
                                    </th>
                                    <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm font-normal text-slate-700 sm:pl-6 md:pl-0">
                                        Description
                                    </th>
                                    <th scope="col" class="hidden py-3.5 px-3 text-left text-sm font-normal text-slate-700 sm:table-cell">
                                        Type
                                    </th>
                                    <th scope="col" class="hidden py-3.5 px-3 text-right text-sm font-normal text-slate-700 sm:table-cell">
                                        Price
                                    </th>
                                </tr>
                                </thead>
                                <tbody>
                                <template v-for="(item,index) in sale.warehouse" :key="sale.id">
                                    <tr class="border-b border-slate-200">
                                        <td class="py-4 pl-4 pr-3 text-sm sm:pl-6 md:pl-0">
                                            <div class="font-medium text-slate-700"> {{ index + 1 }} </div>
                                        </td>
                                        <td class="hidden px-3 py-4 text-sm text-left text-slate-500 sm:table-cell">
                                            {{ item.item }}
                                        </td>
                                        <td class="hidden px-3 py-4 text-sm text-left text-slate-500 sm:table-cell">
                                            {{ item.type }}
                                        </td>
                                        <td class="py-4 pl-3 pr-4 text-sm text-right text-slate-500 sm:pr-6 md:pr-0">
                                            € {{ item.price }}
                                        </td>
                                    </tr>
                                </template>
                                </tbody>
                                <tfoot>
                                <tr>
                                    <th scope="row" colspan="3" class="hidden pt-4 pl-6 pr-3 text-sm font-normal text-right text-slate-700 sm:table-cell md:pl-0">
                                        Total
                                    </th>
                                    <td class="pt-4 pl-3 pr-4 text-sm font-normal text-right text-slate-700 sm:pr-6 md:pr-0">
                                        $ {{ total(sale.warehouse) }}
                                    </td>
                                </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </article>
        </div>
    </section>
</template>

<script>
import NavBar from "../main/nav-bar.vue";
import useSales from "../../composables/sales";
import {onMounted} from "vue";
import moment from 'moment';

export default {
    components: {NavBar},
    props: {
        id:{
            required: true,
            type: String
        }
    },
    setup(props) {
        const { sale, getSale } = useSales()

        onMounted(getSale(props.id))

        const dateTime = (value) => {
            return moment(value).format("YYYY. MMMM - D.");
        }

        const total = (data) => {
            let total = 0
            data.map((data) => {
                total = total + data.price
            })
            return total
        }

        return {
            sale,
            dateTime,
            total
        }
    }
}
</script>
