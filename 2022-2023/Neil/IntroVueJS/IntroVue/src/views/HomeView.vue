<!-- eslint-disable @typescript-eslint/no-unused-vars -->
<script setup lang="ts">
import ToggleInput from '../components/ToggleInput.vue';
import Checkbox from '../components/Checkbox.vue';
import { ref } from 'vue';

const isActive = ref(false);
const checked = ref(false);
</script>

<template>
  <ToggleInput v-model="isActive" />
  <Checkbox v-model:checked="checked" text="Se souvenir de moi" />
  <!-- <p>{{ isActive }}</p> -->
</template>
