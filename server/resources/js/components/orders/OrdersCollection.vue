<template>
    <div>
        <table class="table tablesorter table-hover" id="">
            <thead class=" text-primary">
            <tr>
                <th v-text="trans('admin.code')"></th>
                <th v-text="trans('admin.status')"></th>
                <th v-text="trans('admin.subtotal')"></th>
                <th v-text="trans('admin.total')"></th>
                <th v-text="trans('admin.created_at')"></th>
                <th v-text="trans('admin.settings')"></th>
            </tr>
            </thead>
            <tbody>
              <single-order v-for="(item, index) in items" :order="item"  :key="index" @editing="selectOrder"></single-order>
            </tbody>
        </table>

        <paginator :metaData="metaData" @changed="fetch"></paginator>

        <edit-order-modal v-if="selectedOrder" :order="selectedOrder" @updated="updated"></edit-order-modal>
    </div>
</template>

<script>
    import SingleOrder from './SingleOrder';
    import EditOrderModal from './EditOrderModal';

    export default {
        components: {
            SingleOrder: SingleOrder,
            EditOrderModal: EditOrderModal,
        },

        data() {
            return {
                items: [],
                metaData: false,
                meta: null,
                selectedOrder: false
            }
        },

        created() {
            this.fetch();
        },

        methods: {
            fetch(page) {
                axios.get(this.url(page))
                    .then(this.refresh);
            },

            refresh({data}) {
                this.items = data.data;
                this.metaData = {...data.meta, ...data.links};
            },

            url(page) {
                if(! page) {
                    let query = location.search.match(/page=(\d+)/);
                    page = query ? query[1] : 1;
                }

                return `${location.pathname}?page=${page}`;
            },

            selectOrder(order) {
                this.selectedOrder = order;
            },

            updated(order) {
                let updatedItem = this.items.find(item => {return item.code == order.code;});
                updatedItem.status = order.status;
            }
        }
    }
</script>
