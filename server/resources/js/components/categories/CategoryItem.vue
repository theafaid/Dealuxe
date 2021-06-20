<template>
    <tr>
            <td>
                <div class="form-check">
                    <label class="form-check-label">
                        <input class="form-check-input" type="checkbox" value="">
                        <span class="form-check-sign">
                            <span class="check"></span>
                        </span>
                    </label>
                </div>
            </td>
            <td>
                <p class="title" v-text="category.name"></p>
                <p class="text-muted" v-text="">({{category.children.length}}) Children</p>
            </td>
            <td>
                <button
                    class="btn btn-info" data-toggle="modal" data-target=".bd-children-modal-lg"
                    v-if="category.children.length"
                    @click.prevent="selectCategory(category)">
                    View Children
                </button>
            </td>
            <td class="td-actions text-right">
                <button type="button" rel="tooltip" title="" class="btn btn-link" data-original-title="Edit Task">
                    <i class="tim-icons icon-pencil"></i>
                </button>
            </td>
        </tr>
</template>

<script>
    import CategoryChildrenModal from './CategoryChildrenModal.vue'
    import ChildItem from './ChildItem.vue'

    export default {

        components: {
            ChildItem: ChildItem,
            CategoryChildrenModal: CategoryChildrenModal,
        },

        props: {
            category: {
                required: true,
            }
        },

        data() {
            return {

            }
        },

        methods: {
            selectCategory(category) {
                this.$emit('input', category);
            }
        }
    }
</script>

<style scoped>

</style>
