<template>
    <div class="tags">
        <div class="tag" v-for="tag in tags" :key="tag.id">{{ tag.name }}</div>
        <div class="card">
            <div class="card-body">
                <div class="mb-3">
                    <label for="" class="form-label">Name</label>
                    <input type="text" class="form-control" v-model="tagName" aria-describedby="helpId"
                        placeholder="Tag Name">
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">Description</label>
                    <input type="text" class="form-control" v-model="tagDescription" aria-describedby="helpId"
                        placeholder="Tag Description">
                </div>
            </div>
            <div class="card-footer">
                <button class="btn btn-sm btn-primary rounded-pill" type="button" @click="save">Save</button>
                <button class="btn btn-sm btn-outline-danger rounded-pill" type="button">Save</button>
            </div>
        </div>
    </div>
</template>

<script setup>
import { ref, onMounted } from 'vue'

const tags = ref([]);
const tagName = ref()
const tagDescription = ref()

const save = () => {
    if (tagName.value.length > 0) {
        axios.post('/api/admin/tags', {
            name: tagName.value,
            description: tagDescription.value
        }).then(response => {
            console.log(response)
        })
    }
}

onMounted(() => {
    axios.get(`/api/admin/tags`, { api_token: window.Laravel.apiToken }).then(response => {
        tags.value = response.data
    })
})
</script>
