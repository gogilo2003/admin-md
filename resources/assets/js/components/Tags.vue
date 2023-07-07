<template>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 w-full">
        <div class="card">
            <div class="card-body">
                <div class="mb-3">
                    <label for="" class="form-label">Name</label>
                    <input type="text" class="form-control" v-model="selectedTag.name" aria-describedby="helpId"
                        placeholder="Tag Name">
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">Description</label>
                    <textarea class="form-control" v-model="selectedTag.description" aria-describedby="helpId"
                        placeholder="Tag Description"></textarea>
                </div>
            </div>
            <div class="card-footer">
                <button class="btn btn-primary rounded-pill" type="button" @click="saveTag">
                    <span class="material-icons">save</span> Save</button>
                <button v-if="edit" class="btn btn-outline-warning rounded-pill" type="button" @click="cancelTag">
                    <span class="material-icons">cancel</span> Cancel</button>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <div class="space-y-4 max-h-96 overflow-y-auto">
                    <div class="border border-stone-100 flex justify-between items-center rounded p-3" v-for="tag in tags"
                        :key="tag.id">
                        <div class="">
                            <div class="capitalize font-semibold font-serif">{{ tag.name }}</div>
                            <div class="text-md">{{ tag.description }}</div>
                        </div>
                        <div class="tasks">
                            <button class="btn btn-primary btn-link btn-fab" @click="editTag(tag)">
                                <span class="material-icons">edit</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { ref, onMounted, reactive } from 'vue'

const tags = ref([]);
const selectedTag = ref({
    id: null,
    name: "",
    description: ""
})

const edit = ref(false)
const saving = ref(false)

const editTag = (tag) => {
    selectedTag.value = {
        id: tag.id,
        name: tag.name,
        description: tag.description
    }
    edit.value = true
}

const cancelTag = () => {
    selectedTag.value = {
        id: null,
        name: "",
        description: ""
    }
    edit.value = false
}

const saveTag = () => {
    saving.value = true
    if (selectedTag.value.name.length > 0) {

        if (edit.value) {
            axios.patch(`/api/admin/tags/${selectedTag.value.id}`, {
                name: selectedTag.value.name,
                description: selectedTag.value.description
            }).then(response => {
                tags.value = tags.value.map(item => item.id == response.data.tag.id ? response.data.tag : item)
                selectedTag.value.id = null
                selectedTag.value.name = ""
                selectedTag.value.description = ""

                edit.value = false
                saving.value = false
            }).then(error => {
                saving.value = false
            })
        } else {
            axios.post(`/api/admin/tags`, {
                name: selectedTag.value.name,
                description: selectedTag.value.description
            }).then(response => {

                tags.value = [response.data.tag, ...tags.value]

                selectedTag.value.id = null
                selectedTag.value.name = ""
                selectedTag.value.description = ""

                edit.value = false
                saving.value = false
            }).catch(error => {
                saving.value = false
            })
        }
    }
}

onMounted(() => {
    let access_token = localStorage.getItem('admin_access_token');
    axios.defaults.headers.common['Authorization'] = `Bearer ${access_token}`
    axios.get(`/api/admin/tags`, { api_token: window.Laravel.apiToken }).then(response => {
        tags.value = response.data.data
    }).catch(error => {
        console.log(error);
    })
})
</script>
