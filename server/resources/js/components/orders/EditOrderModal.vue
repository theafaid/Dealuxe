<template>
    <div
            id="editOrderModal"
            class="modal fade bd-edit-order-modal-lg"
            tabindex="-1"
            role="dialog"
            aria-labelledby="myLargeModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="title">{{trans('admin.edit_order', {ordercode: order.code, username: order.user.name})}}</h5>
                        </div>
                        <div class="card-body">
                            <form @submit.prevent="edit" @keydown="form.onKeydown($event)">
                                <div class="row">
                                    <div class="col-md-12 pr-md-1">
                                        <div class="form-group">
                                            <label v-text="trans('admin.status')"></label>
                                            <select
                                                v-model="form.status"
                                                class="form-control"
                                                name="status"
                                                :class="{ 'is-invalid': form.errors.has('status') }">
                                                <option
                                                    v-for="(status, index) in statuses"
                                                    :value="status"
                                                    :key="index"
                                                    v-text="trans('admin.order_statuses.' + status)"></option>
                                            </select>
                                            <has-error :form="form" field="status"></has-error>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-fill btn-primary" v-text="trans('admin.edit')"></button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</template>

<script>
    export default {
        props: ['order'],

        data() {
            return {
                form: new Form({
                    status: this.order.status
                }),

                statuses: ['pending', 'processing', 'payment_failed', 'completed', 'delivering']
            }
        },

        computed: {
            changed() {
                return this.order.status != this.form.status;
            },

            canEdit() {
                return  this.changed && this.statuses.includes(this.form.status);
            }
        },

        methods: {
            edit() {
                if(! this.changed) {
                    this.hideModal();
                } else {
                    this.canEdit ? this.submit() : null;
                }
            },

            submit() {
                this.form.patch(`/dashboard/orders/${this.order.code}`)
                    .then(response => {
                        this.$emit('updated', response.data);
                        this.hideModal();
                    });
            },

            hideModal() {
                $('#editOrderModal').modal('hide');
            }
        }
    }
</script>
