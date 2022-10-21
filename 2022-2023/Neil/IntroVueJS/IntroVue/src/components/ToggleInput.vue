<script setup lang="ts">
const props = defineProps<{
  modelValue: boolean;
}>();

const emit = defineEmits(["update:modelValue"]);

function onToggle() {
  emit("update:modelValue", !props.modelValue);
}
</script>

<template>
  <label class="w-10 h-5 border border-black flex">
    <div
      class="w-0 transition-all duration-100 ease-in-ease-out"
      :style="[modelValue ? 'flex-grow: 1' : 'flex-grow: 0']"
    ></div>
    <div class="bg-black w-5 h-5 rounded-full"></div>
    <input type="checkbox" :value="modelValue" @input="onToggle" hidden
  /></label>
</template>
