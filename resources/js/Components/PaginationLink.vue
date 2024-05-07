<script setup>
import { usePage, Link } from '@inertiajs/vue3';
import {computed} from "vue";

const page = usePage();

console.log('page', page.props)

const links = computed(() => {
    return page.props.table.links || []
})

const total = computed(() => {
    return page.props.table.total || 0
})

const from = computed(() => {
    return page.props.table.from || 0
})

const to = computed(() => {
    return page.props.table.to || 0
})
</script>

<template>
    <div
        class="flex items-center justify-between px-4 py-3 mt-5 bg-white border-gray-200 sm:px-6"
    >
        <div class="flex justify-between flex-1 sm:hidden">
            <a
                href="#"
                class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md hover:bg-gray-50"
                >Previous</a
            >
            <a
                href="#"
                class="relative inline-flex items-center px-4 py-2 ml-3 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md hover:bg-gray-50"
                >Next</a
            >
        </div>
        <div
            class="hidden sm:flex sm:flex-1 sm:items-center sm:justify-between"
        >
            <div>
                <p class="text-sm text-gray-700">
                    Showing
                    <span class="font-medium">{{ from }}</span>
                    to
                    <span class="font-medium">{{ to }}</span>
                    of
                    <span class="font-medium">{{ total }}</span>
                    results
                </p>
            </div>
            <div>
                <nav
                    class="inline-flex -space-x-px rounded-md shadow-sm isolate"
                    aria-label="Pagination"
                >
                    <Link
                        v-for=" (link, index) in links" 
                        :key="index" 
                        :href="link.url || '#'"
                        class="relative inline-flex items-center px-4 py-2 text-sm font-semibold"
                        :class="{
                            'z-10 text-white bg-indigo-600 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600': link.active,
                            'text-gray-900 ring-1 ring-inset ring-gray-300 hover:bg-gray-50 focus:z-20 focus:outline-offset-0': !link.active,
                            'cursor-not-allowed opacity-50 pointer-events-none': !link.url,
                            'rounded-l-md': index === 0,
                            'rounded-r-md': index === links.length - 1,
                        }"
                        v-html="link.label"
                    />
                </nav>
            </div>
        </div>
    </div>
</template>
