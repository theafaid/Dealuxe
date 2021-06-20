<template>
    <tr>
        <td>
            <a :href="showUrl" v-text="order.code"></a>
        </td>
        <td v-text="order.status"></td>
        <td v-text="order.subtotal"></td>
        <td v-text="order.total"></td>
        <td v-text="order.created_at"></td>

        <td>
            <div class="dropdown">
                <button type="button" class="btn btn-link dropdown-toggle btn-icon" data-toggle="dropdown">
                    <i class="tim-icons icon-settings-gear-63"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-right text-center" aria-labelledby="dropdownMenuLink">
                    <a class="dropdown-item" :href="showUrl">
                        <i class="fa fa-eye"></i> {{trans('admin.view')}}
                    </a>
                    <a
                        @click.prevent="edit(order)"
                        class="dropdown-item"
                        data-toggle="modal"
                        data-target=".bd-edit-order-modal-lg">
                        <i class="fa fa-edit"></i> {{trans('admin.edit')}}
                    </a>
                </div>
            </div>
        </td>
    </tr>
</template>

<script>
    export default {
        props: ['order'],

        computed: {
            showUrl() {
                return `${location.pathname}/${this.order.code}`;
            },
        },

        methods: {
            edit(order) {
                this.$emit('editing', order);
            }
        }
    }
</script>
