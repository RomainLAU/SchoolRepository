<script setup lang="ts">
import { computed, ref, watch } from "vue";

const count = ref(0);

function decrease() {
  count.value -= 1;
}
function increase() {
  count.value++;
}

const double = computed(() => {
  return count.value * 2;
});

const students = ref([
  { id: 1, name: "Luis" },
  { id: 2, name: "Romain" },
  { id: 3, name: "Mika" },
  { id: 4, name: "William" },
]);
</script>

<template>
  <main class="p-16 bg-[#E19ED]">
    <button
      @click="increase"
      class="px-4 h-8 bg-slate-200 border border-gray-300"
    >
      Increase
    </button>
    <button
      @click="decrease"
      class="px-4 h-8 bg-slate-200 border border-gray-300"
    >
      Decrease
    </button>
    <h2>Count: {{ count }}</h2>
    <p :class="[count % 2 === 0 ? 'bg-green-500' : 'bg-red-500']">
      {{ count % 2 === 0 ? "Count is even" : "Count is odd" }}
    </p>
    <h2>Doubled value: {{ double }}</h2>

    <ul>
      <li v-for="student in students" :key="student.id">
        {{ student.name }}
      </li>
    </ul>
  </main>
</template>
