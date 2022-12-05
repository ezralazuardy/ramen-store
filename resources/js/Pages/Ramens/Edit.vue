<script setup>
import { ref } from "vue";
import { useForm } from "@inertiajs/inertia-vue3";
import AppLayout from "@/Layouts/AppLayout.vue";
import ActionMessage from "@/Components/ActionMessage.vue";
import FormSection from "@/Components/FormSection.vue";
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import TextInput from "@/Components/TextInput.vue";

const categoryInput = ref(null);
const storeInput = ref(null);
const nameInput = ref(null);
const stockInput = ref(null);
const priceInput = ref(null);
const category = ref(null);
const store = ref(null);

const form = useForm({
    category: null,
    store: null,
    name: null,
    stock: null,
    price: null,
});

const updateData = (ramen) => {
    form.category = category.value
        ? category.value.id
        : ramen.ramen_category_id;
    form.store = store.value ? store.value.id : ramen.ramen_store_id;
    form.name = ramen.name;
    form.stock = ramen.stock;
    form.price = ramen.price;
    form.put(route("ramens.update", ramen.id), {
        errorBag: "updateData",
        preserveScroll: true,
        onError: () => {
            if (form.errors.category) {
                form.reset("category");
                categoryInput.value.focus();
            }
            if (form.errors.store) {
                form.reset("store");
                storeInput.value.focus();
            }
            if (form.errors.name) {
                form.reset("name");
                nameInput.value.focus();
            }
            if (form.errors.stock) {
                form.reset("stock");
                stockInput.value.focus();
            }
            if (form.errors.price) {
                form.reset("price");
                priceInput.value.focus();
            }
        },
    });
};

const chooseCategory = (ramenCategory) => {
    category.value = ramenCategory;
};

const chooseStore = (cakeStore) => {
    store.value = cakeStore;
};

defineProps({
    ramen_categories: Object,
    ramen_stores: Object,
    ramen: Object,
});
</script>

<template>
    <AppLayout title="Ramens">
        <template #header>
            <h2 class="font-semibold text-xl text-white leading-tight">
                Ramen Management
            </h2>
        </template>

        <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
            <FormSection @submitted="updateData(ramen)">
                <template #title>Edit Ramen</template>

                <template #description> Edit a ramen data. </template>

                <template #form>
                    <div class="col-span-6 sm:col-span-4">
                        <InputLabel for="category" value="Ramen Category" />
                        <div class="dropdown relative mt-2 w-full">
                            <button
                                ref="categoryInput"
                                class="dropdown-toggle w-full px-6 py-3 bg-zinc-800 text-white font-medium text-sm leading-tight capitalize rounded shadow-md hover:bg-zinc-900 hover:shadow-lg focus:bg-zinc-900 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-zinc-800 active:shadow-lg active:text-white transition duration-150 ease-in-out flex items-center whitespace-nowrap"
                                type="button"
                                id="category"
                                data-bs-toggle="dropdown"
                                aria-expanded="false"
                            >
                                {{
                                    category
                                        ? category.name
                                        : ramen.ramen_category_name
                                }}
                                <div class="w-full flex justify-end">
                                    <svg
                                        aria-hidden="true"
                                        focusable="false"
                                        data-prefix="fas"
                                        data-icon="caret-down"
                                        class="w-2 ml-2"
                                        role="img"
                                        xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 320 512"
                                    >
                                        <path
                                            fill="currentColor"
                                            d="M31.3 192h257.3c17.8 0 26.7 21.5 14.1 34.1L174.1 354.8c-7.8 7.8-20.5 7.8-28.3 0L17.2 226.1C4.6 213.5 13.5 192 31.3 192z"
                                        ></path>
                                    </svg>
                                </div>
                            </button>
                            <ul
                                class="dropdown-menu min-w-max absolute w-full bg-white text-base z-50 float-left py-2 list-none text-left rounded-lg shadow-lg mt-1 hidden m-0 bg-clip-padding border-none"
                                aria-labelledby="dropdown_type"
                            >
                                <li
                                    class="dropdown-item text-sm py-2 px-4 font-normal block w-full whitespace-nowrap bg-transparent text-gray-700 hover:bg-gray-100"
                                    v-for="ramen_category in ramen_categories"
                                    @click="chooseCategory(ramen_category)"
                                >
                                    {{ ramen_category.name }}
                                </li>
                            </ul>
                        </div>
                        <InputError
                            :message="form.errors.category"
                            class="mt-2"
                        />
                    </div>
                    <div class="col-span-6 sm:col-span-4">
                        <InputLabel for="store" value="Ramen Store" />
                        <div class="dropdown relative mt-2 w-full">
                            <button
                                ref="storeInput"
                                class="dropdown-toggle w-full px-6 py-3 bg-zinc-800 text-white font-medium text-sm leading-tight capitalize rounded shadow-md hover:bg-zinc-900 hover:shadow-lg focus:bg-zinc-900 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-zinc-800 active:shadow-lg active:text-white transition duration-150 ease-in-out flex items-center whitespace-nowrap"
                                type="button"
                                id="store"
                                data-bs-toggle="dropdown"
                                aria-expanded="false"
                            >
                                {{
                                    store ? store.name : ramen.ramen_store_name
                                }}
                                <div class="w-full flex justify-end">
                                    <svg
                                        aria-hidden="true"
                                        focusable="false"
                                        data-prefix="fas"
                                        data-icon="caret-down"
                                        class="w-2 ml-2"
                                        role="img"
                                        xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 320 512"
                                    >
                                        <path
                                            fill="currentColor"
                                            d="M31.3 192h257.3c17.8 0 26.7 21.5 14.1 34.1L174.1 354.8c-7.8 7.8-20.5 7.8-28.3 0L17.2 226.1C4.6 213.5 13.5 192 31.3 192z"
                                        ></path>
                                    </svg>
                                </div>
                            </button>
                            <ul
                                class="dropdown-menu min-w-max absolute w-full bg-white text-base z-50 float-left py-2 list-none text-left rounded-lg shadow-lg mt-1 hidden m-0 bg-clip-padding border-none"
                                aria-labelledby="dropdown_store"
                            >
                                <li
                                    class="dropdown-item text-sm py-2 px-4 font-normal block w-full whitespace-nowrap bg-transparent text-gray-700 hover:bg-gray-100"
                                    v-for="ramen_store in ramen_stores"
                                    @click="chooseStore(ramen_store)"
                                >
                                    {{ ramen_store.name }}
                                </li>
                            </ul>
                        </div>
                        <InputError :message="form.errors.store" class="mt-2" />
                    </div>
                    <div class="col-span-6 sm:col-span-4">
                        <InputLabel for="name" value="Ramen Name" />
                        <TextInput
                            id="name"
                            ref="nameInput"
                            v-model="ramen.name"
                            type="text"
                            class="mt-1 block w-full"
                        />
                        <InputError :message="form.errors.name" class="mt-2" />
                    </div>
                    <div class="col-span-6 sm:col-span-4">
                        <InputLabel for="stock" value="Ramen Stock" />
                        <TextInput
                            id="stock"
                            ref="stockInput"
                            v-model="ramen.stock"
                            type="number"
                            class="mt-1 block w-full"
                        />
                        <InputError :message="form.errors.stock" class="mt-2" />
                    </div>
                    <div class="col-span-6 sm:col-span-4">
                        <InputLabel for="price" value="Ramen Price" />
                        <TextInput
                            id="price"
                            ref="priceInput"
                            v-model="ramen.price"
                            type="number"
                            class="mt-1 block w-full"
                        />
                        <InputError :message="form.errors.price" class="mt-2" />
                    </div>
                </template>

                <template #actions>
                    <ActionMessage :on="form.recentlySuccessful" class="mr-3">
                        Saved.
                    </ActionMessage>

                    <PrimaryButton
                        :class="{ 'opacity-25': form.processing }"
                        :disabled="form.processing"
                    >
                        Save
                    </PrimaryButton>
                </template>
            </FormSection>
        </div>
    </AppLayout>
</template>
