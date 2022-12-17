<script setup lang="ts">
const props = defineProps<{
  modelValue: boolean;
}>();

const emit = defineEmits(['update:modelValue']);

function onToggle() {
  emit('update:modelValue', !props.modelValue);
}
</script>

<template>
  <label
    class="w-10 h-5 border border-black flex rounded-xl items-center px-0.5"
  >
    <div
      class="w-0 transition-all duration-300 ease-in-ease-out"
      :class="[modelValue ? 'grow' : 'grow-0']"
    ></div>
    <div class="bg-black w-4 h-4 rounded-full"></div>
    <input type="checkbox" :value="modelValue" @input="onToggle" hidden
  /></label>
</template>
