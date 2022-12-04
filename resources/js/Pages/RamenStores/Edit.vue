<script setup>
import { ref, onMounted } from "vue";
import { useForm } from "@inertiajs/inertia-vue3";
import AppLayout from "@/Layouts/AppLayout.vue";
import ActionMessage from "@/Components/ActionMessage.vue";
import FormSection from "@/Components/FormSection.vue";
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import TextInput from "@/Components/TextInput.vue";

const nameInput = ref(null);

const form = useForm({
    name: null,
});

const updateData = (ramenStore) => {
    form.name = ramenStore.name;
    form.put(route("ramens.stores.update", ramenStore.id), {
        errorBag: "updateData",
        preserveScroll: true,
        onError: () => {
            if (form.errors.name) {
                form.reset("name");
                nameInput.value.focus();
            }
        },
    });
};

defineProps({
    ramen_store: Object,
});
</script>

<template>
    <AppLayout title="Ramen Stores">
        <template #header>
            <h2 class="font-semibold text-xl text-white leading-tight">
                Ramen Stores Management
            </h2>
        </template>

        <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
            <FormSection @submitted="updateData(ramen_store)">
                <template #title>Edit Ramen Store</template>

                <template #description> Edit a ramen store data. </template>

                <template #form>
                    <div class="col-span-6 sm:col-span-4">
                        <InputLabel for="name" value="Ramen Store Name" />
                        <TextInput
                            id="name"
                            ref="nameInput"
                            type="text"
                            class="mt-1 block w-full"
                            autocomplete="current-password"
                            v-model="ramen_store.name"
                        />
                        <InputError :message="form.errors.name" class="mt-2" />
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
