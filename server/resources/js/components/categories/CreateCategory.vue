<template>
    <div class="d-inline">
        <!-- Large modal -->
        <button
            type="button"
            class="btn btn-primary"
            data-toggle="modal"
            data-target=".bd-create-category-modal-lg"
            @click.prevent="creating=true">
            <i class="tim-icons icon-simple-add"></i>
        </button>

        <div
            id="createCategoryModal"
            class="modal fade bd-create-category-modal-lg"
            tabindex="-1"
            role="dialog"
            aria-labelledby="myLargeModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="title">Create a new category</h5>
                        </div>
                        <div class="card-body">
                            <form @submit.prevent="create" @keydown="form.onKeydown($event)">
                                <div class="row">
                                    <div class="col-md-8 pr-md-1">
                                        <div class="form-group">
                                            <label>Category Name *</label>
                                            <input
                                                type="text"
                                                name="name"
                                                class="form-control"
                                                :class="{ 'is-invalid': form.errors.has('name') }"
                                                placeholder="Enter category name"
                                                v-model="form.name">
                                            <has-error :form="form" field="name"></has-error>
                                        </div>
                                    </div>
                                    <div class="col-md-4 px-md-1">
                                        <div class="form-group">
                                            <label>Category Order</label>
                                            <input
                                                type="number"
                                                name="order"
                                                class="form-control"
                                                :class="{ 'is-invalid': form.errors.has('order') }"
                                                placeholder="order"
                                                v-model="form.order">
                                            <has-error :form="form" field="order"></has-error>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-8 pr-md-1">
                                        <div class="form-group" v-if="parents.length">
                                            <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                                <label
                                                    class="btn btn-sm btn-primary btn-simple"
                                                    :class="! isChild ? 'active' : ''" id="0" @click="isChild=false">
                                                    <input type="radio" name="options" checked="">
                                                    <span class="d-none d-sm-block d-md-block d-lg-block d-xl-block">Parent</span>
                                                    <span class="d-block d-sm-none">
                                                  <i class="tim-icons icon-single-02"></i>
                                                </span>
                                                </label>
                                                <label class="btn btn-sm btn-primary btn-simple"
                                                       :class="isChild ? 'active' : ''" id="1" @click="isChild=true">
                                                    <input type="radio" class="d-none d-sm-none" name="options">
                                                    <span class="d-none d-sm-block d-md-block d-lg-block d-xl-block">Child</span>
                                                    <span class="d-block d-sm-none">
                                                  <i class="tim-icons icon-gift-2"></i>
                                                </span>
                                                </label>
                                            </div>
                                        </div>
                                        <div v-if="! parents.length">
                                            <div class="alert alert-info">No parents found</div>
                                        </div>
                                        <div class="form-group" v-else-if="this.isChild">
                                            <label>Parent</label>
                                            <select
                                                class="form-control"
                                                :class="{ 'is-invalid': form.errors.has('username') }"
                                                name="parent_id"
                                                v-model="form.parent_id">
                                                <option
                                                    v-for="parent in parents"
                                                    v-text="parent.name"
                                                    :value="parent.id">
                                                </option>
                                            </select>
                                            <has-error :form="form" field="parent_id"></has-error>
                                        </div>
                                    </div>
                                    <div class="col-md-12 pr-md-1">
                                        <label>Category Image</label>
                                        <div class="form-group">
                                            <image-uploader
                                                class="form-control"
                                                :preview="true"
                                                :className="['image', { 'fileinput--loaded': hasImage }]"
                                                :debug="1"
                                                :autoRotate="true"
                                                :maxWidth="360"
                                                :maxHeight="270"
                                                outputFormat="string"
                                                @input="setImage"
                                                @onUpload="startImageResize"
                                                @onComplete="endImageResize"
                                            >
                                                <label for="fileInput" slot="upload-label">
                                                    <figure>
                                                        <svg
                                                            xmlns="http://www.w3.org/2000/svg"
                                                            width="32"
                                                            height="32"
                                                            viewBox="0 0 32 32"
                                                        >
                                                            <path
                                                                class="path1"
                                                                d="M9.5 19c0 3.59 2.91 6.5 6.5 6.5s6.5-2.91 6.5-6.5-2.91-6.5-6.5-6.5-6.5 2.91-6.5 6.5zM30 8h-7c-0.5-2-1-4-3-4h-8c-2 0-2.5 2-3 4h-7c-1.1 0-2 0.9-2 2v18c0 1.1 0.9 2 2 2h28c1.1 0 2-0.9 2-2v-18c0-1.1-0.9-2-2-2zM16 27.875c-4.902 0-8.875-3.973-8.875-8.875s3.973-8.875 8.875-8.875c4.902 0 8.875 3.973 8.875 8.875s-3.973 8.875-8.875 8.875zM30 14h-4v-2h4v2z"
                                                            ></path>
                                                        </svg>
                                                    </figure>
                                                </label>
                                            </image-uploader>
                                            <v-im
                                            <has-error :form="form" field="image"></has-error>
                                        </div>
                                    </div>
                                </div>

                                <div class="card-footer">
                                    <button type="submit" class="btn btn-fill btn-primary">Save</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import {Form} from 'vform';

    export default {
        props: {
            parents: [],
        },

        data () {
            return {
                hasImage: false,
                creating: false,
                isChild:  false,
                form: new Form({
                    name: '',
                    parent_id: '',
                    order: '',
                    image: ''
                })
            }
        },

        watch: {
          'isChild'(value) {
              if (!value) this.form.parent_id = null;
          }
        },

        methods: {
            setImage: function(output) {
                this.form.image = output;
            },

            testo(output) {
                this.form.image = output
            },

            create() {
                this.form.post('/dashboard/categories')
                    .then(response => {
                       this.$emit('created', {
                           category: response.data.data,
                           parentId: this.form.parent_id
                       });
                        $('#createCategoryModal').modal('hide');
                    })
                    .catch(error => {
                    });
            }
        }
    }
</script>

