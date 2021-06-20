<template>

    <div class="card card-tasks">
        <div class="card-header ">
            <h6 class="title d-inline">Categories</h6>
            <div class="dropdown">
                <create-category :parents="localCategories" @created="created"></create-category>
                <button type="button" class="btn btn-link dropdown-toggle btn-icon" data-toggle="dropdown">
                    <i class="tim-icons icon-settings-gear-63"></i>
                </button>
            </div>
        </div>
        <div class="card-body ">
            <div class="table-full-width table-responsive ps ps--active-y">
                <table class="table">
                    <tbody>
                    <category-item
                        v-for="category in localCategories"
                        v-model="selectedCategory"
                        :category="category"
                        :key="category.id">
                    </category-item>
                    </tbody>
                </table>
                <category-children-modal
                    v-if="selectedCategory"
                    :children="selectedCategory.children">
                </category-children-modal>
                <div class="ps__rail-x" style="left: 0px; bottom: 0px;"><div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;"></div></div><div class="ps__rail-y" style="top: 0px; height: 410px; right: 0px;"><div class="ps__thumb-y" tabindex="0" style="top: 0px; height: 390px;"></div></div></div>
        </div>
    </div>
</template>

<script>
    import CategoryItem from "./CategoryItem";
    import CreateCategory from './CreateCategory';
    import CategoryChildrenModal from "./CategoryChildrenModal";

    export default {

        components: {
            CategoryItem: CategoryItem,
            CategoryChildrenModal: CategoryChildrenModal,
            CreateCategory: CreateCategory,
        },

        props: {
            categories: {
                required: true,
            }
        },

        data() {
            return {
                localCategories: this.categories,
                selectedCategory: null,
            }
        },

        computed: {
            empty () {
                return ! this.localCategories.length;
            }
        },

        methods: {
            created({category, parentId}){
                if(! parentId) {
                    this.localCategories.unshift(category);
                } else {

                    let parent = this.localCategories.find(c => c.id == parentId);

                    parent.children.push(category);
                }
            }
        }
    }
</script>

<style scoped>

</style>
