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
    ramen_categories: Object,
});
</script>

<template>
    <AppLayout title="Ramen Categories">
        <template #header>
            <h2 class="font-semibold text-xl text-white leading-tight">
                Ramen Categories Management
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <Link :href="route('ramens.categories.create')">
                    <PrimaryButton>Add New Ramen Category</PrimaryButton>
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
                                                    Action
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr
                                                class="bg-zinc-50 border-b"
                                                v-for="ramen_category in ramen_categories"
                                                :key="ramen_category.id"
                                            >
                                                <td
                                                    class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900"
                                                >
                                                    {{ ramen_category.id }}
                                                </td>
                                                <td
                                                    class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap"
                                                >
                                                    {{ ramen_category.name }}
                                                </td>
                                                <td
                                                    class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap"
                                                >
                                                    <Link
                                                        :href="
                                                            route(
                                                                'ramens.categories.edit',
                                                                ramen_category.id
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
                                                                'ramens.categories.destroy',
                                                                ramen_category.id
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
