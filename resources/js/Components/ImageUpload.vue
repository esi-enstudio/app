<script setup>
import {ref} from "vue";

const emit = defineEmits(['image']);
const props = defineProps({ userAvatar : String });
const currentAvatar = props.userAvatar ? `/storage/${props.userAvatar}` : null;
const preview = ref(currentAvatar);
const oversizedImage = ref(false);
const resetBtn = ref(false);

const selectImage = (e) => {
    preview.value = URL.createObjectURL(e.target.files[0]);
    oversizedImage.value = e.target.files[0].size > 1000000;
    resetBtn.value = true;
    emit('image', e.target.files[0]);
}

const resetAvatar = () => {
    resetBtn.value = false;
    preview.value = currentAvatar;
    oversizedImage.value = false;
    emit('image', null);
}
</script>

<template>
    <div class="mb-4">
        <figure
            class="h-[140px] mx-auto max-w-[15rem] bg-slate-100 rounded-lg border-green-400 border-2"
            :class="{'!border-red-500' : oversizedImage}"
        >
            <label for="image" class="cursor-pointer relative">
                <img class="h-full max-w-full rounded-lg mx-auto" :src="preview ?? 'https://static.thenounproject.com/png/1077596-200.png'" alt="image description">

                <button
                    class="absolute top-2 right-2 bg-white/75 w-8 h-8 rounded-full gird place-items-center text-slate-700"
                    v-if="resetBtn"
                    @click.prevent="resetAvatar"
                    type="button"
                >
                    <i class="fa-solid fa-rotate-left"></i>
                </button>
            </label>

            <figcaption
                class="mt-2 text-sm text-center text-gray-500 dark:text-gray-400"
                :class="{'!text-red-500' : oversizedImage}"
            >
                {{ oversizedImage ? 'The selected image exceeds 1Mb' : 'Image (Max size 1Mb)'}}
            </figcaption>
        </figure>

        <input @input="selectImage" type="file" name="image" id="image" class="hidden">
    </div>
</template>

<style lang="scss" scoped>

</style>
