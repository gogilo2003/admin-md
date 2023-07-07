<template>
    <div>
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
        <div class="tags">
            <div class="tag" v-for="tag in tags" :key="tag.id">
                <div class="details">
                    <div class="name">{{ tag.name }}</div>
                    <div class="desciption">{{ tag.description }}</div>
                </div>
                <div class="tasks">
                    <button class="btn btn-primary btn-link btn-fab" @click="editTag(tag)">
                        <span class="material-icons">edit</span>
                    </button>
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

const editTag = (tag) => {
    selectedTag.value = tag
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
    if (selectedTag.value.name.length > 0) {
        let url = edit.value ? `/api/admin/tags/${selectedTag.id}` : `/api/admin/tags`
        axios.post(url, {
            name: selectedTag.value.name,
            description: selectedTag.value.description
        }).then(response => {
            if (edit.value)
                tags.value.unshift(response.data.tag)

            selectedTag.value.id = null
            selectedTag.value.name = ""
            selectedTag.value.description = ""
            edit.value = false
        })
    }
}

onMounted(() => {
    let access_token = localStorage.getItem('admin_access_token');
    axios.defaults.headers.common['Authorization'] = `Bearer ${access_token}`
    axios.get(`/api/admin/tags`, { api_token: window.Laravel.apiToken }).then(response => {
        tags.value = response.data.data
    })
})
</script>
<style lang="scss">
.tags {
    height: 30vh;
    overflow-y: auto;

    .tag {
        padding: 0.5rem 1rem;
        margin: 1rem 0;
        box-shadow: 4px 4px 4px rgba($color: #000000, $alpha: 0.35);
        position: relative;
        background-color: rgba($color: #000000, $alpha: 0.04);
        width: calc(100% - 20px);

        &:nth-child(odd) {
            background-color: rgba($color: #000000, $alpha: 0.1);
        }

        .details {

            .name {
                font-size: large;
                font-weight: 600;
            }

            .description {
                font-size: small;
                font-weight: 300;
                color: rgba($color: #000000, $alpha: 0.35);
            }
        }

        .tasks {
            position: absolute;
            right: 0;
            top: 0;
        }
    }
}
</style>
