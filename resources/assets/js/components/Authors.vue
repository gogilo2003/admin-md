<template>
    <div>
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-primary rounded-pill" @click="newAuthor">
            New Author
        </button>
        <EasyDataTable :headers="headers" :items="items" theme-color="#7cb342" table-class-name="customize-table"
            show-index>
            <template #item-name="{ avatar, name }">
                <div>
                    <img class="avator" :src="avatar" alt="">
                    <span>{{ name }}</span>
                </div>
            </template>
            <template #item-phone="{ phone }">{{ phone }}</template>
            <template #item-email="{ email }">{{ email }}</template>
            <template #item-tasks="{ id, name, phone, email, avatar, details }">
                <button @click="editAuthor({ id, name, phone, email, avatar, details })" type="button"
                    class="btn btn-fab btn-link btn-primary"><i class="material-icons">edit</i></button>
                <button @click="deleteAuthor(id)" type="button" class="btn btn-fab btn-link btn-danger"><i
                        class="material-icons">delete</i></button>
            </template>
        </EasyDataTable>

        <!-- Modal -->
        <div class="modal fade" id="authorModalDialog" tabindex="-1" role="dialog" aria-labelledby="authorModalDialogHelp"
            aria-hidden="true" data-backdrop="static">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="card">
                        <div class="modal-header card-header">
                            <h5 class="modal-title">{{ title }}</h5>
                            <button type="button" class="btn-close btn btn-link btn-fab btn-sm" @click="close"
                                aria-label="Close"><i class="material-icons">close</i></button>
                        </div>
                        <div class="modal-body card-body">
                            <div class="row no-gutter">
                                <div class="col-md-4">
                                    <section class="cropper-area">
                                        <div class="img-cropper">
                                            <vue-cropper ref="cropper" :aspect-ratio="1 / 1" :src="imgSrc"
                                                preview=".preview" />
                                        </div>
                                    </section>
                                    <div>
                                        <input ref="input" type="file" name="image" accept="image/*" @change="setImage"
                                            class="my-custom-file-input" id="customFile" />

                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <label for="nameInput" class="form-label">Name</label>
                                        <input type="text" class="form-control" name="nameInput" id="nameInput"
                                            aria-describedby="helpId" v-model="authorName">
                                    </div>
                                    <div class="form-group">
                                        <label for="phoneInput" class="form-label">Phone</label>
                                        <input type="tel" class="form-control" name="phoneInput" id="phoneInput"
                                            aria-describedby="helpId" v-model="authorPhone">
                                    </div>
                                    <div class="form-group">
                                        <label for="emailInput" class="form-label">Email</label>
                                        <input type="email" class="form-control" name="emailInput" id="emailInput"
                                            aria-describedby="helpId" v-model="authorEmail">
                                    </div>
                                    <div class="form-group">
                                        <label for="detailsInput" class="form-label">Details</label>
                                        <textarea class="form-control" name="detailsInput" id="detailsInput" rows="3"
                                            v-model="authorDetails"></textarea>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="modal-footer card-footer">
                            <button type="button" class="btn btn-primary rounded-pill" @click="saveAuthor"><i
                                    class="material-icons">save</i> Save</button>
                            <button type="button" class="btn btn-outline-secondary rounded-pill" @click="close"><i
                                    class="material-icons">close</i> Close</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</template>

<script setup>
import axios from "axios";
import { ref, onMounted } from "vue"
import VueCropper from 'vue-cropperjs';
import 'cropperjs/dist/cropper.css';

const headers = ref([
    { text: "NAME", value: "name" },
    { text: "PHONE", value: "phone" },
    { text: "EMAIL", value: "email" },
    { text: "", value: "tasks" },
]);

const items = ref([]);

const title = ref("New Author")
const edit = ref(false)

const authorId = ref("")
const authorName = ref("")
const authorPhone = ref("")
const authorEmail = ref("")
const authorDetails = ref("")
const authorAvatar = ref("")

const imgSrc = ref('/vendor/admin/img/avatar.jpg')
const cropImg = ref('')
const cropper = ref('')

const editAuthor = (author) => {
    title.value = "Edit Author"
    edit.value = true

    authorId.value = author.id
    authorName.value = author.name
    authorPhone.value = author.phone
    authorEmail.value = author.email
    authorDetails.value = author.details
    authorAvatar.value = author.avatar
    imgSrc.value = author.avatar
    cropper.value.replace(imgSrc.value)

    $('#authorModalDialog').modal('show')
}

const newAuthor = () => {
    title.value = "New Author"
    edit.value = false
    authorId.value = ""
    authorName.value = ""
    authorPhone.value = ""
    authorEmail.value = ""
    authorDetails.value = ""
    imgSrc.value = '/vendor/admin/img/avatar.jpg'
    cropper.value.reset()
    $('#authorModalDialog').modal('show')
}

const close = () => {
    $('#authorModalDialog').modal('hide')
}

const saveAuthor = () => {


    cropper.value.getCroppedCanvas().toBlob((blob) => {
        // const formData = new FormData();
        let data = new FormData()

        data.append('name', authorName.value)
        data.append('phone', authorPhone.value)
        data.append('email', authorEmail.value)
        data.append('details', authorDetails.value)
        data.append('avatar', blob, 'avatar.png')

        if (edit.value) {
            data.append('_method', 'PATCH');
            axios.post(`/api/admin/authors/${authorId.value}`, data).then(response => {
                if (response.data.success) {
                    items.value[items.value.findIndex(item => item.id == authorId.value)] = response.data.author
                    $.notify({ title: "Author Update", message: "Author updated successfuly", icon: "far fa-check-circle" }, { type: 'success', timer: 5000, width: '360px' })
                    close()
                }
            }).catch(error => {
                $.notify({ title: "Error", message: "An error occured. Please try again", icon: "fas fa-exclamation-circle" }, { type: 'danger', timer: 5000, width: '360px' })
            })
        } else {
            axios.post('/api/admin/authors', data).then(response => {
                if (response.data.success) {
                    items.value.unshift(response.data.author)
                    $.notify({ title: "New Author", message: "Author stored successfuly", icon: "far fa-check-circle" }, { type: 'success', timer: 5000, width: '360px' })
                    close()
                }
            }).catch(error => {
                $.notify({ title: "Error", message: "An error occured. Please try again", icon: "fas fa-exclamation-circle" }, { type: 'danger', timer: 5000, width: '360px' })
            })
        }
    }, 'image/png');

}

const deleteAuthor = (id) => {
    axios.delete(`/api/admin/authors/${id}`).then(response => {
        items.value = items.value.filter(item => item.id != id)
        $.notify({ title: "Delete Author", message: "Author deleted successfuly", icon: "far fa-check-circle" }, { type: 'success', timer: 5000, width: '360px' })
        close()
    }).catch(error => {
        $.notify({ title: "Error", message: "An error occured. Please try again", icon: "fas fa-exclamation-circle" }, { type: 'danger', timer: 5000, width: '360px' })
    })
}

const cropImage = () => {
    // get image data for post processing, e.g. upload or setting image src
    cropImg.value = cropper.value.getCroppedCanvas().toDataURL();
    return cropImg.value
}

const setImage = (e) => {
    const file = e.target.files[0];
    if (file.type.indexOf('image/') === -1) {
        alert('Please select an image file');
        return;
    }
    if (typeof FileReader === 'function') {
        const reader = new FileReader();
        reader.onload = (event) => {
            imgSrc.value = event.target.result;
            // rebuild cropperjs with the updated source
            cropper.value.replace(event.target.result);
        };
        reader.readAsDataURL(file);
    } else {
        alert('Sorry, FileReader API not supported');
    }
}

onMounted(() => {
    let access_token = localStorage.getItem('admin_access_token');
    axios.defaults.headers.common['Authorization'] = `Bearer ${access_token}`
    axios.get('/api/admin/authors').then(response => {
        items.value = response.data.data
    })
})
</script>
<style lang="scss">
.my-custom-file-input {

    &::-ms-browse,
    &::-webkit-file-upload-button {
        background-color: #7cb342;
        color: #fff;
    }
}

.cropper-container {
    width: 100% !important;
}

.btn-close {
    float: right;
    margin-top: -0.5rem;
    margin-right: -0.5rem;
}

.main-panel .header {
    margin: 1rem auto;
}

.customize-table {
    .avator {
        margin: 0.5rem;
        border-radius: 50%;
        box-shadow: 0px 0px 5px rgba($color: #7cb342, $alpha: 0.35);
    }

    --easy-table-border: 0px solid #445269;
    --easy-table-row-border: 1px solid #445269;

    --easy-table-header-font-size: 14px;
    // --easy-table-header-height: 50px;
    --easy-table-header-font-color: #fff;
    --easy-table-header-background-color: #7cb342;

    // --easy-table-header-item-padding: 10px 15px;

    // --easy-table-body-even-row-font-color: #fff;
    // --easy-table-body-even-row-background-color: #4c5d7a;

    // --easy-table-body-row-font-color: #c0c7d2;
    // --easy-table-body-row-background-color: #2d3a4f;
    // --easy-table-body-row-height: 50px;
    --easy-table-body-row-font-size: 14px;

    // --easy-table-body-row-hover-font-color: #2d3a4f;
    // --easy-table-body-row-hover-background-color: #eee;

    // --easy-table-body-item-padding: 10px 15px;

    // --easy-table-footer-background-color: #2d3a4f;
    // --easy-table-footer-font-color: #c0c7d2;
    --easy-table-footer-font-size: 14px;
    // --easy-table-footer-padding: 0px 10px;
    // --easy-table-footer-height: 50px;

    // --easy-table-scrollbar-track-color: #2d3a4f;
    // --easy-table-scrollbar-color: #2d3a4f;
    // --easy-table-scrollbar-thumb-color: #4c5d7a;

    // --easy-table-scrollbar-corner-color: #2d3a4f;

    // --easy-table-loading-mask-background-color: #2d3a4f;
}
</style>
