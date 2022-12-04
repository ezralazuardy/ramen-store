<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import DangerButton from "@/Components/DangerButton.vue";
import { defineComponent } from "vue";
import { Link } from "@inertiajs/inertia-vue3";

defineComponent({
    AppLayout,
    PrimaryButton,
    DangerButton,
});

defineProps({
    ramen_stores: Object,
});
</script>

<template>
    <AppLayout title="Ramen Stores">
        <template #header>
            <h2 class="font-semibold text-xl text-white leading-tight">
                Ramen Stores Management
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <Link :href="route('ramens.stores.create')">
                    <PrimaryButton>Add New Ramen Store</PrimaryButton>
                </Link>
                <div
                    class="bg-zinc-800 overflow-hidden shadow-xl sm:rounded-lg mt-8"
                >
                    <div class="flex flex-col">
                        <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
                            <div
                                class="inline-block min-w-full sm:px-6 lg:px-8"
                            >
                                <div class="overflow-hidden">
                                    <table class="min-w-full">
                                        <thead class="bg-zinc-800 border-b">
                                            <tr>
                                                <th
                                                    scope="col"
                                                    class="text-sm font-bold text-white px-6 py-4 text-left"
                                                >
                                                    #
                                                </th>
                                                <th
                                                    scope="col"
                                                    class="text-sm font-bold text-white px-6 py-4 text-left"
                                                >
                                                    Name
                                                </th>
                                                <th
                                                    scope="col"
                                                    class="text-sm font-bold text-white px-6 py-4 text-left"
                                                >
                                                    Address
                                                </th>
                                                <th
                                                    scope="col"
                                                    class="text-sm font-bold text-white px-6 py-4 text-left"
                                                >
                                                    Action
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr
                                                class="bg-zinc-50 border-b"
                                                v-for="ramen_store in ramen_stores"
                                                :key="ramen_store.id"
                                            >
                                                <td
                                                    class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900"
                                                >
                                                    {{ ramen_store.id }}
                                                </td>
                                                <td
                                                    class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap"
                                                >
                                                    {{ ramen_store.name }}
                                                </td>
                                                <td
                                                    class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap"
                                                >
                                                    {{ ramen_store.address }}
                                                </td>
                                                <td
                                                    class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap"
                                                >
                                                    <Link
                                                        :href="
                                                            route(
                                                                'ramens.stores.edit',
                                                                ramen_store.id
                                                            )
                                                        "
                                                    >
                                                        <PrimaryButton>
                                                            Edit
                                                        </PrimaryButton>
                                                    </Link>
                                                    <Link
                                                        :href="
                                                            route(
                                                                'ramens.stores.destroy',
                                                                ramen_store.id
                                                            )
                                                        "
                                                    >
                                                        <DangerButton
                                                            class="ml-4"
                                                            type="submit"
                                                        >
                                                            Remove
                                                        </DangerButton>
                                                    </Link>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
