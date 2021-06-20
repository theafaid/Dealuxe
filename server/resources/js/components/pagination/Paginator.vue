<template>
    <nav v-if="shouldPaginate">
        <ul class="pagination">
            <li class="page-item" v-show="prevUrl" @click="page--">
                <span class="page-link">&laquo;</span>
            </li>
            <li class="page-item" :class="page == index ? 'active' : ''" v-for="index in metaData.last_page" @click="page=index">
                <span class="page-link" v-text="index"></span>
            </li>
            <li class="page-item" v-show="nextUrl" @click="page++">
                <span class="page-link">&raquo;</span>
            </li>
        </ul>
    </nav>
</template>

<script>
    export default {
        props: ['metaData'],

        data() {
            return {
                page: 1,
                prevUrl: this.metaData.prev_page_url,
                nextUrl: this.metaData.next_page_url,
            }
        },

        watch: {
            'metaData'(data) {
                this.page = data.current_page;
                this.prevUrl = data.prev;
                this.nextUrl = data.next;
            },

            'page'(page) {
                this.broadcast().updateUrl();
            }
        },

        computed: {
            shouldPaginate() {
                return !! (this.nextUrl || this.prevUrl);
            }
        },

        methods: {
            broadcast() {
                this.$emit('changed', this.page);

                return this;
            },

            updateUrl() {
                history.pushState(null, null, `?page=${this.page}`);
            }
        }
    }
</script>
